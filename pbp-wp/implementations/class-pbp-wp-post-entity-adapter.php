<?php
namespace PbP_WP\Implementations;

use PbP_Core\Interfaces\Entity_Type;
use PbP_Core\Interfaces\Entity_Interface;

/**
 * @package wordpress-specific
 * 
 * Adapter class for WP_Post entity class
 */
class PbP_WP_Post_Entity_Adapter implements Entity_Interface{
    
	/**
	 * @var int
	 */
    private $id;
	
	/**
	 * @var Entity_Type
	 */
	private $type;
	
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
			$this->type = new Entity_Type($wpPost->post_type);
        }
    }
    
    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }
	
	/**
     * @return Entity_Type
     */
	public function get_type() {
		return $this->type;
	}
    
    
}
