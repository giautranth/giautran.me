<?php
require_once __DIR__ . '/wp-load.php';

// 1. Switch Theme
switch_theme('vegangarden');

// 2. Set Site Title & Tagline
update_option('blogname', 'Vegan Garden Berlin');
update_option('blogdescription', '100 % Vegane Vietnamesische Küche in Friedrichshain');

// 3. Set Permalinks to /%postname%/
global ;
->set_permalink_structure('/%postname%/');
->flush_rules();

// 4. Create or Update Pages
function create_or_get_page(\, \, \ = '') {
    \ = get_page_by_path(\);
    if (!\) {
        \ = wp_insert_post(array(
            'post_title'     => \,
            'post_name'      => \,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed'
        ));
        if (\ && !is_wp_error(\)) {
            update_post_meta(\, '_wp_page_template', \);
        }
        return \;
    } else {
        if (\) {
            update_post_meta(\->ID, '_wp_page_template', \);
        }
        return \->ID;
    }
}

\     = create_or_get_page('Home', 'home');
\    = create_or_get_page('Über Uns', 'about', 'page-about.php');
\  = create_or_get_page('Journal', 'ratgeber', 'page-ratgeber.php');
\  = create_or_get_page('Kontakt', 'kontakt', 'page-kontakt.php');

// 5. Configure Static Front Page
update_option('show_on_front', 'page');
update_option('page_on_front', \);

echo 'SUCCESS: Vegan Garden Berlin Theme activated and configured successfully!
';
echo 'Active Theme: ' . wp_get_theme()->get('Name') . '
';
echo 'Front Page ID: ' . \ . '
';

// Self delete for security
@unlink(__FILE__);
