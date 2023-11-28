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
class AdminWP
{
    /**
     * 
     */
    private static $nombre_plugin;
    
	/**
	 *
	 */
	static function init()
	{
	    AdminWP::crear_menu();
	    add_filter( 'plugin_action_links', [ __CLASS__, 'enlace_configuracion' ], 10, 2 );
	}

	/**
	 *
	 */
	static function crear_menu()
	{
		wp_enqueue_style( 
			'admin-estilos', 
			MWARG_MANTENIMIENTO_URL_RAIZ . '/css/admin.css', 
			false 
		);

		

				if( @$_POST['modo_mantenimiento_activo'] )
		            $switch ="On";
		        
	            else
	               $switch ="Off";
                

		add_menu_page
		(
			
			'Mantenimiento ' . $switch,
			'Mantenimiento ' . $switch,
			'manage_options',
			'mwarg_mantenimiento_web',
			array( __CLASS__, 'vista_configuracion' ),
			plugin_dir_url( __FILE__ ) . 'img/icon.png',
		'66'
		);
	}

	/**
	 * 
	 */
	static function enlace_configuracion( $enlaces, $archivo )
	{
	    // Sólo añado enlaces a mi plugin
	    if( !self::$nombre_plugin )
	        self::$nombre_plugin = 
	           plugin_basename( 
	               MWARG_MANTENIMIENTO_DIR_RAIZ . '/web-en-mantenimiento.php' 
	           );
        if( $archivo != self::$nombre_plugin )
            return $enlaces;
        
        // Procedo
        $enlace = [
            sprintf(
                "<a href=\"%s\">%s</a>",
                admin_url( 'tools.php?page=mwarg_mantenimiento_web' ),
                __( 'Configuración', 'mwarg_mweb' )
            ) ];
        return array_merge( $enlace, $enlaces );
	}
	
