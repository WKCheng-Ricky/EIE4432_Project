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

    <?php
        
        if(isset($_SESSION['shopkeeper'])){
            if($_SESSION['shopkeeper'] == 0){
                require "shop_menu_body.php";
            }

            if($_SESSION['shopkeeper'] == 1){
                require "show_item_body.php";
            }
        } else {
            require "window_shopping.php";
        }


        require "home.php";
    ?>


    <?php
        require "footer.php";
    ?>
</body>
</html>