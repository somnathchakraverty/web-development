<form name="addLeadForm" id="addLeadForm" novalidate>
        {{csrf_field()}} 
        <ul>
            <li>
                <div class="form-field"> 
                    <input name="contact_no" id="contact_no" type="text" value="{{$contact_no}}" minlength="10" maxlength="10" placeholder="Enter Your Mobile No. *" autocomplete="off" required> 
                </div>
            </li>
            <li>
                <div class="form-field"> 
                    <input name="name" id="name" type="text" placeholder="Enter Your Name * " autocomplete="off" required>
                </div>
            </li>
            <li class="bordernone">
                <div class="form-field-city"> 
                    <select class="form-select-opt minimal" id="city" name="city" required="true">
                        <option value="" selected>Select Your City *</option>
                        @foreach($city_detail as $key => $ct)
                            <option value="{{$key}}">{{ $ct }}</option>
                        @endforeach
                    </select>
                </div>
            </li>
            <li class="rightbtncta">
                <div class="form-ctabtn-hicam"> 
                    <input name="send" onClick="sendLandingDetails();" type="submit" id="landing_desktop" class="ctabutton_final" value="Submit">
                </div>
            </li>
        </ul>
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