<?php
// the products page(unbought products) I've desided to go hard coded values for the products on this page other pages are not
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
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/products.css">
  <link rel="stylesheet" href="css/navbar.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Registration</title>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div id="main">
    <h2> Product Registration</h2>
    <h3> Please enter product serial number to register your new product !</h3>
    <div id="form">
      <form method="GET" action='../Controllers/registerProduct.php'>
        <input type="number" name="serialNumber" min="110" max="119" step="1" placeholder="110">

        <br>
        <br>

        <input type="submit">
        <br>
        <a href="ProductsPricing">Click here for Product Price list</a>
      </form>


    </div>

    <br>

    <h2 style="text-decoration:underline">Our Appliances</h2>

    <div id="box">

      <div class="container">
        <a href="singleProduct?action=110" class="hover">
          <div class="box" style="background-image:url('https://i.postimg.cc/SNQYv5JQ/oven.png');"></div>
        </a>
        <h3 class="textover">Oven<br> 110</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=111">
          <div class="box" style="background-image:url('https://i.postimg.cc/nhCjHD46/dishwasher.png'); background-size:70%; background-repeat:no-repeat;background-position: center"></div>
        </a>
        <h3 class="textover">Dishwasher<br> 111</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=112">
          <div class="box" style="background-image:url('https://i.postimg.cc/5ygYt5kM/washingmachine.jpg'); background-size:70%; background-repeat:no-repeat;background-position: center"></div>
        </a>
        <h3 class="textover">Washing Machine<br> 112</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=113">
          <div class="box" style="background-image:url('https://i.postimg.cc/fL40qR01/hob.png');background-position-y:80px;background-size:90%;background-repeat:no-repeat"></div>
        </a>
        <h3 class="textover">Hob<br> 113</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=114">
          <div class="box" style="background-image:url('https://i.postimg.cc/3xRpd6Tf/tv.png'); background-size:cover; background-position-y:70px;"></div>
        </a>
        <h3 class="textover">TV<br> 114</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=115">
          <div class="box" style="background-image:url('https://i.postimg.cc/Dy5Lfhtb/coffeemachine.png');background-size:70%;background-repeat:no-repeat;background-position:center 10px"></div>
        </a>
        <h3 class="textover">Coffee machine<br> 115</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=116">
          <div class="box" style="background-image:url('https://i.postimg.cc/N20MZ463/tumble.png'); background-size:70%; "></div>
        </a>
        <h3 class=" textover">Tumble Dryer<br> 116</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=117">
          <div class="box" style="background-image:url('https://i.postimg.cc/xTsNDRzv/fridge.png');background-size:48%; background-repeat:no-repeat; background-position-x:65px;"></div>
        </a>
        <h3 class=" textover">Fridge<br> 117</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=118">
          <div class="box" style="background-image:url('https://i.postimg.cc/ryNtgcyY/waterheater.png'); background-size:50%; background-repeat:no-repeat; background-position-x:60px; background-position-y:20px"></div>
        </a>
        <h3 class="textover">Water Heater<br> 118</h3>
      </div>

      <div class="container">
        <a href="singleProduct?action=119">
          <div class="box" style="background-image:url('https://i.postimg.cc/3w0vZvWg/vaccum.png'); background-repeat:no-repeat; background-position-y:50px;"></div>
        </a>
        <h3 class=" textover">Robot Vaccum Cleaner<br> 119</h3>
      </div>
    </div>
    <br>
  </div>
  <br>
</body>
<script src="js/navbar.js"></script>

</html>