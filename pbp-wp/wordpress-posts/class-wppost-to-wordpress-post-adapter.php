<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 17:52
 */

namespace PbP_WP\WordPress_Posts;


class WPPost_To_WordPress_Post_Adapter implements IWordPress_Post{
	/**
	 * @var \WP_Post
	 */
	private $post;

	/**
	 * @param \WP_Post $post
	 */
	public function __construct(\WP_Post $post){

		$this->post = $post;
	}

	/**
	 * @return int
	 */
	function get_id() {
		return $this->post->ID;
	}

	/**
	 * @return string
	 */
	function get_type() {
		return $this->post->post_type;
	}

	/**
	 * @return string
	 */
	function get_title() {
		return $this->post->post_title;
	}

	/**
	 * @return string
	 */
	function get_content() {
		return $this->post->post_content;
	}
}