<?php
/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */
namespace pbpCore\interfaces;

interface IEntity {
    function getId();
    function getTitle();
    function getContents();
}
