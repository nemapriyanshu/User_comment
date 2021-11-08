<?php
include("connection.php");
$error='';
    if(isset($_POST['REGIS']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        if(!empty($name) && !empty($email)  && !empty($pass))
        {
            if(mysqli_query($conn,"insert into user_data (name,email,password) values('$name','$email','$pass')"))
            {
                header("location:login.php");
            }
            else
            {
                $error="User Already Register";
            }
        }
        else
        {
            $error="All Fields Are required";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    
<div class="container col-6 mt-5" >
    <div class="h1 text-center mb-5">Registration</div>
    <?php
    if(!empty($error)){
    ?>
    <div class="alert alert-danger"><?=$error?></div>
    <?php } ?>
    <form  method="post">
        <input type="text" class="mb-2 form-control" Name="name" placeholder="Name">
        <input type="text" class="mb-2 form-control" Name="email" placeholder="Email">
        <input type="text" class="mb-2 form-control" Name="password" placeholder="Password">
        <input type="submit" value="Register" name="REGIS" class="btn btn-warning">
        <a href="login.php" class="btn btn-primary">Login</a>
    </form>
</div>


</body>
</html>