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
          <h1 class="display-2">Revenue by genre</h1>
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
                  <th>Genre</th>
                  <th>Movies</th>
                  <th>Tickets Sold</th>
                  <th>Revenue</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle"><?php echo $genre->getName();?></td>
                  <td style="vertical-align: middle"><?php foreach($movieList as $row) { echo $row->getTitle(); echo ", ";}?></td>
                  <td style="vertical-align: middle"><?php echo ""?></td>
                  <td style="vertical-align: middle"><?php echo ""?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>