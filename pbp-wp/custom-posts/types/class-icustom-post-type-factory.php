<?php
/**
 * User: tabletopgamer
 * Date: 18.01.2015
 * Time: 17:32
 */
namespace PbP_WP\Custom_Posts\Types;

use PbP_Core\Repository\Entity_Type;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

interface ICustom_Post_Type_Factory {

	/**
	 * @param string $type_name
	 *
	 * @return ICustom_Post_Type
	 */
	public function get_post_type( $type_name );

	/**
	 * @param ICustom_Post_Type $post_type
	 */
	public function add_known_post_type(ICustom_Post_Type $post_type);

	/**
	 * @param Entity_Type $type
	 *
	 * @return ICustom_Post_Type
	 */
	public function create_post_from_entity_type( $type );
}