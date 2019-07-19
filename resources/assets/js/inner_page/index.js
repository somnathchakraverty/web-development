setTimeout(function(){ 
    if(typeof(clevertap) !== 'undefined') {
        clevertap.notifications.push({
            "titleText"         :'Would you like to receive Push Notifications?',
            "bodyText"          :'We promise to only send you relevant content and give you updates on your transactions',
            "okButtonText"      :'Sign me up!',
            "rejectButtonText"  :'No thanks',
            "okButtonColor"     :'#00a0a8'
        });
    }
},3000);

var select2;

function gaEventHabitRisk(name){
    pushGaEvent("Browse By Habit", "Click on Habit", name);
}

function gaEventCommonRisk(name){
    pushGaEvent("Browse By Habit", "Click on Habit", name);
}

/* Search - Home Page */
function searchHomePage() {
    // e.g. [Domain]/[city_name]/orderbook?f[profile_2]=Liver%20Function&f[parameter_2]=dsds
    var favorite = {};
    
    var content_ids   = [];
    var content_name  = [];

    $("select[name='search_value']").find("option:selected").each(function(){
        var pkg_id = $(this).val();
        var pkg_value = $(this).data('value');
        content_ids.push(pkg_id);
        content_name.push(pkg_value);
        favorite[pkg_id] = pkg_value;
    });

    var city_name = getCookie('sLocation');
    var city_detail = "{{$city_name}}";
    
    if(city_name !== '') {
        city_detail = city_name.toLowerCase();
    }

    /* Exception case : city not present in cookie and not set in backend */
    if(city_detail === '') {
        city_detail = 'gurgaon';
    }

    if(Object.keys(favorite).length !== 0 && favorite.constructor === Object) {
        var esc = encodeURIComponent;
        var search_query = Object.keys(favorite)
            .map(function(k) {
                return 'f[' + esc(k) + ']' + '=' + esc(favorite[k]);
            }).join('&');

        if (typeof(fbq) !== 'undefined') {
            var searchLength = Object.keys(favorite).length;         
            var content_type = 'product';
            var fbData = [];
            fbData['content_ids']   = content_ids;
            fbData['content_type']  = content_type;
            fbData['content_name']  = content_name;
            fbData['content_category'] = 'Search > Home Page';
            fbq('track', 'Search', fbData);
        }

        window.location = document.location.origin + '/' + city_detail + '/orderbook' + '?' + search_query;
    }
    else {
        console.log("Home Page : Search empty");
    }         
}

