<?php
//class to handle user profile data

namespace Com\Kahuna\Models;

use Com\Kahuna\Models\DB;
use Com\Kahuna\Models\Product;
use Com\Kahuna\Models\RegisteredProduct;

require_once 'DB.php';
require_once 'Product.php';
require_once 'RegisteredProduct.php';

class Operation {
  //get User email from DB
  public static function getUserByEmail($email) {
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  public static function getUserById($userId) {
    //get User ID from DB
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT userId FROM users WHERE userId = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public static function getProductByUserId($userId) {
    //get product allocated to user
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * FROM registeredProducts WHERE userId = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $products = array();
    while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
      $products[] = new Product($row->serialNumber, $row->type, $row->productDescription, $row->imgUrl);
    }
    return $products;
  }

  public static function getAllProducts() {
    //display all products stored in the DB (COMPANY DB PRE-DEFINED)
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = array();
    while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
      $products[] = new Product($row->serialNumber, $row->type, $row->productDescription, $row->imgUrl);
    }
    return $products;
  }


  public static function getProductBySerialNumber($serialNumber) {
    // get product by its serial number
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * FROM products WHERE serialNumber = :serialNumber");
    $stmt->bindParam(':serialNumber', $serialNumber);
    $stmt->execute();
    $row = $stmt->fetch(\PDO::FETCH_OBJ);
    if (!$row) {
      return false;
    }
    $product = new Product($row->serialNumber, $row->type, $row->productDescription, $row->imgUrl);
    return $product;
  }


  public static function registerProduct($userId, $serialNumber, $DateOfPurchase) {
    // register a product to the allocated uses
    global $errors;
    $db = DB::getInstance()->getHandler();
    $stmt = $db->prepare("SELECT * from products WHERE serialNumber = :serialNumber");
    $stmt2 = $db->prepare("SELECT * from registeredProducts Where serialNumber = :serialNumber and userId = :userId");
    $stmt->bindParam(':serialNumber', $serialNumber);
    $stmt2->bindParam(':serialNumber', $serialNumber);
    $stmt2->bindParam(':userId',  $userId);
    $stmt->execute();
    $stmt2->execute();
    if (!$stmt->fetch()) {
      //if error while user is registering a product
      $errors[] = "Error";
      header('location: http://localhost/Kahuna/Views/error?error=fail');
    } else {
      if ($stmt2->rowCount() > 0) {
        //if product is already registered to user
        $errors = array();
        $errors[] = "Product Already registered!"; //
        header('location: http://localhost/Kahuna/Views/error?error=PoR');
      } else {
        // if product is not registered to user
        $db = DB::getInstance()->getHandler();
        $stmt = $db->prepare("INSERT INTO registeredproducts (userId, serialNumber, DateOfPurchase) VALUES (:userId, :serialNumber , :DateOfPurchase)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':serialNumber', $serialNumber);
        $stmt->bindParam(':DateOfPurchase', $DateOfPurchase);
        $stmt->execute();
        header('location: http://localhost/Kahuna/Views/dashboard?registered=ok');
      }
    }
  }


  public static function getAllRegisteredProducts($userId) {
    //display all product registered to user(Bought Products)
    $db = DB::getInstance()->getHandler();
    $query = 'SELECT rp.userId, rp.serialNumber, rp.dateOfPurchase, p.type, p.productDescription, p.imgUrl FROM registeredProducts rp INNER JOIN products p ON rp.serialNumber = p.serialNumber WHERE userId = :userId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $products = $stmt->fetchALL(\PDO::FETCH_OBJ);
    foreach ($products as $product) {
      $registeredProducts[] = new RegisteredProduct($product->serialNumber, $product->type, $product->productDescription, $product->imgUrl, $product->dateOfPurchase);
    }
    if (isset($registeredProducts))
      return $registeredProducts;
  }
}
