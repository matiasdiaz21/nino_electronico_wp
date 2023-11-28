<?php

/* ======================================================================================
   @author     Mantenimiento Web (https://mantenimientoweb.com.ar)
   @version    1.0.4
   @copyright  Copyright &copy; 2021 Mantenimiento Web, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace mwarg_mweb;

/**
 *
 */
class RedirigirAConfiguracion
{
    /**
     * 
     */
    private static $redirigir;
    
    /**
     * 
     */
    static function crear()
    {
        RedirigirAConfiguracion::$redirigir = new RedirigirAConfiguracion(); 
    }
    
	/**
	 * Redirijo cuando el loop del admin haya terminado
	 */
	function __destruct()
	{
	    wp_safe_redirect( admin_url( 'tools.php?page=mwarg_mantenimiento_web' ) );
	    exit;
	}
}

?>