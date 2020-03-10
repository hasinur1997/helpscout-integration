<?php

namespace HelpScoutIntegration;

class Frontend {
    /**
     * Frontend constructor.
     */
    public function __construct() {
        $this->init_classes();
        $this->init_hooks();
    }

    public function init_hooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Initialize all classes
     *
     * @return void
     */
    public function init_classes() {
        $classes = [
            'HelpScoutIntegration\Frontend\ShortCode',
            'HelpScoutIntegration\Frontend\EndPoint'
        ];

        if ( empty( $classes ) ) {
            return;
        }

        foreach ( $classes as $class ) {
            new $class();
        }
    }

    /**
     * Enqueue Scripts
     *
     * @return void
     */
    public function enqueue_scripts() {
//		wp_enqueue_style('bootstrap-style');
//		wp_enqueue_script('bootstrap-script');
    }
}
