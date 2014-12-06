<?php
/**
Plugin Name: Acme Programs
Depends: CMB2 (beta)
Plugin URI: http://pixelplow.com
Description:  This is the plugin that makes programs happen.
Author: Peter Shackelford
Version: 0.1
Author URI: http://pixelplow.com/
**/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type taxonomies and metaboxes.
require plugin_dir_path( __FILE__ ) . 'includes/program-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/program-post-type-metaboxes.php';
	//Registers the degree level taxonomy used by the acmeu program type.

/**
File structure loosly based on devinsays white label Team Post Type found here:https://github.com/devinsays/team-post-type
His example uses classes and object oriented programing. I am not going to pretend I grasp all the ins and outs of OOP so this tutorial will mainly be procedural. 
Keeping your metabox code in one place and your post type/taxonomy registration in another will make it easier to manage when you find that you need more
**/