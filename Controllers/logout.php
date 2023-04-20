<?php

//controller for logout
session_start();
session_destroy();
unset($_SESSION);
header("location:http://localhost/Kahuna/Views/index?logout=success");
