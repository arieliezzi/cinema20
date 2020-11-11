<?php
  if(!isset($_SESSION["loggedUser"])) 
  {
?>
    <!-- Inicio del nav del invitado -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container"> 
        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar12"> 
          <a class="navbar-brand d-none d-md-block" href="<?php echo FRONT_ROOT ?>Session/index">
            <i class="fa d-inline fa-lg fa-circle"></i>
            <b>MoviePass</b>
          </a>
          <ul class="navbar-nav mx-auto">
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link text-primary" href="<?php echo FRONT_ROOT ?>Session/showRegisterView">Sign in</a> </li>
            <li class="nav-item"> <a class="btn navbar-btn ml-2 btn-primary" href="<?php echo FRONT_ROOT ?>Session/Index"> Log in</a>  </li> 
          </ul>
        </div>
      </div>
    </nav>
    <!-- Fin del nav del invitado -->

<?php
  } else 
    { 
      if ($_SESSION["loggedUser"] == 1) 
      {
?>

    <!-- Inicio del nav del administrador -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container"> 
        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar12"> 
          <a class="navbar-brand d-none d-md-block" href="<?php echo FRONT_ROOT ?>Home/index">
            <i class="fa d-inline fa-lg fa-circle"></i>
            <b><?php echo $_SESSION["userName"]?></b>
          </a>
          <ul class="navbar-nav mx-auto">
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link text-primary" href="<?php echo FRONT_ROOT ?>Show/showUserListView">User Screening</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/showListView">Cinemas</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Api/showListView">API Movies</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/showListView">Internal Movies</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/showListView">Shows</a> </li> 
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Revenue/showRevenueView">Revenues</a> </li> 
            <li class="nav-item"> <a class="btn navbar-btn ml-2 btn-primary" href="<?php echo FRONT_ROOT ?>Session/logout"> Log out</a>  </li> 
          </ul>
        </div>
      </div>
    </nav>
    <!-- Fin del nav del administrador -->

    <?php
        } else { 
    ?>

    <!-- Inicio del nav del usuario -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
      <div class="container"> 
        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar12">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar12"> 
          <a class="navbar-brand d-none d-md-block" href="<?php echo FRONT_ROOT ?>Show/showUserListView">
            <i class="fa d-inline fa-lg fa-circle"></i>
            <b><?php echo $_SESSION["userName"]?></b>
          </a>
          <ul class="navbar-nav mx-auto">
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/showUserListView">Shows</a> </li> 
            <li class="nav-item"> <a class="btn navbar-btn ml-2 btn-secondary" href="<?php echo FRONT_ROOT ?>Session/logout"> Log out</a>  </li> 
          </ul>
        </div>
      </div>
    </nav>
    <!-- Fin del nav del usuario -->

<?php
             }
  }
?>
