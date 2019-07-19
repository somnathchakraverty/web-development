
/* Landing Page */
    function saveLeadSuccessHandler(response) {
        $("#ajax-loader").hide();
        
        var utm_id = $("#utm_id").val();
        var ga_category = $("#ga_category").val();
        showStrError("success", "Thank you for sharing your details with us. Our Customer Care Executive will get in contact with you.");

        if(response.status && response.new_lead) {        
            gtag_report_conversion();    
            pushGaEvent(ga_category, 'Lead Captured', $("input[name='contact_no']").val());

            if (typeof(fbq) !== 'undefined') {
                var fbData = {
                    "data":  {
                        "utm_id": utm_id,
                        "mobile": $("input[name='contact_no']").val(),
                        "source": "web"
                    }
                }
                fbq('track', 'Lead', fbData);
            }
            
            if(response.hasOwnProperty("data")) {
                if(response.data !== '') {
                    if(getUrlVars()['publisher_id'] != undefined) {
                        pushGaEvent(utm_id, 'Vendor Publisher Pixel', getUrlVars()['publisher_id']);
                        localStorage.removeItem('vendor_code');
                    }
                    else {
                        pushGaEvent(utm_id, 'Vendor Pixel', response.lead_id);
                        localStorage.removeItem('vendor_code');
                    }                                        
                    $("footer").append(response.data);                                        
                }                                    
            }
        }
        
        var validator = $("#addLeadForm").validate();
        validator.resetForm();
        $('#addLeadForm').trigger("reset");

        if($('#basicModal').length == 1) {
            $('#basicModal').modal('hide');
        }

        return false;
    }

    function saveLeadErrorHandler(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;
        
        showStrError("error", errorData.message);
        return false;
    }
    
    function sendLandingDetails() {
        
        $('#addLeadForm').validate({
			rules: {
				name: {
					required: true,
					lettersonly: true
				},
				email_id: {
					email: true
				},
				contact_no: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 10					
				},
				city: {
					required: true
				}
			},
			messages: {
				name: {
					required : "Please specify your name",
					lettersonly: "Please enter characters only"
				},
				email_id: {
					email: "Email address must be in the format of test@domain.com"
				},
				contact_no: {
					required: "We need your mobile no. to contact you",
					digits: "Not a valid 10-digit mobile no.",
					minlength : "Please enter valid 10 digit no.",
					minlength : "Please enter valid 10 digit no."
                },
                city: {
					required : "Please select your city"
				}
            },
            submitHandler: function (form) {
                ajaxCallPromise(saves_api_url, "POST", $('#addLeadForm').serialize()).then(saveLeadSuccessHandler, saveLeadErrorHandler);

                return false;
            }
        });
        return false;
    }

/* Landing Page */

/* Mobile Landing Page Form */
    function hideTabOnMobileLead() {
        $("#lead_mob_back").removeClass('white-visible');
        $("#lead_mob_back").addClass('green-visible');
        $(".showLeadMobileForm").hide();
    }

    function tabOnMobileLead() {
        $("#lead_mob_back").removeClass('green-visible');
        $("#lead_mob_back").addClass('white-visible');
        $(".showLeadMobileForm").show();
    }

    function saveMobileLeadSuccessHandler(response) {
        $("#ajax-loader").hide();
        
        var utm_id = $("#utm_id").val();
        var ga_category = $("#ga_mobile_category").val();
        showStrError("success", "Thank you for sharing your details with us. Our Customer Care Executive will get in contact with you.");
        
        if(response.status && response.new_lead) {
            pushGaEvent(ga_category, 'Lead Captured', $("input[name='contact_no']").val());
            gtag_report_conversion();

            if (typeof(fbq) !== 'undefined') {
                var fbData = {
                    "data":  {
                        "utm_id": utm_id,
                        "mobile": $("input[name='contact_no']").val(),
                        "source": "web"
                    }
                }
                fbq('track', 'Lead', fbData);
            }
            
            if(response.hasOwnProperty("data")) {
                if(response.data !== '') {
                    if(getUrlVars()['publisher_id'] != undefined) {
                        pushGaEvent(utm_id, 'Vendor Publisher Pixel', getUrlVars()['publisher_id']);
                        localStorage.removeItem('vendor_code');
                    }
                    else {
                        pushGaEvent(utm_id, 'Vendor Pixel', response.lead_id);
                        localStorage.removeItem('vendor_code');
                    }                                        
                    $("footer").append(response.data);                                        
                }                                    
            }          
        }  

        var validator = $("#addLeadFormMobile").validate();
        validator.resetForm();
        $('#addLeadFormMobile').trigger("reset");

        hideTabOnMobileLead();
        return false;
    }

    function saveMobileLeadErrorHandler(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;
        
        showStrError("error", errorData.message);
        return false;
    }

    function sendLandingMobileDetails() {
        tabOnMobileLead();

        $('#addLeadFormMobile').validate({
			rules: {
                customer_mobile: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 10					
				},
				customer_name: {
					required: true,
					lettersonly: true
				},                				
				customer_city: {
					required: true
				},
				customer_email: {
					email: true
				}
			},
			messages: {
                customer_mobile: {
					required: "We need your mobile no. to contact you",
					digits: "Not a valid 10-digit mobile no.",
					minlength : "Please enter valid 10 digit no.",
					minlength : "Please enter valid 10 digit no."
                },
				customer_name: {
					required : "Please specify your name",
					lettersonly: "Please enter characters only"
				},
				customer_email: {
					email: "Email address must be in the format of test@domain.com"
				},				
                customer_city: {
					required : "Please select your city"
				}
            },
            submitHandler: function () {
                ajaxCallPromise(saves_api_url, "POST", $('#addLeadFormMobile').serialize()).then(saveMobileLeadSuccessHandler, saveMobileLeadErrorHandler);
                return false;
            }
		});
    }
/* Mobile Landing Page Form */

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}