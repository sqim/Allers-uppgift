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

/*Here we define filepaths*/

if (!defined('ABSPATH')) exit;
define('PLUGIN_BASE_URL', plugins_url('allers') . '/'); 
define('PLUGIN_BASE_DIR_LONG', dirname(__FILE__));

/*Including custom post type*/
require_once(PLUGIN_BASE_DIR_LONG . '/custom.php');
/*Load widget*/
require_once(PLUGIN_BASE_DIR_LONG . '/class/class.widget.php');
?>