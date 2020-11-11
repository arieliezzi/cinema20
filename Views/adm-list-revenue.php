<?php 
 include("validate-session.php");
 include('header.php');
 include('nav-guest.php');
?>

<div class="py-5 text-center" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 pb-4">
        <h1 class="display-2">Revenue Querys</h1>
          <?php if ($message != NULL) { ?>
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading"><?php echo $message; ?></h4>
          </div>
          <?php } ?>
        </div>
        
      <div class="mx-auto col-md-3 col-10 bg-white">
        <div class="card">
          <div class="card-body">
            <h1 class="mb-4">By Cinema<br></h1>
            <form action="<?php echo FRONT_ROOT ?>Ticket/showRevenueByCinema" method="post">
              <select class="form-control" id="idCinema" name="cinemas">
                <?php foreach ($cinemaList as $cinema) { ?>
                    <option value="<?php echo $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                <?php } ?>
              </select>    
              <br>    
              <button type="submit" class="btn btn-success">Next ><br></button>
            </form>
          </div>
        </div>
      </div>

      <div class="mx-auto col-md-3 col-10 bg-white">
        <div class="card">
          <div class="card-body">
            <h1 class="mb-4">By Movie<br></h1>
            <form action="<?php echo FRONT_ROOT ?>Ticket/showRevenueByMovie" method="">
              <select class="form-control" id="idMovie" name="cinemas">
                <?php foreach ($movieList as $movie) { ?>
                  <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                <?php } ?>
              </select>
              <br>
              <button type="submit" class="btn btn-success">Next ><br></button>
            </form>
          </div>
        </div>
      </div>

      <div class="mx-auto col-md-3 col-10 bg-white">
        <div class="card">
          <div class="card-body">
            <h1 class="mb-4">By Genre<br></h1>
            <form action="<?php echo FRONT_ROOT ?>Ticket/showRevenueByGenre" method="post">
              <select class="form-control" id="idGenre" name="cinemas">
                <?php foreach ($genreList as $genre) { ?>
                  <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName(); ?></option>
                <?php } ?>
              </select>
              <br>
              <button type="submit" class="btn btn-success">Next ><br></button>
            </form>
          </div>
        </div>
      </div>

      <div class="mx-auto col-md-3 col-10 bg-white">
        <div class="card">
          <div class="card-body">
            <h1 class="mb-4">By Date<br></h1>
            <form action="<?php echo FRONT_ROOT ?>Ticket/showRevenueByDate" method="post">
                <div class="form-group"> <input required  type="date" class="form-control" placeholder="" name="startDate" id="startDate"> (start date) </div>
                <div class="form-group"> <input required type="date" class="form-control" placeholder="" name="endDate" id="endDate"> (end date) </div>
                <button type="submit" class="btn btn-success">Next ><br></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>