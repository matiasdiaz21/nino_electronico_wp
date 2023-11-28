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
class Log
{
	/**
	 *
	 */
	static function texto( $texto )
	{
		if( !MWARG_MANTENIMIENTO_LOG_ACTIVO )
			return;
		if( !file_exists( dirname( MWARG_MANTENIMIENTO_FICHERO_LOG ) ) )
			if( !@mkdir( dirname( MWARG_MANTENIMIENTO_FICHERO_LOG ), 0755, true ) )
			{
			    Mensajes::error( 
		            __( "No puedo crear dir log: ", 'mwarg_mweb' ) . 
    		        dirname( MWARG_MANTENIMIENTO_FICHERO_LOG )
			    );
			    return;
			}
		@file_put_contents( 
			MWARG_MANTENIMIENTO_FICHERO_LOG, 
			'[' . date( 'Y-m-d H:i:s' ) . "] $texto\n", 
			FILE_APPEND | LOCK_EX
		);
	}

	/**
	 *
	 */
	static function error( $texto )
	{
	    Log::texto( '[x] ' . $texto );
	}
}

?>