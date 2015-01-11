<?php

/**
 * Description of PbpCustomPostRegister
 *
 * @author tabletopgamer
 */
abstract class PbP_Custom_Post {
     
    abstract protected function get_singular_name();
    abstract protected function get_plural_name();
    abstract protected function get_post_type();
        
    public function register_custom_post() {

        $singularName = $this->get_singular_name() ;
        $pluralName = $this->get_plural_name();
        $postType = $this->get_post_type();
       
        $labels = array(
            'name'			=> _x( $singularName, $postType ),
            'singular_name' => _x( $singularName, $postType ),
            'add_new'		=> _x( 'Add new', $postType ),
            'add_new_item'	=> _x( 'Add new ' . $singularName, $postType ),
            'edit_item'		=> _x( 'Edit ' . $singularName, $postType ),
            'new_item'		=> _x( 'New ' . $singularName, $postType ),
            'view_item'		=> _x( 'View ' . $singularName, $postType ),
            'search_items'	=> _x( 'Search ' . $pluralName, $postType ),
            'not_found'		=> _x( 'No ' . $pluralName . ' Found', $postType ),
            'not_found_in_trash' => _x( 'No ' . $pluralName . ' found in Trash', $postType ),
            'parent_item_colon'	 => _x( $pluralName, $postType ),
            'menu_name'			 => _x( $pluralName, $postType ),
        );

        $args = array(
            'capability_type'		=> 'post',
            'show_in_nav_menus'		=> true,
            'publicly_queryable'	=> true,
            'exclude_from_search'	=> false,
            'labels'		=> $labels,
            'hierarchical'	=> true,
            'description'	=> $pluralName,
            'public'		=> true,
            'show_ui'		=> true,
            'show_in_menu'	=> true,
            'menu_position' => 5,
            'menu_icon'		=> 'dashicons-book-alt',
            'has_archive'	=> true,
            'query_var'		=> true,
            'can_export'	=> true,
            'rewrite'		=> true,
            'supports'		=> array( 
				'title', 'editor', 'author', 'thumbnail',
                'revisions', 'page-attributes', 'comments' ),
        );

        register_post_type( $postType, $args );
    }

    public function init() {
        add_action( 'init', array( $this, 'register_custom_post' ) );
    }
}
