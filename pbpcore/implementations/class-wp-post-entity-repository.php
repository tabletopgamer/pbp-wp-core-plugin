<?php 
namespace pbpcore\implementations;

use pbpcore\interfaces\Entity_Repository_Interface;


/**
 * @package core
 *  
 * Wordpress specific implementation for an IEntityRepository
 * @see Entity_Repository_Interface
 */
class WP_Post_Entity_Repository implements Entity_Repository_Interface{
    
    /**
     * @param array[int] $entityIds
     * @return array[IEntity] An array containing all entities for the specified ids. 
     * If no entities could be found, then an emtpy array is returned.
     */
    public function getEntitiesById( array $entityIds ) {
        
        $args = array( 'post__in' => $entityIds );
          
        $wpPosts = \get_posts( $args );
        
        $entities = array();
        
        if ( count( $wpPosts ) > 0 ){
            foreach ( $wpPosts as $wpPost ){
                $entities[] = new WP_Post_Entity_Adapter( $wpPost) ;
               
            }
        }
        
        return $entities;
    }

    /**
     * @param int $entityId
     * @return Entity_Interface The IEntity, if there is an entity with entity_id exists, NULL otherwise
     */
    public function getEntityById( $entityId ) {
        $result = NULL;
        $wpPost = \get_post( $entityId );
        
        if ( $wpPost !== NULL ){
            $result = new WP_Post_Entity_Adapter( $wpPost );
        }
        
        return $result;
    }

}
