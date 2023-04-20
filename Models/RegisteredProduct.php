<?php
//Class RegisteredProduct Representing The Table in database
namespace Com\Kahuna\Models;

class RegisteredProduct {
  private $serialNumber;
  private $type;
  private $productDescription;
  private $imgUrl;
  private $dateOfPurchase;

  public function __construct($serialNumber, $type, $productDescription, $imgUrl, $dateOfPurchase) {
    $this->serialNumber = $serialNumber;
    $this->type = $type;
    $this->productDescription = $productDescription;
    $this->imgUrl = $imgUrl;
    $this->dateOfPurchase = $dateOfPurchase;
  }

  public function getSerialNumber() {
    return $this->serialNumber;
  }


  public function getType() {
    return $this->type;
  }

  public function getProductDescription() {
    return $this->productDescription;
  }

  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getDateOfPurchase() {
    return $this->dateOfPurchase;
  }
}
