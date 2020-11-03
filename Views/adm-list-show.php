<!DOCTYPE html>
<?php
include('header.php');
include('nav-guest.php');
?>

<html>

<body>

  <div class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-2">Show List</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php if ($message != NULL) { ?>
            <div class="alert alert-info" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
              <h4 class="alert-heading"><?php echo $message; ?></h4>
            </div>
          <?php } ?>

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th style="text-align: center">#</th>
                  <th>Poster</th>
                  <th>Cinema</th>
                  <th>Room</th>
                  <th>Movie</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th style="text-align: center">-</th>
                  <th style="text-align: center">-</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=1; foreach ($showList as $show) { ?>
                  <tr>
                    <th style="text-align: center; vertical-align: middle"><?php echo ($i); ?></th>
                    <td style="vertical-align: middle"> <center> <img src="<?php echo $show->getMovie()->getImage(); ?>" alt="Poster" height="100" width="67"> </center> </td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $show->getCinema()->getName() ?></td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $show->getRoom()->getName(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $show->getMovie()->getTitle() ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $show->getStartDate(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $show->getTime();?></td>
                    <td style="text-align: center; vertical-align: middle;"><button type="submit" name="id" class="btn btn-primary" value="<?php echo $show->getId(); ?>"> Modify </button></td>
                    <td style="text-align: center; vertical-align: middle;"><button type="submit" name="id" class="btn btn-primary" value="<?php echo $show->getId();  ?>"> Delete </button></td>
                  </tr>
              <?php $i=$i+1; } ?>
                  
         
                <form action="<?php echo FRONT_ROOT . "Show/showAddView" ?>" method="">
                      <td style="text-align: center; vertical-align: middle"><button type="submit" name="id" class="btn btn-primary" value="<?php echo "test" ?>">Add</button>
                </form>
              </tbody>
            </table>
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