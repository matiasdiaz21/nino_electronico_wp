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
 */
class Input
{
	/**
	 *
	 */
	static function post( $var_name, $vdef = null )
	{
	    if( isset( $_POST[$var_name] ) )
	        return wp_kses_post( $_POST[$var_name] );
	    return $vdef;
	}

	/**
	 *
	 */
	static function get( $var_name, $vdef = null )
	{
	    if( isset( $_GET[$var_name] ) )
	        return wp_kses_post( $_GET[$var_name] );
        return $vdef;
	}
}

?>