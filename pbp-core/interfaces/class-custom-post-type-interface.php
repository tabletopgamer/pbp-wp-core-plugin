<?php
namespace PbP_Core\Interfaces;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface Custom_Post_Type_Interface {
    function get_singular_name();
    function get_plural_name();
    function get_post_type();
}
