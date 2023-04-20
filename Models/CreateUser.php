<?php
// class to create a new User
namespace Com\Kahuna\Models\CreateUser;

use Com\Kahuna\Models\DB;

require_once 'DB.php';

class CreateUser {
  //Check if email already exsits
  public static function getUserByEmail($email) {
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  //
  public static function createUser($name, $email, $number, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("INSERT INTO users (name, email, number, password) VALUES (:name, :email, :number, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();
    $lastInesrtId = $db->lastInsertId();
    return $lastInesrtId;
  }


  public static function getLastInsertedUserId() {
    $db =  DB::getInstance()->getHandler();
    return $db->lastInsertId();
  }
}
