<?php
/**
 * Plugin Name: Brozzme Hover.css integration
 * Plugin URL: http://brozzme.com/hover-functions/
 * Description: shortcode, collection, responsive, css, hover effects
 * Version: 0.1
 * Author: Benoît Faure
 * Author URI: http://brozzme.com
 *
 * Set of functions created to choose and play with Hover.css (Ian Lunn)
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
 * http://codex.wordpress.org/TinyMCE_Custom_Styles
 * http://code.tutsplus.com/tutorials/adding-custom-styles-in-wordpress-tinymce-editor--wp-24980
 *
 */

add_filter('mce_css', 'brozzme_hover_editor_style');
function brozzme_hover_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/css/hover.css';

    return $url;
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'brozzme_hover_editor_buttons' );

function brozzme_hover_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'brozzme_hover_before_init' );

function brozzme_hover_before_init( $settings ) {

    $style_formats = formats_class_array();


    $settings['style_formats'] = json_encode( $style_formats );

    // var_dump($settings['style_formats']);

    return $settings;

}

/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */

/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
//add_action('wp_enqueue_scripts', 'brozzme_hover_editor_enqueue');

/*
 * Enqueue stylesheet, if it exists.
 */
function brozzme_hover_editor_enqueue() {
    $StyleUrl = plugin_dir_url(__FILE__).'/css/hover.css';
    wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}

// function to retrieve hover class array and format it for dropdown in tinymce editor
function formats_class_array(){
    global $hover_class_array;
  //  $formats_array = array();
    $formats_types = array();

    foreach($hover_class_array['hoverclass'] as $key=>$value) {
        $item = array();


         foreach ($value as $subkey => $subvalue) {
             // need to add restriction for img and some class
              $item[] = array('title'=> $subvalue, 'selector'=>'a,p,li,div,span,img,h1,h2,h3,h4', 'classes'=> 'hvr-'.$subkey);

          }

        $formats_types[] = array('title'=> $key, 'items'=>$item);
    }
    $formats_array = $formats_types;

return $formats_array;
}
function style_formats_hover(){
    global $hover_class_array;

    $formats_types = array();
    // retrieve all effect types catégories
    foreach($hover_class_array['hoverclass'] as $key=>$value){
      $formats_types[]= array();
    }


}