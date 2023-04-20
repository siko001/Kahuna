<?php
//
require_once '../Controllers/product.php';

session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true && !isset($_SESSION['userId'])) {
  unset($_SESSION['loggedin']);
  session_destroy();
  header('location: http://localhost/kahuna/views/index');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/singleProduct.css">
  <title><?= $product->getType(); ?></title>
</head>

<body>
  <div id="main">
    <div class="container">
      <div class="pic" style="background-image:url('<?= $product->getImgUrl(); ?>')"></div>
      <div class="description">
        <h4>Type</h4>
        <p><?= $product->getType(); ?>
        </p>
        <h4>Serial Number</h4>
        <p><?= $product->getSerialNumber(); ?>
        </p>
        <h4> Description</h4>
        <p><?= $product->getProductDescription(); ?>
        </p>
      </div>
    </div>
  </div>
</body>

</html>