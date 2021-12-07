<?php

//check is the request sent from signup.php
if(!isset($_POST['login-submit'])){
    echo "not activated correctly";
    header("Location: index.php?error=unauthorized+entry");
    exit(); 
}

//get parameter:
$uname = $_POST['uname']; //username or email
$pwd = $_POST['pwd'];


//validation condition:
$valid_user = preg_match("/^[a-zA-Z0-9]*$/", $username);

//validation check (email format and username format)
if(!$valid_user){
    header("Location: index.php?error=invalid+name". $email_str .$nickname_str . $gender_str);
    exit();
}

//Query database
require_once "dbh.php";

//check if record existed
$sql = "SELECT id, username, pwd, shopkeeper  FROM users WHERE username=? OR email=?;"; 
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: index.php?error=sqlconnection");
    exit();
}

//s = string, i = int, b = blob, d = double
mysqli_stmt_bind_param($stmt, "ss", $uname, $uname);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$pwdCheck = false;
if($row = mysqli_fetch_assoc($result)){
    if($row['shopkeeper'] == 0){
        $pwdCheck = password_verify($pwd, $row['pwd']);
    } else {
        $pwdCheck = ($pwd == $row['pwd']);
    }
    
} else {
    header("Location: index.php?error=user+not+exist");
    exit();
}

require "dbh_free.php";

if(!$pwdCheck){
    header("Location: index.php?error=wrongpwd");
    exit();
}

if($pwdCheck){
    session_start();
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['shopkeeper'] = $row['shopkeeper'];


    $cookie_name = "userId";
    $cookie_value = $row['id'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day

    header("Location: index.php?login=success");
    exit();
}

header("Location: index.php?error=unknown");
exit();

?>