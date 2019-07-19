@extends('layout.master')

@section('page-content')

    <!-- banner -->
    <figure class="inner-banner">
        <img src="/img/inner-banner-gray.jpg" alt="banner">
        <figcaption>
            <div class="container">
                <h1>Upload Your <br> Prescription</h1>
            </div>
        </figcaption>
    </figure>
    <!-- book your test -->
    <section class="book-your-test">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="book-div">
                        <div class="step-div">
                            <h2>STEP 1</h2>
                            <p>Click below to Upload a Prescription</p>
                        </div>
                        <div class="book-content">
                            <div class="left-content-sec">
                                <form id="form1" runat="server" enctype="multipart/form-data">
                                    <input type='file' id="imgInp" name="prescription[]" accept="image/*" multiple="multiple"/>
                                    <a style="margin-left:0px;" href="#" class="btn btn-danger"> <img src="/img/uparrow-icon.png"> Upload Prescription </a>
                                </form>
                                
                            </div>
                            <div class="right-content-sec">
                                <p>Attached Prescription</p>
                                <div class="show-div"><img id="blah" src="/img/file-img.jpg" alt="" /><ul id="showFiles"></ul></div>
                            </div>
                            <ul>
                                    <li>Image size should not exceed 2 MB.</li>
                                    <li>Maximum 3 prescription can be uploaded.</li>
                                </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="book-div">
                        <div class="step-div">
                            <h2>STEP 2</h2>
                            <p>Enter below information</p>
                        </div>
                        <div class="book-content">
                            @if(isset($name))
                                <input class="form-control" autocomplete="off" id="up_name" value="{{$name}}" name="up_name" maxlength="56" placeholder="Full Name of Patient*" required="true" tabindex="1" type="text" readonly>
                            @else
                                <input class="form-control" autocomplete="off" id="up_name" name="up_name" maxlength="56" placeholder="Enter full name" required="true" tabindex="1" type="text">
                            @endif
                            @if(isset($mobile))
                                <input class="form-control" autocomplete="off" id="mobile_number" value="{{$mobile}}" name="mobile_number" placeholder="Mobile*" minlength="10" maxlength="10" required="true" tabindex="2" type="text" readonly>
                            @else
                                <input class="form-control" autocomplete="off" id="mobile_number" name="mobile_number" placeholder="Mobile*" minlength="10" maxlength="10" required="true" tabindex="2" type="text">
                            @endif
                            
                            <button class="btn btn-theme" type="button" id="uploadprescription">Submit</button>                                
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer-scripts')
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var form_data   =   new FormData();
        var token       =   "{{csrf_token()}}";
        var is_auth     =   "{{$is_loggedin}}";
        function readURL(input) {
            if (input.files) {
                var files = input.files,  filesLength = files.length;
                $("#showFiles").innerHTML = '';
                var total_files =   form_data.getAll('files[]').length + filesLength ;
                if(total_files > 3){
                    filesLength =   3 - form_data.getAll('files[]').length; 
                }
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    var reader = new FileReader();
                    reader.fileName =   files[i].name; 
                    var size_length    =   reader.size     =   files[i].size; 
                    console.log(size_length);
                    if(size_length > 0 && size_length < 2097153){
                        var j   =   0;
                        reader.onload = function (e) {
                            var file        =   e.target;
                            var name_code   =   convertText(e.target.fileName);
                            var size = e.target.size;
                            console.log(name_code);
                            var html        =   "<li class=\"pip\" data-id="+j+"><img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + name_code + "\"/>" +

                              "<br/><span class=\"removeupload\"><img src='/img/remove-attachment.png'></span>" +

                              "</li>";
                            $("#showFiles").append(html);
                            j++;
                        }
                        form_data.append("files[]", f);

                        reader.readAsDataURL(f);
                    }else{
                        showStrError("error", "Image size should not exceed 2 MB.");
                    }
                }
                $('#imgInp').val('');
            }
        }
                
        function convertText(input) {
            var output = '';
            len = input.length;
            for (var i = 0;  i < len; i++) {
                output += input[i].charCodeAt(0)
            }
            return output;
        }
        
        $(document).ready(function(){
        
            $('body').on('click', '.removeupload', function () {
                var title   =   $(this).parent(".pip").find('img.imageThumb').attr('title');
                var files   =   form_data.getAll("files[]");
                form_data   =   new FormData();                       
                $(this).parent(".pip").remove();
                $.each(files, function( index, value ) {
                    var namecode = convertText(value.name);
                    if(title   !=  namecode)
                        form_data.append("files[]", value);
                });
                if(form_data.getAll("files[]").length == 0)
                    $("#blah").removeClass("hidden");
            });
            
            $("#imgInp").change(function(){
                if ( form_data.getAll("files[]").length < 3 ){ 
                    readURL(this);
                    $("#blah").addClass("hidden");
                }else                    
                    alert("Maximum 3 prescription can be uploaded.");
            });
            
            $('input[name="mobile_number"]').keypress(function(e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
                    $(".mobile_error").remove();
                    //display error message
                    $( 'input[name="mobile_number"]' ).after( "<label for='mobile_number' class='mobile_error error'>Digits Only</label>" );
                    $(".mobile_error").show().fadeOut(400,  function(){ $(".mobile_error").remove(); });
                    return false;
                }
            });
            
            $('body').on('click', '#uploadprescription', function(e){
                var name            =   $( "input[name='up_name']" ).val();
                var mobile          =   $( "input[name='mobile_number']" ).val();
                var total_files     =   form_data.getAll("files[]").length;
                var source          =   'web';
                if (isMobile.any()) 
                    source  =   'mobile';
                                
                var letterNumber = /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/;
                
                if(name.length == 0){
                    alert("Name Should be required");
                }                
                if(form_data.getAll('files[]').length == 0 || form_data.getAll('files[]').length > 3){
                    alert("Please upload the prescription first");
                    return false;
                }
                if(!name.match(letterNumber))
                {
                    alert("Name should not contain special character");
                    return false;
                }
                
                if(mobile.length != 10){
                    alert("Mobile number is missing");
                    return false;
                }
                
                if(total_files  ==  0 && total_files > 3){
                    alert("Upload atleast one prescription");
                    return false;
                }
                
                form_data.append('mobile_number', mobile);
                form_data.append('name', name);
                form_data.append('source', source);
                form_data.append('_token', '{{csrf_token()}}');
                
                $.ajax({
                    url: "{{route('upload-prescription')}}",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: function (response) {
                        $("#ajax-loader").hide();
                        if(response.status){
                            window.location.replace(response.url);
                        }else{
                            alert(response.error);
                        }
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var jsonResponseText = $.parseJSON(jqXHR.responseText);
                        alert(jsonResponseText.toString());
                        return false;
                    }
                });
            });  
            $('html, body').animate({
                     scrollTop: '520px'
                 },
                 1000);
        });        
        
    </script>    
@endpush