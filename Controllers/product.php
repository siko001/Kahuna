<?php
//controller for getting the information on each product indavidually from the Db (unbought Products)
require_once '../Models/Operation.php';

use \Com\Kahuna\Models\Operation;

$action = null;
$action = $_GET['action'];
$operation = new Operation;
switch ($action) {
  case 110:
    $serialNumber = 110;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 111:
    $serialNumber = 111;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 112:
    $serialNumber = 112;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 113:
    $serialNumber = 113;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 114:
    $serialNumber = 114;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 115:
    $serialNumber = 115;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 116:
    $serialNumber = 116;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 117:
    $serialNumber = 117;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 118:
    $serialNumber = 118;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 119:
    $serialNumber = 119;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
  case 120:
    $serialNumber = 120;
    $product = $operation::getProductBySerialNumber($serialNumber);
    break;
}
