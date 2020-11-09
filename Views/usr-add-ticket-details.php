<?php
include("validate-session.php");
include('header.php');
include('nav-guest.php');
?>

<div class="py-5" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <?php if ($message != NULL) { ?>
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading"><?php echo $message; ?></h4>
          </div>
        <?php } ?>
      </div>

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 mb-5">
        <div class="card">
          <div class="card-body">
            <img class="card-img-top" src="<?php echo $show->GetMovie()->getImage(); ?>" alt="Card image cap">
          </div>
        </div>
      </div>
      <!-- Final de la tarjeta -->

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 mb-5">
        <div class="card">
          <div class="card-body text-center">
            <h1 class="mb-4">Your Tickets</h1>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"> <img class="card-img-top" src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=<?php echo $ticket->getQrInfo(); ?>" alt="Card image cap"> </li>
            </ul>
            <br>
            <a href="<?php echo FRONT_ROOT ?>Show/showUserListView">
              <button href="<?php echo FRONT_ROOT ?>Show/showUserListView" class="btn btn-primary">Save QR code</button>
            </a>
          </div>
        </div>
      </div>
      <!-- Final de la tarjeta -->

      <!-- Comienzo de tarjeta -->
      <div class="col-md-4 col-10 bg-white">
        <div class="card">
          <div class="card-body text-center">
            <h1 class="mb-4">Tickets Details<br></h1>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Tickets:</strong> <?php $ticket->getQuantity(); ?> </li>
              <li class="list-group-item"><strong>Date:</strong> <?php $ticket->getDate(); ?> </li>
              <li class="list-group-item"><strong>Price: </strong> <?php echo "$" . $ticket->getShow()->getRoom()->getPrice() ?> </li>
              <li class="list-group-item"><strong>Grand Total:</strong> <?php echo "$" . ($ticket->getQuantity() * $ticket->getShow()->getRoom()->getPrice()) ?> </li>
              <li class="list-group-item"><strong>Cinema:</strong> <?php echo $ticket->getShow()->getCinema()->getName() ?> </li>
              <li class="list-group-item"><strong>Room:</strong> <?php echo $ticket->getShow()->getRoom()->getName(); ?> </li>
              <li class="list-group-item"><strong>Hour:</strong> <?php echo $ticket->getShow()->getTime(); ?> </li>
            </ul>
            <br>
            <a href="<?php echo FRONT_ROOT ?>Show/showUserListView">
              <button class="btn btn-primary">< Back to home</button>
            </a> 
          </div>
        </div> 
      </div>
      <!-- Final de la tarjeta -->

    </div> 
  </div> 
</div> 
   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>