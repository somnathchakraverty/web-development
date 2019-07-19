@extends('layout.master')

@section('page-content')
<style>
    .imgrefer { max-width: 36%;}
    @media only screen and (max-width: 767px) {
        .imgrefer { display: none;}
        .Family-headingdiv { padding-bottom :18px; }
        #refercode { font-size: 18px; }
        #basic-addon2 {padding: 13px 0px 6px 0px;}
        .btn-danger:hover { background-color: #f17920 !important;border-color: #f17920;}
        .btn-danger:active:hover {background-color: #f17920 !important;border-color: #f17920;outline: none;}
    }
</style>
    <section class="faimly-friendwraper">

        <div class="fixed-bar">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="container">
            <div class="row">
                <!------aside-end -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 Referdiv">
                    <div class="Family-headingdiv text-left">
                        <h3>Refer & Earn</h3>
                    </div>
                    <div class="Retake-Healthkarmadiv text-center">
                        <img src="/img/glob-animate.png" alt="" class="imgrefer">
                        <div class="add-box">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                <h2>Refer & Earn</h2>
                                <h3>Give {{$refer_details['refererAmount']}}, Get {{$refer_details['earnAmount']}}</h3>
                                <p>Your Code to Invite</p>
                                <div class="input-group ">
                                <input type="text" class="form-control" id="refercode" placeholder="{{ $refer_details['referCode'] }}" value="{{ $refer_details['referCode'] }}" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly>
                                    <div class="input-group-append">
                                        <a class="btn btn-danger input-group-text" id="basic-addon2" onclick="select_all_and_copy(document.getElementById('refercode'));">Copy</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 refertext">
                                <h4 class="termsrefer"> Terms & Condition </h4>
                                {!! $refer_details['appTerm'] !!}
                            </div>                            
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </section>
    <div style="display:none;" id="temp_div"></div>
@endsection
<script>
function copyToClipboard(str) {
    console.log("textarea", str);
    var el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);

    if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        // save current contentEditable/readOnly status
        var editable = el.contentEditable;
        var readOnly = el.readOnly;

        // convert to editable with readonly to stop iOS keyboard opening
        el.contentEditable = true;
        el.readOnly = true;

        // create a selectable range
        var range = document.createRange();
        range.selectNodeContents(el);

        // select the range
        var selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        el.setSelectionRange(0, 999999);

        // restore contentEditable/readOnly to original state
        el.contentEditable = editable;
        el.readOnly = readOnly;
        el.select(); 
    } else {
        el.select(); 
    }

    document.execCommand('copy');
    document.body.removeChild(el);

    showStrError("success", "Copied");
}

function copyToClipboard2(string) {
  let textarea;
  let result;

  try {
    textarea = document.createElement('textarea');
    textarea.setAttribute('readonly', true);
    textarea.setAttribute('contenteditable', true);
    textarea.style.position = 'fixed'; // prevent scroll from jumping to the bottom when focus is set.
    textarea.value = string;

    document.body.appendChild(textarea);

    textarea.focus();
    textarea.select();

    const range = document.createRange();
    range.selectNodeContents(textarea);

    const sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);

    textarea.setSelectionRange(0, textarea.value.length);

    textarea.contentEditable = editable;
    textarea.readOnly = readOnly;

    result = document.execCommand('copy');
  } catch (err) {
    console.error(err);
    result = null;
  } finally {
    document.body.removeChild(textarea);
  }

  // manual copy fallback using prompt
  if (!result) {
    const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    const copyHotkey = isMac ? '⌘C' : 'CTRL+C';
    result = prompt(`Press ${copyHotkey}`, string); // eslint-disable-line no-alert
    if (!result) {
        showStrError("error", "Not Copied");
        return false;
    }
  }
  showStrError("success", "Copied");
  return true;
}

function copyFunction() {

    if (isMobile.any()) {
        
        var text = $("#refercode").val();
        console.log("text");

        var $t = $('<input type="text" id="temp_textbox" value="text to copy" contenteditable="true" readOnly="false"/>');
        $t.val(text).appendTo('#temp_div');
        // $t.select();
        
        //$t.remove();
        var input = document.getElementById('temp_textbox');
        var editable = input.contentEditable;
		var readOnly = input.readOnly;

		input.contentEditable = true;
		input.readOnly = false;

		var range = document.createRange();
		range.selectNodeContents(input);

		var selection = window.getSelection();
		selection.removeAllRanges();
		selection.addRange(range);

		input.setSelectionRange(0, 999999);
		input.contentEditable = editable;
        input.readOnly = readOnly;
        input.select();
        document.execCommand('copy');

    }
    else {
        /* Get the text field */
        var copyText = document.getElementById("refercode");
        
        /* Select the text field */
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");
    }
   
    /* Alert the copied text */
    showStrError("success", "Copied");
}

