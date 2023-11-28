<?php

/* ======================================================================================
   @author     Mantenimiento Web (https://mantenimientoweb.digital)
   @version    1.0.4
   @copyright  Copyright &copy; 2021 Mantenimiento Web, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace mwarg_mweb;

/**
 * 
 * @author mantenimientoweb
 *
 */
class Mensajes
{
    /**
     *
     */
    private static function agregar( $tipo, $texto )
    {
        $mensajes = unserialize( get_option( MantenimientoWeb::WP_OPTION_MENSAJES ) );
        if( !is_array( $mensajes ) )
            $mensajes = [];
        $mensajes[] = [ 'tipo' => $tipo, 'texto' => $texto ];
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( $mensajes ) );
    }
    
    /**
     * 
     */
    static function aviso( $texto )
    {
        Mensajes::agregar( 'aviso', $texto );
    }

    /**
     *
     */
    static function error( $texto )
    {
        Mensajes::agregar( 'error', $texto );
    }

    /**
     *
     */
    static function dame()
    {
        $mensajes = unserialize( get_option( MantenimientoWeb::WP_OPTION_MENSAJES ) );
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( [] ) );
        return is_array( $mensajes ) ? $mensajes : [];
    }
    
    /**
     *
     */
    static function borrar()
    {
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( [] ) );
    }    
}

?>