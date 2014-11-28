<?php
/**
Plugin Name: Acme Programs
Plugin URI: http://pixelplow.com
Description:  this is the plugin that makes programs happen.
Author: Peter Shackelford
Version: 0.1
Author URI: http://pixelplow.com/
**/

//Registers the degree level taxonomy used by the acmeu program type.
add_action( 'init', 'register_taxonomy_degree_levels' );

function register_taxonomy_degree_levels() {
				$labels = array(
				'name' => _x( 'Degree Levels', 'acmeu_degree_levels' ),
				'singular_name' => _x( 'Degree Level', 'acmeu_degree_levels' ),
				'search_items' => _x( 'Search Degree Levels', 'acmeu_degree_levels' ),
				'popular_items' => _x( 'Popular Degree Levels', 'acmeu_degree_levels' ),
				'all_items' => _x( 'All Degree Levels', 'acmeu_degree_levels' ),
				'parent_item' => _x( 'Parent Degree Level', 'acmeu_degree_levels' ),
				'parent_item_colon' => _x( 'Parent Degree Level:', 'acmeu_degree_levels' ),
				'edit_item' => _x( 'Edit Degree Level', 'acmeu_degree_levels' ),
				'update_item' => _x( 'Update Degree Level', 'acmeu_degree_levels' ),
				'add_new_item' => _x( 'Add New Degree Level', 'acmeu_degree_levels' ),
				'new_item_name' => _x( 'New Degree Level', 'acmeu_degree_levels' ),
				'separate_items_with_commas' => _x( 'Separate degree levels with commas', 'acmeu_degree_levels' ),
				'add_or_remove_items' => _x( 'Add or remove degree levels', 'acmeu_degree_levels' ),
				'choose_from_most_used' => _x( 'Choose from the most used degree levels', 'acmeu_degree_levels' ),
				'menu_name' => _x( 'Degree Levels', 'acmeu_degree_levels' ),
				);

				$args = array(
					'labels' => $labels,
					'public' => true,
					'show_in_nav_menus' => false,
					'show_ui' => true,
					'show_tagcloud' => false,
					'hierarchical' => true,
					'rewrite' => true,
					'query_var' => true,
					'capabilities' => array( 'manage_terms' => 'administrator', 'edit_terms' => 'administrator', 'delete_terms' => 'administrator' ),//This makes it so only the administrator role can add new terms to the degree level taxonomy
				);

				register_taxonomy( 'acmeu_degree_levels', array( 'acmeu_program' ), $args );
}
/**
 * Setting the default terms for program levels
 *
 * @uses    get_terms
 * @uses    wp_insert_term
 * @uses    acmeu_u_program_levels
 * @uses    term_exists
 *
 * @since   1.0
 * @author  Based on WP Theme Tutorial, Curtis McHale
 */
function acmeu_u_program_default_levels(){

				// see if we already have populated any terms
				$level = get_terms( 'acmeu_degree_levels', array( 'hide_empty' => false ) );

				// if no terms then lets add our terms.
				if ( empty( $level ) ){
								$levels = acmeu_u_program_levels();
								foreach ( $levels as $level ){
												if ( ! term_exists( $level['name'], 'acmeu_degree_levels' ) ){
																wp_insert_term( $level['name'], 'acmeu_degree_levels', array( 'slug' => $level['short'] ) );
			}
		}
	}

}
add_action( 'init', 'acmeu_u_program_default_levels' );


/**
 * Returns an array of degree levels with name and slug
 *
 * @return  array
 *
 * @since   1.0
 * @author  Based on WP Theme Tutorial, Curtis McHale
 */
function acmeu_u_program_levels(){//add as many levels as you need here before enabling your plugin.

				$levels = array(
				'0' => array( 'name' => 'Major', 'short' => 'major' ),
				'1' => array( 'name' => 'Minor', 'short' => 'minor' ),
				'2' => array( 'name' => 'Endorsement', 'short' => 'endorsement' ),
				);

				return $levels;
}

add_action( 'init', 'register_cpt_acmeu_program' );// Registers the CPT for acmeu_program

function register_cpt_acmeu_program() {
				/*This first block handles how things appear to users in the admin panel.*/
				$labels = array(
					'name' => _x( 'Programs', 'acmeu_program' ),
					'singular_name' => _x( 'Program', 'acmeu_program' ),
					'add_new' => _x( 'Add New', 'acmeu_program' ),
					'add_new_item' => _x( 'Add New Department', 'acmeu_program' ),
					'edit_item' => _x( 'Edit Program', 'acmeu_program' ),
					'new_item' => _x( 'New Program', 'acmeu_program' ),
					'view_item' => _x( 'View Program', 'acmeu_program' ),
					'search_items' => _x( 'Search Programs', 'acmeu_program' ),
					'not_found' => _x( 'No programs found', 'acmeu_program' ),
					'not_found_in_trash' => _x( 'No programs found in Trash', 'acmeu_program' ),
					'parent_item_colon' => _x( 'Parent Program:', 'acmeu_program' ),
					'menu_name' => _x( 'Programs', 'acmeu_program' ),
				);

				$args = array(
					'labels' => $labels,
					'hierarchical' => true,//This lets us make child posts
					'description' => 'This is an Academic Program at Acme University',
					'supports' => array( 'title', 'editor', 'thumbnail' ),//These are what we will use for title, description and hero graphic.
					'taxonomies' => array( 'acmeu_degree_levels', 'acmeu_disciplines' ),//This is where we connect the program to the taxonomies we will be making later
					'public' => true,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 5,
					'menu_icon' => 'dashicons-awards',//dash icons are a great way to spiff up your content types in the admin menu.
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => array(
							'slug' => 'academics/programs',
							'with_front' => false,
							'feeds' => false,
							'pages' => true,
					),//This rewrite section is what decides where this post type will live. In this example programs will be found at http://sitename.edu/academics/programs/title
					'capability_type' => 'post',
				);

				register_post_type( 'acmeu_program', $args );
}
// Everything above this line was covered in this post: http://pixelplow.com/setting-up-content-types/
function cmb2_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_acmeu_';

	$meta_boxes['program-credits'] = array(
		'id'            => 'program-credits',
		'title'         => __( 'Program Credits', 'cmb2' ),
		'object_types'  => array( 'acmeu_program', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'fields'        => array(
			array(
				'name'       => __( 'Credits', 'cmb2' ),
				'desc'       => __( 'Enter a number. This will be displayed as "34 Credits"', 'cmb2' ),
				'id'         => $prefix . 'program-credits',
				'type'       => 'text_small'
			)
		)
	);

	return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
