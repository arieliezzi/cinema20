<!DOCTYPE html>
<?php
include("validate-session.php");
include('header.php');
include('nav-guest.php');
?>
<html>

<body>
  <div class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-2">Revenue Querys</h1>
          
          <h1 class="display-5">- Revenue by cinema</h1>
          <div class="col-md">
            <form action="<?php echo FRONT_ROOT ?>Ticket/revenueByCinema" method="post">
              <div class="form-group col-md-6">
                <select class="form-control" id="idCinema" name="cinemas">
                  <?php foreach ($cinemaList as $cinema) { ?>
                    <option value="<?php echo $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Next ><br></button>
              </div>
            </form>
          </div>

          <h1 class="display-5">- Revenue by movie</h1>
          <div class="col-md">
            <form action="<?php echo FRONT_ROOT ?>Ticket/revenueByMovie" method="post">
              <div class="form-group col-md-6">
                <select class="form-control" id="idMovie" name="cinemas">
                  <?php foreach ($movieList as $movie) { ?>
                    <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Next ><br></button>
              </div>
            </form>
          </div>

          <h1 class="display-5">- Revenue by genre</h1>
          <div class="col-md">
            <form action="<?php echo FRONT_ROOT ?>Ticket/revenueByGenre" method="post">
              <div class="form-group col-md-6">
                <select class="form-control" id="idGenre" name="cinemas">
                  <?php foreach ($genreList as $genre) { ?>
                    <option value="<?php echo $genre->getId(); ?>"><?php echo $genre->getName(); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Next ><br></button>
              </div>
            </form>
          </div>

          <h1 class="display-5">- Revenue between dates</h1>
          <div class="col-md">
            <form action="<?php echo FRONT_ROOT ?>Ticke/revenueByDates" method="post">
              <div class="form-group col-md-2">
                <div class="form-group"> Insert a start date <input required  type="date" class="form-control" placeholder="" name="startDate" id="startDate">  </div>
                <div class="form-group"> Insert a end date <input required type="date" class="form-control" placeholder="" name="endDate" id="endDate"> </div>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Next ><br></button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>