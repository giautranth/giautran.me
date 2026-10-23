<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

header('Content-Type: text/plain; charset=utf-8');

$site_icon = get_option('site_icon');
echo "site_icon option value: " . var_export($site_icon, true) . "\n";

if ($site_icon) {
    echo "Attachment URL: " . wp_get_attachment_url($site_icon) . "\n";
} else {
    echo "site_icon is NOT set in WordPress options!\n";
}
