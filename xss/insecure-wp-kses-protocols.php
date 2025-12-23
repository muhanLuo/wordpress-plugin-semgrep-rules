<?php

// ruleid: insecure-wp-kses-protocols
echo wp_kses($string, array( 'a' => array ('href' => true)), ["http", "javascript", "https"]);

// ok: insecure-wp-kses-protocols
echo wp_kses($string, array( 'a' => array ('href' => true)), ["http", "ftp", "https"]);

// ok: insecure-wp-kses-protocols
echo wp_kses('<style>' . $style_information . '</style>', array('style' => array()));

// ruleid: insecure-wp-kses-protocols
$protocols = ["http", "javascript", "https"];

if (1 == 1)
{
    echo "Random text";
}

echo wp_kses($string, array( 'strong' => array()), $protocols);

// ok: insecure-wp-kses-protocols
$protocols = ["http", "ftp", "https"];

echo wp_kses($string, array( 'img' => array('src')), $protocols);

?>