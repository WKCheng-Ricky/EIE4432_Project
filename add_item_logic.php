<?php

    //check is the request sent from add_item.php
    if(!isset($_POST['add-item-submit'])){
        echo "not activated correctly";
        header("Location: add_item.php?error=unauthorized+entry");
        exit(); 
    }

    echo "request sent from add_item.php<br>";

    //get parameter:
    $itemname = $_POST['iname'];
    $itemprice = $_POST['iprice'];
    $itemstock = $_POST['istock'];

    echo "name: " . $itemname . "<br>";
    echo "price: " . $itemprice . "<br>";
    echo "stock: " . $itemstock . "<br>";

    // $imgData = null;
    // $imageProperties = null;

    
    $imgfullpath = NULL;
    $folder = 'img/item/';
    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            $file = $_FILES['img']['tmp_name'];
            $filename = $_FILES['img']['name'];
    
            $tail = end(explode('.', $filename));
            $filename = str_replace(' ', '', $itemname). "." . $tail;
            $imgfullpath = $folder . $filename;
    
            if(file_exists($imgfullpath) > 0){   
                unlink($imgfullpath);
            }
    
            move_uploaded_file($file, $imgfullpath);              
        }
    }

    // if (count($_FILES) > 0) {
    //     if (is_uploaded_file($_FILES['img']['tmp_name'])) {
    //         $imgData = file_get_contents($_FILES['img']['tmp_name']);
    //         $imageProperties = getimageSize($_FILES['img']['tmp_name'])['mime'];    
            
    //     }
    // }

    $itemname_str = "&itemname=".$itemname;
    $itemprice_str = "&itemprice=".$itemprice;
    $itemstock_str = "&nick=".$itemstock;

    //Connect to database
    require "dbh.php";

    //check if record existed
    $sql = "SELECT name from item WHERE name=?"; //use prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: add_item.php?error=sql1");
        exit();
    }

    //s = string, i = int, b = blob, d = double
    mysqli_stmt_bind_param($stmt, "s", $itemname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $itemExist = mysqli_stmt_num_rows($stmt) > 0 ? true : false ;

    //validation check (is item exist)
    if($itemExist){
        echo  "item exist" . "<br>";
        header("Location: add_item.php?error=itemExist");
        exit();
    }
    
    echo  "item not exist" . "<br>";

    //Insert data into database
    $sql = "INSERT INTO item (`name`, price, stock, imageData, imageType) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: add_item.php?sql2");
        exit();
    }

    echo  "stmt prepared" . "<br>";

    mysqli_stmt_bind_param($stmt, "sssss", $itemname, $itemprice, $itemstock, $imgfullpath, $imageProperties);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $itemAdded = mysqli_stmt_affected_rows($stmt) > 0 ? true : false ;

    if(!$itemAdded){
        echo  "afftected rows: " . mysqli_stmt_affected_rows($stmt);
        //header("Location: add_item.php?error=sql3");
        exit();
    }

    echo "item added to database" . "<br>";
    echo "done" . "<br>";

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  

    echo '<img src="data:image/jpeg;base64,'. $imgData .'"/>'; 

    header("Location: add_item.php?add_item=success");
    exit();
?>