$(function() {
  $( "#txtDob" ).datepicker({
    changeMonth: true,
    changeYear: true,
    maxDate: '-10Y'
  });

  $("#txtAccountType1").click(function(){
      changeAccountType(1);
  });

  $("#txtAccountType2").click(function(){
      changeAccountType(2);
  });

  //Check password match or not
  var password = document.getElementById("txtPassword")
  var confirm_password = document.getElementById("txtRepassword");  
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
});

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Password Not Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

function changeAccountType (type) {
  if(type == 1) { //This is Company
    $('#frmCompany').show();
    $('#frmUser').hide();
  }
  else if(type == 2) { //This is User
    $('#frmCompany').hide();
    $('#frmUser').show();
  }
}