<?php

include("connection.php");
echo "   deletecomment.php";

$idd = $_GET['del'];
$sql="delete from post_comment where id=$idd";

mysqli_query($conn,$sql);

header(("location:dashboard.php"))

?>