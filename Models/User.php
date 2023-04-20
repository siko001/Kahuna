<?php
//Class User Representing The Table in database
namespace Com\Kahuna\Models;

class User {
  private $id;
  private $fullname;
  private $email;
  private $number;
  private $password;


  public function __construct($fullname, $email, $number, $password, $id = null) {
    $this->fullname = $fullname;
    $this->email = $email;
    $this->number = $number;
    $this->password = $password;
    $this->id = $id;
  }

  public function getFullname() {
    return $this->fullname;
  }

  public function setFullname($fullname) {
    $this->fullname = $fullname;
  }

  public function getEmail() {
    return $this->email;
  }


  public function setEmail($email) {
    $this->email = $email;
  }

  public function getNumber() {
    return $this->number;
  }


  public function setNumber($number) {
    $this->number = $number;
  }


  public function getPassword() {
    return $this->password;
  }


  public function setPassword($password) {
    $this->password = $password;
  }

  public function getId() {
    return $this->id;
  }
  public function createUser($name, $email, $number, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("INSERT INTO users (name, email, number, password) VALUES (:name, :email, :number, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
  }
}
