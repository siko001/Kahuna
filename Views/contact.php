<?php
//contact us page
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true && !isset($_SESSION['userId'])) {
  unset($_SESSION['loggedin']);
  session_destroy();
  header('location: http://localhost/kahuna/Views/index');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/contact.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div id="main">
    <h3> Please fill in the form below</h3>
    <br>
    <form method="POST" action="thankyou.html"> <!--skipped the proccess of this form. But if i were building the website i would, input filter all fields and use htmlSpecialChar function to display the name, email and Phone number -->
      <label for="name">Name</label>
      <input type="text" name="name" value="<?= $_SESSION['name'] ?>" readonly required>
      <br>
      <br>
      <label for="email">Email</label>
      <input type="email" name="email" value="<?= $_SESSION['email'] ?>" readonly required>
      <br>
      <br>
      <label for="number">Phone</label>
      <input type="text" name="number" value="<?= $_SESSION['number'] ?>" readonly required>
      <br>
      <br>
      <label for="msg">Please enter your query below</label>
      <br>
      <br>
      <textarea type="text" rows="10" cols="50"></textarea>
      <br>
      <input type="submit" name="submit">
  </div>
</body>
<script src="js/navbar.js"></script>

</html>