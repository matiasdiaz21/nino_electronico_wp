<?php
/**
 * Gonzales MU WordPress Plugin
 *
 * @package   Gonzales
 * @author    Tomasz Dobrzyński
 * @link      https://tomasz-dobrzynski.com
 * @copyright Copyright © 2018 Tomasz Dobrzyński
 *
 * Plugin Name: Gonzales MU
 * Description: Gonzales helper. Responsible for conditional plugin (de)activation
 * Version: 1.0.1
 * Author: Tomasz Dobrzyński
 * Author URI: https://tomasz-dobrzynski.com
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Gonzales MU actual functionalty
 * ============================================================================
 */
class GonzalesHelper {
	/**
	 * List of enabled/disabled plugins
	 *
	 * @var array
	 */
	public $control;

	/**
	 * Name of current content type
	 *
	 * @var string
	 */
	private $content_type;

	/**
	 * Configuration storage (cache purposes)
	 *
	 * @var array
	 */
	private $cached_configuration;

	/**
	 * WordPress initialization
	 */
	function __construct() {
		add_filter( 'option_active_plugins', array( $this, 'filter_plugins' ) );
	}

	/**
	 * Get current URL
	 *
	 * @return string
	 */
	private function get_current_url() {
		$request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI' );

		$url = explode( '?', $request_uri, 2 );
		if ( strlen( $url[0] ) > 1 ) {
			$out = rtrim( $url[0], '/' );
		} else {
			$out = $url[0];
		}

		return $out;
	}

	/**
	 * Read and save to cache Gonzales plugin configuration
	 *
	 * @return array Configuration
	 */
	private function get_configuration() {
		global $wpdb;
		$out = array();

		if ( empty( $this->cached_configuration ) ) {
			$out = array();
			$current_url = esc_url( $this->get_current_url() );

			$disabled_global = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE url = "" AND regex = ""', ARRAY_A );
			$disabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE url = "%s"',
				$current_url
				), ARRAY_A );
			$disabled_regex = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE regex != ""', ARRAY_A );

			$enabled_posts = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_enabled WHERE content_type != "here"', ARRAY_A );
			$enabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM %s WHERE content_type = \'%s\' AND url=\'%s\'',
				$wpdb->prefix . 'gonzales_p_enabled',
				'here',
				$current_url ), ARRAY_A );
			$enabled = array_merge( $enabled_here, $enabled_posts );

			if ( ! empty( $disabled_global ) ) {
				foreach ( $disabled_global as $row ) {
					$out['disabled'][ $row['name'] ]['everywhere'] = true;
				}
			}

			if ( ! empty( $disabled_here ) ) {
				foreach ( $disabled_here as $row ) {
					$out['disabled'][ $row['name'] ]['here'] = true;
				}
			}

			if ( ! empty( $disabled_regex ) ) {
				foreach ( $disabled_regex as $row ) {
					$out['disabled'][ $row['name'] ]['regex'] = stripslashes( $row['regex'] );
				}
			}

			if ( ! empty( $enabled ) ) {
				foreach ( $enabled as $row ) {
					$out['enabled'][ $row['name'] ][ $row['content_type'] ] = true;
				}
			}

			$this->cached_configuration = $out;
		}

		return $this->cached_configuration;
	}

	/**
	 * Get list of marked as disabled plugins.
	 *
	 * @param string $plugin Plugin name.
	 * @return array List
	 */
	private function is_disabled( $plugin ) {
		global $wpdb;
		$out = array();

		/**
		 * Part of load_configuration()
		 */
		$out = $this->get_configuration();

		/**
		 * Part of get_visibility_plugin()
		 */
		$state = false;
		$current_url = esc_url( $this->get_current_url() );

		if ( isset( $out['disabled'][ $plugin ] ) ) {

			if ( isset( $out['disabled'][ $plugin ]['regex'] ) ) {
				$matches = array();
				if ( isset( $out['disabled'][ $plugin ]['regex'] ) ) {
					@preg_match( '/' . $out['disabled'][ $plugin ]['regex'] . '/', $current_url, $matches );
				}
				$state = ( count( $matches ) ? true : false );
			} else {
				$state = true;
			}

			if ( isset( $out['enabled'][ $plugin ]['here'] ) ) { // Content type doesn't work here.
				$state = false;
			}
		}

		return $state;
	}

	/**
	 * Get plugin name from path.
	 *
	 * @param  string $plugin Input.
	 * @return string         Plugin slug name
	 */
	private function get_plugin_slug( $plugin ) {
		$out = explode( '/', $plugin );

		if ( count( $out ) == 1 ) {
			/**
			 * Single file, not nested in folder.
			 * Exploding and removing extension assuming it can be .php5 or php7 instead of traditional .php
			 */
			$out = explode( '.', $plugin );
			array_pop( $out );
		}

		return $out[0];
	}

	/**
	 * Filter list of plugins.
	 *
	 * @param  array $plugins Input list.
	 * @return array          Filtered list
	 */
	public function filter_plugins( $plugins ) {
		if ( is_admin() ) {
			return $plugins;
		}

		foreach ( $plugins as $key => $plugin ) {
			if ( $this->is_disabled( $this->get_plugin_slug( $plugin ) ) ) {
				unset( $plugins[ $key ] );
				$this->control['disabled'][] = $plugin;
			} else {
				$this->control['enabled'][] = $plugin;
			}
		}

		return $plugins;
	}
}

$gonzales_helper = new GonzalesHelper;
