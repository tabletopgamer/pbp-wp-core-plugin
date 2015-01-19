<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:37
 */

namespace PbP_WP\Custom_Posts;


class Custom_Fields_Repository implements ICustom_Fields_Repository {
	/**
	 * @param int $post_id
	 * @param array $custom_keys The keys of the meta that needs to be retrieved.
	 *
	 * @return array
	 */
	public function get_custom_fields( $post_id, array $custom_keys ) {

		if ( ! is_numeric( $post_id ) ) {
			throw new \InvalidArgumentException( "Argument 'post_id' must be a number. '$post_id' value not valid." );
		}
		$result        = array();
		$custom_fields = get_post_meta( $post_id );

		foreach ( $custom_keys as $key ) {
			if ( is_string( $key ) && array_key_exists( $key, $custom_fields ) ) {
				$result[ $key ] = $this->normalize_meta_value( $custom_fields[ $key ] );
			} else {
				throw new \InvalidArgumentException( "The key '$key' is not valid for post with id '$post_id'" );
			}
		}

		return $result;
	}


	/**
	 * Tries to normalize meta values. As WordPress always returns an array of values, even if
	 * there is only one value for that meta, that value will be retrieved instead of the whole array.
	 * eg. ['key' => [ 0 => 'value'] ] will result in ['key' => 'value']
	 *
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	private function normalize_meta_value( $value ) {
		$result = $value;

		if ( is_array( $value ) ) {
			$count = count( $value );

			if ( 0 == $count ) {
				$result = null;
			} else if ( 1 == $count ) {
				$result = maybe_unserialize( $value[0] );
			}
		}

		return $result;

	}
}