<?php
    session_start();

    if(!isset($_POST['purchase-submit'])){
        header("Location: index.php?error=unauthorized+entry");
    }

    $itemJSON = $_SESSION['shoppingcart'];
    $itemJSON = json_encode($itemJSON);

    $userId = $_SESSION['userId'];

    //Insert into database
    require_once "dbh.php";

    //actually insert data into database
    //Guarenteed data : username, pwd, email
    $sql = "INSERT INTO sales (itemJSON, date, userId) VALUES (?, now(), ?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: shoppingcart.php?error=sql1");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $itemJSON, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $userRegistered = mysqli_stmt_affected_rows($stmt) > 0 ? true : false ;

    if(!$userRegistered){
        header("Location: shoppingcart.php?error=sql2");
        exit();
    }


    $shoppingcart = $_SESSION['shoppingcart'];
    //update every item stock as well
    foreach($shoppingcart as $item){
        $sql = "SELECT stock  FROM item WHERE id=" . $item['id']; 
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            header("Location: index.php?error=item_not_exist");
            exit();
        } 

        $stock = -1;
        if (mysqli_num_rows($result) > 0) {
            if($row = mysqli_fetch_assoc($result)){
                $stock = $row['stock'];
            }
        } 

        $newStock = $stock - $item['qty'];

        $sql = "UPDATE item SET stock = {$newStock} WHERE id=" . $item['id']; 
        echo $sql;
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            header("Location: index.php?error=item_not_exist");
            exit();
        } 
    


    }



    unset($_SESSION['shoppingcart']);
    header("Location: shoppingcart.php?purchase=success");
    exit();

?>