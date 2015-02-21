<?php

/**
 * Plugin Name: Brozzme-hover - CSS3 transitions
 * Plugin URL: http://brozzme.com/hover-functions/
 * Description: CSS3 transitions embed on your website into structural elements, choose and play with Hover.css (Ian Lunn)
 * A collection of CSS3 powered hover effects to be applied to links, buttons, logos, SVG, featured images.
 * Version: 1.0.0
 * Author: Benoît Faure
 * Author URL: http://brozzme.com
 * Github: https://github.com/Benoti/Brozzme Hover
 *
 * MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Hover.css (http://ianlunn.github.io/Hover/)
 * Version: 2.0.0
 * Author: Ian Lunn @IanLunn
 * Author URL: http://ianlunn.co.uk/
 * Github: https://github.com/IanLunn/Hover

 * Made available under a MIT License:
 * http://www.opensource.org/licenses/mit-license.php
/**
 * Date: 23/01/15
 * Time: 12:03
 * settings options created : brozzme_hover_settings
 */

defined( 'ABSPATH' ) OR exit;

(@__DIR__ == '__DIR__') && define('__DIR__', realpath(dirname(__FILE__)));

//require_once __DIR__ .'/includes/brozzme_hover_settings.php';
require_once __DIR__ .'/includes/brozzme_hover_array.php';
require_once __DIR__ .'/includes/brozzme_hover_init.php';
require_once __DIR__ .'/includes/hook_mce.php';

register_activation_hook(   __FILE__, 'brozzme_hover_plugin_activation' );
register_deactivation_hook( __FILE__, 'brozzme_hover_plugin_deactivation' );
register_uninstall_hook(    __DIR__ .'/uninstall.php', 'brozzme_hover_plugin_uninstall' );


function brozzme_hover_plugin_deactivation(){
    $option_name = 'brozzme_hover_settings';
   // delete_option($option_name);
}

/**
 * Creates the options
 */
function brozzme_hover_plugin_activation() {
    //check if tss option setting is already present

    if(!get_option('brozzme_hover_settings')) {
        //not present, so add
        $options = array(
            'bhi_enable_style'=> true,
            'bhi_jquery_loading'=> true,
            'bhi_enable_automatic_hover'=> true,
            'bhi_automatic_style_targets'=> 'entry-title',
            'bhi_effect_name'=> 'hvr-buzz-out',
            'bhi_background_color'=> '#D15820'

        );
        
        add_option('brozzme_hover_settings', $options);
    }
}

// load css style - frontend
function brozzme_hover_frontend_style() {

    $options = get_option( 'brozzme_hover_settings' );

            if($options['bhi_enable_style'] == 1) {
                if ($options['bhi_jquery_loading'] == 2) {
                    $in_footer = true;
                } else {
                    $in_footer = false;
                }

        wp_enqueue_style('brozzme_hover-hover-style', plugin_dir_url(__FILE__) . 'css/hover.css', 'style');
        wp_enqueue_style('brozzme_hover-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', 'style', '4.1.0');
        // just a few class - lot of selectors to add
        wp_enqueue_style('brozzme_hover-frontend-style', plugin_dir_url(__FILE__) . 'css/style.css', 'style');
        // this part enable the transfer of necessary variables to the js file, whom will add the hover class on the fly
        wp_register_script( 'js_frontend_brozzme_hover', plugin_dir_url( __FILE__ )  . 'js/front-end-hover.js', array(), '1.0.0', $in_footer);

        $options_args = array(
            'bhi_automatic_style_targets'=> $options['bhi_automatic_style_targets'],
            'bhi_effect_name' => $options['bhi_effect_name'],
            'bhi_background_color'=> $options['bhi_background_color']
        );
        wp_localize_script('js_frontend_brozzme_hover', 'bhiOptions', $options_args);

        wp_enqueue_script( 'js_frontend_brozzme_hover' );
            }

}
add_action( 'wp_enqueue_scripts', 'brozzme_hover_frontend_style', 12);

