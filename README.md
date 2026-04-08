# Semgrep Rules for WordPress Plugins

This list contains Semgrep rules written to find common security vulnerabilities in WordPress Plugins.

These rules are primarily based off the following resources:

- [WordFence - Common WordPress Vulnerabilities and Prevention Through Secure Coding Best Practices](https://www.wordfence.com/wp-content/uploads/2021/07/Common-WordPress-Vulnerabilities-and-Prevention-Through-Secure-Coding-Best-Practices.pdf)
- [WordFence - Alex Thomas' articles](https://www.wordfence.com/blog/author/wfalext/)
- [PatchStack Academy](https://patchstack.com/academy/welcome/)

## Example Usage

```sh
git clone https://github.com/muhanLuo/wordpress-plugin-semgrep-rules.git

semgrep login

semgrep scan --config="p/php" --config ./wordpress-plugin-semgrep-rules/ --metrics=off --timeout 60 --dataflow-traces --sarif --output scan_results.sarif ./plugin-directory/
```

**Explanation**

- ``--config="p/php"``: Configures Semgrep to scan with the [default PHP ruleset](https://semgrep.dev/p/php)
- ``--config ./wordpress-plugin-semgrep-rules/``: Configures Semgrep to also scan with the rules in this specific directory.
- ``--metrics=off``: Disables metrics from being sent to the Semgrep server.
- ``--timeout 60``: Max amount of time (in seconds) a rule spends on a single file.
- ``--dataflow-traces``: Causes Semgrep to output detailed data flow for rules which performs [sources to sinks](https://www.youtube.com/watch?v=ZaOtY4i5w_U) analysis such as [``wp-php-object-injection-audit.yml``](https://github.com/muhanLuo/wordpress-plugin-semgrep-rules/blob/main/deserialization/wp-php-object-injection-audit.yml).
- ``--sarif``: Outputs results in SARIF format, which is a standard output format for static analysis tools.
- ``--output scan_results.sarif``: File where the output will be saved
- ``./plugin-directory/``: Directory to scan

Additional CLI information for Semgrep can be found [here](https://semgrep.dev/docs/cli-reference).
## 5 Tips to Get the Most out of the Rules

### 1. Test the Rules out Before You Run

Semgrep often makes [changes](https://semgrep.dev/docs/release-notes) to their engine, and sometimes this can break the rules. Run this command in ``wordpress-plugin-semgrep-rules/`` before these rules are ran to ensure that the rules work.

```sh
semgrep scan -v --config . --test .
```

 Consider downgrading your version of Semgrep if these rules suddenly stop working after updating to a newer version.
### 2. Create a Semgrep Account

While almost all of the rules in this repository can be run without a Semgrep account, ``wp-ajax-hook-missing-auth`` cannot be run without being logged-in since it uses [join mode](https://semgrep.dev/docs/writing-rules/experiments/join-mode/overview), which is an experimental feature in Semgrep.

After creating an account, simply run ``semgrep login`` in your CLI.
### 3. Run these rules alongside Semgrep's PHP ruleset

The rules in the current repository only covers certain WordPress-specific issues. For a more thorough scan, combine the rules in this repository with [Semgrep's PHP ruleset](https://semgrep.dev/p/php).

*Side note: Semgrep also has a [WordPress ruleset](https://semgrep.dev/p/wordpress), but I don't think those rules are very good as of writing in April 2026.*
### 4. Set a longer ``--timeout``

When running these rules in Semgrep, you may want to set a longer timeout using the following argument ``--timeout``. Some of these rules do take a bit longer to run and can sometimes timeout on larger files.
### 5. Use SARIF Explorer

Trail of Bits' VSCode extension [SARIF Explorer](https://github.com/trailofbits/vscode-sarif-explorer) is extremely useful for reviewing the output of the scan. The extension offers a lot of great features such as:

- Easy browsing and navigation of findings
- The ability to mark findings as false positives, already reviewed, or true vulnerabilities.
- A search and filter feature for the Semgrep output. 

![Alt text for screen readers](https://raw.githubusercontent.com/trailofbits/vscode-sarif-explorer/refs/heads/main/media/README/main_cropped.png)


## Rule Description

### Deserialization

| Rule(s)                           | Description                                                                                                                                                                                                                                                    |
| --------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ``wp-php-object-injection-audit`` | Identifies data flows from user input to ``unserialize()`` or ``maybe_unserialize()``. <br><br>For more information, see this [article](https://patchstack.com/academy/wordpress/vulnerabilities/php-object-injection/) by Patchstack on PHP Object Injection. |
### Missing Authorization

| Rule(s)                                | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| -------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ``wp-ajax-hook-missing-auth``          | **⚠️You must login to run this rule because [this rule uses ``join mode``](https://semgrep.dev/docs/writing-rules/experiments/join-mode/overview), which is an experimental feature only available to logged in users.**<br><br>Finds AJAX hooks whose callbacks don't perform capability or nonce checks.<br><br>For more information, read [this article from WordFence](https://www.wordfence.com/blog/2023/02/authorization-vs-intent-why-you-should-always-verify-both/). This rule was inspired by [Brandon Roldan](https://noob3xploiter.medium.com/automating-csrf-detection-in-wordpress-plugins-with-semgrep-52ece2c212b7).<br><br>*Side note: Don't run this rule on [too many plugins at once](https://semgrep.dev/docs/kb/semgrep-code/scan-engine-kill), this rule seems to use a lot of memory. In my experience, running this rule on too many plugins (a couple hundred) can cause your computer to crash.* |
| ``wp-return-true-register-rest-route`` | Finds uses of ``register_rest_route()``  where ``'permission_callback' => '__return_true'``. This means that the associated callback doesn't include any authorization checks.<br><br>More information on the ``register_rest_route()`` function can be found here on [WPKama](https://wp-kama.com/function/register_rest_route).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| ``wp-missing-auth-rest-route-*``       | Find uses of ``register_rest_route()`` uses where the callback function in ``'permission_callback'`` doesn't include ``current_user_can()``. This means that this REST route likely doesn't perform authorization checks.<br><br>More information on the ``register_rest_route()`` function can be found here on [WPKama](https://wp-kama.com/function/register_rest_route).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| ``wp-missing-direct-access-check``     | Finds PHP files which do not prevent a user from directly navigating to the file via the URL. Marks All PHP files which do not call ``defined( 'ABSPATH' )``.<br><br>Further reading here from [Notes on Tech](https://notesontech.com/preventing-direct-access-to-php-files-in-wordpress/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |

### Cross-site Scripting (XSS)

| Rule(s)              | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| -------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ``wp-reflected-xss`` | Identifies data flows from the ``$_GET`` or ``$_REQUEST`` superglobal to a function which prints strings such as ``echo()``, ``print()``, ``printf()``, ect... Excludes all findings where data flows through a sanitizer such as ``esc_attr()`` or ``wp_kses()``.<br><br>For more information, see this article by WordFence on [how to find XSS vulnerabilities in WordPress plugins](https://www.wordfence.com/blog/2024/09/how-to-find-xss-cross-site-scripting-vulnerabilities-in-wordpress-plugins-and-themes/). |

### Miscellaneous

| Rule(s)                    | Description                                                                                                                                                                                                                                                    |
| -------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ``wp-open-redirect-audit`` | Identifies data flows from the ``$_GET`` or ``$_REQUEST`` superglobal to ``wp_redirect()`` or ``header()``. <br><br>To learn more, read the following article [here](https://patchstack.com/academy/wordpress/vulnerabilities/open-redirect/) from Patchstack. |

