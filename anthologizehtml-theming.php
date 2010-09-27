<?php

/*
Plugin Name: Anthologize HTML -- theming
Description: Demo HTML exporter for Anthologize using theming functions

*/
require_once(WP_PLUGIN_DIR. '/anthologize/anthologize.php');
require_once(WP_PLUGIN_DIR. '/anthologize/includes/class-format-api.php');

anthologize_register_format( 'html_theming', __( 'HTML theming', 'anthologize' ), WP_PLUGIN_DIR . '/anthologizehtml-theming/output.php' );
$fontSizes = array('48pt'=>'48 pt', '36pt'=>'36 pt', '18pt'=>'18 pt', '14'=>'14 pt', '12'=>'12 pt');
anthologize_register_format_option( 'html_theming', 'font-size', __( 'Font Size', 'anthologize' ), 'dropdown', $fontSizes, '14pt' );


anthologize_register_format_option( 'html_theming', 'download', __('Download HTML?', 'anthologize'), 'checkbox', array('Download'=>'download'), 'download');
?>
