<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 14/01/15
 * Time: 12:50
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

function brozzme_hicss_plugin_uninstall(){
$option_name = 'brozzme_hover_settings';

delete_option($option_name);
}

?>