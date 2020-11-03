<?php 
 include('header.php');
 include('nav-guest.php');
?>

<div class="py-5 text-center" style="background-image: url('default/images/background.jpg');background-size:cover;">
  <div class="container">
    <div class="row">
      <div class="mx-auto col-md-6 col-10 bg-white p-5">
        <h1 class="mb-4">Modify Show<br></h1>
          <div class="card">
            <div class="card-body">
              <form action="<?php echo FRONT_ROOT ?>Show/update" method="post">
                <div class="form-group"> <input type="hidden" class="form-control" placeholder="id" name="idShow" value="<?php echo $show->getId(); ?>" id="idShow"> </div>
                <div class="form-group"> <input type="text" class="form-control" placeholder="Cinema" value="<?php echo $show->getCinema()->getName(); ?>" readonly> </div>
                <div class="form-group"> <input type="text" class="form-control" placeholder="Room" value="<?php echo $show->getRoom()->getName(); ?>" readonly>  </div>
                <div class="form-group"> <input type="text" class="form-control" placeholder="Movie" value="<?php echo $show->getMovie()->getTitle(); ?>" readonly> </div>
                
                <div class="form-group"> Insert a start date <input required type="date" class="form-control" placeholder="" name="startDate"  value="<?php echo $show->getStartDate() ?>" id="startDate">  </div>
                <div class="form-group"> Insert a end date <input required type="date" class="form-control" placeholder="" name="endDate" value="<?php echo $show->getEndDate() ?>" id="endDate"> </div>
                <div class="form-group"> Insert time (24hs system)<input required type="time" class="form-control" placeholder="" name="time"  value="<?php echo $show->getTime() ?>" id="time"> </div>
                <div class="form-group"> Insert movie duration (minutes) <input required type="number" class="form-control" placeholder="" name="duration"  value="<?php echo $show->getDuration() ?>" id="duration"> </div>
            
                <button type="submit" class="btn btn-success">Modify show<br></button>
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