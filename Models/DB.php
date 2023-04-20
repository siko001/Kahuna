<?php
//singleton database connection
namespace Com\Kahuna\Models;

class DB {
  private static $singleton;
  private $connection;
  private $DB_USERNAME = 'root';
  private $DB_PASSWORD = 'Divemaster368804';
  private $DB_HOST = 'localhost';

  private function __construct() {
    $this->connection = new \PDO(
      "mysql:host=$this->DB_HOST;dbname=kahuna",
      $this->DB_USERNAME,
      $this->DB_PASSWORD
    );
    $this->connection->exec('SET CHARACTER SET utf8');
  }

  public static function getInstance() {
    if (is_null(self::$singleton)) {
      self::$singleton = new DB();
    }
    return self::$singleton;
  }

  public function getHandler() {
    return $this->connection;
  }
}
