<?php
namespace PbP_Game_Posts;

use PbP_Core\Interfaces\PbP_Custom_Post;

class PbP_Game_Custom_Post extends PbP_Custom_Post {

    protected function get_post_type() {
        return 'tabletop_game';        
    }

    protected function get_singular_name() {
        return 'PbP Game';
    }
        
    protected function get_plural_name() {
        return 'PbP Games';
    }

}
