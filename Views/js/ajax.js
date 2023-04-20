function checkEmail() {
  var email = document.getElementsByName("email")[0].value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("error").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "../Controllers/checkEmail.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("email=" + email);
}

//the ajax request to check if the email is avaliable
