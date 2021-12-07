<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->



    <body>
    <!-- <link rel="stylesheet" href="show_item.css"> -->
    <?php
        require "dbh.php";

        $sql = "SELECT * FROM item"; 
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            header("Location: index.php?error=user_not_exist");
            exit();
        } 

   
        $itemarr = array();
        while($row = mysqli_fetch_assoc($result)){
            $itemname = $row['name'];
            $itemprice = $row['price'];
            $itemstock = $row['stock'];
            $imgfullpath = $row['imageData'];
            $itemId = $row['id'];

            $item = array("id"=>$itemId, "name"=>$itemname, "price"=>$itemprice, "stock"=>$itemstock, "imageData"=>$imgfullpath);
            array_push($itemarr, $item);
        }
        mysqli_close($conn);
    ?>

        <style>
            .grid{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
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


            .grid_inner_er {
                display: grid;
                grid-template-columns: 1fr 1fr;
                /* grid-template-rows: 300px 300px; */
                place-items: center;
            }

            .grid_inner_er button {
                background-color: #04AA6D;
                color: white;
                border-radius: 8px;
                padding: 15px;
                margin: 5px 5px 22px 0;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            .grid_inner_er input[type=number]{
                padding: 15px;
                margin: 5px 5px 22px 0;
                background: #f1f1f1;
                display: inline-block;
                border: none;
            }


            .grid_inner p{
                padding: 15px;
                margin: 5px 5px 22px 0;
                background: #f1f1f1;
            }
        </style>

        <?php
        if(isset($_GET['shoppingcart'])){
            echo '<p style="color:green;">Shopping cart has been updated!</p>';
        }
        ?>
        <div class="grid">
                <?php 
                    if(empty($itemarr) ){
                        exit();
                    }
                    
                    // echo "size of array: " . sizeof($itemarr) . "<br>";
                    foreach ($itemarr as $item) {
                        
                        $name = $item['name'];
                        $stock = $item['stock'];
                        $price = $item['price'];
                        $imageData = $item['imageData'];

                        $id = $item['id'];

                        if($stock <= 0){
                            continue;
                        }

                        echo '<div class="grid_inner">';
                            echo '<div>';
                               echo '<img src="' . $imageData . '">';
                            echo '</div>';

                            echo '<div>';
                                echo    "<p>Name: {$name}</p>";
                                echo    "<p>In Stock: {$stock}</p>";
                                echo    "<p>Price: {$price}</p>";

                                echo    '<form action="add_to_shopping_cart.php" method="post">';
                                    echo    '<div class="grid_inner_er">';
                                        echo    '<input type="text" name="id" value="'.$id.'" hidden/>';
                                        echo    '<div><input type="number" name="qty" placeholder="Qty." min="0" max="'.$stock.'"/></div>';
                                        echo    '<div><button type="submit" name="add-shoppingcart-submit" placeholder="The quantity you want.">Buy</button></div>';
                                    echo    '</div>';
                                echo    "</form>";
                            echo '</div>';    
                        echo '</div>';
                    }
                ?>

        </div>
   


