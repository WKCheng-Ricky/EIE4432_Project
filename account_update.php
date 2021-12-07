<?php
    require_once "dbh.php";
    session_start();

    if(!isset($_POST['edit-submit'])){
        echo "not activated correctly";
        header("Location: index.php?error=unauthorized+entry");
        exit(); 
    }

    $email = $_POST['email'];
    $nickname = $_POST['unick'];
    $gender = $_POST['gender'] == "male" ? 'M' : 'F';
    $birthday = $_POST['birthday'];

    $id = $_SESSION['userId'];

    $sql = "SELECT imageData  FROM users WHERE id={$id}"; 
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        header("Location: index.php?error=user_not_exist");
        exit();
    } 

    if (mysqli_num_rows($result) > 0) {
        if($row = mysqli_fetch_assoc($result)){
            $imgfullpath = $row['imageData'];
        }
    } 


    $folder = 'img/avator/';
    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            $file = $_FILES['img']['tmp_name'];
            $filename = $_FILES['img']['name'];

            $imgfullpath = $imgfullpath . strval(time());
            if(file_exists($imgfullpath) > 0){   
                unlink($imgfullpath);
            }
            move_uploaded_file($file, $imgfullpath);              
        }
    }


    //validation condition:
    $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $valid_user = preg_match("/^[a-zA-Z0-9]*$/", $username);

    //validation check (email format and username format)
    if(!$valid_email && !$valid_user){
        header("Location: account.php?error=invalidboth");
        exit();
    }

    if(!$valid_email ){
        header("Location: account.php?error=invalidemail". $username_str .$nickname_str . $gender_str);
        exit();
    }

    if(!$valid_user){
        header("Location: account.php?error=invalidname". $email_str .$nickname_str . $gender_str);
        exit();
    }


    $id = $_SESSION['userId'];

    $sql = "UPDATE users SET nickname=?, email=?, gender=?, birthday=?, imageData = ? WHERE id = '{$id}';";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: account.php?error=sql");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $nickname, $email, $gender, $birthday, $imgfullpath);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    echo "{$id}:\t{$email},\t{$nickname}\t{$gender}\t{$birthday}";

    require_once "dbh_free.php";

     header("Location: account.php?edit=success");
     exit();

  
