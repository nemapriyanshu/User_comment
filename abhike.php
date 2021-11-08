<?php
include("connection.php");
session_start();

if(empty( $_SESSION['email']))
{
    header("location:login.php");
}

$email = $_SESSION['email'];
$idd = $_SESSION['user_id'];
// echo $idd;
// $pp = mysqli_query($conn, "select * from post where user_id=$idd");



if (isset($_POST['addpost'])) {
    $title = $_POST['title'];
    $des = $_POST['description'];
    $tmp = $_FILES['image']['tmp_name'];
    $fname = $_FILES['image']['name'];
    $desp = "IMAGE/";
    move_uploaded_file($tmp, $desp . $fname);
    $img1 = "IMAGE/$fname";
    $pp = mysqli_query($conn, "insert into post (title,description,image,user_id) values('$title','$des','$img1',$idd) ");

    header("location:dashboard.php");
}
$coment_id = '';


if (isset($_POST['Comment'])) {
    $comt = $_POST['datacomment'];
    $coment_id = $_POST['idcomment'];
    // echo $comt . $coment_id;
    mysqli_query($conn, "insert into post_comment (comments,post_id) values('$comt','$coment_id')");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

    <style>
        .m-10 {
            margin: 50px 0px 0px 100px;
        }

        .text-col1 {
            color: #FFA600;
        }

        .btn-col3 {
            background-color: #FFED14;
        }
    </style>
</head>

<body>
<?php include("dashnav.php") ?>

   

    <div class="m-10  row text-center">
        <!-- 1st -->
        <?php
        $pp = mysqli_query($conn, "select * from post where user_id=$idd");
        while ($arr = mysqli_fetch_assoc($pp)) 
        { ?>


<div class="card m-5 " style="width: 18rem;">
    <img class="card-img-top" src="<?= $arr['image'] ?>" alt="Card image cap" width="200px" height="200px">

    <div class="card-body">
        <h5 class="card-title"><?= $arr['title'] ?></h5>
        <p class="card-text"><?= $arr['description'] ?></p>
    

        <a href="delete.php?delid=<?=$arr['id']?>" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#COmment<?php echo $arr['id'];?>"> Comment </button>

    </div>
</div>


<!-- ------------------------------------COMMENT MODALLLLL---------------------------------------- -->


<div class="modal fade" id="COmment<?php echo $arr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="commentlevel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center m-auto">
                    <h5 class="modal-title h2  text-col1" id="commentlevel">

                        ADD Comment <i class="bi bi-send-plus  m-2"></i></h5>
                </div>

                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
        
                <div class="h6 row border">
<?php
        $id3=$arr['id'];
        $ppp=mysqli_query($conn,"select * from post_comment where post_id=$id3");
        while($kkk=mysqli_fetch_assoc($ppp))
        {
?>

            <span class=" h3 col-1 mt-2">
       
            <?php if($_SESSION['email']) {?>
                <a href="deletecomment.php?del=<?php echo $kkk['id'];?>"> 
                <i class="bi bi-x-square btn-danger btn"></i>
               
                 </a>
               <?php } ?>
            
             </span>
            <p class="h3 col-11"><?=$kkk['comments']?></p>
        
            <?php }  ?>
        </div>
                <form method="post">
                    <input type="text" placeholder="Comment Here" name="datacomment" class="form-control">
                    <input type="hidden" name="idcomment" value="<?=$arr['id']?>" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="Comment" name="Comment" class="btn btn-col3">
            </div>
            </form>
        </div>
    </div>
</div>







        <?php } ?>

















        <!-- ADD POST CODING -->



        <!-- Modal -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center text-warning m-auto">
                            <h3 class="modal-title" id="exampleModalLabel">ADD POST</h3>
                        </div>
                        <button type="button" class="close btn-lg btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="container">
                                <input type="text" class="form-control mb-3" name="title" placeholder="TITLE">
                                <input type="text" class="form-control mb-3" name="description" placeholder="Description">
                                <div class="row">
                                    <div class="col h3">Choose Image</div>
                                    <input type="file" class="form-control col mb-3" name="image">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                <input type="submit" value="POST" name="addpost" class="btn btn-primary">
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </form>





</body>

</html>