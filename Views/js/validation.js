//client side registration and login validation. if user switches of clientside validation, server side validation is also present in other files.

$(document).ready(function () {
  //sign-up validation

  //Check the name input
  $("#sign-up").on("submit", function (event) {
    var name = $("#name").val();
    var hasNumbers = /\d/.test(name);
    var nameError = "";

    if (/[^a-zA-Z0-9 ]/.test(name)) {
      nameError = "Name cannot contain special characters";
    } else if (hasNumbers) {
      nameError = "Name cannot contain numbers";
    } else if (name.length < 6) {
      nameError = "Please enter atleast 6 characters ";
    }

    //check email
    var email = $("#email").val();
    var emailError = "";
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      emailError = "Please enter a valid email address";
    }

    //check phone number

    var mobile = $("#mobile").val();
    var mobileError = "";
    var mobileRegex = /^(\+)?\d{8,}$/;

    if (!mobileRegex.test(mobile)) {
      mobileError = "Please enter a valid mobile number";
    }

    //check the passwords inputted
    var password = $("#password").val();
    var cpassword = $("#cpassword").val();
    var passwordError = "";
    var cpasswordError = "";

    if (password.length < 8) {
      passwordError = "Password must be atleast 8 characters";
      cpasswordError = "Password must be atleast 8 characters";
    }
    if (password !== cpassword) {
      passwordError = "Passwords do not match";
      cpasswordError = "Passwords do not match";
    }

    if (
      nameError ||
      emailError ||
      mobileError ||
      passwordError ||
      cpasswordError
    ) {
      event.preventDefault();

      // remove any existing error messages
      $(".error-message").remove();

      // create a new error message div for email
      if (emailError) {
        var emailErrorDiv = $("<div>")
          .addClass("error-message")
          .text(emailError);
        $("#email").after(emailErrorDiv);
      }

      // create a new error message div for name
      if (nameError) {
        var nameErrorDiv = $("<div>").addClass("error-message").text(nameError);
        $("#name").after(nameErrorDiv);
      }

      // create a new error message div for mobile
      if (mobileError) {
        var mobileErrorDiv = $("<div>")
          .addClass("error-message")
          .text(mobileError);
        $("#mobile").after(mobileErrorDiv);
      }

      // create a new error message div for password
      if (passwordError) {
        var passwordErrorDiv = $("<div>")
          .addClass("error-message")
          .text(passwordError);
        $("#password").after(passwordErrorDiv);
      }

      // create a new error message div for password
      if (cpasswordError) {
        var cpasswordErrorDiv = $("<div>")
          .addClass("error-message")
          .text(cpasswordError);
        $("#cpassword").after(cpasswordErrorDiv);
      }
    }
  });

  $("#name, #email, #mobile, #password, #cpassword").on("input", function () {
    $(".error-message").remove();
  });
});

//sign-in validation

$("#sign-in").on("submit", function (event) {
  var emailLog = $("#emailLog").val();
  var emailErrorLog = "";
  var emailRegexLog = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailRegexLog.test(emailLog)) {
    emailErrorLog = "Please enter a valid email address";
  }

  var passwordLog = $("#passwordLog").val();
  if (passwordLog.length < 8) {
    passwordErrorLog = "Please enter a valid password";
  }

  if (emailErrorLog || passwordErrorLog) {
    event.preventDefault();

    // remove any existing error messages
    $(".error-message").remove();

    // create a new error message div for email
    if (emailErrorLog) {
      var emailErrorDivLog = $("<div>")
        .addClass("error-message")
        .text(emailErrorLog);
      $("#emailLog").after(emailErrorDivLog);
    }

    // create a new error message div for password
    if (passwordErrorLog) {
      var passwordErrorDivLog = $("<div>")
        .addClass("error-message")
        .text(passwordErrorLog);
      $("#passwordLog").after(passwordErrorDivLog);
    }
  }
});
