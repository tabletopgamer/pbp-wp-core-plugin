<?php

class PbP_Card_Custom_Post extends PbP_Custom_Post {

    protected function get_post_type() {
        return 'tabletop_card';        
    }

    protected function get_singular_name() {
        return 'PbP Card';
    }
        
    protected function get_plural_name() {
        return 'PbP Cards';
    }

}
