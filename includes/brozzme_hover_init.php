<?php

/**
 * Plugin Name: Brozzme Hover - CSS3 transitions
 * Plugin URL: http://brozzme.com/hover-functions/
 * Description: CSS3 transitions on structural elements, hover effects
 * Set of functions created to choose and play with Hover.css (Ian Lunn)
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

add_action( 'admin_init', 'brozzme_hover_settings_init' );

function brozzme_hover_settings_init(  ) {
global $hover_class_array;
    register_setting( 'brozzmeHoverIntegrationCss', 'brozzme_hover_settings' );
    
    
        add_settings_section(
            'bhi_brozzmeHoverIntegration_section',
            __( 'Make Hover.css a part of your WordPress styles', 'brozzme-hover' ),
            'brozzme_hover_settings_section_callback',
            'brozzmeHoverIntegrationCss'
        );
                add_settings_field(
                    'bhi_enable_style',
                    __( 'Enable Hover.css CSS3 transitions', 'brozzme-hover' ),
                    'bhi_integration_style_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section'
                );
                add_settings_field(
                    'bhi_enable_automatic_hover',
                    __( 'Enable automatic Hover transitions', 'brozzme-hover' ),
                    'bhi_enable_automatic_hover_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section'
                );
                add_settings_field(
                    'bhi_jquery_loading',
                    __( 'Jquery loading', 'brozzme-hover' ),
                    'bhi_jquery_loading_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section'
                );
                add_settings_field(
                    'bhi_automatic_style_targets',
                    __( 'Target css class (separate by commas)', 'brozzme-hover' ),
                    'bhi_automatic_style_targets_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section'
                );
                add_settings_field(
                    'bhi_effect_name',
                    __( 'CSS3 transition Effect', 'brozzme-hover' ),
                    'bhi_box_effect_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section',
                    array('hover_array' => $hover_class_array,)
                );
                add_settings_field(
                    'bhi_background_color',
                    __( 'Change the effect background color', 'brozzme-hover' ),
                    'bhi_background_color_render',
                    'brozzmeHoverIntegrationCss',
                    'bhi_brozzmeHoverIntegration_section'
                );
}

// form rendering



function bhi_integration_style_render(  ) {

    $options = get_option( 'brozzme_hover_settings' );
    ?>
    <select name="brozzme_hover_settings[bhi_enable_style]">
        <option value="1" <?php if ( $options['bhi_enable_style'] == 1 ) echo 'selected="selected"'; ?>><?php _e( 'Default (link hover)', 'brozzme-hover' );?></option>
        <option value="2" <?php if ( $options['bhi_enable_style'] == 2 ) echo 'selected="selected"'; ?>><?php _e( 'No link Hover', 'brozzme-hover' );?></option>
    </select>
<?php

}
function bhi_jquery_loading_render(  ){

    $options = get_option( 'brozzme_hover_settings' );
    ?>
    <select name='brozzme_hover_settings[bhi_jquery_loading]'>
        <option value='2' <?php selected( $options['bhi_jquery_loading'], 2 ); ?>><?php _e( 'Default (header)', 'brozzme-hover' );?></option>
        <option value='1' <?php selected( $options['bhi_jquery_loading'], 1 ); ?>><?php _e( 'Choosen (footer)', 'brozzme-hover' );?></option>
    </select>
<?php

}
function bhi_box_effect_render(  ){

    $options = get_option( 'brozzme_hover_settings' );
    global $hover_class_array;
   // echo get_hover_effect_type($hover_class_array, 'brozzme_hover_settings[bhi_effect_name]', 'json-one');
    $select_name = 'brozzme_hover_settings[bhi_effect_name]';
    $select_id = 'json-one';
    $prefix = $hover_class_array['prefix'];
    if($options['bhi_effect_name']!=''){
        echo '<select name="brozzme_dropdown" id="'.$select_id.'">';
        echo '<option selected value="base">'.__('Please Select another type','brozzme-hover').'</option>';
        foreach($hover_class_array as $key=>$value){
            if($key == 'hoverclass'){
                foreach($value as $subkey=>$subvalue){
                    $friendly_name = $hover_class_array['hovertypes'][$subkey];
                    echo  '<option value="'.$subkey.'" >'.$friendly_name.'</option>';
                }
            }
        }
        echo '</select>';
        echo '<select name="'.$select_name.'" id="json-two">
                <option value="'.$options['bhi_effect_name'].'" selected>'.$options['bhi_effect_name'].'</option>
            </select>';
        echo '<div style="clear:left;padding-top:20px;">
            <div class="test '.$options['bhi_effect_name'].'"><a href="#">'.get_bloginfo('name').'</a></div>
        </div>';
    }
    else{
        echo '<select name="brozzme_dropdown" id="'.$select_id.'">';
        echo '<option selected value="base">'.__('Please Select a type','brozzme-hover').'</option>';
        foreach($hover_class_array as $key=>$value){
            if($key == 'hoverclass'){
                foreach($value as $subkey=>$subvalue){
                    $friendly_name = $hover_class_array['hovertypes'][$subkey];
                    echo  '<option value="'.$subkey.'" >'.$friendly_name.'</option>';
                }
            }
        }
        echo '</select>';
        echo '<select name="'.$select_name.'" id="json-two">
                <option>'.__('Select a type above','brozzme-hover').'</option>
            </select>';
        $blog_title = get_option('blogname');
        echo '<div style="clear:left;padding-top:20px;">
            <div class="test hvr-buzz"><a href="">'.get_bloginfo('name').'</a></div>
        </div>';
    }

//var_dump($options);
}

function bhi_enable_automatic_hover_render(  ){

    $options = get_option( 'brozzme_hover_settings' );
    ?>
    <select name='brozzme_hover_settings[bhi_enable_automatic_hover]'>
        <option value='1' <?php selected( $options['bhi_enable_automatic_hover'], 1 ); ?>><?php _e( 'Yes', 'brozzme-hover' );?></option>
        <option value='2' <?php selected( $options['bhi_enable_automatic_hover'], 2 ); ?>><?php _e( 'No', 'brozzme-hover' );?></option>
    </select>
<?php

}
function bhi_automatic_style_targets_render(  ) {

    $options = get_option( 'brozzme_hover_settings' );
    ?>
    <input type='text' name='brozzme_hover_settings[bhi_automatic_style_targets]' value='<?php echo $options['bhi_automatic_style_targets']; ?>'>
<?php

}


function bhi_background_color_render(  ) {

    $options = get_option( 'brozzme_hover_settings' );
    ?>
    <input type='text' name='brozzme_hover_settings[bhi_background_color]' value='<?php echo $options['bhi_background_color']; ?>' class='color-field'>
<?php

}
function brozzme_hover_settings_section_callback(  ) {

    echo __( 'Manage your Hover.css settings for ', 'brozzme-hover' ).' '.get_bloginfo('name');

}


function bhi_options_page(  ) {

    ?>
    <form action='options.php' method='post'>

        <h2><?php _e( 'Brozzme Hover.css Integration', 'brozzme-hover' );?></h2>

        <?php
        settings_fields( 'brozzmeHoverIntegrationCss' );
        do_settings_sections( 'brozzmeHoverIntegrationCss' );
        submit_button();
        ?>

    </form>
<?php
    brozzme_hover_welcome_page();
}
