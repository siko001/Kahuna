<?php

use \Com\Kahuna\Models\DB;
use \Com\Kahuna\Model\Operation;

require_once 'config.php';
require_once 'Operation.php';

try {
  $accessToken = $handler->getAccessToken();
} catch (\Facebook\Execptions\FacebookResponseException $e) {
  echo "Response Exception " . $e->getMessage();
  exit();
} catch (\Facebook\Execptions\FacebookSDKException $e) {
  echo "SDK Exeception " . $e->getMessage();
  exit();
}

if (!$accessToken) {
  header("location:http://localhost/Kahuna/Views/index");
  exit();
}

$oAuth2Client = $fb->getOAuth2Client();
if (!$accessToken->isLongLived())
  $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

$response = $fb->get("/me?fields=id, first_name, last_name, email", $accessToken);
$userData = $response->getGraphNode()->asArray();
$_SESSION['userData'] = $userData;
$_SESSION['accessToken'] = (string) $accessToken;

$fullname = $userData['first_name'] . " " . $userData['last_name'];
$_SESSION['name'] = $fullname;
$_SESSION['email'] = $userData['email'];
$userData['phone'] = $userData['id']; // i did this as facebook does not allow phone numbers so i'm just doing this for the sake of finishing :)
$_SESSION['number'] = $userData['phone'];
$id = $userData['id'];

if ($userData) {
  checkFBLogin($userData['id'], $fullname, $userData['email'], "12345678", password_hash("SorryTookAShortCut:)", PASSWORD_DEFAULT)); //since i cannot get the info for the number from fb due to privacy "TAPPARSI" we inputted the number our selves for the sake of it :) //same for password :)
  exit();
}


function checkFBLogin($userId, $fullname, $email, $number, $password) {
  global $id;
  $conn = DB::getInstance()->getHandler();
  $query = "SELECT * FROM users WHERE email= :email";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $stmt->fetch(PDO::FETCH_OBJ);
  if ($stmt->rowCount() == 0) {
    $conn = DB::getInstance()->getHandler();
    $query = "INSERT INTO users(UserId, name, email, number, password) VALUES (:userId, :fullname, :email, :number, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $userId;
    header("location: http://localhost/Kahuna/Views/dashboard?facebookUser=$id");
  } else {
    $conn = DB::getInstance()->getHandler();
    $query = "SELECT * FROM users WHERE email= :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['userId'] = $result['UserId'];
    $_SESSION['loggedin'] = true;
    header("location: http://localhost/Kahuna/Views/dashboard?facebookUser=$id");
  }
}
