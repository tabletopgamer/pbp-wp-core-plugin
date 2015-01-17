<?php
namespace PbP_WP\Interfaces;

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
}
