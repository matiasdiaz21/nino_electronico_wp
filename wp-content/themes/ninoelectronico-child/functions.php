<?php
/**
 * Electro Child
 *
 * @package electro-child
 */

/**
 * Disable for automated testing.
 *
 * @link   https://wpforms.com/developers/how-to-disable-recaptcha-for-automated-testing/
 */
 
    // Disable reCAPTCHA assets and initialisation on the frontend.
    add_filter( 'wpforms_frontend_recaptcha_disable', '__return_true' );
 
    // Disable validation and verification on the backend.
    add_filter( 'wpforms_process_bypass_captcha', '__return_true' );
function my_scripts_method() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/assets/js/custom.js'
    );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


function electro_footer_brands_carousel(){
	if( function_exists( 'electro_brands_carousel' ) && apply_filters( 'electro_footer_brands_carousel', true ) ) {
		$no_of_brands  = apply_filters( 'electro_footer_brands_number', 34 );
		
		$section_args  = apply_filters( 'ec_footer_bc_section_args', array() );
		$taxonomy_args = apply_filters( 'ec_footer_bc_taxonomy_args', array(
			'number'  => $no_of_brands
		) );
		$carousel_args = apply_filters( 'ec_footer_bc_carousel_args', array( 'autoplay' => true, 'loop' => true, 'autoplayTimeout' => 2000 ) );
		
		electro_brands_carousel( $section_args, $taxonomy_args, $carousel_args );
	}
}



add_filter( 'woocommerce_product_subcategories_args', 'custom_woocommerce_product_subcategories_args' );

function custom_woocommerce_product_subcategories_args( $args ) {
  $args['exclude'] = get_option( 'default_product_cat' );
  return $args;
}

function bd_sale_price_html( $price, $product ) {
 
	if ( $product->is_on_sale()) :
   
	  if ($product->is_type( 'variable' )){
		return $price;
	  } else {
		$return_string = str_replace( '<ins>', '<ins><span class="theprice">Internet!</span> ', $price);
	 	 return $return_string;
	  }
	  

	
   
	else :
	  return $price;
	endif;
   
}
add_filter( 'woocommerce_get_price_html', 'bd_sale_price_html', 100, 2 );
	

add_filter( 'woocommerce_register_post_type_product', 'wc_modify_product_post_type' );

function wc_modify_product_post_type( $args ) {
     $args['supports'][] = 'revisions';

     return $args;
}



/*function customjs_load()
{
    if (is_page(8))
    {

    ?>

        <script type="text/javascript">
					window.onload = function() {
						img = document.getElementsByClassName("payment_method_transbank");
						img = img[0].getElementsByTagName("img");
						img = img[0];
						img.src = "https://ninoelectronico.cl/wp-content/themes/ninoelectronico-child/assets/img/webpay2.png";
					};
        </script>

        

    <?php

    }
}

add_action('wp_head', 'customjs_load', 2);
*/


add_action( 'wp_head', 'add_my_google_analytics_code', PHP_INT_MAX );
function add_my_google_analytics_code() {
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-78392009-16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-78392009-16');
</script>
<?php
}


add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {
    if( $product->is_type('variable')){
        $percentages = array();

        // Get all variation prices
        $prices = $product->get_variation_prices();

        // Loop through variation prices
        foreach( $prices['price'] as $key => $price ){
            // Only on sale variations
            if( $prices['regular_price'][$key] !== $price ){
                // Calculate and set in the array the percentage for each variation on sale
                $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
            }
        }
        // We keep the highest value
        $percentage = max($percentages) . '%';
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
    }
    return '<span class="onsale">' . esc_html__( 'SALE', 'woocommerce' ) . ' ' . $percentage . '</span>';
}

// Añadir valor en píxel conversión Facebook con WooCommerce
add_action( 'woocommerce_thankyou', 'jb_pixeltracking' );

function jb_pixeltracking( $order_id ) {
   $order = new WC_Order( $order_id );
   $order_total = $order->get_total();
 ?>
    <!-- Nuevo pixel de Facebook, acción conversión dinámica -->
    <script>
   fbq('track', 'Purchase', {value: '<?php echo $order_total ?>', currency: 'EUR'});
   </script> 
    <!-- END FB Tracking -->
  
<?php
}

add_action( 'electro_onsale_product_content', 'woocommerce_template_loop_add_to_cart', 80 );


function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Categorias TIenda', 'theme-slug' ),
        'id' => 'sidebar-tiendamo',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'theme_slug_widgets_init' );

// In your theme's functions.php
function customize_add_button_atts( $attributes ) {
    return array_merge( $attributes, array(
      'text' => 'Añadir Producto',
    ) );
  }
  add_filter( 'wpcf7_field_group_add_button_atts', 'customize_add_button_atts' );


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .wpr-flex--egal {
      display:none !important;
      font-size: 12px;
    } 
    .status-all-completed {
      background:#191986 !important;
    } 

    .status-all-completed span{
      color:#fff;
    }
  </style>';
}

add_action('wp_enqueue_scripts', 'myfct_enqueue_scripts'); 
function myfct_enqueue_scripts() { wp_deregister_script('jquery'); wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"), false, null); wp_enqueue_script('jquery'); }