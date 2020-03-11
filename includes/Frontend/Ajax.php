<?php


namespace HelpScoutIntegration\Frontend;


use HelpScoutIntegration\Admin\Customer;
use HelpScoutIntegration\Admin\Thread;

class Ajax {
    /**
     * Ajax constructor.
     */
    public function __construct() {
        add_action( 'wp_ajax_crete_thread', [$this, 'create_thread'] );
    }

    /**
     * Create conversation reply
     */
    public function create_thread() {
        error_log( print_r( $_POST, true ) );
        $current_user    = wp_get_current_user();
        $message         = isset( $_POST['message'] ) ? sanitize_text_field( $_POST['message'] ) : '';
        $conversation_id = isset( $_POST['conversation_id'] ) ? intval( $_POST['conversation_id'] ) : 0;
        $customer_id     = Customer::get( $current_user->ID, $current_user->user_email );

        $data = [
            "customer"  => [
                'id'    =>  $customer_id
            ],
            "text"  =>  $message
        ];

        error_log( print_r( $data, true ) );

        $created_thread = Thread::create( $conversation_id, $data );

        if ( is_wp_error( $created_thread ) ) {
            return wp_send_json_error([
                'message'    => __( 'Send to fail', 'helpscout-integration' )
            ]);
        }
        return wp_send_json_success([
            'message'   => __( 'Successfully send', 'helpscout-integration' )
        ]);
    }
}
