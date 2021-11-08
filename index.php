<?php
    include("connection.php");


    
if (isset($_POST['Comment'])) {
    $comt = $_POST['datacomment'];
    $coment_id = $_POST['idcomment'];
    // echo $comt . $coment_id;
    mysqli_query($conn, "insert into post_comment (comments,post_id) values('$comt','$coment_id')");
    header("location:index.php")  ;  

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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <link rel="stylesheet" href="style.css">
    <style>
        .m-10 {
            margin: 0px 0px 0px 100px;
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
    <?php include("nav.php"); ?>

    <div class="m-10  row text-center">
        <!-- 1st -->
        <?php
        $pp = mysqli_query($conn, "select * from post");
        while ($arr = mysqli_fetch_assoc($pp)) { ?>

<?php
        $nid=$arr['user_id'] ;
         $temp=mysqli_query($conn,"select name from user_data where id=$nid") ;
         $pk1=mysqli_fetch_assoc($temp);
         ?>
        



<div class=" col-6 mb-5">

<div class="container2    p-1">
    <img src="<?= $arr['image'] ?>" alt="Avatar" class="image">
    <div class="overlay">
    <div class="container">
           
         </div>
        <div class="h2 text-center" style="color:#C6FC8D"><?= $arr['title'] ?></div>
        <div class="text">
            <p class="contain2 mt-5">
            <?= $arr['description'] ?>
       
       </p>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#COmment<?php echo $arr['id'];?>"> Comment </button>

            <div class="mt-5" style="color:antiquewhite ; font-size:20px;">  Posted by :-          <?= $pk1['name']; ?> </div>
        </div>


    </div>
</div>
</div>


           


            <!-- ------------------------------------COMMENT ODALLLLL---------------------------------------- -->


            <div class="modal fade" id="COmment<?php echo $arr['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="commentlevel" aria-hidden="true">
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

                            <div class="h6">
                                <?php
                                $id3 = $arr['id'];
                                // echo $id3;
                                $ppp = mysqli_query($conn, "select * from post_comment where post_id=$id3");
                                while ($kkk = mysqli_fetch_assoc($ppp)) {
                                ?>

                                   <span class="border-primary border row">
                                   <span class="h1 m-auto col-1">
                                        <!-- <i class="bi bi-arrow-right-short"></i> -->
                                        <i class="far fa-hand-point-right"></i>
                                    </span>
                                    <p class="h4  col-11"><?= $kkk['comments'] ?></p>
                                  
                                   </span>
                                <?php }  ?>
                            </div>
                            <form method="post">
                                <input type="text" placeholder="Comment Here" name="datacomment" class="form-control">
                                <input type="hidden" name="idcomment" value="<?= $arr['id'] ?>">
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








</body>

</html>