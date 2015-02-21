/**
 * Created by Benoît Faure on 28/01/15.
 *
 * http://codex.wordpress.org/Function_Reference/wp_localize_script
 */

jQuery(function($){
    var bhiClass = bhiOptions.bhi_automatic_style_targets;
    var substr = bhiClass.split(',');
    var effect = bhiOptions.bhi_effect_name;
    var color = bhiOptions.bhi_background_color;
    $('head').append("<style>." + effect + ":before { background:" + color + "; }</style>");


    //alert(color);
    for(var i=0; i< substr.length; i++) {
        $("."+ substr[i]).addClass( effect );
     //    $("."+substr[i]+":before").css({"background": color, "color": "white"});
    }


});
