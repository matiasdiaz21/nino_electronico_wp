<?php
define('WP_CACHE', true); // Added by WP Rocket

define('WP_HOME', 'http://localhost:8009');
define('WP_SITEURL', 'http://localhost:8009');
define('FS_METHOD', 'direct');


/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'nino_electronico');
/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');
/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');
/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'host.docker.internal');
/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');
/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');
/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|-K265/UM+:L8ag4@&^a%]$8Z;N_-Y S{o|V}KO`b{>s}F1XT_J^e EZ]4b}q0i`');
define('SECURE_AUTH_KEY',  ';)WwonnA!.+{j!C(JCHp[CPN)}w!qQFC`O9+XUe-x}du?XOsb7r|kr&Wr_Y4$mt#');
define('LOGGED_IN_KEY',    '52>8M9DgBx.s`VC-^A]L*=.E, CgAWy!_JS<&,S%8/c|Em2$<)X,Agl97 ARu-e4');
define('NONCE_KEY',        '8*zVB,M/5ypsP!is^g|Z+x)pfJ7%0Ohi, S6,5 l{ P+N!1|)P#Ct|UqBkLZ|(EZ');
define('AUTH_SALT',        '-R*,Nh(_hrCHI+J@p-d]1D$-wRDg:;v9@]]9rG.I&(]voY??B3B+|T%X8R-e7~`C');
define('SECURE_AUTH_SALT', 'pbZPK,p/Tq=l{1E~lu~ 7*TC@c7HU$0 vW!>qum-hry[kvE+53WV.52T@p+)+pzK');
define('LOGGED_IN_SALT',   '/ IP`oImm:Z}!*($3zy&Xu%PE/m)NJA6jt-C4,M=3A#/8=MJ[%y%+;M1V;#S&F06');
define('NONCE_SALT',       'nYh~PLVE-+?l_99Njw&BCb,[$_hS+9}4@[(S{s+-9f#RL:^|c|)|g_NI|Z?`@B|#');
/**#@-*/
/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'frelectronino_';
/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);
/* ¡Eso es todo, deja de editar! Feliz blogging */
/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
