<?php
//class handling the server side validation upon registration from user

namespace Com\Kahuna\Models;

require_once '../Models/Operation.php';
require_once '../Models/User.php';

use \Com\Kahuna\Models\Operation;
use \Com\Kahuna\Models\User;

class RegisterUser {
  public function register() {
    $errors = array();
    $name = "";
    $email = "";
    $number = "";
    $password = "";
    $cpassword = "";

    if (isset($_POST['registerSubmit'])) {
      $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
      $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
      $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_DEFAULT);

      //Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      //validation for name
      if (empty($name)) {
        $errors[] = 'Name cannot be empty';
      } else if (!preg_match('/^[a-zA-Z]+(\s[a-zA-Z]+)*$/', $name)) {
        $errors[] = 'Name can only contain alphabetical characters';
      } else if (strlen($name) < 6) {
        $errors[] = 'Minimum 6 Characters';
      }

      //validation for email
      if (empty($email)) {
        $errors = 'Please enter an email';
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
      }

      //validation for number
      if (empty($number)) {
        $errors = 'Please enter a Phone number';
      } else if (!preg_match('/^\+?\d{8,}$/', $number)) {
        $errors[] = 'Enter a Valid Phone Number';
      }
      //validation for password
      if (empty($password)) {
        $errors[] = 'Please enter a Password';
      } else if (strlen($password) < 8) {
        $errors[] = 'Password must contain minimum 8 characters';
      }
      //validation for confirm password
      if (empty($cpassword)) {
        $errors = 'Please confirm your Password';
      } else if (strlen($cpassword) < 8) {
        $errors[] = 'Password must contain minimum 8 characters';
      }

      //check that passwords match
      if ($password != $cpassword) {
        $errors[] = 'Passwords do not match';
      }

      if (count($errors) > 0) {
        // display errors to the user
        header('location: http://localhost/Kahuna/Views/error');
      } else {
        $userModel = new Operation();


        $user = $userModel->getUserByEmail($email);

        if ($user !== false) {
          // email already registered
          header("location: http://localhost/Kahuna/Views/index?register=emailtaken");
        } else {
          // insert the new successful registrant into the database
          $user = new User($name, $email, $number, $hashedPassword);
          $user->createUser($name, $email, $number, $hashedPassword);

          if ($user) {
            // redirect the user to the login page
            header("location: http://localhost/Kahuna/Views/index?register=complete");
          } else {
            $errors[] = "Error: failed to insert user into database";
            header('location: http://localhost/Kahuna/Views/error');
          }
        }
      }
    }
  }
}
