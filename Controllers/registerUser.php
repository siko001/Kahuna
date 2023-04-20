<?php
//controller to register a new user
require_once '../Models/RegisterUser.php';

use \Com\Kahuna\Models\RegisterUser;

$userController = new RegisterUser();
$userController->register();
