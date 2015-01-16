<?php namespace PbP_Core\Interfaces;

/**
 * Interface describing behavior for a generig Entity Repository
 *
 * @author tabletopgamer
 */
interface IEntity_Repository {
    
    /**
     * @param int The unique identifier of the entity
     * @return IEntity The IEntityObject.
     */
    function getById( $entityId );
    
    /**
     * @param array $entityIds An one dimesnional array containing a list of ids.
     * @return IEnity[] An array of entities. Empty array is returned in case none is found
     */
    function getByIds( array $entityIds );
    
}
