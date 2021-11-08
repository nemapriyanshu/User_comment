<?php
include("connection.php");

$iddd= $_GET['delid'];

   mysqli_query($conn,"delete from post where id=$iddd");
    
        header("location:dashboard.php");

    
?>