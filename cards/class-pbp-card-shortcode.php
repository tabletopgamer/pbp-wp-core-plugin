<?php

class PbP_Card_Shortcode {

    static function init() {

        add_shortcode( 'pbpcard', array( __CLASS__, 'handle_shortcode' ) );

        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'register_script' ) );

        add_filter( 'comment_text', 'do_shortcode' );
    }

    static function register_script() {
        wp_register_script( 'my-script', plugins_url( '/../cards/js/cards.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'my-script' );
        
        wp_register_style( 'my-style', plugins_url( '/../cards/css/cards.css', __FILE__ ) );
        wp_enqueue_style( 'my-style' );
    }
    
    function handle_shortcode( $atts, $content = null ) {

        $cards = array();
        $i = 0;
        foreach ( $atts as $att ) {
            $i++;
            $text = "this is the card description";
            if ( $content == null ) {
                $cards[] =  "<div id=\"div-$att$i\" class='pbp-card' ><p>$att</p>$text</div></span>";
            } else {
                $content = do_shortcode( $content );
                $cards[] = "<span class='pbp-container'><span id=\"$att$i\" title='$att' class='pbp-card-handle'>$content</span>" .
                    "<div id=\"div-$att$i\" class='pbp-card--hidden' ><p>$att</p>$text</div></span>";
            }
            
            
            
        }

        $result = implode( ' ', $cards );

        return $result;
    }

}