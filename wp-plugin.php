<?php
/*
Plugin Name: wp-plugin
Plugin URI: 
Description: A plugin that creates and shows custom post types
Version: 1
Author: Simon Quick
Author URI: 
License: 
*/
?>
<?php

/*Här definierar vi filvägar*/

if (!defined('ABSPATH')) exit;
define('PLUGIN_BASE_URL', plugins_url('allers') . '/'); 
define('PLUGIN_BASE_DIR_LONG', dirname(__FILE__));

/*Här laddar vi in pluginens filer*/

/*Ladda in custom post type*/
require_once(PLUGIN_BASE_DIR_LONG . '/custom.php');
/*Ladda in widget*/
require_once(PLUGIN_BASE_DIR_LONG . '/widget.php');
?>