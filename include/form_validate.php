<!--=============== ERROR MESSAGE FUNCTION ================-->
<script type="text/javascript">
     
    
$(document).ready(function() {
  // the fade out effect on hover
  $('.error').hover(function() {
    $(this).fadeOut(200);
  });
  $("#registration_form").submit(function() {
    $('.error').fadeOut(200);
    if (!validateForm()) {
      // go to the top of form first
      $(window).scrollTop($("#registration_form").offset().top);
      return false;
    }
    return true;
  });
});
    
//--=============== VALIDATION FUNCTION ================-
function validateForm() {
  var errCnt = 0;
  var first_name = $.trim($("#first_name").val());
  var last_name = $.trim($("#last_name").val());
  var address = $.trim($("#address").val());
  var city = $.trim($("#city").val());
  var postcode = $.trim($("#postcode").val());
  var phone = $.trim($("#phone").val());    
  var email = $.trim($("#email").val());  
  var password = $.trim($("#password").val());
  var password2 = $.trim($("#confirm_password").val());

//============== Validate First Name ====================
    
  if (first_name == "") {
    $("#first_name_err").html("Enter your first name.");
    $('#first_name_err').fadeIn("fast");
    errCnt++;
  } else if (first_name.length <= 2) {
    $("#first_name_err").html("Enter at least 3 letter.");
    $('#first_name_err').fadeIn("fast");
    errCnt++;
  }
    
//============== Validate Last Name ====================

  if (last_name == "") {
    $("#last_name_err").html("Enter your last name.");
    $('#last_name_err').fadeIn("fast");
    errCnt++;
  } else if (last_name.length <= 2) {
    $("#last_name_err").html("Enter at least 3 letter.");
    $('#last_name_err').fadeIn("fast");
    errCnt++;
  }
    
//============== Validate Address =====================
    
  if (address == "") {
    $("#address_err").html("Enter your address.");
    $('#address_err').fadeIn("fast");
    errCnt++;
  } else if (address.length <= 2) {
    $("#address_err").html("Enter at least 3 letter.");
    $('#address_err').fadeIn("fast");
    errCnt++;
  }
  
//================ Validate City ========================
    
  if (city == "") {
    $("#city_err").html("Enter your city.");
    $('#city_err').fadeIn("fast");
    errCnt++;
  } else if (city.length <= 1) {
    $("#city_err").html("Enter at least 2 letter.");
    $('#city_err').fadeIn("fast");
    errCnt++;
  }
    
//=============== Validate Postcode ==================== 
    
  if (postcode == "") {
    $("#postcode_err").html("Enter your postcode.");
    $('#postcode_err').fadeIn("fast");
    errCnt++;
  } else if (postcode.length <= 3) {
    $("#postcode_err").html("Enter at least 4 numbers.");
    $('#postcode_err').fadeIn("fast");
    errCnt++;
  } else if (!$.isNumeric(postcode)) {
    $("#postcode_err").html("Must be digits only.");
    $('#postcode_err').fadeIn("fast");
    errCnt++;
  }
    
//============== Validate Phone ====================    
    
  if (phone == "") {
    $("#phone_err").html("Enter phone number.");
    $('#phone_err').fadeIn("fast");
    errCnt++;
  } else if (phone.length <= 9 || phone.length > 10) {
    $("#phone_err").html("Enter 10 digits only.");
    $('#phone_err').fadeIn("fast");
    errCnt++;
  } else if (!$.isNumeric(phone)) {
    $("#phone_err").html("Must be digits only.");
    $('#phone_err').fadeIn("fast");
    errCnt++;
  }
    
//============== Validate Email ====================
    
if (!isValidEmail(email)) {
    $("#email_id_err").html("Enter valid email.");
    $('#email_id_err').fadeIn("fast");
    errCnt++;
  }  

//============== Validate Password ====================  
    
if (password != password2) {
    $('#password_id_err').html("Your passwords do not match");
    $('#password_id_err').fadeIn("fast");
    errCnt++;
} else if (password.length < 6 || password.length > 8 ) {
    $('#password_id_err').html("Enter between 6  to 8 letters.");
    $('#password_id_err').fadeIn("fast");
    errCnt++;
}
    
//============== Validate Email ====================
    

if (errCnt > 0) return false;
  else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
    
</script>