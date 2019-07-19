<form id="myForm" action="{{ $payuInfoUrl }}" method="post">
<?php
    foreach ($paymentParameterDetail as $key => $value) {
        echo '<input type="hidden" name="'.htmlentities($key).'" value="'.htmlentities($value).'">';
    }
?>
</form>
<script type="text/javascript">
    function setCookie(name,value,days = 30) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    setCookie('isNewBooking', true);
    document.getElementById('myForm').submit();
</script>