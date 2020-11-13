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
          <h1 class="display-2">My tickets</h1>
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
              <thead class="thead-light">
                <tr>
                  <th style="text-align: center">#</th>
                  <th>QR</th>
                  <th>Movie</th>
                  <th>Cinema</th>
                  <th>Room</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php $j=1; foreach ($ticketList as $unitaryTicket) {  ?>
                  <tr>
                    <th style="text-align: center; vertical-align: middle"><?php echo $j++; ?></th>
                    <td style="text-align: center; vertical-align: middle">
                      <center> <img class="card-img-top" src="https://chart.googleapis.com/chart?chs=50x50&cht=qr&chl=<?php echo $unitaryTicket->getQrInfo(); ?>" alt="Card image cap"> </center>
                    </td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $unitaryTicket->getShow()->GetMovie()->getTitle(); ?></td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $unitaryTicket->getShow()->getCinema()->getName(); ?></td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $unitaryTicket->getShow()->getRoom()->getName(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $unitaryTicket->getDate(); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo date('H:m', strtotime($unitaryTicket->getShow()->getStartTime())); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo "$".$unitaryTicket->getPrice(); ?></td>
                  </tr>
                <?php } ?>
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