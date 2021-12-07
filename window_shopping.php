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

            $item = array("name"=>$itemname, "price"=>$itemprice, "stock"=>$itemstock, "imageData"=>$imgfullpath);
            array_push($itemarr, $item);
        }
        mysqli_close($conn);
    ?>

        
    <p>Log in to proceed purchase!</p>
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

            .grid_inner p{
                padding: 15px;
                margin: 5px 5px 22px 0;
                background: #f1f1f1;
            }
        </style>
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

                        if($stock <= 0){
                            continue;
                        }

                        echo '<div class="grid_inner">';
                            echo '<div>';
                               echo '<img src="' . $imageData . '">';
                            echo '</div>';

                            echo '<div>';
                                echo  "<p>Name: {$name}</p>";
                                echo  "<p>Price: $ {$price}</p>";
                            echo '</div>';    
                        echo '</div>';
                    }
                ?>

        </div>
   


