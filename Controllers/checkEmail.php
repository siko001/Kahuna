<?php
//controller for the ajax request to check if ther email is avaliable for registration as soon as the user is done typing
require_once '../Models/CheckEmailAvaliablity.php';
require_once '../Models/CheckEmail.php';

use \Com\Kahuna\Models\CheckEmail;


$controller = new CheckEmail();
$controller->checkEmail();
