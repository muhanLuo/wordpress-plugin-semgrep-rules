<?php

// redirect should be followed by exit

// ruleid: wp-open-redirect-audit
wp_redirect($_GET["url"]);
exit;


$site = $_REQUEST["site"];
// ruleid: wp-open-redirect-audit
wp_redirect($site);
exit;


// ok: wp-open-redirect-audit
wp_safe_redirect($_REQUEST["url"]); 
exit;

// ok: wp-open-redirect-audit
header("Location: http://www.example.com/");

$bad_site = $_REQUEST["website"];
// ruleid: wp-open-redirect-audit
header("Location: " . $bad_site);

$redirect_url = get_url((int) $_GET["id"]);
// ok: wp-open-redirect-audit
wp_redirect($redirect_url);
?>