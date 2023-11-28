<?php

if ( ! function_exists( 'electro_vc_recent_viewed_products' ) ) :

    function electro_vc_recent_viewed_products( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
        ), $atts));

        $args = array(
            'section_title'     => $section_title,
        );
        
        $html = '';
        if( function_exists( 'electro_recent_viewed_products' ) ) {
            ob_start();
            electro_recent_viewed_products( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_recent_viewed_products' , 'electro_vc_recent_viewed_products' );

endif;
