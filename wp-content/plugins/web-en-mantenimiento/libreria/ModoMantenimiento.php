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
class ModoMantenimiento
{
    /**
     * Cadenas con las vars a almacenar en tabla wp_options
     */
    const WP_OPTION_MODO_MANTENIMIENTO_ACTIVO = 'mwarg_mantenimiento_web_mma';
    const WP_OPTION_MENSAJE_TEXTO = 'mwarg_mantenimiento_web_mensaje_texto';
    const WP_OPTION_PLANTILLA = 'mwarg_mantenimiento_plantilla';
    const WP_OPTION_IMAGEN = 'mwarg_mantenimiento_imagen';

	/**
	 *
	 */
	static function activar()
	{
		self::borrar_cache();
	    update_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO, true );
        Mensajes::aviso( __( "Modo mantenimiento activado", 'mwarg_mweb' ) );
	}
	
	/**
	 *
	 */
	static function desactivar()
	{
		self::borrar_cache();
        update_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO, false );
        Mensajes::aviso( __( "Modo mantenimiento desactivado", 'mwarg_mweb' ) );
    }

	/**
	 *
	 */
	static function borrar_cache()
	{
		global $file_prefix;
		if( function_exists( 'w3tc_pgcache_flush' ) ) 
			w3tc_pgcache_flush(); 
		if( function_exists( 'wp_cache_clean_cache' ) ) 
			wp_cache_clean_cache( $file_prefix, true );
    }

	/**
	 *
	 */
	static function esta_activo()
	{
	    return get_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO );
	}

	/**
	 *
	 */
	static function dibujar_landing( $plantilla_original )
	{
		if( self::esta_activo() && !is_user_logged_in() )
		{
			global $mensaje, $plantilla;
			$mensaje = self::dame_mensaje_texto();
			$plantilla = self::dame_plantilla();
			return MWARG_MANTENIMIENTO_DIR_FRONTAL . '/index.php';
		}
		return $plantilla_original;
	}

	/**
	 *
	 */
	static function dame_mensaje_texto()
	{
		return get_option( self::WP_OPTION_MENSAJE_TEXTO, '' );
	}

	/**
	 *
	 */
	static function dame_plantilla()
	{
		return get_option( self::WP_OPTION_PLANTILLA, 1 );
	}

	/**
	 *
	 */
	static function dame_imagen()
	{
		return get_option( self::WP_OPTION_IMAGEN, '' );
	}




	static function actualizar_plantilla( $numero )
	{
		if( !is_numeric( $numero ) || $numero < 1 || $numero > 6 )
		{
			Mensajes::error( __( "Imagen incorrecta", 'mwarg_mweb' ) );
			return;
		}
		update_option( self::WP_OPTION_PLANTILLA, $numero );
		Mensajes::aviso( __( "Imagen actualizada", 'mwarg_mweb' ) );
	}

	/**
	 *
	 */


	static function actualizar_mensaje_texto( $mensaje )
	{
		$mensaje = str_replace( '<?php', '', $mensaje );
		$mensaje = str_replace( '<?=', '', $mensaje );
		$mensaje = str_replace( '<?', '', $mensaje );
		$mensaje = str_replace( '?>', '', $mensaje );
		update_option( self::WP_OPTION_MENSAJE_TEXTO, $mensaje );
		Mensajes::aviso( __( "Mensaje actualizado", 'mwarg_mweb' ) );
	}




	static function actualizar_imagen( $imagen )
{
	

		if(strpos($imagen, '.jpg') or strpos($imagen, '.png') !== false){

		$imagen = str_replace( '<?php', '', $imagen );
		$imagen = str_replace( '<?=', '', $imagen );
		$imagen = str_replace( '<?', '', $imagen );
		$imagen = str_replace( '?>', '', $imagen );
		update_option( self::WP_OPTION_IMAGEN, $imagen);
		Mensajes::aviso( __( "Imagen Insertada", 'mwarg_mweb' ) );
	}else{

		if($imagen == ''){

				update_option( self::WP_OPTION_IMAGEN, $imagen);

}else{

		Mensajes::error( __( "Ingrese archivo png o jpg", 'mwarg_mweb' ) );

}
	}

	}








	
	
}

?>