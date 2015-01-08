<?php

class PbpGameCustomPost {

    static function register_game_custom_post() {

        $postType = 'tabletop_game';

        $labels = array(
            'name' => _x('Game', $postType),
            'singular_name' => _x('Game', $postType),
            'add_new' => _x('Add new', $postType),
            'add_new_item' => _x('Add new Game', $postType),
            'edit_item' => _x('Edit Game', $postType),
            'new_item' => _x('New Game', $postType),
            'view_item' => _x('View Game', $postType),
            'search_items' => _x('Search Games', $postType),
            'not_found' => _x('No Games Found', $postType),
            'not_found_in_trash' => _x('No Games found in Trash', $postType),
            'parent_item_colon' => _x('Games', $postType),
            'menu_name' => _x('Tabletop Games', $postType),
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'Tabletop Game',
            'supports' => array('title', 'editor', 'author', 'thumbnail',
                'revisions',
                'page-attributes', 'comments'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book-alt',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type($postType, $args);
    }

    /** add a comment */
    function create_pbp_core_game_pages() {
        $postType = 'tabletop_game';

        $post = array(
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_date' => date('Y-m-d H:i:s'),
            'post_name' => $postType,
            'post_status' => 'publish',
            'post_title' => 'Games',
            'post_type' => 'page',
        );
        //insert page and save the id
        $newvalue = wp_insert_post($post, false);
        
        //save the id in the database
        update_option('mrpage', $newvalue);
    }

    static function init() {

        add_action('init', array(__CLASS__, 'register_game_custom_post'));
        
        // Activates function if plugin is activated
        // register_activation_hook(__FILE__, 'create_pbp_core_game_pages');
    }

}
