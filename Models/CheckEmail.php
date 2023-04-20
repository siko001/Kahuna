<?php
//class to handle the ajax response and display to user
namespace Com\Kahuna\Models;


class CheckEmail {
  public function checkEmail() {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $model = new CheckEmailAvaliablity();

    if ($model->checkEmailExists($email)) {
      echo "<span class='error'>Email Unavaliable</span>";
    } else {
      if ($email != null) {
        echo "<span class='ok'>Email Avaliable</span>";
      }
    }
  }
}
