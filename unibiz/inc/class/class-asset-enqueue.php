<?php
/**
 * Block Pattern Class
 *
 * @author Jegstudio
 * @package unibiz
 */
namespace Unibiz;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Init Class
 *
 * @package unibiz
 */
class Asset_Enqueue {
	/**
	 * Class constructor.
	 */
	public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 20 );
		add_action( 'enqueue_block_assets', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 20 );
	}

    /**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		wp_register_style(
			'unibiz-style',
			get_stylesheet_uri(),
			array(),
			UNIBIZ_VERSION
		);

		wp_style_add_data( 'unibiz-style', 'path', UNIBIZ_DIR );
		
		wp_enqueue_style( 'unibiz-style' );

				wp_register_style( 'preset', trailingslashit( get_template_directory_uri() ) . 'assets/css/preset.css', array(), UNIBIZ_VERSION );
		if ( file_exists( trailingslashit( get_template_directory() ) . 'assets/css/preset.css' ) && filesize( trailingslashit( get_template_directory() ) . 'assets/css/preset.css' ) < 51200 ) {
			wp_style_add_data( 'preset', 'path', trailingslashit( get_template_directory() ) . 'assets/css/preset.css' );
		}
		wp_enqueue_style( 'preset' );
		wp_register_script( 'preset_script', trailingslashit( get_template_directory_uri() ) . 'assets/js/preset_script.js', array(), UNIBIZ_VERSION, true );
		wp_enqueue_script( 'preset_script' );


        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
    }

	/**
	 * Enqueue admin scripts and styles.
	 */
	public function admin_scripts() {
		
    }
}
