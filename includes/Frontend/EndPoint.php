<?php


namespace HelpScoutIntegration\Frontend;

/**
 * Class EndPoint
 * @package HelpScoutIntegration\Frontend
 */
class EndPoint {
    /**
     * EndPoint constructor.
     */
    public function __construct() {

//		add_action( 'init', [$this, 'add_end_point_arg'] );
//		add_action( 'init', [$this, 'rewrite_end_point'] );
        add_filter( 'query_vars', [ $this, 'add_query_vars' ] );
    }

    /**
     * Add end point arg
     *
     * @return void
     */
    public function add_end_point_arg() {
        add_query_arg( [
            'action' => 'create-new-ticket',

        ], home_url() );
    }

    public function rewrite_end_point() {
        error_log( print_r( 'sdfsdflsdl;fk;l', true ) );
        add_rewrite_endpoint( 'tickets', EP_ROOT | EP_PAGES );
    }

    public function add_query_vars( $vars ) {
        $vars[] = 'tickets';

        return $vars;
    }
}
