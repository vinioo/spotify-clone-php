<?php
  ob_start();
  session_start();

  $timezone = date_default_timezone_set("America/Sao_Paulo");

  $conn = mysqli_connect("localhost","root","vinicius","spotify");

  if (mysqli_connect_errno()) {
    echo "Failed to connect :" . mysqli_connect_errno();
  }




 ?>
