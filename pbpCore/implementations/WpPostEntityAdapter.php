<?php
/**
 * @package core
 * 
 * Adapter class for WP_Post entity class
 */

namespace pbpCore\implementations;
use pbpCore\interfaces\IEntity;

class WpPostEntityAdapter implements IEntity{
    
    private $id;
    private $title;
    private $contents;
    
    /**
     * @param \WP_Post $wpPost
     */
    public function __construct(\WP_Post $wpPost) {
        if ($wpPost == NULL || !is_a($wpPost, "WP_Post")) {
            throw new InvalidArgumentException("'wpPost' must be a valid WP_Post" );
        }

        if ($wpPost != NULL) {
            $this->id = $wpPost->ID;
            $this->title = $wpPost->post_title;
            $this->contents = $wpPost->post_content;
        }
    }
    
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getContents() {
        return $this->contents;
    }
}
