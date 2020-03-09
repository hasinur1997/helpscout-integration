<?php


namespace HelpScoutIntegration\Admin;

/**
 * Class Auth
 *
 * @package HelpScoutIntegration\Admin
 */
class Auth {
    /**
     * Auth constructor.
     */
    public function __construct() {
        // Get helpscout code
        add_action( 'admin_init', [ $this, 'init_authorization' ] );
    }

    /**
     * Initialize authorization
     *
     * @return void
     */
    public function init_authorization() {
        $this->get_authorized();
        $this->delete_authorized();
    }

    /**
     * Get authorize code from HelpScout
     *
     * @return void
     */
    public function get_authorized() {

        if ( isset( $_GET['code'] ) ) {
            $code = $_GET['code'];

            $this->save_authorize_code( $code );
            $this->save_token();
            wp_redirect( admin_url( 'admin.php?page=helpscout-integration' ) );
        }

    }

    /**
     * Save authorized code
     *
     * @param $code
     *
     * @return void
     */
    public function save_authorize_code( $code ) {
        update_option( 'helpscout_authorize_code', $code );
    }

    /**
     * Delete authorization
     */
    public function delete_authorized() {
        if ( isset( $_GET['action'] ) && $_GET['action'] == 'cancel_authorized' ) {
            delete_option( 'helpscout_authorize_code' );
            wp_redirect( admin_url( 'admin.php?page=helpscout-integration' ) );
        }
    }

    /**
     * Get authorized code
     *
     * @return string
     */
    public static function get_authorized_code() {
        return get_option( 'helpscout_authorize_code' );
    }

    /**
     * Get token
     *
     * @return object
     */
    private function get_token() {
        $auth = [
            'code'          => self::get_authorized_code(),
            'client_id'     => Setting::get_app_id(),
            'client_secret' => Setting::get_app_secret(),
            'grant_type'    => 'authorization_code'
        ];

        $params = [
            'method'    => 'POST',
            'timeout'   => 15,
            'sslverify' => false,
            'body'      => $auth
        ];

        $response = wp_remote_post( 'https://api.helpscout.net/v2/oauth2/token', $params );

        $response = json_decode( $response['body'] );

        return $response;
    }

    /**
     *  Save token
     *
     * @return void
     */
    private function save_token() {
        $token         = $this->get_token();
        $refresh_token = $token->refresh_token;
        $access_token  = $token->access_token;

        $data = [
            'refresh_token' => $refresh_token,
            'access_token'  => $access_token
        ];

        update_option( 'helpscout_integration_token', $data );
    }

    /**
     * Get helpscout auth token
     *
     * @return array
     */
    public static function get_auth_token() {
        return get_option( 'helpscout_integration_token' );
    }

    /**
     * Get helpscout access token
     *
     * @return string
     */
    public static function get_access_token() {
        $auth_token   = self::get_auth_token();
        $access_token = isset( $auth_token['access_token'] ) ? $auth_token['access_token'] : '';

        return $access_token;
    }

    /**
     * Get refresh token
     *
     * @return string
     */
    public static function get_refresh_token() {
        $auth_token    = self::get_auth_token();
        $refresh_token = isset( $auth_token['refresh_token'] ) ? $auth_token['refresh_token'] : '';

        return $refresh_token;
    }

    /**
     * Get requested access token
     */
    public static function get_requested_access_token() {
        $auth = [
            'refresh_token' => self::get_refresh_token(),
            'client_id'     => Setting::get_app_id(),
            'client_secret' => Setting::get_app_secret(),
            'grant_type'    => 'refresh_token'
        ];

        $params = [
            'method'    => 'POST',
            'timeout'   => 15,
            'sslverify' => false,
            'body'      => $auth
        ];

        $response = wp_remote_post( API . 'oauth2/token', $params );
        $response = json_decode( $response['body'] );

        $data = [
            'refresh_token' => $response->refresh_token,
            'access_token'  => $response->access_token
        ];

        update_option( 'helpscout_integration_token', $data );

        return self::get_access_token();
    }
}
