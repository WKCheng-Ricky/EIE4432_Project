<?php

session_start();
session_unset();
session_destroy();

$cookie_name = "userId";
setcookie($cookie_name, time()-3600);

header("Location: index.php");