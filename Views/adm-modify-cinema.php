<?php 
 include("validate-session.php");
 include('header.php');
 include('nav-guest.php');
?>

<div class="py-5 text-center" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">
      <div class="mx-auto col-md-6 col-10 bg-white p-5">
        <h1 class="mb-4">Modify Cinema<br></h1>
          <div class="card">
            <div class="card-body">
              <form action="<?php echo FRONT_ROOT ?>Cinema/update" method="post">
                <div class="form-group"> <input required type="text" class="form-control" placeholder="ID" name="id" value="<?php echo $cinema->getId(); ?>" id="id" readonly> </div>
                <div class="form-group"> <input required type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $cinema->getName(); ?>" id="name"> </div>
                <div class="form-group"> <input required type="text" class="form-control" placeholder="Adress" name="adress" value="<?php echo $cinema->getAddress(); ?>" id="adress"> </div>
                <div class="form-group"> <input hidden type="number" class="form-control" placeholder="Capacity" name="capacity" value="<?php echo $cinema->getCapacity(); ?>"id="capacity"> </div>
                <div class="form-group"> <input required type="text" class="form-control" placeholder="Image URL" name="imageUrl" value="<?php echo $cinema->getImageUrl(); ?>" id="imageUrl"> </div>
                <button type="submit" class="btn btn-success">Modify cinema<br></button>
              </form>
            </div>
          </div> <br>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>