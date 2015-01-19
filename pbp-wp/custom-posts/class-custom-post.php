<?php
/**
 * User: tabletopgamer
 * Date: 19.01.2015
 * Time: 19:20
 */

namespace PbP_WP\Custom_Posts;


use PbP_WP\WordPress_Posts\IWordPress_Post;

class Custom_Post implements ICustom_Post {
	/**
	 * @var IWordPress_Post
	 */
	private $post;
	/**
	 * @var array
	 */
	private $fields;

	/**
	 * @param IWordPress_Post $post
	 * @param array $fields
	 */
	public function __construct( IWordPress_Post $post, array $fields ) {

		$this->post   = $post;
		$this->fields = $fields;
	}

	/**
	 * @return string
	 */
	function get_type() {
		return $this->get_type();
	}

	/**
	 * @return array
	 */
	function get_fields() {
		return $this->fields;
	}

	/**
	 * @return int
	 */
	function get_id() {
		return $this->post->get_id();
	}

	/**
	 * @return string
	 */
	function get_title() {
		return $this->post->get_title();
	}

	/**
	 * @return string
	 */
	function get_content() {
		return $this->post->get_content();
	}
}
