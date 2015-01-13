<?php
namespace PbP_WP\Interfaces;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface PbP_WP_Post_Type_Interface {
    function get_singular_name();
    function get_plural_name();
    function get_post_type();
}
