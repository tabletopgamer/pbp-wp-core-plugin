<?php

use PbP_WP\Implementations\PbP_WP_Post_Type_Provider;
use \PbP_Core\Interfaces\Entity_Type;

/**
 * Description of pbp-entity-types-tests
 *
 * @author tabletopgamer
 */

class PbP_WP_Post_Types_Tests extends PHPUnit_Framework_TestCase {

	 /**
     * @var PbP_WP_Post_Type_Provider
     */
    protected $sut;
	
	public function setUp(){
		$this->sut = new PbP_WP_Post_Type_Provider();
	}
	
	/**
	 * @covers PBP_POST_TYPES::get_type
	 */
    public function testGetType_WithExistingType_ReturnsCorrectPostType() {
		$existingType = Entity_Type::CARD;
		
		$result = $this->sut->get_type($existingType);
        
		$this->assertEquals( $result->get_post_type(), Entity_Type::CARD);
    }
	
	/**
	 * @covers PBP_POST_TYPES::get_type
	 */
	public function testGetType_WithInExistingType_ReturnsUnknownType() {
		$existingType = "inexisting type";
		
		$result = $this->sut->get_type($existingType);
        
		$this->assertEquals( $result->get_post_type(), Entity_Type::UNKNOWN);
    }
}
