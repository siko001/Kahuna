<?php

require_once '../Models/DB.php';

use Com\Kahuna\Models\DB;

class Appliance implements JsonSerializable {

  private $type;
  private $productDescription;
  private $imgUrl;
  private $serialNumber;
  private static $applianceList = array();

  public function __construct($type, $productDescription, $imgUrl, $serialNumber = null) {
    $this->type = $type;
    $this->productDescription = $productDescription;
    $this->imgUrl = $imgUrl;
    $this->serialNumber = $serialNumber;
  }

  private function persist() {
    $conn = DB::getInstance()->getHandler();
    if ($this->serialNumber == null) {
      $this->serialNumber++;
      //Insert a new record
      $query = <<<SQL
      INSERT INTO products(type ,productDescription ,imgUrl) VALUES (:type, :productDescription, :imgUrl)
      SQL;
      $stat = $conn->prepare($query);
      $stat->bindParam(':type', $this->type);
      $stat->bindParam(':productDescription', $this->productDescription);
      $stat->bindParam(':imgUrl', $this->imgUrl);
      $stat->execute();
      self::updateAll();
    } else {
      //insert in the DB with serialNUmber inserted by the user
      $query = <<<SQL
      INSERT INTO products(serialNumber, type ,productDescription ,imgUrl) VALUES (:serialNumber ,:type, :productDescription, :imgUrl)
      SQL;
      $stat = $conn->prepare($query);
      $stat->bindParam(':serialNumber', $this->serialNumber);
      $stat->bindParam(':type', $this->type);
      $stat->bindParam(':productDescription', $this->productDescription);
      $stat->bindParam(':imgUrl', $this->imgUrl);
      $stat->execute();
      self::updateAll();
    }
  }

  private static function updateAll() {
    $conn = DB::getInstance()->getHandler();
    $stat = $conn->prepare("SELECT * FROM products");
    $stat->execute();
    $result = $stat->fetchALL(PDO::FETCH_OBJ);

    foreach ($result as $appliance) {
      array_push(self::$applianceList, new Appliance(
        $appliance->type,
        $appliance->productDescription,
        $appliance->imgUrl,
        $appliance->serialNumber
      ));
    }
  }


  public static function getAll() {
    self::updateAll();
    echo "<table border='1'>
    <tr>
    <td>SerialNumber</td>
    <td>Type</td>
    <td>Description</td>
    </tr>";

    foreach (self::$applianceList as $appliance) {
      echo "<tr>";
      echo "<td>" . $appliance->serialNumber . "</td>";
      echo "<td>" . $appliance->type .  "</td>";
      echo "<td>" .  $appliance->productDescription . "</td>";
      //dont want the img url to show i think it's nicer :)
      echo "<tr>";
    }
    echo "</table>";
  }
  //make the api list nicer table

  public function post() {
    $this->persist();
  }


  public static function get($serialNumber) {
    self::updateAll();
    foreach (self::$applianceList as $appliance) {
      if ($appliance->getSerialNumber() == $serialNumber) {
        return $appliance;
      }
    }
  }

  public static function delete($serialNumber) {
    $conn = DB::getInstance()->getHandler();
    $stat = $conn->prepare("DELETE FROM products WHERE serialNumber = :serialNumber");
    $stat->bindParam(':serialNumber', $serialNumber);
    $stat->execute();
  }

  public static function put($type, $productDescription, $imgUrl, $args) {
    $conn = DB::getInstance()->getHandler();
    $stat = $conn->prepare("UPDATE products SET serialNumber = :serialNumber, type = :type, productDescription = :productDescription, imgUrl = :imgUrl WHERE serialNumber = :serialNumber");
    $stat->bindParam(':serialNumber', $args);
    $stat->bindParam(':type', $type);
    $stat->bindParam(':productDescription', $productDescription);
    $stat->bindParam(':imgUrl', $imgUrl);
    $stat->execute();
  }


  public static function getId($serialNumber) {
    $conn = DB::getInstance()->getHandler();
    $stat = $conn->prepare("SELECT * FROM products WHERE serialNumber = :serialNumber");
    $stat->bindParam(':serialNumber', $serialNumber);
    $stat->execute();
    if ($stat->rowcount() > 0) {
      return $serialNumber;
    } else {
      header('HTTP/1.1 404 APPLIANCE NOT FOUND');
    }
  }


  public function getSerialNumber() {
    return $this->serialNumber;
  }


  public function getType() {
    return $this->type;
  }


  public function setType($type) {
    $this->type = $type;
    $this->persist();
  }


  public function getProductDescription() {
    return $this->productDescription;
  }


  public function setProductDescription($productDescription) {
    $this->productDescription = $productDescription;
    $this->persist();
  }


  public function getImgUrl() {
    return $this->imgUrl;
  }


  public function setImgUrl($imgUrl) {
    $this->imgUrl = $imgUrl;
    $this->persist();
  }


  public function jsonSerialize(): mixed {
    return array(
      'serialNumber' => $this->serialNumber,
      'type' => $this->type,
      'productDescription' => $this->productDescription,
      'imgUrl' => $this->imgUrl,
    );
  }
}
