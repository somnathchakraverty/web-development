var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

function showStrErrorFast(type, message){
    switch(type) {
        case 'success':
        toastr.success( message, 'success!', {timeOut: 1500} );

        break;
        case 'info':
        toastr.info( message, 'Info!', {timeOut: 1500} );

        break;
        case 'error':
        toastr.error( message, 'Error!', {timeOut: 1500} );

        break;
        case 'warning':
        toastr.warning( message, 'Warning!', {timeOut: 1500} );

        break;
        default:
        toastr.info( message, 'Info!', {timeOut: 1500} );
    }
}

var total_question = 0;
var question_list_json = [];
var current = 1;

/* Form And Question - Start */
function getHealthQuestionLeadSuccessHandler(response) {
    $("#ajax-loader").hide();

    var question_list = '';
    total_question = response.length;
    question_list_json = response;
    var question_indicator = ''; 

    response.forEach(function(items, key) { 
        
        if(key === 0) {
            question_indicator += '<li onClick="clickIndicator('+(key+1)+');" class="qindic active" id="q_indicator_'+(key+1)+'"></li>';
        }
        else {
            question_indicator += '<li onClick="clickIndicator('+(key+1)+');" class="qindic" id="q_indicator_'+(key+1)+'"></li>';
        }
        

        if(key == 0) {
            question_list += '<div class="item questionListImage img_'+items.question_id+'" id="q'+(key+1)+'_div">';
        }
        else {
            question_list += '<div class="item questionListImage hide_question img_'+items.question_id+'" id="q'+(key+1)+'_div">';
        }
        
       
       
        question_list += '<article class="question_list">';
        question_list +=    '<div class="carouselCaption questionListCap">';
        question_list +=    '   <h1>Answer the following questions</h1>';
                                    
        question_list +=    '   <div class="main-question">';
        question_list +=    '       <h3>'+items.question+'</h3>';
        if(items.question_type == 1)  {
            question_list +=    '<h4> (You can select multiple choice) </h4>';
        } 
                                        
        question_list +=    '   <div class="cursorBlink">';
        if(items.question_sub_type == 0) {
            question_list +=    '       <div class="hkradio-selector">';
        }
        if((items.question_sub_type == 1) && (items.question_type == 0)) {
            question_list +=    '       <div class="hkbox-select">';
        }
        if((items.question_sub_type == 1) && (items.question_type == 1)) {
            question_list +=    '       <div class="hkbox-check">';
        }

        question_list +=    '<ul>';
        
        items.options.forEach(function(opt, key2) { 
            question_list +=    '<div class="display_break_q'+items.question_id+'">';
            if(items.question_sub_type == 0) {
                question_list +=    '<li>';
                question_list +=    '<input id="quest_'+opt.option_id+'" type="radio" name="quest_'+items.question_id+'" value="'+opt.option_id+'" onClick="clickNewRadio('+(key+1)+');" required />';
                question_list +=    '<label style="padding-left:0px !important;" class="'+opt.class+'" for="quest_'+opt.option_id+'" class="">';
                question_list +=    '<font>'+opt.option+'</font>';
                question_list +=    '</label>';
                question_list +=    '</li>';
            }
                            
            if((items.question_sub_type == 1) && (items.question_type == 0)) {
                question_list +=    '<li class="'+opt.class+'">';
                question_list +=    '<input id="quest_'+opt.option_id+'" type="radio" name="quest_'+items.question_id+'" value="'+opt.option_id+'" onClick="clickNewRadio('+(key+1)+');" required />';

                question_list +=    '<label  for="quest_'+opt.option_id+'">';
                question_list +=    '<center>'+opt.option+'</center>';
                question_list +=    '</label>';
                question_list +=    '</li>';
            }
            if((items.question_sub_type == 1) && (items.question_type == 1)) {
                question_list += '<div class="'+opt.class+' checkbox-btn">';                            
                 question_list += '<input name="quest_'+items.question_id+'" type="checkbox" id="quest_'+items.question_id+'_'+opt.option_id+'" value="'+opt.option_id+'" required/>';
                
                question_list += '<label class="checkbox-inline" for="quest_'+items.question_id+'_'+opt.option_id+'" onClick="clickLastCheckbox('+items.question_id+','+opt.option_id+');"><center>'+opt.option+'</center>';
                question_list += '</label>';
                question_list += '</div>';
                
            }
            question_list += '</div>';
        });
        question_list += '</ul>\
                        </div>\
                    </div>\
                </div>\
            </div>';

                                
        question_list += '<div class="hk_nextprev">';
        question_list += '<ul>';
    
        if(key>=1) {
            question_list += '<li class="">';
            question_list += '<input class="hk_arrowprev" type="button" name="prev_q'+(key+1)+'" id="prev_q'+(key+1)+'" value="" onClick="showNewPrevious();">';
            question_list += '</li>';
        }
        

        question_list += '<li class="">';
        question_list += '<input class="hk_arrownext" type="button" style="opacity:0.2;" name="next_q'+(key+1)+'" id="next_q'+(key+1)+'" value="" onClick="showNewNext();" disabled="disabled">';
        question_list += '</li>';
        
        question_list += '</ul>';
                                
        question_list += '</div>';                           
        question_list += '</article>';
        question_list += '<img src="'+items.background_image+'" alt="" style="width:100%;">';
        question_list += '</div>';
    });

    $("#healthkarma_question_list").html(question_list);
    $("#healthkarma_form_div").hide();
    $("#healthkarma_question_div").show();
    $("#healthkarma_question_indicator").html(question_indicator);

    if (isMobile.any()) {
        $.scrollTo($('#healthkarma_question_div'), 1000);
    }
}

