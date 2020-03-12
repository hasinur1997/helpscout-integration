<?php

namespace HelpScoutIntegration;

class Admin {
    /**
     * Admin constructor.
     */
    public function __construct() {
        $this->init_classes();
        $this->init_hooks();
    }

    /**
     * Initialize required hooks
     *
     * @return void
     */
    public function init_hooks() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 5 );

    }

    /**
     * Initialize all classes
     *
     * @return void
     */
    public function init_classes() {
        $classes = [
            'HelpScoutIntegration\Admin\Menu',
            'HelpScoutIntegration\Admin\Setting',
            'HelpScoutIntegration\Admin\Auth'
        ];

        if ( empty( $classes ) ) {
            return;
        }

        foreach ( $classes as $class ) {
            new $class();
        }
    }

    /**
     * Enqueue scripts
     *
     * @return void
     */
    public function enqueue_scripts( $hooks ) {
//        wp_enqueue_style( 'bootstrap-style' );

        wp_enqueue_style( 'bootstrap-style' );
        wp_enqueue_style('conversesion-style');
        wp_enqueue_script( 'bootstrap-script' );
    }
}
