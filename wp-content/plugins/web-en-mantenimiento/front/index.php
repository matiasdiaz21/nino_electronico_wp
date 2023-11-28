<?php

    $url_img = MWARG_MANTENIMIENTO_URL_FRONTAL . '/img';
    $class = "fondo$plantilla";

    global $wpdb;

        $img = $wpdb -> get_var("SELECT option_value FROM wp_options WHERE option_name ='mwarg_mantenimiento_imagen'");
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- mwarg_mantenimiento_web -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php echo get_bloginfo('title')?></title>
    <?php
    if (function_exists('wp_site_icon')) {
        wp_site_icon();
    }



    ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, minimum-scale=1">
    <meta name="description" content="<?php echo get_bloginfo('description')?>"/>
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta property="og:site_name" content="<?php echo get_bloginfo('title') . ' - ' . get_bloginfo('description')?>"/>
    <meta property="og:title" content="<?php echo get_bloginfo('title')?>"/>
    <meta property="og:type" content="Maintenance"/>
    <meta property="og:url" content="<?php echo site_url(); ?>"/>
    <meta property="og:description" content="<?php echo get_bloginfo('description')?>"/>
    <?php if( !empty( $logo ) ) { ?>
        <meta property="og:image" content="<?php echo $logo; ?>" />
        <meta property="og:image:url" content="<?php echo $logo; ?>"/>
        <meta property="og:image:secure_url" content="<?php echo $logo; ?>"/>
        <meta property="og:image:type" content="<?php echo $logo_ext; ?>"/>
    <?php } ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <style type="text/css">

        /* layout */
        .mwarg-contenedor-ppal {
        }
        .mwarg-contenido {
            width:100%;
          
            margin: 0 auto;
            min-height: 600px;
        }
        .mwarg-texto {
        }

        /* estilo fondo 1 */

      body.fondo1 {
            background-color: #fff;
        }
        body.fondo1 .mwarg-contenido {
            background: url("<?php echo $url_img?>/fondo1.png") top center no-repeat #fff;
			background-size: cover;
            background-size: contain
        }
        body.fondo1 .mwarg-texto {
                    
          position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;
        }
        body.fondo1 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif;  
        }

        /* estilo fondo 2 */

      body.fondo2 {
            background-color: #fff;
        }
        body.fondo2 .mwarg-contenido {
            background: url("<?php echo $url_img?>/fondo2.png") top center no-repeat #fff;
			background-size: cover;
            background-size: contain
        }
        body.fondo2 .mwarg-texto {
                   
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;
        }
        body.fondo2 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif;  
        }
   /* estilo fondo 3 */

      body.fondo3 {
            background-color: #fff;
        }
        body.fondo3 .mwarg-contenido {
            background: url("<?php echo $url_img?>/fondo3.png") top center no-repeat #fff;
			background-size: cover;
            background-size: contain
        }
        body.fondo3 .mwarg-texto {
                     
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;
        }
        body.fondo3 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif;  
        }
 /* estilo fondo 4 */

      body.fondo4 {
            background-color: #fff;

        }
        body.fondo4 .mwarg-contenido {
            background: url("<?php echo $url_img?>/fondo4.png") top center no-repeat #fff;
			background-size: cover;
            background-size: contain;
        }
        body.fondo4 .mwarg-texto {
                   
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;

        }
        body.fondo4 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif; 
           
           
        }



 /* estilo fondo 5 */

      body.fondo5 {
            background-color: #fff;
        }
        body.fondo5 .mwarg-contenido {
            background: url("<?php echo $url_img?>/fondo5.jpg") top center no-repeat #fff;
			background-size: cover;
            background-size: contain;
          
        }
        body.fondo5 .mwarg-texto {
                    
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;


        }
        body.fondo4 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif;

         
        }


        /* estilo fondo 6 */

       

      body.fondo6 {
            background-color: #fff;       
        }
        body.fondo6 .mwarg-contenido {
            background: url("<?php echo $img?>") top center no-repeat #fff;
            background-size: cover;
            background-size: contain;

        }
        body.fondo6 .mwarg-texto {  
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);          
            text-align: center;    
            color:#292D3E;
            background: #fff;
            border-radius: 20px;
            opacity: 0.8;
        }
        body.fondo6 h1, h2, h3, h4, h5, p {   
            font-family: Verdana, Geneva, sans-serif;  
        }

       

        /* estilos comunes */
        h1 { font-size: 60px; }
        h2 { font-size: 50px; }
        h3 { font-size: 40px; }
        h4 { font-size: 30px; }
        h5 { font-size: 25px; }
        p { font-size: 20px; }

        /* media queries */
        @media only screen and (max-width: 780px) {
            h1 { font-size: 45px; }
            h2 { font-size: 40px; }
            h3 { font-size: 35px; }
            h4 { font-size: 30px; }
            h5 { font-size: 25px; }
            p { font-size: 20px; }
        }
        @media only screen and (max-width: 480px) {
            h1 { font-size: 36px; }
            h2 { font-size: 32px; }
            h3 { font-size: 28px; }
            h4 { font-size: 24px; }
            h5 { font-size: 20px; }
            p { font-size: 16px; }
        }
    </style>
   
</head>
<body class="<?php echo $class?>">
<div class="mwarg-contenedor-ppal">
    <div class="mwarg-contenido">
        
    </div>
	<div class="mwarg-texto">
            <?php echo $mensaje?>
        </div>
</div>
</body>
</html>