function select_all_and_copy(el)
{
    console.log("el",el);

    if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        // Copy textarea, pre, div, etc.
        if (document.body.createTextRange) {
            // IE
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(el);
            textRange.select();
            textRange.execCommand("Copy");   
            tooltip(el, "Copied!"); 
        }
        else if (window.getSelection && document.createRange) {
            // non-IE
            var editable = el.contentEditable; // Record contentEditable status of element
            var readOnly = el.readOnly; // Record readOnly status of element
                el.contentEditable = true; // iOS will only select text on non-form elements if contentEditable = true;
                el.readOnly = false; // iOS will not select in a read only form element
            var range = document.createRange();
            range.selectNodeContents(el);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range); // Does not work for Firefox if a textarea or input
            if (el.nodeName == "TEXTAREA" || el.nodeName == "INPUT")
                el.select(); // Firefox will only select a form element with select()
            if (el.setSelectionRange && navigator.userAgent.match(/ipad|ipod|iphone/i))
                el.setSelectionRange(0, 999999); // iOS only selects "form" elements with SelectionRange
            el.contentEditable = editable; // Restore previous contentEditable status
            el.readOnly = readOnly; // Restore previous readOnly status
            
            if (document.queryCommandSupported("copy"))
            {
                var successful = document.execCommand('copy'); 
                if (successful) tooltip(el, "Copied to clipboard.");
                else tooltip(el, "Press CTRL+C to copy");
            }
            else
            {
                if (!navigator.userAgent.match(/ipad|ipod|iphone|android|silk/i))
                    tooltip(el, "Press CTRL+C to copy");
            }
        }
    }
    else {
        var el = document.createElement('textarea');
        el.value = $("#refercode").val();
        el.setAttribute('readonly', '');
        el.style = {position: 'absolute', left: '-9999px'};
        document.body.appendChild(el);
        el.select(); 

        document.execCommand('copy');
        document.body.removeChild(el);

        showStrError("success", "Copied");
    }
} // end function select_all_and_copy(el) 

function tooltip(el, message)
{
    var scrollLeft = document.body.scrollLeft || document.documentElement.scrollLeft;
    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    var x = parseInt(el.getBoundingClientRect().left) + scrollLeft + 10;
    var y = parseInt(el.getBoundingClientRect().top) + scrollTop + 10;
    if (!document.getElementById("copy_tooltip"))
    {
        var tooltip = document.createElement('div');
        tooltip.id = "copy_tooltip";
        tooltip.style.position = "absolute";
        tooltip.style.border = "1px solid black";
        tooltip.style.background = "#dbdb00";
        tooltip.style.opacity = 1;
        tooltip.style.transition = "opacity 0.3s";
        document.body.appendChild(tooltip);
    }
    else
    {
        var tooltip = document.getElementById("copy_tooltip")
    }
    tooltip.style.opacity = 1;
    tooltip.style.left = x + "px";
    tooltip.style.top = y + "px";
    tooltip.innerHTML = message;
    showStrError("success", "Copied");
    $("#basic-addon2").text('Copied');
    setTimeout(function() { 
        tooltip.style.opacity = 0;
        $("#basic-addon2").text('Copy');
    }, 2000);
}

function paste(el) 
{
   	if (window.clipboardData) { 
	   	// IE
    	el.value = window.clipboardData.getData('Text');
    	el.innerHTML = window.clipboardData.getData('Text');
    }
    else if (window.getSelection && document.createRange) {
        // non-IE
        if (el.tagName.match(/textarea|input/i) && el.value.length < 1)
        	el.value = " "; // iOS needs element not to be empty to select it and pop up 'paste' button
        else if (el.innerHTML.length < 1)
        	el.innerHTML = "&nbsp;"; // iOS needs element not to be empty to select it and pop up 'paste' button
        var editable = el.contentEditable; // Record contentEditable status of element
        var readOnly = el.readOnly; // Record readOnly status of element
       	el.contentEditable = true; // iOS will only select text on non-form elements if contentEditable = true;
       	el.readOnly = false; // iOS will not select in a read only form element
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range); 
        if (el.nodeName == "TEXTAREA" || el.nodeName == "INPUT") 
        	el.select(); // Firefox will only select a form element with select()
        if (el.setSelectionRange && navigator.userAgent.match(/ipad|ipod|iphone/i))
        	el.setSelectionRange(0, 999999); // iOS only selects "form" elements with SelectionRange
        if (document.queryCommandSupported("paste")) 
       	{  
			var successful = document.execCommand('Paste');  
		    if (successful) tooltip(el, "Pasted.");
		    else 
			{
				if (navigator.userAgent.match(/android/i) && navigator.userAgent.match(/chrome/i))
				{
					tooltip(el, "Click blue tab then click Paste");
				
						if (el.tagName.match(/textarea|input/i))
						{
			        		el.value = " "; el.focus();
			        		el.setSelectionRange(0, 0); 
			        	}
			        	else 
			        		el.innerHTML = "";
		
				}
				else	
					tooltip(el, "Press CTRL-V to paste");
			}   
		} 
		else 
		{  
		    if (!navigator.userAgent.match(/ipad|ipod|iphone|android|silk/i))
				tooltip(el, "Press CTRL-V to paste"); 
		} 
		el.contentEditable = editable; // Restore previous contentEditable status
        el.readOnly = readOnly; // Restore previous readOnly status
    }
}


</script>

@push('footer-scripts')