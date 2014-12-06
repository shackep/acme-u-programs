<?php
// Everything above this line was covered in this post: http://pixelplow.com/setting-up-content-types/
//What follows is dependant on having the CMB2 (Custom Meta Box 2) plugin installed and enabled. It can be found here: https://github.com/WebDevStudios/CMB2 and here: https://wordpress.org/plugins/cmb2/
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
	$meta_boxes['field_group'] = array(
		'id'           => 'field_group',
		'title'        => __( 'Program Emphases', 'cmb2' ),
		'object_types' => array( 'acmeu_program', ),
		'fields'       => array(
			array(
				'id'          => $prefix . 'repeat_group',
				'type'        => 'group',
				'description' => __( 'Method for listing multiple things to expect from this program. This may include approach/philosophy, learning environment or hands on esperience.', 'cmb2' ),
				'options'     => array(
					'group_title'   => __( 'Program Emphases {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another', 'cmb2' ),
					'remove_button' => __( 'Remove this one', 'cmb2' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Title',
						'id'   => 'title',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Description',
						'description' => 'Write a short description for this entry',
						'id'   => 'description',
						'type' => 'textarea_small',
					),
				),
			),
		),
	);
	return $meta_boxes;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );