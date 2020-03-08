<?php


namespace HelpScoutIntegration;

/**
 * Class Assets
 * @package HelpScoutIntegration
 */
class Assets {
	/**
	 * Assets constructor.
	 */
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'register' ], 5 );
		} else {
			add_action( 'wp_enqueue_scripts', [ $this, 'register' ], 5 );
		}
	}

	/**
	 * Register scripts and styles
	 *
	 * @return void
	 */
	public function register() {
		$this->register_scripts( $this->get_scripts() );
		$this->register_style( $this->get_styles() );
	}

	/**
	 * Register scripts
	 *
	 * @param $scripts
	 *
	 * @return void
	 */
	public function register_scripts( $scripts ) {

		foreach ( $scripts as $handle => $script ) {
			$deps           = isset( $script['deps'] ) ? $script['deps'] : false;
			$in_footer      = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
			$version        = isset( $script['version'] ) ? $script['version'] : HELPSCOUT_INTEGRATION_VERSION;

			wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
		}
	}

	/**
	 * Register styles
	 *
	 * @param $styles
	 *
	 * @return void
	 */
	public function register_style( $styles ) {
		foreach( $styles as $handle => $style ) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;

			wp_register_style( $handle, $style['src'], $deps, HELPSCOUT_INTEGRATION_VERSION );
		}
	}

	/**
	 * Get scripts
	 *
	 * @return array
	 */
	public function get_scripts() {
		return [
			'bootstrap-script' => [
				'src'   => HELPSCOUT_INTEGRATION_ASSETS . '/frontend/js/bootstrap.min.js',
				'version'   => filemtime( HELPSCOUT_INTEGRATION_PATH . '/assets/frontend/js/bootstrap.min.js'),
					'deps'  => ['jquery'],
				'in_footer' => true
			]
		];
	}

	/**
	 * Get styles
	 *
	 * @return array
	 */
	public function get_styles() {
		return [
			'bootstrap-style' => [
				'src' => HELPSCOUT_INTEGRATION_ASSETS . '/frontend/css/bootstrap.min.css'
			],
		];
	}
}