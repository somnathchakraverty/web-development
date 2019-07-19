<form name="addLeadForm" id="addLeadForm" novalidate>
    {{csrf_field()}}  
    <div class="field-form">
        <input name="name" id="name" type="text" value="{{$name}}" class="user-icon pl10" placeholder="Enter Your Name *" required autocomplete="off" autofocus>
    </div>
    <div class="field-form">
        <input id="contact_no" value="{{$contact_no}}" class="mob-icon pl10" minlength="10" maxlength="10" name="contact_no" type="text" placeholder="Enter Your Mobile No. *" required autocomplete="off">                                        
    </div>      
    <div class="field-form">
        <select class="form-select minimal" id="city" name="city" required="true">
            <option value="" selected>Select Your City *</option>
            @foreach($city_detail as $key => $ct)
                <option value="{{$key}}">{{ $ct }}</option>
            @endforeach
        </select>
    </div>
    {{-- <div class="field-form" style="display:none;">
        <input class="email-icon pl10" value="{{$email_id}}" id="email_id" name="email_id" type="email" placeholder="Enter your Email"  autocomplete="off"> 
    </div> --}}
    <div class="field-button">
        <input type="submit" onClick="sendLandingDetails();" value="Get Free Call Now" id="landing_desktop">
    </div>
    <span class="mand_field_text">* Mandatory fields</span>
    
    <input type="hidden" name="utm_id" id="utm_id" value="{{$utm_id}}">
    
    @if(!empty($message))
        <input type="hidden" name="message" id="message" value="{{$message}}">
    @endif

    @if(!empty($utm_source))
        <input type="hidden" name="utm_source" id="utm_source" value="{{$utm_source}}">
    @endif
    
    @if(!empty($utm_campaign))
        <input type="hidden" name="utm_campaign" id="utm_campaign" value="{{$utm_campaign}}">
    @endif

    @if(!empty($utm_medium))
        <input type="hidden" name="utm_medium" id="utm_medium" value="{{$utm_medium}}">
    @endif

    @if(!empty($publisher_id))
        <input type="hidden" name="publisher_id" id="publisher_id" value="{{$publisher_id}}">
    @endif

    @if(!empty($source))
        <input type="hidden" name="source" id="source" value="{{$source}}">
    @else
        <input type="hidden" name="source" id="source" value="web">
    @endif

</form>