<?php
namespace PbP_WP;

use PbP_Core\IPbP_Plugin;

/**
 * Description of PbpCustomPostRegister
 * @package wordpress-specific
 * @author tabletopgamer
 */
class PbP_Plugin_Loader implements IPbP_Plugin_Loader {

	/**
	 * @var IPbP_Plugin[]
	 */
	private $plugins;

	public function __construct() {
		$this->plugins = array();
	}

	/**
	 * @param IPbP_Plugin $plugin
	 */
	public function add_plugin( IPbP_Plugin $plugin ) {
		$this->plugins[] = $plugin;
	}

	/**
	 * Register all actions and filtered needed for properly loading the
	 * registered plugins
	 */
	public function load_all() {
		$actions = array(
			'init'               => 'on_register_custom_posts',
			'add_meta_boxes'     => 'on_register_meta_boxes',
			'wp_enqueue_scripts' => 'on_register_scripts'
		);

		foreach ( $actions as $event => $callback ) {
			add_action( $event, array( $this, $callback ) );
		}

	}

	public function on_register_custom_posts() {

		foreach ( $this->plugins as $plugin ) {
			foreach ( $plugin->get_custom_post_types() as $customPost ) {

				$postType     = $customPost->get_type_name();
				$singularName = $postType;
				$pluralName   = $postType . 's';

				$labels = array(
					'name'               => $singularName,
					'singular_name'      => $singularName,
					'add_new'            => 'Add new',
					'add_new_item'       => 'Add new ',
					'edit_item'          => 'Edit ',
					'new_item'           => 'New ',
					'view_item'          => 'View ' . $singularName,
					'search_items'       => 'Search ' . $pluralName,
					'not_found'          => 'No ' . $pluralName . ' Found',
					'not_found_in_trash' => 'No ' . $pluralName . ' found in Trash',
					'parent_item_colon'  => $pluralName,
					'menu_name'          => $pluralName,
				);

				$args = array(
					'capability_type'     => 'post',
					'show_in_nav_menus'   => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'labels'              => $labels,
					'hierarchical'        => true,
					'description'         => $pluralName,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'menu_position'       => 5,
					'menu_icon'           => 'dashicons-book-alt',
					'has_archive'         => true,
					'query_var'           => true,
					'can_export'          => true,
					'rewrite'             => true,
					'supports'            => array(
						'title',
						'editor',
						'author',
						'thumbnail',
						'revisions',
						'page-attributes',
						'comments',
					),
				);

				register_post_type( $postType, $args );
			}
		}
	}

	public function on_register_scripts() {
		foreach ( $this->plugins as $plugin ) {
			foreach ( $plugin->get_included_scripts() as $script ) {
				wp_register_script( $script->get_script_name(), plugins_url( '/../' . $script->get_file_name(), __FILE__ ), array( 'jquery' ), '1.0', true );
				wp_enqueue_script( $script->get_script_name() );
			}

		}

		foreach ( $this->plugins as $plugin ) {
			foreach ( $plugin->get_included_styles() as $script ) {
				wp_register_style( $script->get_script_name(), plugins_url( '/../' . $script->get_file_name(), __FILE__ ) );
				wp_enqueue_style( $script->get_script_name() );
			}
		}
	}

	public function on_register_meta_boxes() {

		foreach ( $this->plugins as $plugin ) {
			foreach ( $plugin->get_custom_post_types() as $customPost ) {
				$type = $customPost->get_type_name();
				add_meta_box( 'pbp_meta_' . $type, 'Meta Box Title', array(
					$this,
					'prfx_meta_callback'
				), $type, 'normal', 'high' );
			}
		}

		function prfx_meta_callback( \WP_Post $post ) {
			$type = $post->post_type;

			echo 'This is a meta box for: ' . $type;

			wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
			$prfx_stored_meta = get_post_meta( $post->ID );
			?>

			<p>
				<label for="meta-text"
				       class="prfx-row-title"><?php _e( 'Example Text Input', 'prfx-textdomain' ) ?></label>
				<input type="text" name="meta-text" id="meta-text"
				       value="<?php if ( isset ( $prfx_stored_meta['meta-text'] ) ) {
					       echo $prfx_stored_meta['meta-text'][0];
				       } ?>"/>
			</p>

		<?php
		}
	}


//	/**
//   * need to add action 'save_post'      => 'prfx_meta_save'
//   */
//	function prfx_meta_save( $post_id ) {
//
//		// Checks save status
//		$is_autosave    = wp_is_post_autosave( $post_id );
//		$is_revision    = wp_is_post_revision( $post_id );
//		$is_valid_nonce = ( isset( $_POST['prfx_nonce'] ) && wp_verify_nonce( $_POST['prfx_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';
//
//		// Exits script depending on save status
//		if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
//			return;
//		}
//
//		// Checks for input and sanitizes/saves if needed
//		if ( isset( $_POST['meta-text'] ) ) {
//			update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST['meta-text'] ) );
//		}
//
//	}


}
