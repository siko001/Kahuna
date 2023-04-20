<?php
//class to handle the login

namespace Com\Kahuna\Models;

use \Com\Kahuna\Models\DB;

require_once '../Models/DB.php';

class Login {
  private $db;

  function __construct() {
    $this->db = DB::getInstance()->getHandler();
  }

  function login($email, $password) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($user) {
      if (password_verify($password,  $user['password'])) {
        session_start();
        $_SESSION['userId'] = $user['UserId'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['number'] = $user['number'];
        $userId = $_SESSION['userId'];
        $_SESSION['loggedin'] = true;
        header("location: http://localhost/Kahuna/Views/dashboard?user=$userId");
      } else {
        header("location: http://localhost/Kahuna/Views/index?signin=error");
      }
    } else {
      header("location: http://localhost/Kahuna/Views/index?signin=error");
    }
  }
}
