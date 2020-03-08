<?php
namespace HelpScoutIntegration\Admin;

class Menu {
	/**
	 * Menu constructor.
	 */
	public function __construct() {
		// Admin menu
		add_action( 'admin_menu', [$this, 'add_admin_menu_page'] );
	}

	/**
	 * Add menu page for admin
	 */
	public function add_admin_menu_page() {
		add_menu_page( __('HelpScout', 'helpscout-integration'), __( 'HelpScout', 'helpscout-integration' ), 'manage_options', 'helpscout-integration', [$this, 'helpscout_page'] );
	}

	/**
	 * HelpScout settings page
	 */
	public function helpscout_page() {
		Setting::display();
	}
}