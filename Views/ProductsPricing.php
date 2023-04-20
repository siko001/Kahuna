<?php
// a table generating all the products information thorugh OOP and with a small twist(easteregg) to keep things fun
require_once '../Controllers/allProducts.php';
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true && !isset($_SESSION['userId'])) {
  unset($_SESSION['loggedin']);
  session_destroy();
  header('location: http://localhost/Kahuna/Views/index');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/productPricing.css">
  <title>Pricing</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th>Serial Number</th>
        <th>Type</th>
        <th>Product Description</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($products as $product) : ?>
        <tr>
          <td><?= $product->getSerialNumber(); ?></td>
          <td><?php if ($product->getSerialNumber() == '120') {
                echo "----------";
              } else {
                echo $product->getType();
              }   ?> </td>
          <td><?php if ($product->getSerialNumber() == '120') {
                echo "CAN YOU FIND ME!?!?  *HINT* INSPECT!";
              } else {
                echo $product->getProductDescription();
              }   ?> </td>
          <td>$9999</td>
        </tr>
      <?php endforeach; ?>
    <tbody>
  </table>
</body>

</html>