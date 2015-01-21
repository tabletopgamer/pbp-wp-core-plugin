<?php
/**
 * User: tabletopgamer
 * Date: 21.01.2015
 * Time: 23:05
 */
namespace PbP_WP;

use PbP_Core\IPbP_Plugin;


/**
 * Description of PbpCustomPostRegister
 * @package wordpress-specific
 * @author tabletopgamer
 */
interface IPbP_Plugin_Loader {

	/**
	 * @param IPbP_Plugin $plugin
	 */
	public function add_plugin( IPbP_Plugin $plugin );

	/**
	 * Register all actions and filtered needed for properly loading the
	 * registered plugins
	 */
	public function load_all();
}