<?php
namespace PbPWp\Core;

class Entity implements IEntity{
    public function getContents() {
        
    }

    public function getId() {
        
    }

    public function getTitle() {
        
    }

}

interface IEntity{
    
    function getId();
    function getTitle();
    function getContents();
    
}
