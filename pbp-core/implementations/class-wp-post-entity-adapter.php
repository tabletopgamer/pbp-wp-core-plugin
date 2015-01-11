<?php
namespace PbP_Core\Implementations;

use PbP_Core\Interfaces\Entity_Interface;

/**
 * @package core
 * 
 * Adapter class for WP_Post entity class
 */
class WP_Post_Entity_Adapter implements Entity_Interface{
    
    private $id;
    private $title;
    private $contents;
    
    /**
     * @param \WP_Post $wpPost
     */
    public function __construct( \WP_Post $wpPost ) {
        if ($wpPost == NULL || !is_a($wpPost, 'WP_Post')) {
            throw new InvalidArgumentException( 'wpPost must be a valid WP_Post' );
        }

        if ( $wpPost != NULL ) {
            $this->id = $wpPost->ID;
            $this->title = $wpPost->post_title;
            $this->contents = $wpPost->post_content;
        }
    }
    
    
    public function get_id() {
        return $this->id;
    }
    
    public function get_title() {
        return $this->title;
    }

    public function get_contents() {
        return $this->contents;
    }
}
