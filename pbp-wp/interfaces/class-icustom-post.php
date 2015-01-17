<?php
namespace PbP_WP\Interfaces;
use PbP_WP\Custom_Posts\Custom_Post_Field;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface ICustom_Post {
    /**
     * @return int
     */
    function get_id();

    /**
     * @return string
     */
    function get_type();

    /**
     * @return Custom_Post_Field[]
     */
    function get_fields();
}
