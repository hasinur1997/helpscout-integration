<?php


namespace HelpScoutIntegration\Frontend;

use HelpScoutIntegration\Admin\Customer;

/**
 * Class ShortCode
 * @package HelpScoutIntegration\Frontend
 */
class ShortCode {
	/**
	 * ShortCode constructor.
	 */
	public function __construct() {
		add_shortcode( 'helpsout_ticket', [ $this, 'helpsout_ticket' ] );
	}

	/**
	 * Display helpscout ticket list
	 *
	 * @return string
	 */
	public function helpsout_ticket() {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
		$customer_id = Customer::get(2, 'hasinurrahman35@gmail.com');
		$tickets = Customer::get_customer_conversations($customer_id);

		ob_start();

		$template = '';
		switch ($action) {
			case 'create-new-ticket':
				$template = HELPSCOUT_INTEGRATION_INCLUDES . '/templates/frontend/create-new-ticket.php';
				break;
			default:
				$template = HELPSCOUT_INTEGRATION_INCLUDES . '/templates/frontend/helpscout-ticket-list.php';
				break;

		}

		if ( file_exists( $template ) ) {
			require_once $template;
		}
		return ob_get_clean();
	}
}