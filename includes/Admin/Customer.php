<?php


namespace HelpScoutIntegration\Admin;

use HelpScoutIntegration\Admin\Request;

use HelpScoutIntegration\Admin\Setting;

/**
 * Class Customer
 *
 * @package HelpScoutIntegration\Admin
 */
class Customer {
    /**
     * Get helpscout customer id
     *
     * @param $user_id
     * @param $user_email
     *
     * @return integer
     */
    public static function get( $user_id, $user_email ) {
        $customer_id = get_user_meta( $user_id, '_helpscout_customer_id', true );

        if ( ! $customer_id ) {
            $response = Request::get( 'customers?mailbox=' . Setting::get_mailbox_id() . '&query=(email:"' . $user_email . '")' );

            if ( ! empty( $response->_embedded->customers ) ) {
                $customer_id = $response->_embedded->customers[0]->id;
                update_user_meta( $user_id, '_helpscout_customer_id', $customer_id );
            }

            $customer_id = 0;
        }

        return $customer_id;
    }

    /**
     * Get customer conversation
     *
     * @param $customer_id
     *
     * @return array
     */
    public static function get_customer_conversations( $customer_id ) {
        $response = Request::get( 'conversations?mailbox=' . Setting::get_mailbox_id() . '&query=(customerIds: ' . $customer_id . ')' );

        return $response->_embedded->conversations;
    }

    /**
     * Get current user conversations
     *
     * @return array
     */
    public static function get_current_user_conversations() {
        $current_user = wp_get_current_user();
        $customer_id  = self::get( $current_user->ID, $current_user->user_email );

        return self::get_customer_conversations( $customer_id );
    }
}
