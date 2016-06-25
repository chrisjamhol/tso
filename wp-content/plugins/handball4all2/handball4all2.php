<?php
/*
Plugin Name: Handball4All2
Description: TSO Plugin für Spielergebnisse
Author: Christopher Holden
*/

/* block direct requests */
if ( !function_exists( 'add_action' ) ) {
	echo 'Hello, this is a plugin: You must not call me directly.';
	exit;
}
defined('ABSPATH') OR exit;

if(!class_exists('handball4all2')){
 require_once plugin_dir_path( __FILE__ ) . '/handball4all2.php';
}

$Handball4All2 = new Handball4All2();

?>