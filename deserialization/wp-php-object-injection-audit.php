<?php

// ruleid: wp-php-object-injection-audit
$content = unserialize($_POST['post_content']);

$rank_value = $_GET['param'];
$cookie = $_COOKIE['session'];
// ruleid: wp-php-object-injection-audit
$rank_math=unserialize($rank_value);

// ruleid: wp-php-object-injection-audit
$import_options = maybe_unserialize($cookie);

// ok: wp-php-object-injection-audit
$data = serialize($cookie);

// ok: wp-php-object-injection-audit
unserialize( $_POST["data"], ['allowed_classes' => false] );


$post_id = get_post(intval($_POST["id"])); 
// ok: wp-php-object-injection-audit
$post_info = maybe_unserialize($post_id);
?>