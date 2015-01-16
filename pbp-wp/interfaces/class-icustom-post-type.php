<?php
namespace PbP_WP\Interfaces;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface ICustom_Post_Type {
    function get_singular_name();
    function get_plural_name();
    function get_post_type();
    function get_fields();
}
