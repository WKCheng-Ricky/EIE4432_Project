<?php
if($stmt != null ){
    mysqli_stmt_close($stmt);
}
if($conn != null){
    mysqli_close($conn);
}
