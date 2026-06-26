<?php
/**
 * CIH Child Theme Functions
 * Tự động include file shortcodes để UX Builder có thể dùng các shortcode membership
 */

// Load shortcodes membership
$cih_shortcodes_file = get_stylesheet_directory() . '/cih/cih-shortcodes.php';
if ( file_exists( $cih_shortcodes_file ) ) {
    require_once $cih_shortcodes_file;
}
