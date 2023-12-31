<?php
/**
 * The header v1 for Electro.
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
<div class="off-canvas-wrapper">
<div id="page" class="hfeed site">
    <?php
    /**
     * @hooked electro_skip_links - 0
     * @hooked electro_top_bar - 10
     */
    do_action( 'electro_before_header' ); ?>

    <header id="masthead" class="site-header header-v1 stick-this">
        
        <div class="container hidden-lg-down">
            <?php
            /**
             * @hooked electro_masthead   - 10
             * @hooked electro_navigation - 20
             */
            do_action( 'electro_header_v1' ); ?>
        </div>

        <?php
        /**
         * @hooked electro_handheld_header - 10
         */
        do_action( 'electro_after_header' ); ?>

        
        
    </header><!-- #masthead -->


    <?php do_action( 'electro_before_content' ); ?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
        <?php
        /**
         * @hooked woocommerce_breadcrumb - 10
         */
        do_action( 'electro_content_top' ); ?>

        