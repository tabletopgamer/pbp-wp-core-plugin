<?php
namespace PbP_WP\Custom_Posts;
use PbP_WP\Custom_Posts\Custom_Field;


/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface ICustom_Post_Type {
    /**
     * @return string
     */
    function get_type_name();

    /**
     * @return array[]
     */
    function get_post_fields();
}
