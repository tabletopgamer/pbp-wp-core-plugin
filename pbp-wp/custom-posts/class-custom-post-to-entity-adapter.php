<?php
namespace PbP_WP\Custom_Posts;

use PbP_Core\Repository\Entity_Type;
use PbP_Core\Repository\IEntity;

/**
 * @package wordpress-specific
 *
 * Adapter class for WP_Post entity class
 */
class Custom_Post_To_Entity_Adapter implements IEntity {

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
		if ( $wpPost == null ) {
			throw new \InvalidArgumentException( 'wpPost must be a valid WP_Post' );
		}

		if ( $wpPost != null ) {
			$this->id       = $wpPost->ID;
			$this->title    = $wpPost->post_title;
			$this->contents = $wpPost->post_content;
			$this->type     = $wpPost->post_type;
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
