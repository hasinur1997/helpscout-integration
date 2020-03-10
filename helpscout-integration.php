<?php
/*
Plugin Name: HelpScout Integration
Plugin URI: https://hasinur.me
Description: A integration application for HelpScout
Version: 1.0
Author: Hasinur Rahman
Author URI: https://hasinur.me/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: helpscout-integration
Domain Path: /languages
*/

/**
 * Copyright (c) YEAR Your Name (email: Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Base_Plugin class
 *
 * @class Base_Plugin The class that holds the entire Base_Plugin plugin
 */
class HelpScout_Integration {

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0';

    /**
     * Constructor for the Base_Plugin class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct() {

        $this->define_constants();

        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        $this->includes();
        $this->init_hooks();
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'API', 'https://api.helpscout.net/v2/' );
        define( 'MAIL_BOX_ID', '' );
        define( 'HELPSCOUT_INTEGRATION_VERSION', $this->version );
        define( 'HELPSCOUT_INTEGRATION_FILE', __FILE__ );
        define( 'HELPSCOUT_INTEGRATION_PATH', dirname( HELPSCOUT_INTEGRATION_FILE ) );
        define( 'HELPSCOUT_INTEGRATION_INCLUDES', HELPSCOUT_INTEGRATION_PATH . '/includes' );
        define( 'HELPSCOUT_INTEGRATION_URL', plugins_url( '', HELPSCOUT_INTEGRATION_FILE ) );
        define( 'HELPSCOUT_INTEGRATION_ASSETS', HELPSCOUT_INTEGRATION_URL . '/assets' );
    }

    /**
     * Initializes the Base_Plugin() class
     *
     * Checks for an existing Base_Plugin() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new HelpScout_Integration();
        }

        return $instance;
    }

    /**
     * Plugin init
     */
    public function plugin_init() {
        new HelpScoutIntegration\Assets();
        new HelpScoutIntegration\Admin();
        new HelpScoutIntegration\Frontend();
    }

    /**
     * Placeholder for activation function
     *§
     * Nothing being called here yet.
     */
    public function activate() {

        update_option( 'helpscout_integration_version', HELPSCOUT_INTEGRATION_VERSION );
    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public function deactivate() {

    }

    /**
     * Include the required files
     *
     * @return void
     */
    public function includes() {
        require_once __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the hooks
     *
     * @return void
     */
    public function init_hooks() {
        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );

        // Loads frontend scripts and styles
//		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        add_action( 'plugins_loaded', [ $this, 'plugin_init' ] );
    }

    /**
     * Initialize plugin for localization
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'helpscout-integration', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


}

function helpscout_integration() {
    return HelpScout_Integration::init();
}

$helpscout_integration = helpscout_integration();
