/**
 * Created by admin on 27/01/15.
 */


jQuery(function($){

    $("#json-one").change(function() {

        var $dropdown = $(this);

        $.getJSON("../wp-content/plugins/brozzme-hover/jsondata/data.json", function(data) {

            var key = $dropdown.val();
            var vals = [];
            var container = [];
            var prefix = data.prefix;
            var $jsontwo = $("#json-two");

            $jsontwo.empty();
            switch(key) {

                case 'transition':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='transition') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'background':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='background') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'border':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='border') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'shadow-glow':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='shadow-glow') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'speech-bubbles':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='speech-bubbles') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'icons':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='icons') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'curls':
                    container = data.hoverclass;
                    $.each(container, function(i, object) {
                        if(i =='curls') {
                            $.each(object, function (index, value) {
                                $jsontwo.append("<option value='" + prefix + index + "'>" + value + "</option>");
                            });
                        }
                    });
                    break;

                case 'base':
                    vals = ['Please choose from above'];
            }
        });
    });
});

jQuery(function($){
    // change the div effect without loading
    $("#tss_effect").change(function() {
        var $dropdown = $(this);
        var key = $dropdown.val();
        var prefix1 = 'hvr-';
        var lastClass = $('.test').attr('class').split(' ').pop();
        $(".test").removeClass( lastClass ).addClass( key );


    });
});
// change the div effect without loading
jQuery(function($){

    $("#json-two").change(function() {
        var $dropdown = $(this);
        var key = $dropdown.val();
        var prefix1 = 'hvr-';
        var lastClass = $('.test').attr('class').split(' ').pop();
        $(".test").removeClass( lastClass ).addClass( key );


    });
});