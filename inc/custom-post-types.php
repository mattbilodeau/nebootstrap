<?php 

// Custom Post Types

// Create Case studies custom post type
add_action( 'init', 'create_case_studies_post_type' );
function create_case_studies_post_type() {

    register_post_type( 'case_studies',
        array(
            'labels' => array(
                'name'          => __( 'Case Studies', 'zenagency' ),
                'singular_name' => __( 'Case Study', 'zenagency' ),
            ),
            'has_archive'  => true,
            'hierarchical' => true, 
            'menu_icon'    => 'dashicons-admin-page',
            'public'       => true,
            'rewrite'      => array( 'slug' => 'case_studies', 'with_front' => false ),
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),

        )
    );
    
}

// Create Case studies Cats custom taxonomy
add_action( 'init', 'create_case_studies_cat_taxonomy' );
function create_case_studies_cat_taxonomy() {

    register_taxonomy( 'case_studies_cat', 'case_studies',
        array(
            'labels' => array(
                'name'          => _x( 'Case Study Category', 'taxonomy general name', 'zenagency' ),
                'add_new_item'  => __( 'Add New Case Study Category', 'zenagency' ),
                'new_item_name' => __( 'New Case Study Category', 'zenagency' ),
            ),
            'exclude_from_search' => true,
            'has_archive'         => true,
            'hierarchical'        => true,
            'rewrite'             => array( 'slug' => 'case_studies_cat', 'with_front' => false ),
            'show_ui'             => true,
            'show_tagcloud'       => false,
        )
    );

}

// Create Certifications and qualifications custom post type
add_action( 'init', 'create_certifications_post_type' );
function create_certifications_post_type() {

    register_post_type( 'certifications',
        array(
            'labels' => array(
                'name'          => __( 'Certifications/ Qualifications', 'zenagency' ),
                'singular_name' => __( 'Certification/Qualification', 'zenagency' ),
            ),
            'has_archive'  => true,
            'hierarchical' => true, 
            'menu_icon'    => 'dashicons-admin-page',
            'public'       => true,
            'rewrite'      => array( 'slug' => 'certifications', 'with_front' => false ),
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),

        )
    );
    
}


// Create Partners custom post type
add_action( 'init', 'create_partners_post_type' );
function create_partners_post_type() {

    register_post_type( 'partners',
        array(
            'labels' => array(
                'name'          => __( 'Partners', 'zenagency' ),
                'singular_name' => __( 'Partner', 'zenagency' ),
            ),
            'has_archive'  => true,
            'hierarchical' => true, 
            'menu_icon'    => 'dashicons-admin-page',
            'public'       => true,
            'rewrite'      => array( 'slug' => 'partners', 'with_front' => false ),
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),

        )
    );
    
}


// Create Our Team custom post type
add_action( 'init', 'create_team_post_type' );
function create_team_post_type() {

    register_post_type( 'our_team',
        array(
            'labels' => array(
                'name'          => __( 'Our Team', 'zenagency' ),
                'singular_name' => __( 'Team', 'zenagency' ),
            ),
            'has_archive'  => true,
            'hierarchical' => true, 
            'menu_icon'    => 'dashicons-admin-page',
            'public'       => true,
            'rewrite'      => array( 'slug' => 'our_team', 'with_front' => false ),
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),

        )
    );
    
}

