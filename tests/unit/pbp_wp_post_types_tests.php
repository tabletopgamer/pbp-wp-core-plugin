<?php

use PbP_WP\Implementations\PBP_WP_POST_TYPES;

/**
 * Description of pbp-entity-types-tests
 *
 * @author tabletopgamer
 */

class PbP_WP_Post_Types_Tests extends PHPUnit_Framework_TestCase {

	public function setUp(){
	}
	
	/**
	 * @covers PBP_POST_TYPES::get_type
	 */
    public function testGetType_WithExistingType_ReturnsCorrectPostType() {
		PBP_WP_POST_TYPES::initialize();
		$existingType = "tabletop_card";
		
		$result = PBP_WP_POST_TYPES::get_type($existingType);
        
		
		$this->assertEquals( PBP_WP_POST_TYPES::$CARD, $result );
    }
	
	/**
	 * @covers PBP_POST_TYPES::get_type
	 */
	public function testGetType_WithInExistingType_ReturnsUnknownType() {
		
		PBP_WP_POST_TYPES::initialize();
		$existingType = "this does not exist";
		
		$result = PBP_WP_POST_TYPES::get_type($existingType);
        
		$this->assertEquals( PBP_WP_POST_TYPES::$UNKNOWN, $result );
    }
	
	
	/**
	 * @covers PBP_POST_TYPES::get_type
	 */
	public function testGetType_WithInExistingType_CalledBeforeClassInitialized_ThrowsRuntimeException() {
		
		$this->setExpectedException('RuntimeException', 'initialized()  before calling get_type() !');
		
		$existingType = "tabletop_card";
				
		PBP_WP_POST_TYPES::get_type($existingType);
    }
	
	public function tearDown()
    {
        PBP_WP_POST_TYPES::deinitialize();
    }
}
