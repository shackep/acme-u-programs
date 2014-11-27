<?php
/*
Plugin Name: Acme Programs
Plugin URI: http://pixelplow.com
Description:  this is the plugin that makes programs happen.
Author: Peter Shackelford
Version: 0.1
Author URI: http://pixelplow.com/
*/
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
        'query_var' => true
    );

    register_taxonomy( 'acmeu_degree_levels', array('acmeu_program'), $args );
}
add_action( 'init', 'register_cpt_acmeu_program' );

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
        'taxonomies' => array('acmeu_degree_levels','acmeu_disciplines'),//This is where we connect the program to the taxonomies we will be making later
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
             'pages' => true
        ),//This rewrite section is what decides where this post type will live. In this example programs will be found at http://sitename.edu/academics/programs/title
        'capability_type' => 'post'
    );

    register_post_type( 'acmeu_program', $args );
}

