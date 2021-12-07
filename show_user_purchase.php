
<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

<!DOCTYPE html>
<html>

    
    <?php 
    require "header.php";
    ?>

    <style>
        .body input{ 
        padding: 15px;
        margin: 5px 5px 22px 0;
        background: #f1f1f1;
        }

        .body input[type=number] {
            width: 100%;
            display: inline-block;
            border: none;
        }
        .body_btn {
        background-color: #04AA6D;
        color: white;
        border-radius: 8px;
        padding: 10px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        }


    </style>

    <form class="body" action="show_user_purchase.php" method="post">
        <div >
            <label for="userId"><b>User ID</b></label>
            <input type="nubmer" placeholder="Enter User Id" name="userId" required>
            <button class="body_btn" type="submit" name="show-user-purchase-submit">Find User's purchase</button>
        </div>
    </form>

    <?php
   
    if(isset($_POST['userId'])){
        require "show_user_purchase_body.php";
    }
  
    require "footer.php";
    ?>
</html>