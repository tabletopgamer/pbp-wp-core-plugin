<?php
namespace PbP_Core\Implementations;

use PbP_Core\Interfaces\Custom_Post_Type_Interface;

class PbP_Post_Type implements Custom_Post_Type_Interface {
	
	private $post_type;
	private $single_name;
	private $plural_name;
	
	public function __construct($post_type, $single_name, $plural_name){
		$this->post_type = $post_type;
		$this->single_name = $single_name;
		$this->plural_name = $plural_name;
	}
	
    public function get_post_type() {
        return $this->post_type;       
    }

    public function get_singular_name() {
        return $this->single_name;
    }
        
    public function get_plural_name() {
        return $this->plural_name;
    }

}


	
	