function getHealthQuestionErrorHandler() {
    $("#ajax-loader").hide();

    var errorData = response.responseJSON;
        
    showStrError("error", errorData.message);
    return false;
}


function getNewQuestionList() {
    var name = $("#huserName").val();
    if(name == '') {
        showStrErrorFast("error", "Full name is required");
        var element = document.getElementById("huserName");
        element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
        element.focus();
        return false;
    }
    if(!(/^[A-Za-z\s]+$/.test(name))) {
        showStrErrorFast("error", "Full name should be alphabet");
        var element = document.getElementById("huserName");
        element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
        $("#huserName").val("");
        element.focus();
        return false;
    }

    var mobile = $("#huserphone").val();
    if(mobile == '') {
        showStrErrorFast("error", "Mobile No. is required");
        var element = document.getElementById("huserphone");
        element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
        element.focus();
        return false;
    }
    if(!(/^\d{10}$/.test(mobile))) {
        showStrErrorFast("error", "Please enter Valid Mobile No.");
        var element = document.getElementById("huserphone");
        element.focus();
        return false;
    }

    var email_id = $("#healthkarma_email").val();
    if(email_id == '') {
        showStrErrorFast("error", "Email is required");
        var element = document.getElementById("healthkarma_email");
        element.focus();
        return false;
    }
    if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/.test(email_id))) {
        showStrErrorFast("error", "Please enter Valid Email");
        var element = document.getElementById("healthkarma_email");
        element.focus();
        return false;
    }

    var userAge = $("#userAge").val();
    if(userAge == '') {
        showStrErrorFast("error", "Age is required");
        var element = document.getElementById("userAge");
        element.focus();
        return false;
    }
    if(isNaN(userAge)) {
        $("#userAge").val("");
        showStrErrorFast("error", "Please enter valid age");
        var element = document.getElementById("userAge");
        element.focus();

        return false;
    }

    if(parseInt(userAge) < 5 || parseInt(userAge)>120) {
        showStrErrorFast("error", "Age should be in between 5 to 120");
        var element = document.getElementById("userAge");
        element.focus();
        return false;
    }
    
    var userweight = $("#userweight").val();
    if(userweight == '') {
        showStrErrorFast("error", "Weight is required");
        var element = document.getElementById("userweight");
        element.click();
        element.focus();
        $('#next_form').show();
        return false;
    }
    if(isNaN(userweight)) {
        $("#userweight").val("");
        showStrErrorFast("error", "Please enter valid weight");
        var element = document.getElementById("userweight");
        element.focus();
        return false;
    }

    var userheight = $("#userheight").val();
    if(userheight == '') {
        showStrErrorFast("error", "Height is required");
        var element = document.getElementById("userheight");
        element.focus();
        return false;
    }

    var husergender = $("input[name='husergender']:checked").val();
    if(typeof husergender === 'undefined') {
        showStrErrorFast("error", "Please select gender");
        return false;
    }

    var request_question = {
        'age'       : $("#userAge").val(),
        'gender'    : $("input[name='husergender']:checked").val()
    };

    pushGaEvent('Healthkarma', 'Fill - Basic Form', request_question);

    ajaxCallPromise(getHealthKarmaQuestion_api_url, "GET", request_question).then(getHealthQuestionLeadSuccessHandler, getHealthQuestionErrorHandler);    
}
/* Form And Question - End */

