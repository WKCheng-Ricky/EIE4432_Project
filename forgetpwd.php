<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

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

    <h1>Forget Password</h1>

    <style>

    .header input{ 
        padding: 15px;
        margin: 5px 5px 22px 0;
        background: #f1f1f1;
    }

    .header input[type=text] {
        width: 100%;
        /* display: inline-block; */
        display: inline;
        border: none;
    }

    .header_btn {
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
    <?php
        if(isset($_GET['error'])){
            echo '<p style="color:red;">User does not exist.</p>';
        }
    ?>

    <form class="header" action="resetpwd.php" method="post">
        <div >
            <label for="uname"><b>Username/ Email</b></label>
            <input type="text" placeholder="Enter Username/ Email..." name="uname" required>
            
            <button class="header_btn" type="submit" name="reset-submit">Find your account</button>
        </div>
    </form>



    <?php
        require "footer.php";
    ?>
</body>
</html>