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
          <h1 class="display-2">Room List</h1>
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
                  <th>Name</th>
                  <th>Capacity</th>
                  <th>Price</th>
                  <th style="text-align: center">-</th>
                  <th style="text-align: center">-</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($roomList as $room) { ?>
                  <tr>
                    <th style="text-align: center; vertical-align: middle"><?php echo $room->getId(); ?></th>
                    <td style="text-align: center; vertical-align: middle"><?php echo $room->getName(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $room->getCapacity(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $room->getPrice(); ?></td>
                    
                    <form action="<?php echo FRONT_ROOT . "Room/showModifyView" ?>" method="">
                      <input type="hidden" class="form-control" name="idCinema" id="idCinema" value="<?php echo $idCinema ?>">
                      <input type="hidden" class="form-control" name="idRoom" id="idRoom" value="<?php echo $room->getId(); ?>">
                      <td style="text-align: center; vertical-align: middle"><button type="submit" class="btn btn-primary"> Modify </button>
                    </form>

                    <form action="<?php echo FRONT_ROOT . "Room/remove" ?>" method="">
                      <input type="hidden" class="form-control" name="idCinema" id="idCinema" value="<?php echo $idCinema ?>">
                      <input type="hidden" class="form-control" name="idRoom" id="idRoom" value="<?php echo $room->getId(); ?>">
                      <td style="text-align: center; vertical-align: middle"><button type="submit" class="btn btn-primary"> Remove </button>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <form action="<?php echo FRONT_ROOT . "Room/showAddView" ?>" method="">
                    <td style="text-align: center; vertical-align: middle"><button type="submit" name="id" class="btn btn-primary" value="<?php echo $idCinema ?>">Add new Room</button>
                  </form>
                </tr>
              </thead>
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