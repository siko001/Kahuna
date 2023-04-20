<?php
//controller to show all registered product to user(bought products)
use \Com\kahuna\Models\Operation;

require_once '../Models/Operation.php';


$userId = $_SESSION['userId'];
$operation = new Operation();
$registeredProducts = $operation->getAllRegisteredProducts($userId);
