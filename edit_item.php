<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->
<?php 

if(!isset($_POST['iprice'])){

    $itemname = $_POST['iname'];
    // echo "item name: ". $itemname . "<br?";

    require "dbh.php";
    //check if record existed
    $sql = "SELECT *  FROM item WHERE `name` LIKE ?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: find_item.php?error=sql_stmt_prepare");
        exit();
    }

    //s = string, i = int, b = blob, d = double
    mysqli_stmt_bind_param($stmt, "s", $itemname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    //validation check (is user exist)
    if(mysqli_num_rows($result) == 0){
        echo 'item not exist';
        //header("Location: find_item.php?error=itemNotFound");
        exit();
    }    


    if($row = mysqli_fetch_assoc($result)){
        $itemname = $row['name'];
        $itemprice = $row['price'];
        $itemstock = $row['stock'];
        $imgfullpath = $row['imageData'];
    }

    require "dbh_free.php";


} else { 

    //already found the record
    $itemname = $_POST['iname'];
    $itemprice =$_POST['iprice'];
    $itemstock = $_POST['istock'];

    require "dbh.php";
    //check if record existed
    $sql = "SELECT imageData  FROM item WHERE name = '{$itemname}'"; 
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        header("Location: index.php?error=item_not_exist");
        exit();
    } 

    if (mysqli_num_rows($result) > 0) {
        if($row = mysqli_fetch_assoc($result)){
            $imgfullpath = $row['imageData'];
        }
    } 

 
    $folder = 'img/item/';
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

    // echo $itemname . "<br>";
    // echo $itemprice . "<br>";
    // echo $itemstock . "<br>";
    // echo $imgfullpath . "<br>";

    //check if record existed
    $sql = "UPDATE item SET price = ?, stock = ?, imageData = ? WHERE name= ?"; //use prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "stmt problem";
        //header("Location: forgetpwd.php?error=sql");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $itemprice, $itemstock, $imgfullpath, $itemname);
    mysqli_stmt_execute($stmt);

    $updated = true;

}

?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="edit_item.css">
</head>
<body>
    <?php
        require "header.php";
        require "isAdmin.php";
    ?>

    <h1>Edit Item</h1>
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
            display: inline;
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
    </style>
     -->
    <div>

            <?php
              if(isset($updated)){
                      echo '<p style="color: green;font-size: large;">Item updated!</p>';
              }
            ?>

        <div>
            <form  action="edit_item.php" method="post" enctype="multipart/form-data">

                <div style="padding=5px">
                    <div class="item">
                        <label for="iname"><b>Item name</b></label>
                        <input type="text" value="<?php echo $itemname; ?>" name="iname" readonly>

                        <div>
                            <label for="iprice"><b>Item Price</b></label>
                            <input type="number" step="0.01" value="<?php echo $itemprice; ?>" name="iprice" min="0" required>     

                            <label for="istock"><b>Item Stock</b></label>
                            <input type="number" value="<?php echo $itemstock; ?>" name="istock" min="0" required>
                        </div>

                        <div>
                            <label for="img"><b>Select image:</b></label>
                            <input type="file" id="img" name="img">
                        </div>

                        <img src= "<?php echo $imgfullpath?>" name="original_img" />

                        <button class="item_btn" type="submit" name="edit-item-submit">Edit item</button>
                    </div>


                    <div style="background-color:#f1f1f1;">
                        <input type="button" class="cancel_btn" value="Cancel" onclick="location.href = 'index.php';">
                    </div>
                </div>
                
            </form>
        </div>
    
    </div>




    <?php
        require "footer.php";
    ?>
</body>
</html>