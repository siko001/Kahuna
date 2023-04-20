<?php
//Class Product Representing The Table in database
namespace Com\Kahuna\Models;

class Product {
  private $serialNumber;
  private $type;
  private $productDescription;
  private $imgUrl;


  public function __construct($serialNumber, $type, $productDescription, $imgUrl) {
    $this->serialNumber = $serialNumber;
    $this->type = $type;
    $this->productDescription = $productDescription;
    $this->imgUrl = $imgUrl;
  }

  public function getType() {
    return $this->type;
  }

  public function getSerialNumber() {
    return $this->serialNumber;
  }

  public function getProductDescription() {
    return $this->productDescription;
  }

  public function getImgUrl() {
    return $this->imgUrl;
  }
}
