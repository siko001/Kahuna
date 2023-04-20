<?php
session_start();
require_once '../Controllers/showAllRegisteredProducts.php';
//User Dashboard. if user has any products to his account they are displayed through OOP
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true && !isset($_SESSION['userId']) && !isset($_SESSION['accessToken'])) {
  unset($_SESSION['loggedin']);
  session_destroy();
  header('location: http://localhost/Kahuna/Views/index');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/navbar.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kahuna Home</title>
</head>
<link rel="stylesheet" href="css/dashboard.css">

<body>
  <?php include 'navbar.php'; ?>
  <div id="main">

    <h2>Welcome <?php if (isset($_SESSION['userData'])) {
                  echo "Facebook user ";
                }
                if (isset($_SESSION['name'])) {
                  echo htmlspecialchars($_SESSION['name']);
                } ?> </h2>
    <br>
    <?php if (isset($_GET['registered']) && $_GET['registered'] == 'ok') echo "<h1 style='color:#f56501;text-decoration:underline;'>Product Successfully Registered</h1>"; ?>
    <?php if (!isset($registeredProducts)) {
      echo "<h3>Please Register Your Appliance From the <a style='color:black;' href='http://localhost/Kahuna/Views/productPage'>Appliance Page</a></h3>";
    } else {
      echo "<h3>Your Registered Appliances</h3>";
    } ?>
    <div id="box">
      <?php if (isset($registeredProducts)) foreach ($registeredProducts as $rp) : ?>
        <div class="container">
          <div class="box" style="background-image:url('<?= $rp->getImgUrl() ?>');"></div>
          <div class="textover">
            <h3> <?= $rp->getType();   ?></h3>
            <p> <?= $rp->getProductDescription(); ?></p>
            <p> <?= $rp->getDateOfPurchase(); ?> </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
<script src="js/navbar.js"></script>

</html>