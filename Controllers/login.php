<?php
//controller for login
require_once '../Models/Login.php';

use \Com\Kahuna\Models\Login;

if (isset($_POST['signin'])) {
  $email = filter_input(INPUT_POST, 'emailLog', FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, 'passwordLog', FILTER_DEFAULT);

  $login = new Login();
  $login->login($email, $password);
}
