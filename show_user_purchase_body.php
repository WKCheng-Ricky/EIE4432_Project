<?php 
    if($_SESSION['shopkeeper'] != 1){
        header("Location: index.php?error=unauthorized+entry");
        exit();
     }

     
?>

<body>
    <?php
        require "dbh.php";

        $sql = "SELECT * FROM sales WHERE userId = ?"; 
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index.php?error=sql1");
            exit();
        }
    
   

        $userId = $_POST['userId'];
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        $salesarr = array();
        while($row = mysqli_fetch_assoc($result)){
            $date = $row['date'];
            $userId = $row['userId'];
            $itemJSON = $row['itemJSON'];
       
            $item = array("date"=>$date, "userId"=>$userId, "itemJSON"=>$itemJSON);
            array_push($salesarr, $item);
        }
     
    ?>


    <style>
        #customers {
        border-collapse: collapse;
        width: 100%;
        text-align: center;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #04AA6D;
        color: white;
        }

        .container{
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;
            place-items: center;
        }
    </style>

    <table id="customers">
        <tr>
            <th>User ID</th>
            <th>Date of purchase</th>
            <th>Purchase Details</th>
        </tr>
        <?php
            foreach($salesarr as $sale){
                $itemarr = $sale['itemJSON'];
                $itemarr = json_decode($itemarr);
                
                echo "<tr>";
                echo    "<td>" . $sale['userId'] . "</td>";
                echo    "<td>" . $sale['date'] . "</td>";
                echo    "<td>";

                $total = 0;

                foreach($itemarr as $item){
                    
                    $itemqty = $item->qty;
                    $itemId = $item->id;

                    $sql = "SELECT name, price FROM item WHERE id= {$itemId}"; 
                    $result = mysqli_query($conn, $sql);
                    if($row = mysqli_fetch_assoc($result)){
                        $itemname = $row['name'];
                        $itemprice = $row['price'];
                    }
                    
                    $total = $total + $itemprice * $itemqty;
                  
                    echo    '<div class="container">';
                    echo        "<div>{$itemname}</div>";
                    echo        "<div>Qty: {$itemqty}</div>";
                    echo    '</div>';

                }
                echo        '<div class="container">';
                echo            "<div></div>";
                echo            "<div>Total price: $ {$total}</div>";
                echo        '</div>';

                echo    "</td>";
                echo "</tr>";
            }

        ?>
       
    </table> 
   


    <?php
        require "footer.php";
    ?>
</body>