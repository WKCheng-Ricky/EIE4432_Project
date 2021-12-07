<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->



<body>
    <!-- <link rel="stylesheet" href="show_item.css"> -->

        <style>
            .grid{
                display: grid;
                grid-template-columns: 1fr;
                grid-template-rows: 300px 300px;
                place-items: center;
                
            }

            .grid_inner{
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
                place-items: center;
                border: 3px solid #dfdfdf;

            }

            .grid_inner img{
                width: 200px; 
                height: 200px; 
                padding: 15px;
                margin: 5px 5px 22px 0;
                object-fit: cover;
            }


            .grid_inner button {
                background-color: #04AA6D;
                color: white;
                border-radius: 8px;
                padding: 15px;
                margin: 5px 5px 22px 0;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            .grid_inner p{
                padding: 15px;
                margin: 5px 5px 22px 0;
                background: #f1f1f1;
            }
        </style>
        <div class="grid">
                <?php 
                    if(isset($_GET['purchase'])){
                        echo '<p style="color:red;">Thank you for your purchase!</p>';
                        exit();
                    }

                    if(!isset($_SESSION['shoppingcart'])){
                        echo '<p>You cart is currently empty.</p>';
                        exit();
                    }

                    $shoppingcart = $_SESSION['shoppingcart'];
                    $total = 0;
                    
                    

      
                    // echo "size of array: " . sizeof($itemarr) . "<br>";
                    foreach ($shoppingcart as $item) {
                        
                        $id = $item['id'];
                        $qty = $item['qty'];

                        require "dbh.php";

                        $sql = "SELECT name, price, imageData FROM item WHERE id = '{$id}'"; 
                        $result = mysqli_query($conn, $sql);
                    
                        if (!$result) {
                            header("Location: index.php?error=user_not_exist");
                            exit();
                        } 

                        if($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];
                            $price = $row['price'];
                            $imageData = $row['imageData'];
                        } else {
                            $name = null;
                            $price = null;
                            $imageData = null;
                        }

                        mysqli_close($conn);

                        $total = $total + $price*$qty;


                        echo '<div class="grid_inner">';
                            echo '<div>';
                               echo '<img src="' . $imageData . '">';
                            echo '</div>';

                            echo '<div>';
                                echo    "<p>Name: {$name}</p>";
                                echo    "<p>Unit price: $ {$price}</p>";
                                echo    "<p>Purchase amount: {$qty}</p>";
                            echo '</div>';    
                        echo '</div>';
                    }

                    echo    '<form action="purchase.php" method="post">';
                        echo    '<div class="grid_inner" style=" background: #f1f1f1;">';
                            echo    '<div>';
                            echo        "<p>Total amount: $ {$total}</p>";
                            echo    '</div>';

                            echo    '<div>';
                                echo    '<div><button type="submit" name="purchase-submit">Buy?</button></div>';
                            echo    '</div>';  

                        echo    '</div>';
                    echo    "</form>";
                

                      
                ?>

        </div>
   