/* Save health Karma - Start */
var karma_recommend_data = {};
function saveHealthKarmaSuccessHandler(response) {
    $("#ajax-loader").hide();
    if(response) {
        if(response.status) {
            $("#healthkarma_question_div").hide()
            $("#healthkarma_result_div").show();

            document.querySelector('meta[property="og:image"]').setAttribute("content", response.data.webURL);
            document.querySelector('meta[property="og:url"]').setAttribute("content", response.data.webURL);

            var name = $("#huserName").val();
            name = name.charAt(0).toUpperCase() + name.slice(1);
            $("#c_name").html(name);

            $("#h_score").html(response.data.lifeStyleScore);
            $("#peer_score").html(response.data.peerscore+'%');
            
            var risk_data = '';
            if(response.data.risks.length > 0) {
                response.data.risks.forEach(function(val){ 
                    risk_data += '<p class="risk_p">';
                    risk_data += '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+val;
                    risk_data += '</p><br>';
                });
            }
            else {
                risk_data += '<p>';
                risk_data += '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Probable Risks';
                risk_data += '</p>';
            }
            $("#risk_data").html(risk_data);

            var showRecommend = true;
            if(getUrlVars()['recommend'] != undefined) {
                showRecommend = false;
            }
            
            if(showRecommend) {
                var recommend_data = ''; 
                karma_recommend_data = response.data.recommendedTests;
                if(response.data.recommendedTests) {
                    if(response.data.recommendedTests.length > 0) {
                        response.data.recommendedTests.forEach(function(val){ 
                            if(val.name !== '') {
                                recommend_data += '<div class="cart-block cart-width">';
                                recommend_data += '<p>'+val.name+'</p>';
                                recommend_data += '<div class="checkbox checkbox-info checkbox-circle">';
                                recommend_data += '<input name="recommd_check" id="rec_'+val.id+'" value="'+val.id+'" type="checkbox" checked>';
                                recommend_data += '<label for="rec_'+val.id+'"></label>';
                                recommend_data += '</div>';
                                recommend_data += '</div>';
                            }
                        });
                    }
                }
                
                if(recommend_data !== '') {
                    $("#recommend_data").html(recommend_data);
                }
                else {
                    recommend_data += '<div class="cart-block cart-width">';
                    recommend_data += '<p>'+response.data.noRiskMessage+'</p>';
                    recommend_data += '</div>';
                }
            }
            else {
                $("#recomm_head").hide();
                $("#recomm_div").hide();
            }

            if (isMobile.any()) {
                $.scrollTo($('#healthkarma_result_div'), 1000);
            }          
        }
    }
}

function saveHealthKarmaErrorHandler(response) {
    $("#ajax-loader").hide();

    var errorData = response.responseJSON;
        
    showStrError("error", errorData.message);
    return false;
}

