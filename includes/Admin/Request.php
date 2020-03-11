<?php


namespace HelpScoutIntegration\Admin;

use HelpScoutIntegration\Admin\Auth;

/**
 * Class Request
 * @package HelpScoutIntegration\Admin
 */
class Request {
    /**
     * Send remote request get
     *
     * @param $endpoint
     *
     * @return object
     */
    public static function get( $endpoint ) {

        $response = wp_remote_get( API . $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . Auth::get_access_token()
            ]
        ] );

        if ( $response['response']['code'] == 401 ) {
            $response = wp_remote_get( API . $endpoint, [
                'headers' => [
                    'Content-Type'  => 'application/json; charset=UTF-8',
                    'Authorization' => 'Bearer ' . Auth::get_requested_access_token()
                ]
            ] );
        }

        error_log( print_r( $response, true ) );
        return json_decode( $response['body'] );
    }

    /**
     * @param $endpoint
     * @param array $body
     *
     * @return object
     */
    public static function post( $endpoint, $body = [] ) {
        $response = wp_remote_post( API . $endpoint, [
            'headers' => [
                'Content-Type'  => 'application/json; charset=UTF-8',
                'Authorization' => 'Bearer ' . Auth::get_access_token()
            ],
            'body'    => json_encode( $body )
        ] );

        if ( $response['response']['code'] == 401 ) {
            $response = wp_remote_post( API . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . Auth::get_requested_access_token()
                ],
                'body'    => json_encode( $body )
            ] );
        }

        return json_decode( $response['body'] );
    }
}
