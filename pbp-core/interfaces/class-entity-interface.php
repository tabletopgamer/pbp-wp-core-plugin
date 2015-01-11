<?php
namespace PbP_Core\Interfaces;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */

interface Entity_Interface {
    function get_id();
    function get_title();
    function get_contents();
}
