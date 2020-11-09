<?php 
 include("validate-session.php");
 include('header.php');
 include('nav-guest.php');
?>
<div class="pt-5 pb-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if ($message != NULL) { ?>
              <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                <h4 class="alert-heading"><?php echo $message; ?></h4>
              </div>
        <?php } ?>
        <h1 class="display-2">Movies in theaters now<br></h1>
        <h5 class="">Sort by</h5>
        <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Date</button>
          <div class="dropdown-menu"> 
          <a class="dropdown-item" href="">Newest</a>
          <a class="dropdown-item" href="">Oldest<br></a>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Genre</button>
          <div class="dropdown-menu"> 
            <a class="dropdown-item" href="">Genre<br></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="py-5">
  <div class="container">
    <div class="row">
    <?php foreach($showList as $show) { ?> 
    <!-- Comienzo de tarjeta -->
      <div class="col-md-4 mb-5">
        <div class="card">
          <img class="card-img-top" src="<?php echo $show->GetMovie()->getImage(); ?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo substr($show->getMovie()->getTitle(),0,30) ?></h5>
            <p class="card-text"><?php echo substr($show->getMovie()->getDescription(),0,200)."...";?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Cinema: <?php echo $show->getCinema()->getName(); ?> </li>
            <li class="list-group-item">Room: <?php echo $show->getRoom()->getName(); ?> </li>
            <li class="list-group-item">Hour: <?php echo $show->getTime()?> </li>
            <li class="list-group-item">Duration: <?php echo $show->getDuration()." min"?> </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Genre: <?php// echo $show->getMovie()->genresToString(); ?> </li>
          </ul>
          <div class="card-body mx-auto">
            <form action="<?php echo FRONT_ROOT . "ticket/showAddView" ?>" method="">
              <td style="text-align: center; vertical-align: middle"><button type="submit" name="idShow" class="btn btn-dark" value="<?php echo $show->getId() ?>"> Buy Tickets! </button>
            </form>
          </div>
        </div>
      </div>
    <!-- Final de la tarjeta -->
    <?php } ?> 
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>