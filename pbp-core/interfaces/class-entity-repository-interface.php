<?php
namespace PbP_Core\Interfaces;

/**
 * Interface describing behavior for a generig Entity Repository
 *
 * @author tabletopgamer
 */

interface Entity_Repository_Interface {
    
    /**
     * @param $entityId The unique identifier of the entity
     * @return Entity_Interface The IEntityObject. 
     */
    function getEntityById( $entityId );
    
    /**
     * @param array $entityIds An one dimesnional array containing a list of ids.
     * @return IEnity[] An array of entities. Empty array is returned in case none is found
     */
    function getEntitiesById( array $entityIds );
    
}
