<?php
// controller to display all products pre-entered in Db
require_once '../Models/Operation.php';

use \Com\Kahuna\Models\Operation;

$operation = new Operation();
$products = $operation::getAllProducts();
