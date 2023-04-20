<?php
session_start();
require_once '../lib/Facebook/autoLoad.php';
require_once '../Models/DB.php';

use \Com\Kahuna\Models\DB;

$conn = DB::getInstance()->getHandler();

define('APP_ID', '3408027429511596');
define('APP_SECRET', '2d0c922533b1e10b216600755e20d5d7');
define('API_VERSION', 'v16.0');
define('FB_BASE_URL', 'http://localhost/kahuna/Views/index');



$fb = new \Facebook\Facebook([
  'app_id' => APP_ID,
  'app_secret' => APP_SECRET,
  'default_graph_version' => API_VERSION
]);

$handler = $fb->getRedirectLoginHelper();
$redirectTo = 'http://localhost/Kahuna/Models/callback.php';
$permissions = ['email'];
$loginUrl = $handler->getLoginUrl($redirectTo, $permissions);
