<body>
    <link rel="stylesheet" href="show_item.css">
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

            $item = array("name"=>$itemname, "price"=>$itemprice, "stock"=>$itemstock, "imageData"=>$imgfullpath);
            array_push($itemarr, $item);
        }
        
    
        mysqli_close($conn);
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

                        echo '<div class="grid_inner">';
                            echo '<div>';
                               echo '<img src="' . $imageData . '">';
                            echo '</div>';

                            echo '<div>';
                                echo  "<p>Name: {$name}</p>";
                                echo  "<p>Stock: {$stock}</p>";
                                echo  "<p>Price: $ {$price}</p>";
                            echo '</div>';    
                        echo '</div>';
                    }
                ?>

        </div>
   


    <?php
        require "footer.php";
    ?>
</body>