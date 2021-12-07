<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->
<?php
    $TEST = false;
    session_start();
?>
<header>
<link rel="stylesheet" href="header.css">

    <nav class="header_nav">
        <a href="index.php">
            <img class="header_img" src = "img/logo.png" alt="logo">
        </a>
        <ul class="header_ul">
            <li><a href="index.php">Home</a></li>
            <?php
                 if(isset($_SESSION['shopkeeper'])){
                     if($_SESSION['shopkeeper'] == 0){
                        echo '<li><a href="shoppingcart.php">Shopping Cart</a></li>';
                     }

                     if($_SESSION['shopkeeper'] == 1){
                        echo '<li><a href="add_item.php">Add Item</a></li>';
                        echo '<li><a href="find_item.php">Edit Item</a></li>';
                        echo '<li><a href="show_item.php">Show Item</a></li>';
                        echo '<li><a href="show_purchase.php">Check Purchase Record</a></li>';
                        echo '<li><a href="show_user_purchase.php">Check User Purchase Record</a></li>';
                     }
                 }
            ?>
            <!-- 
            <li><a href="#">Shopping Cart</a></li>
            <li><a href="#">Test1</a></li>
            <li><a href="#">Test2</a></li>
            -->
        </ul>

        <div class="header_div">   
            <ul class="header_ul">

                <!-- <li>
                    <button class="header_btn" name="login-prompt" onclick="document.getElementById('login_prompt').style.display='block'">Login</button>
                </li>-->

                <?php
                    if(!isset($_SESSION['userId'])){

                        echo 
                        "<li>" . 
                            '<button class="header_btn" name="login-prompt" 
                                onclick="document' . ".getElementById('login_prompt').style.display='block'". ' ">Login</button>
                        </li>
                        <li><a href="signup.php">Signup</a></li>';
                    } else {
                        echo "<li><p style='color:white;'>Hi, ". $_SESSION['username'] ."!<p></li>";

                        if($_SESSION['shopkeeper'] == 0){
                            echo  '<li><a href="account.php">Account</a></li>';
                        }
                       
                        echo
                        '<li>
                            <form class="header_form" action="logout.php" method = "post">
                                <button class="header_btn" type="submit" name="logout-submit">Logout</button>
                            </form>
                        </li>';
                    }
                ?>
            </ul>
        </div>
    </nav>


    <?php

            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "wrongpwd":
                        echo '<p style="color: red;font-size: large;">Wrong Password!</p>';
                        break;
                    case "user not exist":
                        echo '<p style="color: red;font-size: large;">Account not exist!</p>';
                        break;
               }
            }

            // if(isset($_GET['signup'])){
            //         echo '<p style="color: green;font-size: large;">User created!</p>';
            // }
            ?>

    <div id="login_prompt" class="modal" style="display:none">
        <?php require "login.php"?>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('login_prompt');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
<header>
