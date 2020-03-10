<?php


namespace HelpScoutIntegration\Admin;

use HelpScoutIntegration\Admin\Request;

/**
 * Class Thread
 *
 * @package HelpScoutIntegration\Admin
 */
class Thread {
    /**
     * Get all threads of a conversation
     *
     * @param $conversation_id
     *
     * @return array
     */
    public static function get( $conversation_id ) {
        $response = Request::get( 'conversations/' . $conversation_id . '/threads' );

        return $response->__embedded->threads;
    }

    /**
     * Create a thread of a conversation
     *
     * @param $conversation_id
     * @param array $data
     *
     * @return mixed
     */
    public static function create( $conversation_id, array $data ) {
        $chat = Request::post( 'conversations/' . $conversation_id . '/chats', $data );

        return $chat;
    }

    public function find( $id ) {

    }

    public function update( $id, array $data ) {

    }

}
