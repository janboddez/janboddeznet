<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = apply_filters( 'the_content', $obj->post_content );

$shortlink = wp_get_shortlink( $obj->ID );
if ( ! empty( $shortlink ) ) {
	$permalink = $shortlink;
} else {
	$permalink = get_permalink( $obj );
}

// (Strip tags and) shorten.
$content  = wp_trim_words( $content, 25, ' […]' ); // Also strips all HTML.
// Prepend the title.
$content  = '<p><strong>' . get_the_title( $obj ) . '</strong></p><p>' . $content . '</p>';
// Append a permalink.
$content .= '<p>(<a href="' . esc_url( $permalink ) . '">' . esc_html( $permalink ) . '</a>)</p>';

echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
