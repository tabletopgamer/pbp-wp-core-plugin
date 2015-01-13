<?php
namespace PbP_WP\Implementations;

use PbP_WP\Interfaces\PbP_WP_Post_Type_Interface;

/**
 * Description of PbpCustomPostRegister
 * @package wordpress-specific
 * @author tabletopgamer
 */
class PbP_WP_Custom_Post_Register {
	
	/**
	 * @var PbP_WP_Post_Type[]
	 */
	private $customPosts;
	
	public function __construct() {
		$this->customPosts = array();
	}
	
	public function add_custom_post( PbP_WP_Post_Type_Interface $customPost) {
		$this->customPosts[] = $customPost;
	}
        
    public function register_custom_posts() {

		foreach ( $this->customPosts as $customPost) {
			
			$singularName = $customPost->get_singular_name() ;
			$pluralName = $customPost->get_plural_name();
			$postType = $customPost->get_post_type();

			$labels = array(
				'name'          => _x( $singularName, $postType ),
				'singular_name' => _x( $singularName, $postType ),
				'add_new'       => _x( 'Add new', $postType ),
				'add_new_item'  => _x( 'Add new ' . $singularName, $postType ),
				'edit_item'     => _x( 'Edit ' . $singularName, $postType ),
				'new_item'      => _x( 'New ' . $singularName, $postType ),
				'view_item'     => _x( 'View ' . $singularName, $postType ),
				'search_items'  => _x( 'Search ' . $pluralName, $postType ),
				'not_found'     => _x( 'No ' . $pluralName . ' Found', $postType ),
				'not_found_in_trash' => _x( 'No ' . $pluralName . ' found in Trash', $postType ),
				'parent_item_colon'  => _x( $pluralName, $postType ),
				'menu_name'          => _x( $pluralName, $postType ),
			);

			$args = array(
				'capability_type'       => 'post',
				'show_in_nav_menus'     => true,
				'publicly_queryable'    => true,
				'exclude_from_search'   => false,
				'labels'        => $labels,
				'hierarchical'  => true,
				'description'   => $pluralName,
				'public'        => true,
				'show_ui'       => true,
				'show_in_menu'  => true,
				'menu_position' => 5,
				'menu_icon'     => 'dashicons-book-alt',
				'has_archive'   => true,
				'query_var'     => true,
				'can_export'    => true,
				'rewrite'       => true,
				'supports'      => array( 
					'title', 'editor', 'author', 'thumbnail',
					'revisions', 'page-attributes', 'comments' ),
			);

			register_post_type( $postType, $args );
			
			
		}
    }
	

	public function register_meta_boxes(){
		
		foreach ( $this->customPosts as $customPost) {
			$type = $customPost->get_post_type();
			add_meta_box( 'pbp_meta_' . $type, 'Meta Box Title', array( $this, 'prfx_meta_callback' ), $type , 'normal', 'high');
		}
	}
	
   function prfx_meta_callback( \WP_Post $post ) {
	   $type = $post->post_type;

	   echo 'This is a meta box for: ' . $type;
	    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
		$prfx_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-text" class="prfx-row-title"><?php _e( 'Example Text Input', 'prfx-textdomain' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['meta-text'] ) ) echo $prfx_stored_meta['meta-text'][0]; ?>" />
    </p>
 
    <?php
   }

   
   function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
 
}

    public function register_all() {
		$actions = array(
			'init' => 'register_custom_posts',
			'add_meta_boxes' => 'register_meta_boxes',
			'save_post' => 'prfx_meta_save'
		);
		
		foreach ( $actions as $event => $callback ) {
	        add_action( $event, array( $this, $callback) );
		}
    }
}
