<?php

/*
Plugin Name: Anthologize HTML
Description: Demo HTML exporter for Anthologize

*/
require_once(WP_PLUGIN_DIR. '/anthologize/anthologize.php');
require_once(WP_PLUGIN_DIR. '/anthologize/includes/class-format-api.php');

anthologize_register_format( 'html', __( 'HTML', 'anthologize' ), WP_PLUGIN_DIR . '/anthologizehtml/output.php' );
$fontSizes = array('48pt'=>'48 pt', '36pt'=>'36 pt', '18pt'=>'18 pt', '14'=>'14 pt', '12'=>'12 pt');
anthologize_register_format_option( 'html', 'font-size', __( 'Font Size', 'anthologize' ), 'dropdown', $fontSizes, '14pt' );


anthologize_register_format_option( 'html', 'download', __('Download HTML?', 'anthologize'), 'checkbox', array('Download'=>'download'), 'download');
?>
