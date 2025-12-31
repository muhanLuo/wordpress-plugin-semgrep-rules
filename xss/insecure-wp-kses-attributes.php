<?php

// ruleid: insecure-wp-kses-attributes
$allowed_tags = array(
				'svg'    => array(
					'style'       => array(),
					'version'     => true,
					'xmlns'       => true,
					'xlink:href' => true,
				),
				'defs'   => array(),
				'symbol' => array(
					'id'      => true,
					'viewbox' => true,
				),
				'path'   => array(
					'd'     => true,
					'style' => true,
				),
			);

if (1 == 0) {
	return 0;
}

echo wp_kses( $svg_contents, $allowed_tags, $bla );

// ok: insecure-wp-kses-attributes
$allowed_tags2 = array(
				'svg'    => array(
					'style'       => array()
				),
				'defs'   => array(),
				'symbol' => array(
					'id'      => true,
					'viewbox' => true,
				),
				'path'   => array(
					'd'     => true,
					'style' => true,
				),
			);

if (1 == 0) {
	return 0;
}

echo wp_kses( $svg_contents, $allowed_tags2, $bla );

// ruleid: insecure-wp-kses-attributes
wp_kses($response['error'], [ 'a' => [ 'onload' => [], 'target' => [], ],]);

function plugin_footer() {
        $string = "<img src=123 onerror=alert(document.domain)>";
		// ruleid: insecure-wp-kses-attributes
        echo wp_kses($string, array( 'img' => array ('src' => array(), 'onerror' => array())));
}

add_action('wp_footer', 'plugin_footer');

// ok: insecure-wp-kses-attributes
echo wp_kses($string, array( 'a' => array ('href' => array())));

?>