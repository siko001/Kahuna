<?php
//class to handle ajax request to check user email avalibility
namespace Com\Kahuna\Models;

require_once 'DB.php';

use \Com\Kahuna\Models\DB;


class CheckEmailAvaliablity {
  private $db;

  public function __construct() {
    $this->db = DB::getInstance()->getHandler();
  }

  public function checkEmailExists($email) {
    $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }
}
