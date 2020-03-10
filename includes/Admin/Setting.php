<?php


namespace HelpScoutIntegration\Admin;

/**
 * Class Setting
 *
 * @package HelpScoutIntegration\Admin
 */
class Setting {
	/**
	 * Setting constructor.
	 */
	public function __construct() {
		// Save settings
		add_action( 'admin_init', [$this, 'save_settings'] );
	}

	/**
	 * Display settings page
	 *
	 * @return void
	 */
	public static function display() {
		$app_id             =   self::get_app_id();
		$app_secret         =   self::get_app_secret();
		$mailbox_id         =   self::get_mailbox_id();
		$authorized_code    =   Auth::get_authorized_code();

		require_once HELPSCOUT_INTEGRATION_INCLUDES . '/templates/admin/settings.php';
	}

	/**
	 * Get helpscout integration settings
	 *
	 * @return array
	 */
	private static function get_settings() {
		return get_option('helpscout_settings');
	}

	/**
	 * Get app id
	 *
	 * @return string
	 */
	public static function get_app_id() {
		$helpscout_settings = self::get_settings();
		$app_id             = isset( $helpscout_settings['app_id'] ) ? $helpscout_settings['app_id'] : '';

		return $app_id;
	}

	/**
	 * Get app secret
	 *
	 * @return string
	 */
	public static function get_app_secret() {
		$helpscout_settings = self::get_settings();
		$app_secret = isset( $helpscout_settings['app_secret'] ) ? $helpscout_settings['app_secret'] : '';

		return $app_secret;
	}

	/**
	 * Get mailbox id
	 *
	 * @return integer
	 */
	public static function get_mailbox_id() {
		$helpscout_settings = self::get_settings();
		$mail_box_id = isset( $helpscout_settings['mail_box_id'] ) ? $helpscout_settings['mail_box_id'] : '';

		return $mail_box_id;
	}

	/**
	 * HelpScout save settings
	 */
	public function save_settings() {
		if ( ! current_user_can('manage_options') ) {
			return;
		}

		$nonce = isset( $_POST['_wpnonce'] )  ? $_POST['_wpnonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'helpscout_integration_settings' ) ) {
			return;
		}

		$app_id      = isset( $_POST['helpscout_app_id'] ) ? sanitize_text_field( $_POST['helpscout_app_id'] ) : '';
		$app_secret  = isset( $_POST['helpscout_app_secret'] ) ? sanitize_text_field( $_POST['helpscout_app_secret'] ) : '';
		$mail_box_id = isset( $_POST['mailbox'] ) ? sanitize_text_field( $_POST['mailbox'] ) : '';

		$data = [
			'app_id'        => $app_id,
			'app_secret'    => $app_secret,
			'mail_box_id'   => $mail_box_id
		];

		update_option( 'helpscout_settings', $data );
	}
}