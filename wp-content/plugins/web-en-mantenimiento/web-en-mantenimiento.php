<?php

/*
Plugin Name: Web en Mantenimiento
Plugin URI: https://mantenimientoweb.digital
Description: Con este Plugin podes poner tu Web en Mantenimiento para que los usuarios no puedan verla.
Version: 1.0.5
Requires at least: 3.5
Tested up to: 5.9
Author: Mantenimiento Web
Author URI: https://mantenimientoweb.digital/
License: GPLv2 or later
*/ 

/*  Copyright 2021 Mantenimiento Web

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
  
   
    if( !defined( 'WPINC' ) )
        die;

  
    require dirname( __FILE__ ) . '/config.php';

   
    function mwarg_mweb_activar_plugin() { 
        mwarg_mweb\MantenimientoWeb::activar_plugin(); 
    }
    function mwarg_mweb_desactivar_plugin() { 
        mwarg_mweb\MantenimientoWeb::desactivar_plugin(); 
    }
    function mwarg_mweb_desinstalar_plugin() { 
        mwarg_mweb\MantenimientoWeb::desinstalar_plugin(); 
    }
    function mwarg_mweb_admin_init() { 
        mwarg_mweb\AdminWP::init(); 
    }
    function mwarg_mweb_dibujar_landing( $po ) { 
        return mwarg_mweb\ModoMantenimiento::dibujar_landing( $po ); 
    }

  
    add_action( 'template_include', 'mwarg_mweb_dibujar_landing', 999999 );
    add_action( 'admin_menu', 'mwarg_mweb_admin_init' );
    register_activation_hook( __FILE__, 'mwarg_mweb_activar_plugin' );
    register_deactivation_hook( __FILE__, 'mwarg_mweb_desactivar_plugin' );
    register_uninstall_hook( __FILE__, 'mwarg_mweb_desinstalar_plugin' );

?>