	/**
	 *
	 */
	static function vista_configuracion()
	{
	    // Sólo sesión admin
	    if( !is_admin() )
	        return;
	    
	    //
	    // Acciones MODO MANTENIMIENTO
	    // 
	    $mensajes_modo_mantenimiento = [];
		if( Input::post( 'mwarg_guardar_modo_mantenimiento' ) )
		{
		    //
		    $algun_cambio = false;

		    // Alta/baja modo mantenimiento
		    if( Input::post( 'modo_mantenimiento_activo' ) && ModoMantenimiento::esta_activo() )
		    {
		        ;
		    }
		    else
	        if( !Input::post( 'modo_mantenimiento_activo' ) && !ModoMantenimiento::esta_activo() )
	        {
	            ;
	        }
		    else
		    {
		        if( @$_POST['modo_mantenimiento_activo'] )
		            ModoMantenimiento::activar();

	            else
	                ModoMantenimiento::desactivar();
                $algun_cambio = true;
		    }
			
		

			// Guardo mensaje
			$mensaje = ModoMantenimiento::dame_mensaje_texto();
			if( $mensaje != Input::post( 'mensaje_texto' ) )
			{
			    ModoMantenimiento::actualizar_mensaje_texto(
			        Input::post( 'mensaje_texto' )
		        );
			    $algun_cambio = true;
			}


			//Guardo link Imagén

			$imagen = ModoMantenimiento::dame_imagen();
			if( $imagen != Input::post( 'imagen' ) )
			{
			    ModoMantenimiento::actualizar_imagen(
			        Input::post( 'imagen' )
		        );
			    $algun_cambio = true;
			}

			// Guardo plantilla
			$plantilla = ModoMantenimiento::dame_plantilla();
			if( $plantilla != Input::post( 'plantilla' ) )
			{
			    ModoMantenimiento::actualizar_plantilla(
			        Input::post( 'plantilla' )
		        );
			    $algun_cambio = true;
			}

			// Ningún cambio
			if( !$algun_cambio )
    			Mensajes::aviso( __( "No se ha realizado ningún cambio", 'mwarg_mweb' ) );

    		// Obtengo mensajes
    		$mensajes_modo_mantenimiento = Mensajes::dame();
		}

		// Url plugin
		$url = admin_url() . 'admin.php?page=mwarg_mantenimiento_web';


		
		
		global $wpdb;

		$img = $wpdb -> get_var("SELECT option_value FROM wp_options WHERE option_name ='mwarg_mantenimiento_imagen'");

		
		




		
?>
<div class="mwarg-mweb-admin-contenedor">
<form method="post" action="<?php echo $url?>">
<h2><?php esc_html_e( 'Configuración del plugin Web en Mantenimiento', 'mwarg_mweb' )?></h2>
<p><?php esc_html_e( 'Con esta herramienta podes poner tu web en modo privado. De este modo queda en "Modo Mantenimiento".', 'mwarg_mweb' )?></p>
	<table width="95%">
		<tr>

			<th width="30%"><label><?php esc_html_e( 'Activar Modo Mantenimiento', 'mwarg_mweb' )?>:</label></th>
			<td width="70%"><input type="checkbox" name="modo_mantenimiento_activo" value="1" <?php 
			echo ModoMantenimiento::esta_activo() == true ? 'checked' : '';
			$plantilla = ModoMantenimiento::dame_plantilla();
			?>></td>


		</tr>
		<tr>
			<th><label><?php esc_html_e( 'Imagenes', 'mwarg_mweb' )?>:</label></th>
			<td>
				<table class="mwarg_plantilla">
					<tr>
						<td>
							<input type="radio" name="plantilla" id="pl_1" value="1" <?php echo $plantilla == 1 ? 'checked' : ''?>><br>
							<img src="<?php echo MWARG_MANTENIMIENTO_URL_FRONTAL?>/img/fondo1.png" width="100" height="80" onclick="javascript:jQuery('#pl_1').prop('checked',true)">
						</td>
						<td>
							<input type="radio" name="plantilla" id="pl_2" value="2" <?php echo $plantilla == 2 ? 'checked' : ''?>><br>
							<img src="<?php echo MWARG_MANTENIMIENTO_URL_FRONTAL?>/img/fondo2.png" width="100" height="80" onclick="javascript:jQuery('#pl_2').prop('checked',true)">
						</td>
						<td>
							<input type="radio" name="plantilla" id="pl_3" value="3" <?php echo $plantilla == 3 ? 'checked' : ''?>><br>
							<img src="<?php echo MWARG_MANTENIMIENTO_URL_FRONTAL?>/img/fondo3.png" width="100" height="80" onclick="javascript:jQuery('#pl_3').prop('checked',true)">
						</td>
						<td>
							<input type="radio" name="plantilla" id="pl_4" value="4" <?php echo $plantilla == 4 ? 'checked' : ''?>><br>
							<img src="<?php echo MWARG_MANTENIMIENTO_URL_FRONTAL?>/img/fondo4.png" width="100" height="80" onclick="javascript:jQuery('#pl_4').prop('checked',true)">
						</td>
						
							<td>

							<?php if(!$img){?> 
								
								
							<input type="radio" name="plantilla" id="pl_5" value="5" <?php echo $plantilla == 5 ? 'checked' : ''?>><br>
							<img src="<?php echo MWARG_MANTENIMIENTO_URL_FRONTAL?>/img/fondo5.jpg" width="100" height="80" onclick="javascript:jQuery('#pl_5').prop('checked',true)">
						

						<?php	}else{?> 
								
								<input type="radio" name="plantilla" id="pl_6" value="6" <?php echo $plantilla == 6 ? 'checked' : ''?>><br>
								<img src='<?php echo $img; ?>' width="100" height="80" onclick="javascript:jQuery('#pl_6').prop('checked',true)">
								
					<?php		} ?> 

							
						</td>

						
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			
			<th><label><?php esc_html_e( 'Imagén Personalizada', 'mwarg_mweb' )?>:</label></th>
			<td><input name="imagen" rows="5" style="resize: none;max-width:50%;min-width:50%;" placeholder="Ingrese Link Imagén" value="<?php echo ModoMantenimiento::dame_imagen(); ?>"><?php 
			

		
			
			


			?></input></td>
		</tr>
		<tr>

			<th><label><?php esc_html_e( 'Mensaje de Portada', 'mwarg_mweb' )?>:</label></th>
			<td><textarea name="mensaje_texto" rows="5" style="resize: none;max-width:50%;min-width:50%;"><?php 
			$txt = ModoMantenimiento::dame_mensaje_texto();
			
			if( $txt )
			{
				echo $txt;
			}
			else
			{

				printf( 
					"<h3>%s</h3>\n<p>%s</p>", 
					__( 'Web en Mantenimiento', 'mwarg_mweb' ),
					__( 'Disculpe las molestias', 'mwarg_mweb' )

				);
			}
			?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><label>Desactivado el <b>Modo Mantenimiento</b> vacia la cache, si es que usas algun plugin.</label></td></tr>
	
		<tr>
			
			<td></td>
			<td><input type="submit" name="mwarg_guardar_modo_mantenimiento" id="mwarg_guardar_modo_mantenimiento" class="button button-primary" value="Guardar" style="background: #80207e;"></td>
		</tr>
		
		<tr>
			<td></td>
			<td>
				<?php
				foreach( $mensajes_modo_mantenimiento as $msg )
				{
				    $class = $msg['tipo'] == 'aviso' ? 'mwarg-aviso' : 'mwarg-error';
				    ?><div class="mwarg-mweb-admin-mensaje <?php echo $class?>"><?php
					echo $msg['texto'];
					?></div><?php
				}
				?>
			</td>
		</tr>
	</table>
</form>
<h2><?php esc_html_e( '¿Necesitas un WebMaster?', 'mwarg_mweb' )?></h2>
<p><?php esc_html_e( 'Si sos de Argentina revisa estos ', 'mwarg_mweb' );
	echo ' ';
    printf( 
        __( 
            '<a href="%s" target="_blank" style="text-decoration: none;" ¿>Precios</a>',
            'mwarg_mweb'
        ),
        'https://mantenimientoweb.digital' 
    )?></p>
<em><?php esc_html_e( 'Realizado por ', 'mwarg_mweb' )?><a href="https://mantenimientoweb.digital/" target="_blank" style="color: #80207e;text-decoration: none;"><b>Mantenimiento Web</b></a></em>
<?php
	}
}

?>