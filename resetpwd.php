<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

<?php 
    if(!isset($_POST['reset-submit'])){
        header("Location: index.php");
        exit();
    }

    require_once "dbh.php";

    if(!isset($_POST['pwd'])){
        $uname = $_POST['uname'];
    
        //check if record existed
        $sql = "SELECT username FROM users WHERE username=? or email=?;"; //use prepared statement to prevent sql injection
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: forgetpwd.php?error=sql");
            exit();
        }
    
        //s = string, i = int, b = blob, d = double
        mysqli_stmt_bind_param($stmt, "ss", $uname,  $uname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    
        $userExist = mysqli_stmt_num_rows($stmt) > 0 ? true : false ;
    
        //validation check (is user exist)
        if(!$userExist){
            header("Location: forgetpwd.php?error=usernotexist");
            exit();
        }    
        
    } else {
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];

        echo "hello<br>";
        echo "uname:";
        echo $uname;
        echo "<br>password:";
        echo $pwd;
        echo "<br>";
        
        //check if record existed
        $sql = "UPDATE users SET pwd = ? WHERE username= ? OR email= ?"; //use prepared statement to prevent sql injection
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: forgetpwd.php?error=sql");
            exit();
        }

        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $pwd, $uname, $uname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        echo "Updated";

        header("Location: index.php?reset=success");

        require 'dbh_free.php';
    }
     
?>




<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- <link rel="stylesheet" href="stylesheet.css"> -->
</head>
<body>
    <?php
        require "header.php";
    ?>

    <h1>Reset Password</h1>

    <form class="" action="resetpwd.php" method="post">
        <div class="">
            <label for="uname"><b>Username/ Email</b></label>
            <input type="text" placeholder="Enter Username/ Email..." name="uname" value="<?php echo $uname?>" readonly>

            <label for="pwd"><b>New password</b></label>
            <input type="password" placeholder="Enter a new password" name="pwd" required>
            
            <button class="header_btn" type="submit" name="reset-submit">Reset password</button>
        </div>
    </form>


    <?php
        require "footer.php";
    ?>
</body>
</html>