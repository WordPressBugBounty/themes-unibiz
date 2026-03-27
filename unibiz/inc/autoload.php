<?php
/**
 * Autoload function
 *
 * @author Jegstudio
 * @package unibiz
 */

/**
 * Autoloader function for Unibiz theme classes
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
function unibiz_autoloader( $class ) {
    $prefix   = 'Unibiz';
    $base_dir = UNIBIZ_DIR . 'inc/class/';
    $len      = strlen( $prefix );

    if ( strncmp( $prefix, $class, $len ) !== 0 ) {
        return;
    }

    $array_path     = explode( '\\', substr( $class, $len ) );
    $relative_class = array_pop( $array_path );
    $class_path     = strtolower( implode( '/', $array_path ) );
    $class_name     = str_replace( '_', '-', 'class-' . $relative_class . '.php' );

    $file = rtrim( $base_dir, '/' ) . '/' . $class_path . '/' . strtolower( $class_name );

    if ( is_link( $file ) ) {
        $file = readlink( $file );
    }

    if ( is_file( $file ) ) {
        require $file;
    }
}

spl_autoload_register( 'unibiz_autoloader' );