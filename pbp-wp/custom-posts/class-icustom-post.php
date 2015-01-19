<?php
namespace PbP_WP\Custom_Posts;
use PbP_WP\WordPress_Posts\IWordPress_Post;

/**
 * Description of class-custom-post-interface
 *
 * @author tabletopgamer
 */
interface ICustom_Post extends IWordPress_Post{

    /**
     * @return array
     */
    function get_fields();
}
