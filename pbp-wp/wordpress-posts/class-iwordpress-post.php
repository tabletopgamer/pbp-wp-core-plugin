<?php
namespace PbP_WP\WordPress_Posts;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface IWordPress_Post {
    /**
     * @return int
     */
    function get_id();

    /**
     * @return string
     */
    function get_type();

    /**
     * @return string
     */
    function get_title();

    /**
     * @return string
     */
    function get_content();
}
