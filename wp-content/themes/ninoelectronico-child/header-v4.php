<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package electro
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="new-top-nav">
	<div class="container">
		<div class="thedate">
		</div>
		<div class="thetext">
			<p>||  <span style="color:#e40000">¿Necesitas Ayuda? </span><i class="ec ec-phone"></i>(51) 2 520000   <i class="ec ec-mail"></i>  contacto@casaninoelectronico.cl</p>
		</div>
	</div>
</div>
<div class="off-canvas-wrapper">
<div id="page" class="hfeed site">
	<div class="full-color-background">
		<?php
		/**
		 * @hooked electro_skip_links - 0
		 * @hooked electro_top_bar - 10
		 */
		do_action( 'electro_before_header' ); ?>

		<header id="masthead" class="site-header stick-this header-v4">
			<div class="container <?php echo has_electro_mobile_header() ? 'hidden-lg-down' : ''; ?>">
				<?php
				/**
				 * @hooked electro_row_wrap_start - 0
				 * @hooked electro_header_logo - 10
				 * @hooked electro_primary_menu - 20
				 * @hooked electro_header_support_info - 30
				 * @hooked electro_row_wrap_end - 40
				 */
				do_action( 'electro_header_v4' ); ?>

			</div>
			
			<?php
			/**
			 * @hooked electro_handheld_header - 10
			 */
			do_action( 'electro_after_header' ); ?>
		
		</header><!-- #masthead -->
	</div>
	<?php
	/**
	 * @hooked electro_navbar - 10
	 */
	do_action( 'electro_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="container">
		<?php
		/**
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'electro_content_top' ); ?>