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
          <h1 class="display-2">Revenue by cinema</h1>
          <?php if ($message != NULL) { ?>
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading"><?php echo $message; ?></h4>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered ">
              <thead class="thead-dark">
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Capacity</th>
                  <th>Address</th>
                  <th>Sales</th>
                  <th>Revenue</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center; vertical-align: middle">
                      <center> <img src="<?php echo $cinema->getImageUrl(); ?>" alt="Image" height="100" width="100"> </center>
                  </td>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $cinema->getName();?></td>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $cinema->getCapacity();?></td>
                  <td style="vertical-align: middle; text-align: center;"><?php echo $cinema->getAddress();?></td>
                  <td style="vertical-align: middle; text-align: center;"><strong><?php echo $result["quantity"]?></td></strong>
                  <td style="vertical-align: middle; text-align: center;"><strong><?php echo "$".$result["price"]?></td></strong>
                </tr>
              </tbody>
            </table>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <form action="<?php echo FRONT_ROOT . "Ticket/showRevenueView" ?>" method="">
                      <td style="text-align: center; vertical-align: middle"><button type="submit" name="id" class="btn btn-primary"> < Back to revenue querys</button>
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