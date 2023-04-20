<?php
//controller to register product to user
SESSION_START();
require_once '../Models/Operation.php';

use \Com\kahuna\Models\Operation;

$operation = new Operation;
if ($_GET['serialNumber'] > 120) {
  header("location:http://localhost/Kahuna/Views/error?error=over");
} else if ($_GET['serialNumber'] < 110) {
  header("location:http://localhost/Kahuna/Views/error?error=under");
} else {
  $register = $operation->registerProduct($_SESSION['userId'], $_GET['serialNumber'], date('d/m/Y'));
}
