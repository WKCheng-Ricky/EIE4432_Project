<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php require "header.php"; ?>

    <?php

    if(!isset($_SESSION['userId'])){
        echo "not activated correctly";
        header("Location: signup.php?error=unauthorized+entry");
        exit();
    }

    $userId = $_SESSION['userId'];

    require "dbh.php";
    //check if record existed
    $sql = "SELECT *  FROM users WHERE id={$userId}"; 
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        header("Location: index.php?error=user_not_exist");
        exit();
    } 

    if (mysqli_num_rows($result) > 0) {
        if($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $nickname = $row['nickname'];
            $gender = $row['gender'];
            $email = $row['email'];
            $birthday = $row['birthday'];
            $imgfullpath = $row['imageData'];
        }
    } else {
        //corrupted account
        header("Location: index.php?error=corrupted_user");
        exit();
    }

    mysqli_close($conn);
    
    ?>



<div class=WordSection1>
<!-- 
     <div style="position: relative; width: 100%; max-width: 256px; float:left; border: 1px solid black; margin: 10px;">
        <img src="img/icon1.png" style="width:100%">
        <button style = "position:absolute; bottom:15px; right:15px;">Edit</button>
    </div>
     -->
    <style>
            .account_avator{
                position: relative; 
                width: 100%; 
                max-width: 256px; 
                float:left; 
                border: 1px solid black; 
                margin: 10px;
            }
            .acount_avator_button{
                position:absolute; 
                bottom:15px; 
                right:15px;
            }

            .account {
                margin: 2px;
            }
            .account table,th,td{
                border: 1px solid black;
                
            }
        </style>

        <?php 
            if(isset($_GET['edit'])){
                echo "<p>Updated</p>";
            }
        ?>
<?php echo $imgfullpath?>
        <form action="account_update.php" method="post" enctype="multipart/form-data">     
            <div class="account_avator">
                <img src= "<?php echo $imgfullpath?>" name="original_img" />
                <button class="acount_avator_button">Edit</button>
            </div>

        
            <div class="account">
                <table  style="float:center;" >
                    <tr>
                        <td><p>Username:</p></td>
                        <td><p><?php echo $username?></p></td>
                        <!-- <td><p><input type="text" name="uname" value="<?php echo $username?>" readonly></p></td> -->
                    </tr>

                    <tr>
                        <td><p>Nickname:</p></td>
                        <td><p><input type="text" name="unick" value="<?php echo $nickname?>"></p></td>
                    </tr>

                    <tr>
                        <td><p>Gender</p></td>
                        <td>
                            <p>
                                <label for="male">Male</label>
                                <input type="radio" name="gender" id="male" value="male" <?php if($gender == 'M') echo "checked"; ?> >
                                <label for="female">Female</label>
                                <input type="radio" name="gender" id="female" value="female"  <?php if($gender == 'F') echo "checked"; ?>>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td><p>Email:</p></td>
                        <td><p><input type="text" name="email" value="<?php echo $email?>"></p></td>
                    </tr>

                    <tr>
                        <td><p>Birthday:</p></td>
                        <td><p><input type="date" name="birthday" value="<?php echo $birthday?>"></p></td>
                    </tr>
                </table>
            </div>

            <button onclick="history.back()" style = "float:right;">Cancel</button>
            <button type="submit" style = "float:right;" name="edit-submit">Save</button>
        </form>
   
</div>


    <?php
        require "footer.php";
    ?>
</body>
</html>