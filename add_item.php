<!--	Author: Cheng Wai Kiu
		Purpose: Project
-->

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php
        require "header.php";
        require "isAdmin.php";
    ?>
 <link rel="stylesheet" href="add_item.css">
    <h1>Add Item</h1>
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
    </style> -->
    
    <div>

            <?php
              if(isset($_GET['error'])){
                  switch($_GET['error']){      
                      case "itemExist":
                          echo '<p style="color: red;font-size: large;">item exist!</p>';
                          break;
                }
              }

              if(isset($_GET['add_item'])){
                      echo '<p style="color: green;font-size: large;">Item added!</p>';
              }
            ?>

        <div>
            <form  action="add_item_logic.php" method="post" enctype="multipart/form-data">

                <div style="padding=5px">
                    <div class="item">
                        <label for="iname"><b>Item name</b></label>
                        <input type="text" placeholder="Enter item name" name="iname"  required>

                       
                        <div>
                            <label for="iprice"><b>Item Price</b></label>
                            <input type="number" step="0.01" name="iprice" min="0" required>     

                            <label for="istock"><b>Item Stock</b></label>
                            <input type="number"  name="istock" min="0" required>
                        </div>

                        <div>
                            <label for="img"><b>Select image:</b></label>
                            <input type="file" id="img" name="img">
                        </div>

                        <button class="item_btn" type="submit" name="add-item-submit">Add Item</button>
                    </div>


                    <div style="background-color:#f1f1f1;">
                        <input type="button" class="cancel_btn" value="Cancel" onclick="history.back()">
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