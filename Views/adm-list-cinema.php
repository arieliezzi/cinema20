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
          <h1 class="display-2">Cinemas list</h1>
        </div>
      </div>
    </div>
  </div>
<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
          <form action="<?php echo FRONT_ROOT."Cinema/remove" ?>" method="post">
            <table class="table table-bordered ">
              <thead class="thead-dark">
                <tr>
                  <th style="text-align: center">#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Adress</th>
                  <th>Capacity</th>
                  <th style="text-align: center">-</th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach($cinemaList as $cinema) { ?>
                <tr>
                  <th style="text-align: center; vertical-align: middle"><?php echo $cinema->getId(); ?></th>
                  <td style="text-align: center; vertical-align: middle"> <center> <img src="<?php echo $cinema->getImageUrl(); ?>" alt="Image" height="300" width="200"> </center> </td>
                  <td style="text-align: center; vertical-align: middle"><?php echo $cinema->getName(); ?></td>
                  <td style="text-align: center; vertical-align: middle"><?php echo $cinema->getAddress(); ?></td>
                  <td style="text-align: center; vertical-align: middle;"><?php echo $cinema->getCapacity(); ?></td>
                  <td style="text-align: center; vertical-align: middle"><button type="submit" name="id" class="btn btn-primary" value="<?php echo $cinema->getId()?>"> Remove </button>
                </tr>
              <?php } ?>
              </tbody>
            </table> </form>
          </div>
        </div>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>