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
            <table class="table table-bordered ">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Adress</th>
                  <th>Capacity</th>
                  <th style="text-align: center">-</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th style="vertical-align: middle">1</th>
                  <td style="vertical-align: middle"> <center> <img src="https://media-cdn.tripadvisor.com/media/photo-p/08/e0/88/e4/cine-ambassador.jpg" alt="Malefica Poster" height="300" width="200"> </center> </td>
                  <td style="vertical-align: middle">Ambassador</td>
                  <td style="vertical-align: middle">Corrientes 4580 Mar del Plata Buenos Aires</td>
                  <td style="vertical-align: middle; text-align: center;">500</td>
                  <td style="text-align: center; vertical-align: middle"><button small type="submit" class="btn btn-primary">Eliminar</button></td>
                </tr>
                <tr>
                  <th style="vertical-align: middle">2</th>
                  <td style="vertical-align: middle"> <center> <img src="https://pbs.twimg.com/profile_images/687480484390154241/vg2DOA1D.png" alt="Rey Leon Poster" height="300" width="300"> </center> </td>
                  <td style="vertical-align: middle">El Rey Leon</td>
                  <td style="vertical-align: middle">Un remake del clásico animado de Disney de 1994 'El rey león' que estará dirigido por Jon Favreu. Simba (Donald Glover) es el hijo del rey de los leones, Mufasa, y heredero de todo el reino.</td>
                  <td style="vertical-align: middle; text-align: center;">500</td>
                  <td style="text-align: center; vertical-align: middle"><button small type="submit" class="btn btn-primary">Eliminar</button></td>
                </tr>
                <tr>
                  <th style="vertical-align: middle">3</th>
                  <td style="vertical-align: middle"> <center> <img src="https://image.tmdb.org/t/p/w1280/iKVR1ba3W1wCm9bVCcpnNvxQUWX.jpg" alt="Spiderman Poster" height="300" width="200"> </center> </td>
                  <td style="vertical-align: middle">Spiderman far from home</td>
                  <td style="vertical-align: middle">Peter Parker decide irse junto a Michelle Jones, Ned y el resto de sus amigos a pasar unas vacaciones a Europa después de los eventos ocurridos en Vengadores: EndGame.</td>
                  <td style="vertical-align: middle; text-align: center;">500</td>
                
                  <td style="text-align: center; vertical-align: middle"><button small type="submit" class="btn btn-primary">Eliminar</button></td>
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