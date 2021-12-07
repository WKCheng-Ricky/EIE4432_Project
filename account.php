<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->



<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php
        require "header.php";
    ?>

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

    <h1>Edit Account</h1>
    <link rel="stylesheet" href="account.css">
    <!-- <style>
        /* Full-width input fields */
        .item input{ 
            padding: 15px;
            margin: 5px 5px 22px 0;
            background: #f1f1f1;
        }

        .item input[type=text], .item input[type=file] {
            width: 100%;
            /* display: inline-block; */
            display: inline-block;
            border: none;
        }

       

        .item input:focus{
            background-color: #ddd;
            outline: none;
        }

        .item img {
            width: 300px; 
            height: 300px; 
            object-fit: cover;
        }


        /* Set a style for all buttons */
        .item_btn {
            background-color: #04AA6D;
            color: white;
            border-radius: 8px;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 1;
        }

        .item_btn:hover {
            opacity:0.6;
        }

        /* Extra styles for the cancel button */
        .cancel_btn {
            background-color: #f44336;
            color: white;
            border-radius: 8px;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.8;
        }


        .cancel_btn:hover {
            opacity: 1;
        }


        .grid{
            padding: 15px;
            margin: 5px 5px 22px 0;
            display: grid;
            grid-template-columns: 1fr 4fr ;
             grid-template-rows: auto; 
            place-items: center;
            
        }


        .item img{
            width: 200px; 
            height: 200px; 
            padding: 15px;
            margin: 5px 5px 22px 0;
            object-fit: cover;
        }


    </style> -->

    <div>

            

        <div>
            <?php
                if(isset($_GET['edit'])){
                        echo '<p style="color: green;font-size: large;">Item updated!</p>';
                }
                ?>
            <form  action="account_update.php" method="post" enctype="multipart/form-data">
                
                <div class="grid item">
                    <div>
                        <img src= "<?php echo $imgfullpath?>" name="original_img" />
                        <br>
                        <label for="img"><b>Select image:</b></label>
                        <input type="file" id="img" name="img">
                        
                     
                    </div>

                    <div>
                        <label for="uname"><b>Username</b></label>
                        <input type="text" value="<?php echo $username; ?>" name="uname" readonly>

                        <label for="unick"><b>Nickname:</b></label>
                        <input type="text" name="unick" value="<?php echo $nickname?>">

                        <!-- <fieldset> -->
                        <label><b>Gender</b></label>
                        <br>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" id="male" value="male" <?php if($gender == 'M') echo "checked"; ?> >
                        <label for="female">Female</label>
                        <input type="radio" name="gender" id="female" value="female"  <?php if($gender == 'F') echo "checked"; ?>>
                        <br>
                        <!-- </fieldset> -->

                        <label for="email"><b>Email:</b></label>
                        <input type="text" name="email" value="<?php echo $email?>">
                    
                        <label for="birthday"><b>Birthday:</b></label>
                        <input type="date" name="birthday" value="<?php echo $birthday?>">

                     
                    </div>

                   
                  
                    <button onclick="history.back()" class="cancel_btn" >Cancel</button>
                    <button type="submit" class="item_btn" name="edit-submit">Save</button>

                </div>

        
                
            </form>
        </div>
    
    </div>




    <?php
        require "footer.php";
    ?>
</body>
</html>