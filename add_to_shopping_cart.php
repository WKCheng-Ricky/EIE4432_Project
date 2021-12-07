<?php 
    session_start();
    if(!isset($_SESSION['shoppingcart'])){
        $_SESSION['shoppingcart'] = [];
        $shoppingcart = [];
    } else {
        $shoppingcart = $_SESSION['shoppingcart'];
    }

    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $item = array("id"=>$id, "qty"=>$qty);

    if(empty($shoppingcart)){
        array_push($shoppingcart, $item);
    } else {

        $newshoppingcart = [];
        $found = false;
        foreach ($shoppingcart as $old){
            if($old['id'] != $id){
                array_push($newshoppingcart, $old);
            } else{
                $found = true;
                array_push($newshoppingcart, $item);
            }
        }

        if(!$found){
            array_push($newshoppingcart, $item);
        }

        $shoppingcart = $newshoppingcart;
    }

    $_SESSION['shoppingcart'] = $shoppingcart;

    if(isset($_POST['add-shoppingcart-submit'])){
        header("Location: index.php?shoppingcart=adjusted");
        exit();
    } 



?>