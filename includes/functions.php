<?php

/*!
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

 */



// API PHP

function get_hover_version($hover_class_array){
    $version = $hover_class_array['version'];
}
function get_hover_prefix($hover_class_array){
    $prefix = $hover_class_array['prefix'];
    return $prefix;
}
function get_hover_effect_type($hover_class_array, $select_name, $select_id){
    $prefix = $hover_class_array['prefix'];

    $output = '<select name="brozzme_dropdown" id="'.$select_id.'">';
    $output .= '<option selected value="base">Please Select</option>';
    foreach($hover_class_array as $key=>$value){
        if($key == 'hoverclass'){
            foreach($value as $subkey=>$subvalue){
                $output .= '<option value="'.$subkey.'">'.$subkey.'</option>';

            }
        }
    }
    $output .= '</select>';
    $output .= '<select name="'.$select_name.'" id="json-two">
                <option>Please choose above</option>
            </select>';

    return $output;
}
function get_all_effects_dropdown($hover_class_array, $select_name, $selected){
    $prefix = $hover_class_array['prefix'];

    $output = '<select name="'.$select_name.'" id="'.$select_name.'">';

    foreach($hover_class_array as $key=>$value){
        if($key == 'hoverclass'){
            foreach($value as $subkey=>$subvalue){
                $output .= '<optgroup label="'.$subkey.'">';
                foreach($subvalue as $class=>$class_name){
                    if ( $selected == $class ) {$selected_to_current = 'selected="selected"';}
                    else{$selected_to_current='';}

                    $output .= '<option value="'. $prefix . $class .'" '.$selected_to_current.'>'.$class_name.'</option>';
                }
            }
        }
    }
    $output .= '</select>';

    return $output;
}

function array_json_encoding($hover_class_array){
    echo json_encode($hover_class_array);

}
function return_fresh_select($select_name, $array, $prefix, $part){
    $select = '';
    $select = '<select name="'.$select_name.'">';
    $select .= '<optgroup label="'.$part.'">';
    $select .= '<option value="'.$part.'">'.$part.'</option>';
    foreach($array as $key=>$value){
        $select .= '<option value="'. $prefix . $key .'">'.$value.'</option>';
    }

    $select .= '</select>';

    return $select;

}
