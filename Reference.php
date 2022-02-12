<?php
/*
Plugin Name: Insert Link Reference In Copied Text
Description: This plugin will add a reference from which site someone copied a text.
Author: Mushlih Almubarak
Author URI: https://github.com/mushlih-almubarak
Version: 1
*/

// Include functions.php, use require_once to stop the script if the functions.php file is not found
require_once plugin_dir_path(__FILE__) . 'Functions.php';
// Connect action hook 'admin_menu', run 'ILRICT_add_setting_menu' function
add_action('admin_menu', 'ILRICT_add_setting_menu');

// Add menu link in WordPress dashboard
function ILRICT_add_setting_menu()
{
    add_menu_page(
        'Insert Link Reference In Copied Text', // Page title
        'Insert Reference', // The text displayed on the menu
        'manage_options', // Requirements to be able to view the link
        'insert-link-reference-in-copied-text', // Permalink.
        'ILRICT_setting' // Call the "ILRICT_setting" function
    );

    function ILRICT_setting()
    {
        require_once 'Setting.php';
    }
}
