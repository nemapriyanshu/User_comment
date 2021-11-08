<?php
include("connection.php");
$error='';
    if(isset($_POST['LOGIN']))
    {
        
        $email=$_POST['email'];
        $pass=$_POST['password'];
        if(!empty($pass) && !empty($email) )
        {
            $pp=mysqli_query($conn,"select * from user_data where email='$email'");
            $arr=mysqli_fetch_assoc($pp);
            if(isset($arr['email']))
            {
                if($arr['password']==$pass)
                {
                    session_start();
                    $_SESSION['email']=$email;
                    $_SESSION['user_id']=$arr['id'];
                    header("location:dashboard.php");
                }
                else
                {
                    $error="password Not Matched";
                }
            }
            else
            {
                $error="User Not Register";
            }
        }
        else
        {
            $error="Fill Are Fields";
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
    <div class="h1">Login</div>
    <?php
    if(!empty($error)){
    ?>
    <div class="alert alert-danger"><?=$error?></div>
    <?php } ?>
    <form  method="post">
        <input type="text" class="mb-2 form-control" Name="email" placeholder="Email">
        <input type="text" class="mb-2 form-control" Name="password" placeholder="Password">
        <input type="submit" value="Login" name="LOGIN" class="btn btn-warning">
        <a href="register.php" class="btn btn-primary">Register</a>
    </form>
</div>


</body>
</html>