function submit_feedback_new() {
    var name = $("#huserName").val(); 
    var mobile = $("#huserphone").val();
    var email_id = $("#healthkarma_email").val();
    var userAge = $("#userAge").val();
    var userweight = $("#userweight").val();
    var userheight = $("#userheight").val();
    var husergender = $("input[name='husergender']:checked").val();
    var selected_city = getCookie("sLocationID");
    var token = $("#_token").val();

    var request_data = {
        "age": userAge,
        //"options": "[{\"question_id\":\"1\",\"option_id\":\"3\"},{\"question_id\":\"4\",\"option_id\":\"18\"},{\"question_id\":\"6\",\"option_id\":\"27\"},{\"question_id\":\"10\",\"option_id\":\"45\"},{\"question_id\":\"11\",\"option_id\":\"51\"},{\"question_id\":\"12\",\"option_id\":\"54\"},{\"question_id\":\"13\",\"option_id\":\"58\"},{\"question_id\":\"14\",\"option_id\":\"63\"},{\"question_id\":\"16\",\"option_id\":\"73\"},{\"question_id\":\"19\",\"option_id\":\"92\"},{\"question_id\":\"20\",\"option_id\":\"93\"},{\"question_id\":\"22\",\"option_id\":\"98,100,103\"}]",
        "height": userheight,
        "name": name,
        "gender": husergender,
        "weight": userweight,
        "cityId": selected_city,
        "email": email_id,
        "contact_number": mobile,
        '_token' : token
    }

    if(getUrlVars()['user_id'] != undefined) {
        request_data['userId'] = getUrlVars()['user_id'];
    }

    if(getUrlVars()['lead_id'] != undefined) {
        request_data['lead_id'] = getUrlVars()['lead_id'];
    }   

    var question_save = [];
    var saveFlag = true;
    question_list_json.forEach(function(items, key) { 
        if(items.question_sub_type == 0) {
            var answer = $("input[name='quest_"+items.question_id+"']:checked").val();
            if(answer) {
                question_save.push({question_id:items.question_id, option_id: answer});
            }
            
        }
        else if((items.question_sub_type == 1) && (items.question_type == 0)) {
            var answer = $("input[name='quest_"+items.question_id+"']:checked").val();
            if(answer) {
                question_save.push({question_id:items.question_id, option_id: answer});
            }
        }
        else if((items.question_sub_type == 1) && (items.question_type == 1)) {
            var checkbox_answer = [];
            $.each($("input[name='quest_"+items.question_id+"']:checked"), function(){  
                checkbox_answer.push($(this).val());
            });

            if(checkbox_answer.length === 0) {
                showStrError("error", "Please select atleast one checkbox.");
                saveFlag = false;
                return false;
            }

            if(checkbox_answer.length > 0) {
                question_save.push({question_id:items.question_id, option_id: checkbox_answer.join(',')});
            }
        }
    });
    request_data['options'] =  JSON.stringify(question_save);
    
    if(saveFlag) {
        pushGaEvent('Healthkarma', 'Click Continue - Question', request_data['name']);
        ajaxCallPromise(saveHealthKarma_api_url, "POST", request_data).then(saveHealthKarmaSuccessHandler, saveHealthKarmaErrorHandler);    
    }
}
/* Save health Karma - End */

/* Health Karma - Question Logics - Start */
function clickNewRadio(ques) {

    $.each($(".qindic"), function(){  
        $(this).removeClass('active');
    });
    
    $("#q_indicator_"+(ques+1)).addClass('active');

    if(ques === total_question) {
        return false;
    }

    current = ques;

    if (ques === (total_question-1)) {
        $('#q' + ques + '_div').fadeOut();

        setTimeout(function() {
            var nextquest = parseInt(ques) + 1;
            $('#q' + nextquest + '_div').fadeIn();

            current = nextquest;
            $('#next_q' + ques).css('opacity', '1');
            $('#next_q' + ques).removeAttr("disabled", "disabled");
            $('#next_q' + nextquest).css('opacity', '1');
            $('#next_q' + nextquest).removeAttr("disabled", "disabled");
        }, 400);

        if (isMobile.any()) {
            window.scrollTo(0,200);  
        }
    } else {
        $('#q' + ques + '_div').fadeOut();

        setTimeout(function() {
            var nextquest = parseInt(ques) + 1;
            $('#q' + nextquest + '_div').fadeIn();

            current = nextquest;
            $('#next_q' + ques).css('opacity', '1');
            $('#next_q' + ques).removeAttr("disabled", "disabled");
            // if (isMobile.any()) {
            //     $.scrollTo($('.hk_formDetailBlock'), 1000);
            // }
        }, 400);
    }
    
    
}

function showNewPrevious() {
    var prev_ques = parseInt(current) - 1;

    var cur_quest = parseInt(current);
    $('#q' + cur_quest + '_div').fadeOut();
    //scope.quest['q' + cur_quest] = false;

    $('#q' + prev_ques + '_div').fadeIn();
    //scope.quest['q' + prev_ques] = true;
    current = prev_ques;

    $.each($(".qindic"), function(){  
        $(this).removeClass('active');
    });
    
    $("#q_indicator_"+current).addClass('active');
}

function showNewNext() {

    if (parseInt(current) === total_question) {
        //$analytics.eventTrack('Click on Final Submit', { category: 'HealthKarmaV2' });
        submit_feedback_new();
    }
    else {
        var next_ques = parseInt(current) + 1;

        var cur_quest = parseInt(current);
        $('#q' + cur_quest + '_div').fadeOut();
        //scope.quest['q' + cur_quest] = false;

        $('#q' + next_ques + '_div').fadeIn();
        //scope.quest['q' + next_ques] = true;
        current = next_ques;
        
        $.each($(".qindic"), function(){  
            $(this).removeClass('active');
        });
        $("#q_indicator_"+current).addClass('active');
    }        
}