// load css style - admin
function brozzme_hover_load_wp_admin_style() {

    wp_register_style( 'awesome_wp_admin_css', 'http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
    wp_enqueue_style( 'awesome_wp_admin_css' );
    wp_enqueue_style( 'brozzme_hover-hover-style', plugin_dir_url( __FILE__ )  . 'css/hover.css', 'style' );
    wp_enqueue_style( 'brozzme_hover-frontend-style', plugin_dir_url( __FILE__ )  . 'css/style.css', 'style' );

}
add_action( 'admin_enqueue_scripts', 'brozzme_hover_load_wp_admin_style' );
//
$options = get_option( 'brozzme_hover_settings' );

// load js function - frontend
function brozzme_hover_load_js(){

    $options = get_option( 'brozzme_hover_settings' );

        if($options['bhi_jquery_loading'] == 1){
            $in_footer = true;
        }
        else{
            $in_footer=false;
        }

    wp_register_script( 'js_admin_brozzme_hover', plugin_dir_url( __FILE__ )  . 'js/get_json.js', array(), '1.0.0', $in_footer);
    wp_enqueue_script( 'js_admin_brozzme_hover' );
}
add_action( 'admin_enqueue_scripts', 'brozzme_hover_load_js' );

// admin color picker
add_action( 'admin_enqueue_scripts', 'brozzme_bhi_add_color_picker' );
function brozzme_bhi_add_color_picker( $hook ) {

    if( is_admin() ) {

        // Add the color-picker css file
        wp_enqueue_style( 'wp-color-picker' );

        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'color-picker-custom', plugins_url( 'js/color-picker-custom.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}
// add menu for configuration

add_action( 'admin_menu', 'brozzme_hover_add_admin_menu' );

function brozzme_hover_add_admin_menu(  ) {

    add_options_page('Brozzme Hover', __('Brozzme Hover Settings', 'brozzme-hover'), 'manage_options', 'brozzme-hover', 'bhi_options_page');

}
function brozzme_hover_welcome_page(){

?>
 <div class="notice"><h3><b>Brozzme Hover</b> <?php _e('allow you to embed CSS3 transitions on your website in a friendly way without needs to edit file.', 'brozzme-hover');?></h3>
     <p><?php _e('Available options', 'brozzme-hover');?>:
     <ul><li><b><?php _e('Enable Hover.css style', 'brozzme-hover');?></b>: <?php _e('Activation / desactivation (will not erase settings) of the plugin.', 'brozzme-hover');?></li>
         <li><?php _e('Activate Brozzme Hover and the editor get a new select menu (Formats) with all CSS3 transitions. Be sure that your element does not have many css class (i.e hvr-xxx). In this case, to verify and correct, turn your editor from Visual to Text and manually erase the class you want.', 'brozzme-hover');?></li>
         <li><i><?php _e('Nota : some selector will not work du to css limitation with effect (inline-block, margin...), ajust css properties in style.css in the css folder of the plugin.', 'brozzme-hover');?></i></li>
        <li><b><?php _e('Jquery loading', 'brozzme-hover');?></b>: <?php _e('Insert JavaSscript into the head or footer. Javascript is only need if you choose to include Brozzme Hover globally.', 'brozzme-hover');?></li>
        <li><b><?php _e('Include Brozzme Hover globally', 'brozzme-hover');?></b>: <?php _e('add Brozzme Hover classes to elements.', 'brozzme-hover');?></li>
        <li><b><?php _e('Target css class', 'brozzme-hover');?></b></li>
        <li><?php _e('Detect the css class name to animate in your favorite browser. Make sur to separate them with commas with <b>no space</b> before or after.', 'brozzme-hover');?></li>
        <li><b><?php _e('Effect', 'brozzme-hover');?></b>: <?php _e('Choose a transition effect to apply to all targets class.', 'brozzme-hover');?></li>
        <li><b><?php _e('Change the effect background color', 'brozzme-hover');?></b>: <?php _e('you can customize the background of some transition when need (i.e: background transitions).', 'brozzme-hover');?></li>
     </ul>
     </p>
 </div>
<?php
}

add_action( 'plugins_loaded', 'bhi_load_textdomain' );

/**
 * Load plugin textdomain.
 */
function bhi_load_textdomain() {
    load_plugin_textdomain( 'brozzme-hover', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * plugin settings links
 */
add_filter('plugin_action_links', 'brozzme_hover_plugin_action_links', 10, 2);

function brozzme_hover_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        // The &quot;page&quot; query string value must be equal to the slug
        // of the Settings admin page we defined earlier, which in
        // this case equals &quot;myplugin-settings&quot;.
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=brozzme-hover">'.__('Settings', 'brozzme-hover').'</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}