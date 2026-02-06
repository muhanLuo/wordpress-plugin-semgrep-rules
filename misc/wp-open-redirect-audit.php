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
// safe redirect
wp_safe_redirect($_REQUEST["url"]); 
exit;
?>