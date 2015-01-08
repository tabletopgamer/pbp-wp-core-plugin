<?php 
/**
 * @package core
 *  
 * Wordpress specific implementation for an IEntityRepository
 * @see IEntityRepository
 */
namespace pbpCore\implementations;

use pbpCore\interfaces\IEntityRepository;

class WpPostEntityRepository implements IEntityRepository{
    
    public function getEntitiesById(array $entityIds) {
        
        $args = array( 'post__in' => $entityIds );
          
        $wpPosts = \get_posts($args);
        
        $entities = array();
       echo "Post count" . count($wpPosts);
        if (count($wpPosts) > 0){
            foreach ($wpPosts as $wpPost){
                $entities[] = new WpPostEntityAdapter($wpPost);
               
            }
        }
        
        return $entities;
    }

    public function getEntityById($entityId) {
        
        $wpPost = \get_post($entityId);
        
        return new WpPostEntityAdapter($wpPost);
    }

}
