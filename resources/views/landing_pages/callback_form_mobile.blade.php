<style>
    .sticky-bottom label.error{color: #e43b3f;float: left;}
</style>
<form name="addLeadFormMobile" id="addLeadFormMobile" novalidate>
    {{csrf_field()}}
    <div class="overlay-visible showLeadMobileForm" onClick="hideTabOnMobileLead();"></div>
    <div id="lead_mob_back" class="green-visible"> 
        <a class="mob-close showLeadMobileForm" href="javascript:void(0);" onClick="hideTabOnMobileLead();">
            <span aria-hidden="true" style="font-size: 42px; line-height: 10px;color: #ccc;">&times;</span>
        </a>
        <div class="field-form">
            <input id="customer_mobile" value="{{$contact_no}}" minlength="10" maxlength="10" name="customer_mobile" type="text" class="mob-icon" placeholder="Enter Your Mobile No. *" required autocomplete="off" onClick="tabOnMobileLead();" />
        </div>

        <div class="field-form showLeadMobileForm">
            <input name="customer_name" id="customer_name" value="{{$name}}" type="text" class="user-icon" placeholder="Enter Your Name *" required/>                
        </div>

        <div class="field-form showLeadMobileForm">
            <select class="form-select minimal" id="customer_city" name="customer_city" required>
                <option value="" selected>Select Your City *</option>
                @foreach($city_detail as $key => $ct)
                    <option value="{{$key}}">{{ $ct }}</option>
                @endforeach
            </select>                
        </div>

        {{-- <div class="field-form showLeadMobileForm" style="display:none;">
            <input name="customer_email" id="customer_email" value="{{$email_id}}" type="text" class="user-icon" placeholder="Enter your Email" autocomplete="off"/>
        </div>      --}}
        
        <div class="field-button">
            <input value="Get Free Call Now" type="submit" onClick="sendLandingMobileDetails();" />
        </div>

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

        <input type="hidden" name="source" id="source" value="mobile">
    </div>
</form>