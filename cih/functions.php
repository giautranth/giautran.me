<?php
/*
 * Theme Name: CIH
 * Description: This is a child theme for Flatsome Theme
 * Author: UX Themes
 * Template: flatsome
 * Version: 3.1.13
 */

/*************** ADD CUSTOM CSS HERE. ***************/

// -------------------------------------------------------
// 1. Auto-load TẤT CẢ shortcode cũ từ thư mục shortcodes/
//    (khôi phục bac_si_search_filter, form_lich_hen_complete v.v.)
// -------------------------------------------------------
$cih_shortcodes_dir = get_stylesheet_directory() . '/shortcodes/';
if ( is_dir( $cih_shortcodes_dir ) ) {
    foreach ( glob( $cih_shortcodes_dir . '*.php' ) as $shortcode_file ) {
        require_once $shortcode_file;
    }
}

// -------------------------------------------------------
// 2. Load shortcodes Thẻ Thành Viên (membership)
// -------------------------------------------------------
$cih_membership_sc = get_stylesheet_directory() . '/cih/cih-shortcodes.php';
if ( file_exists( $cih_membership_sc ) ) {
    require_once $cih_membership_sc;
}
