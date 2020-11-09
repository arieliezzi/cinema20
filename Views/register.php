<?php
include_once('header.php');
include_once('nav-guest.php');
?>
<div class="py-5 text-center filter-fade-in">
  <div class="container">
    <div class="row">
      <div class="mx-auto col-md-6 col-10 bg-black p-5">
        <div class="card">
          <div class="card-body">
            <h1 class="mb-4">Register</h1>
            <?php if ($message != NULL) { ?>
              <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                <h4 class="alert-heading"><?php echo $message; ?></h4>
              </div>
            <?php } ?>
            <form action="<?php echo FRONT_ROOT ?>Session/register " method="post">
              <div class="form-group"> <input required type="text" class="form-control" placeholder="Name" name="name" id="name"> </div>    
              <div class="form-group"> <input required type="email" class="form-control" placeholder="Email" name="email" id="email"> </div>
              <div class="form-group mb-3"> <input required type="password" class="form-control" placeholder="Password" name="pass" id="password">
              <small>Max 5 characters</small></div>
              <small class="form-text text-muted text-right">
                <a href=<?php echo FRONT_ROOT."Session/index"?>> Don't have an account?</a>
              </small>
              <button type="submit" class="btn btn-primary" name="btnLogin">Sign in</button>
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