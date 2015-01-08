<?php
/**
 * Interface describing behavior for a generig Entity Repository
 *
 * @author tabletopgamer
 */
namespace pbpCore\interfaces;

interface IEntityRepository {
    
    /**
     * @param $entityId The unique identifier of the entity
     * @return IEntity The IEntityObject. 
     */
    function getEntityById($entityId);
    
    /**
     * @param array $entityIds An one dimesnional array containing a list of ids.
     * @return IEnity[] An array of entities. Empty array is returned in case none is found
     */
    function getEntitiesById(array $entityIds);
    
}
