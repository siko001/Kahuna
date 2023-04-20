<?php

require_once 'appliance.php';

function handleClient($method, $args = '', $control = "") {
  switch ($method) {

    case "GET":
      if ($args == '' && $control == "") {
        echo json_encode(Appliance::getAll());
        break;
      } elseif ($control == "") {
        $appliance = Appliance::get($args);
        if ($appliance != null) {
          echo json_encode($appliance);
        } else {
          echo http_response_code(404) . " Error";
        }
        break;
      }

    case "POST":
      $serialNumber = Appliance::getId($args);
      $type = $_POST['type'];
      $description = $_POST['productDescription'];
      $imgUrl = $_POST['imgUrl'];
      if (!$_POST['serialNumber']) {
        $serialNumber = $args;
      } else {
        $serialNumber = $_POST['serialNumber'];
      }
      $insertApp = new Appliance($type, $description, $imgUrl, $serialNumber);
      $insertApp->post();
      header('HTTP/1.1 200 APPLIANCE CREREATED SUCCESSFULLY');
      echo http_response_code(200) . " Producted Created";
      break;


    case "DELETE":
      Appliance::delete($args);
      if (empty($args)) {
        $args = $_GET['serialNumber'];
        Appliance::delete($args);
      }
      header('HTTP/1.1 200 APPLIANCE DELETED SUCCESSFULLY');
      echo http_response_code(200) . " Product Deleted";
      break;

    case "PUT":
      $serialNumber = Appliance::getId($args);
      $type = $_GET['type'];
      $productDescription = $_GET['productDescription'];
      $imgUrl = $_GET['imgUrl'];
      $appliance = new Appliance($type, $productDescription, $imgUrl, $serialNumber);
      $appliance->put($type, $productDescription, $imgUrl, $serialNumber);
      echo http_response_code() . " APPLIANCE UPDATED";
      header('HTTP/1.1 200 APPLIANCE UPDATED SUCCESSFULLY');
      break;
      echo http_response_code(404) . " Error";
      header('HTTP/1.1 404 APPLIANCE NOT FOUND');
      break;




    default:
      header('HTTP/1.1 405 Method Noth Allowded');
      header('Allowed: GET, POST, PUT, DELETE');
      break;
  }
}

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$pathList = explode('/', $uri);



$resource = $pathList[3];
$args = isset($pathList[4]) ? $pathList[4] : null;
$control = isset($pathList[5]) ? $pathList[5] : null;
strtolower($control);
$time = isset($pathList[6]) ? $pathList[6] : "0";
if ($time == null) {
  $time = 0;
}

if ($resource == 'appliances' && !isset($args) && !isset($control)) {
  handleClient($method);
} else if ($resource == 'appliances' && isset($args) && !isset($control)) {
  handleClient($method, $args);
} else if ($resource == 'appliances' && isset($args) && isset($control) && $control == 'switch-on' || 'switch-off' || 'set-timer') {
  $appliance = Appliance::get($args);
  $type = $appliance->getType();
  if ($control === "switch-on") {
    echo "<h1 style='color:green;position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);'>Switching on your " .  $type . " !</h1>";
  } else if ($control === "switch-off") {
    echo "<h1 style='color:red;position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);'>Switching off your " .  $type . "</h1>";
  } else  if ($control === "set-timer") {
    echo "<h1 style='color:blue;position:absolute;top:50%;left:50%;text-align:center;transform: translate(-50%, -50%);'>setting timer for your " .  $type . "<br>" . $time . " minutes</h1>";
  }
}
