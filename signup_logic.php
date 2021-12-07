<?php

//check is the request sent from signup.php
if(!isset($_POST['signup-submit'])){
    echo "not activated correctly";
    header("Location: signup.php?error=unauthorized+entry");
    exit(); 
}

//get parameter:
$username = $_POST['uname'];
$pwd = $_POST['pwd'];
$email = $_POST['email'];
$nickname = $_POST['unick'];
$gender = $_POST['gender'] == "male" ? 'M' : 'F';
$birthday = $_POST['birthday'];

// $imgData = null;
// $imageProperties = null;
// if (count($_FILES) > 0) {
//     if (is_uploaded_file($_FILES['img']['tmp_name'])) {
//         $imgData = file_get_contents($_FILES['img']['tmp_name']);
//         $imageProperties = getimageSize($_FILES['img']['tmp_name'])['mime'];       
//     }
// }



$imgfullpath = NULL;
$folder = 'img/avator/';
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $file = $_FILES['img']['tmp_name'];
        $filename = $_FILES['img']['name'];

        $tail = end(explode('.', $filename));
        $filename = $email . "." . $tail;
        $imgfullpath = $folder . $filename;

        if(file_exists($imgfullpath) > 0){   
            unlink($imgfullpath);
        }

        move_uploaded_file($file, $imgfullpath);              
    }
}

// validation: empty field
// checked by html
// if(empty($username)){ 
// }

//validation condition:
$valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
$valid_user = preg_match("/^[a-zA-Z0-9]*$/", $username);

$username_str = "&username=".$username;
$email_str = "&email=".$email;
$nickname_str = "&nick=".$nickname;
$gender_str = "&gender=".$gender;

//validation check (email format and username format)

if(!$valid_email && !$valid_user){
    header("Location: signup.php?error=invalidboth" . $nickname_str . $gender_str);
    exit();
}

if(!$valid_email ){
    header("Location: signup.php?error=invalidemail". $username_str .$nickname_str . $gender_str);
    exit();
}

if(!$valid_user){
    header("Location: signup.php?error=invalidname". $email_str .$nickname_str . $gender_str);
    exit();
}

//Insert into database
require_once "dbh.php";


//check if record existed
$sql = "SELECT username from users WHERE username=?"; //use prepared statement to prevent sql injection
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: signup.php?error=sql");
    exit();
}

//s = string, i = int, b = blob, d = double
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$userExist = mysqli_stmt_num_rows($stmt) > 0 ? true : false ;

//validation check (is user exist)
if($userExist){
    header("Location: signup.php?error=userexist");
    exit();
}

//actually insert data into database
//Guarenteed data : username, pwd, email
$sql = "INSERT INTO users (username, pwd, email, nickname, gender, imageData, imageType, birthday) VALUES (?,?,?,?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: signup.php?error=sql");
    exit();
}

$pwd = password_hash($pwd, PASSWORD_DEFAULT);
mysqli_stmt_bind_param($stmt, "ssssssss", $username, $pwd, $email, $nickname, $gender, $imgfullpath, $imageProperties, $birthday);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$userRegistered = mysqli_stmt_affected_rows($stmt) > 0 ? true : false ;

if(!$userRegistered){
    header("Location: signup.php?error=sql");
    exit();
}

echo "user registered";
echo "<br>";
echo "done";

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: signup.php?signup=success");
exit();
?>