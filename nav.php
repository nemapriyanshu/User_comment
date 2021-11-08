<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
      <span class="h3" style="color:#1398C6; margin-left: 50px;">Priyanshu </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav m-auto" >

    <li class="nav-item h4 px-2">
        <a class="nav-link" href="#" style="color:#0729E9; margin-left: 700px;" >Home</a>
      </li>

<?php session_start(); 
  if(empty($_SESSION['email'])){
?>
  
      <li class="nav-item h4  px-2"  >
        <a class="nav-link" href="login.php" style="color:#0729E9">Login</a>
      </li>

      <?php } ?>
  
      <li class="nav-item h4  px-2">
        <a class="nav-link" href="dashboard.php" style="color:#0729E9">Dashboard</a>
      </li>

  
      
    </ul>
  </div>
</nav>