 <!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <header>
        <?php require "header.php"; ?>
    </header>

    <h1>Sign up</h1>
    <style>
        /* Full-width input fields */
        .signup input{ 
            padding: 15px;
            margin: 5px 0 22px 0;
            background: #f1f1f1;
        }

        .signup input[type=text], .signup input[type=password] {
            width: 100%;
            display: inline-block;
            border: none;
        }

       

        .signup input:focus{
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for all buttons */
        .signup_btn {
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

        .signup_btn:hover {
            opacity:0.8;
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
    </style>
    <div>
        <form  action="signup_logic.php" method="post" enctype="multipart/form-data">

            <?php
                 $username = isset($_GET['username']) ? $_GET['username'] : null;
                 $email = isset($_GET['email']) ? $_GET['email'] : null;
                 $nickname = isset($_GET['nick']) ? $_GET['nick'] : null;
                 $birthday = isset($_GET['hbd']) ? $_GET['hbd'] : null;

            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "invalidboth":
                        echo '<p style="color: red;font-size: large;">Invalid username and email!</p>';
                        break;

                    case "invalidemail":
                        echo  '<p style="color: red;font-size: large;">Invalid email!</p>';
                        break;

                    case "invalidname":
                        echo '<p style="color: red;font-size: large;">Invalid username!</p>';
                        break;
                        
                    case "userexist":
                        echo '<p style="color: red;font-size: large;">User exist!</p>';
                        break;
               }
            }

            if(isset($_GET['signup'])){
                    echo '<p style="color: green;font-size: large;">User created!</p>';
            }
            ?>
        <div style="padding=5px">
            <div class="signup">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname"  required>

                <label for="unick"><b>Nick name</b></label>
                <input type="text" placeholder="Enter Nick name" name="unick">

                <label for="pwd"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pwd" required>
                
              
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>
                
                <label for="birthday"><b>Birthday:</b></label>
                <input type="date" id="birthday" name="birthday">

                <fieldset data-role="controlgroup">
                <legend>Choose your gender:</legend>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="male" value="male" checked>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" id="female" value="female">
                </fieldset>

                <label for="img">Select image:</label>
                <input type="file" id="img" name="img"  accept="image/*">
                <!-- <input type="file" id="img" name="img" accept="image/*"> -->

                <button class="signup_btn" type="submit" name="signup-submit">Sign up</button>
            </div>


            <div style="background-color:#f1f1f1;">
                <input type="button" class="cancel_btn" value="Cancel" onclick="history.back()">
            </div>
        </div>
            
        </form>
    </div>
</body>
</html>
 
 
