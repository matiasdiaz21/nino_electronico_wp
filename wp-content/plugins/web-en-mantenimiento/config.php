<?php

  
	define( 
        'MWARG_MANTENIMIENTO_MODO_DESARROLLO', 
        0
    );

  
	define( 
        'MWARG_MANTENIMIENTO_DIR_RAIZ', 
        dirname( __FILE__ ) . '/' 
    );
    define( 
        'MWARG_MANTENIMIENTO_FICHERO_PLUGIN', 
        dirname( __FILE__ ) . '/web-en-mantenimiento.php' 
    );
	define( 
        'MWARG_MANTENIMIENTO_URL_RAIZ', 
        plugins_url( '/', __FILE__ ) 
    );
    define( 
        'MWARG_MANTENIMIENTO_DIR_FRONTAL',
        MWARG_MANTENIMIENTO_DIR_RAIZ . '/front'
    );
    define( 
        'MWARG_MANTENIMIENTO_URL_FRONTAL', 
        MWARG_MANTENIMIENTO_URL_RAIZ . '/front'
    );
	define( 
        'MWARG_MANTENIMIENTO_LOG_ACTIVO', 
        0
    );
	define( 
        'MWARG_MANTENIMIENTO_DIR_LOG', 
        MWARG_MANTENIMIENTO_DIR_RAIZ . '/logs' 
    );
	define( 
        'MWARG_MANTENIMIENTO_FICHERO_LOG', 
        MWARG_MANTENIMIENTO_DIR_LOG . '/' . date( 'Y-m-d' ) . '.txt' 
    );
	
  
    if( MWARG_MANTENIMIENTO_MODO_DESARROLLO )
    {
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        ini_set( "log_errors", 1 );
        ini_set( "error_log", MWARG_MANTENIMIENTO_DIR_LOG . '/php-error.log' );
        date_default_timezone_set( 'America/Argentina/Buenos_Aires' );
    }

 
    spl_autoload_register( function( $class ) {
        if( class_exists( $class ) )
            return;
        if( strpos( $class, "mwarg_mweb\\" ) !== 0 )
            return;
        $filename = 
            dirname( __FILE__ ) . 
            '/libreria/' . 
            substr( $class, strlen( "mwarg_mweb\\" ) ) . '.php'
            ;
        require_once $filename;
    } );

?>