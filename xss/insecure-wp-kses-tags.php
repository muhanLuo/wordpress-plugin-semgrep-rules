<?php


// ruleid: insecure-wp-kses-tags
$allowed_tags = array(
				'svg'    => array(
					'style'       => true,
					'version'     => true,
					'xmlns'       => true,
					'xmlns:xlink' => true,
				),
				'iframe'   => array(),
				'symbol' => array(
					'id'      => true,
					'viewbox' => true,
				)
			);

echo wp_kses( $svg_contents, $allowed_tags);

$string = wp_unslash( $_POST['text'] );

// ok: insecure-wp-kses-tags
$allowed_html = array(
	'a' => array(
		'href'  => true,
		'title' => true,
	),
	'br'     => array(),
	'em'     => array(),
	'svg' => array()
);

$text = wp_kses( $string, $allowed_html );

echo $text;

// ok: insecure-wp-kses-tags
$content = wp_kses($this->content, array(
        'em'    => array(),
        'strong'=> array(),
        'u'     => array(),
        'a'     => array(
          'href'  => array(),
          'title' => array()
        )
      ));

// ruleid: insecure-wp-kses-tags
$content = wp_kses($this->content, array(
        'em'    => array(),
        'script'=> array(),
        'u'     => array(),
        'a'     => array(
          'href'  => array(),
          'title' => array()
        )
      ));

?>