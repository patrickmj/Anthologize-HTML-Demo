<?php

/*
Plugin Name: Anthologize HTML
Description: Demo HTML exporter for Anthologize

*/
require_once(WP_PLUGIN_DIR. '/anthologize/anthologize.php');
require_once(WP_PLUGIN_DIR. '/anthologize/includes/class-format-api.php');

anthologize_register_format( 'html', __( 'HTML', 'anthologize' ), WP_PLUGIN_DIR . '/anthologizehtml/output.php' );
anthologize_register_format_option( 'html', 'font-size', __( 'Font Size', 'anthologize' ), 'dropdown', array('14'=>'14 pt', '12'=>'12 pt'), '14pt' );

$avatarSizes = array('48'=>'48 px', '60'=>'60 px', '72'=>'72 px', '84'=>'84 px', '96'=>'96 px', '108'=>'108 px');

anthologize_register_format_option( 'html', 'avatar-size', __( 'Avatar Size', 'anthologize' ), 'dropdown', $avatarSizes, '72' );

?>