function clickLastCheckbox(question_id, option_id) {
    if(option_id !== 98) {
        $.each($("input[name='quest_22']:checked"), function(){  
            if($(this).val() == "98") {
                $(this).prop('checked', false);
            }          
           
        });
    }
    else {
        $.each($("input[name='quest_22']:checked"), function(){  
            if($(this).val() !== "98") {
                $(this).prop('checked', false);
            }
        });           
    } 
}

function clickIndicator(ques) {
    if(parseInt(ques) < parseInt(current)) {
        var prev_ques = parseInt(ques);

        var cur_quest = parseInt(current);
        $('#q' + cur_quest + '_div').fadeOut();
        $('#q' + prev_ques + '_div').fadeIn();
        current = prev_ques;

        $.each($(".qindic"), function(){  
            $(this).removeClass('active');
        });
        
        $("#q_indicator_"+current).addClass('active');
    }

    if(parseInt(ques) > parseInt(current)) {
        if($('#next_q'+current)[0].hasAttribute('disabled')) {
            
        }
        else {
            var next_ques = ques;

            var cur_quest = parseInt(current);
            $('#q' + cur_quest + '_div').fadeOut();
            $('#q' + next_ques + '_div').fadeIn();
            current = next_ques;
            
            $.each($(".qindic"), function(){  
                $(this).removeClass('active');
            });
            $("#q_indicator_"+current).addClass('active');
        }
    }
}
/* Health Karma - Question Logics - End */

/* Recommend - Start */
function recommend_search() {
    var final_search = [];
    var favorite = {};

    $.each($("input[name='recommd_check']:checked"), function(){  
        var selected_id = $(this).val();
        if(selected_id) {
            karma_recommend_data.forEach(function(items, key) {  
                if(items.id == selected_id) {
                    var tt = {
                        "id": items.type+'_'+items.id,
                        "text": items.name
                    }
                    final_search.push(tt);
                    favorite[items.type+'_'+items.id] = items.name;
                }
            });
        }        
    });

    if (final_search.length !== 0) {     
        
        pushGaEvent('Healthkarma', 'Search From Health Karma', final_search);

        var selected_city = getCookie("sLocation");

        if(selected_city === '' || selected_city == null) {
            selected_city = 'gurgaon';
        }

        var search_query = Object.keys(favorite)
            .map(function(k) {
                return 'f[' + escape(k) + ']' + '=' + escape(favorite[k]);
            }).join('&');

        setTimeout(function() {
            window.location = document.location.origin + '/' + selected_city.toLowerCase() + '/orderbook' + '?' + search_query;
        } , 500);
    }
    else {
        showStrError("error", "Please select atleast one checkbox");
    }
}
/* Recommend - End */

function retakeHealthKarma() {
    location.reload(true);
}

/* Call Back - Start */
function saveCallSuccessHandler(response) {
    $("#ajax-loader").hide();
    if(response) {
        if(response.status) {
            showStrError("success", "You will get a call back shortly.");
        }
    }
}

function saveCallErrorHandler(response) {
    $("#ajax-loader").hide();

    var errorData = response.responseJSON;
        
    showStrError("error", errorData.message);
    return false;
}

function clickToCall() {
    var mobile = $("#huserphone").val();
    if(mobile !== '') {
        var token = $("#_token").val();
        var request_data = {
            'contact_number' : mobile,
            '_token' : token
        }

        ajaxCallPromise(clickToCall_api_url, "POST", request_data).then(saveCallSuccessHandler, saveCallErrorHandler);    
    }
}
/* Call Back - End */

$(document).ready(function(){
    $("#healthkarma_form_div").show();
    //$("#healthkarma_question_div").hide();

    if(getUrlVars()['mobile'] != undefined) {

        if(!(/^\d{10}$/.test(parseInt(getUrlVars()['mobile'])))) {
            showStrErrorFast("error", "Invalid Mobile No. in URL");
        }
        else {
            $("#huserphone").val(getUrlVars()['mobile']);
            $("#huserphone").prop("readonly", true);
        }        
    }
});

// var request_question = {
//     'age'       : '22',
//     'gender'    :  'm'
// };

// ajaxCallPromise(getHealthKarmaQuestion_api_url, "GET", request_question).then(getHealthQuestionLeadSuccessHandler, getHealthQuestionErrorHandler);    


