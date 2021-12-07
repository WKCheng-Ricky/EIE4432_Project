<?php
  // is user logged in?
  if(!isset($_SESSION['userId'])){
    header("Location: index.php?error=unauthorized+entry");
    exit();
  }

  // is user admin?
  if($_SESSION['shopkeeper'] != 1){
    header("Location: index.php?error=unauthorized+entry");
    exit();
  }
?>