$(document).ready(function() {
    
    var interval = setInterval(function () {
        if ($("#actual_risk_area").isInViewport() || $("#actual_habit_area").isInViewport()) {
            var risk_api_url = $("#teams-slider3").data('apiurl');
            var risk_slider_setting = {
                'items' : 3,
                'autoPlay': true
            };
            getSliderAJAXData(risk_api_url, "teams-slider3", risk_slider_setting, true);
            
            var habit_api_url = $("#teams-slider5").data('apiurl');
            var habit_slider_setting = {
                'items' : 3,
                'autoPlay': true
            };
            getSliderAJAXData(habit_api_url, "teams-slider5", habit_slider_setting, true);

            clearInterval(interval);
        }
    }, 500);

    // var interval1 = setInterval(function () { 
    //     if ($("#recomendation").isInViewport() || $("#actual_habit_area").isInViewport()) {
    //         var api_url = $("#recomendation").data('apiurl');
    //         var subscription_slider_setting = {
    //             'items' : 3,
    //             'autoPlay': true
    //         };
    //         getSliderAJAXData(api_url, 'recomendation', subscription_slider_setting, true);
            
    //         clearInterval(interval1);
    //     }
    // }, 500);

    var interval2 = setInterval(function () { 
        if ($("#blog_section").isInViewport()) {
            var api_url = $("#blog_slider").data('apiurl');
            getSliderAJAXData(api_url, 'blog_slider', {}, false);
            clearInterval(interval2);
        }
    }, 500);
    
    function matchCustom(params, data) {
        console.log(data);
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.text += ' (matched)';
            console.log("modifiedData.text", modifiedData.text);
            return 'hello';
            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    function matchStart(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }
        console.log("hello1");
        console.log(data.children);
        // Skip if there is no 'children' property
        // if (typeof data.children === 'undefined') {
        //     return null;
        // }

        // `data.children` contains the actual options that we are matching against
        var filteredChildren = [];
        $.each(data.children, function (idx, child) {
            if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) > -1) {
                filteredChildren.push(child);
            }
        });
        console.log("hello2");
        console.log(filteredChildren);
        var currentRequest;
        if (filteredChildren.length == 0 && params.term.length > 2) {

            // Fetch the preselected item, and add to the control
            // var filterSelect = $('.js-select2');
            currentRequest =  $.ajax({
                url: 'http://d4api.healthians.co.in/webv1/web_api/packageSuggestion?city_id=23&keyword='+params.term,
                type: "GET",
                async: false,
                cache: false,
                beforeSend : function()    {
                    if(currentRequest != null) {
                        console.log("aborting");
                        currentRequest.abort();
                    }
                },
                success: function (data) {
                    // var data = data.data;
                    // console.log("hello");
                    // console.log(data);
                    // $.each(data, function (idx, child) {
                    //     console.log(child);
                    //     var option = new Option(child.text, child.id, true, true);
                    //     console.log(option);
                    //     // filterSelect.append(option).trigger('change');
                    // });
                    
                    currentRequest = null;
                    return data;
                }
            });
            
            if( typeof currentRequest != 'undefined' && typeof currentRequest.responseJSON != 'undefined' )
            {
                if( currentRequest.responseJSON.data != null && currentRequest.responseJSON.data.length > 0)
                {
                    var children_array  =   [];
                    $.each(currentRequest.responseJSON.data, function (idx, child) {
                        children_array.push({
                                id:child.id,
                                text: child.text, 
                            });
                        // filterSelect.append(option).trigger('change');
                    });
                    var data_option   =   [
                            {
                                id: '',
                                text: 'Search Result',
                                children: children_array
                            },
                        ];
                    console.log(data_option);
                    select2.select2({
                        data: data_option,
                        matcher: matchStart,
                    }).on('select2-selecting', function(e) {
                        var $select = $(this);
                        if (e.val == '') {
                            e.preventDefault();
                            var childIds = $.map(e.choice.children, function(child) {
                                return child.id;
                            });
                            console.log(childIds);
                            //$select.select2('val', $select.select2('val').concat(childIds));
                            // $select.select2('close');
                        }
                    });
                    // filteredChildren = currentRequest.responseJSON.data
                }
            }
            console.log("hello3");
            console.log(currentRequest.responseJSON.data);
            
        }else{
            return data;
        }
        // If we matched any of the timezone group's children, then set the matched children on the group
        // and return the group object
        
        if (filteredChildren.length) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.children = filteredChildren;
        console.log(filteredChildren);

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }
        
        // Return `null` if the term should not be displayed
        return null;
    }


    select2 = $(".js-select2").select2({
        closeOnSelect : false,
        placeholder : "Search your Package/Test",
        allowHtml: true,
        allowClear: true,
        tags: true,
        // matcher: matchStart,
        //Allow manually entered text in drop down.
        // createTag: function (params) {
        //     return {
        //     id: params.term,
        //     text: params.term,
        //     newOption: true
        //     }
        // },
        // templateResult: function (data) {
        //     var $result = $("<span></span>");

        //     $result.text(data.text);

        //     if (data.newOption) {
        //     $result.append(" <em>(new)</em>");
        //     }

        //     return $result;
        // }

    });

});

function getSliderAJAXData(api_url, element_id, slider_setting, carousel_active) {
    $.ajax({
        url: api_url,
        type: "GET",
        success: function (data) {
            var response_data = data;
            $("#"+element_id).html(response_data.html_data);
            setTimeout(function(){
                if(carousel_active) {
                    enableCarousel(slider_setting, element_id);
                }
            },100);
        }
    });
}

function enableCarousel(slider_setting, element_id) {
    $("#"+element_id).owlCarousel({
        navigation : true,
        pagination : false,
        items : slider_setting.items,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });
}

