# 🇼 Semgrep Rules for WordPress Plugins

This is a list of Semgrep rules I've personally written to help me find security vulnerabilities in WordPress Plugins. 

*Note: When running these rules in Semgrep, you may want to set a longer timeout using the following argument ``--timeout 30``. Some of these rules do take a bit longer to run and can sometimes timeout on larger plugins.*

A big thanks to WordFence for providing so much free educational material on WordPress plugin security. Many of these rules are based off the following document they created: [Common WordPress Vulnerabilities and Prevention
Through Secure Coding Best Practices](https://www.wordfence.com/wp-content/uploads/2021/07/Common-WordPress-Vulnerabilities-and-Prevention-Through-Secure-Coding-Best-Practices.pdf)

## Rules

### Missing Authorization

1. **``wp-hook-missing-auth-class-method``, ``wp-hook-missing-auth-closures``, and ``wp-hook-missing-auth-functions``**
    - Finds callback functions that don't use ``current_user_can()`` in their function body. These rules only focus on callbacks called by ``add_action()`` and only if the hook name passes the following regex ``(wp_ajax_.*|admin_init|admin_post_.*|admin_action_.*|profile_update|personal_options_update|admin_menu)``.
    - More Info: [(Pages 5-11 of this document)](https://www.wordfence.com/wp-content/uploads/2021/07/Common-WordPress-Vulnerabilities-and-Prevention-Through-Secure-Coding-Best-Practices.pdf)
2. **``wp-return-true-register-rest-route``**
    - Finds  uses of ``register_rest_route()`` uses where ``'permission_callback' => '__return_true'``.
    - More Info: [WP-Kama](https://wp-kama.com/function/register_rest_route)

### Cross-Site Request Forgery (CSRF)

1. **``wp-hook-missing-csrf-protection-class-method``, ``wp-hook-missing-csrf-protection-closures``, ``wp-hook-missing-csrf-protection-functions``**:
    - Finds callback functions that don't use ``wp_verify_nonce()``, ``check_ajax_referer()``, or ``check_admin_referer()`` in their function body. These rules only focus on callbacks called by ``add_action()`` and only if the hook name passes the following regex ``(wp_ajax_.*|admin_init|admin_post_.*|admin_action_.*|profile_update|personal_options_update|admin_menu)``.
    - More Info: [(Pages 12-14 of this document)](https://www.wordfence.com/wp-content/uploads/2021/07/Common-WordPress-Vulnerabilities-and-Prevention-Through-Secure-Coding-Best-Practices.pdf)

### Misc

1. **``wp-missing-direct-access-check``**
    - Finds files which do not prevent direct access. Checking for direct access usually involves verifying that a constant like ``ABSPATH`` or ``WPINC`` exists.
    - More info: [Notes on Tech](https://notesontech.com/preventing-direct-access-to-php-files-in-wordpress/)

## Update History 

### 12/13/2025

- Created repository and added rules
