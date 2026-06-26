<?php
/*
 * Theme Name: CIH
 * Description: This is a child theme for Flatsome Theme
 * Author: UX Themes
 * Template: flatsome
 * Version: 3.1.13
 */

/*************** ADD CUSTOM CSS HERE. ***************/

// Load từng shortcode file cũ theo tên cụ thể
$sc_dir = get_stylesheet_directory() . '/shortcodes/';

$sc_files = [
    'bac_si.php',
    'bac_si_search_filter_form.php',
    'chuyen_khoa.php',
    'danhsach_bacsi_taxonomy.php',
    'form_lich_hen_complete.php',
];

foreach ( $sc_files as $file ) {
    $path = $sc_dir . $file;
    if ( file_exists( $path ) ) {
        require_once $path;
    }
}

// Load shortcodes Thẻ Thành Viên
$cih_membership_sc = get_stylesheet_directory() . '/cih/cih-shortcodes.php';
if ( file_exists( $cih_membership_sc ) ) {
    require_once $cih_membership_sc;
}
