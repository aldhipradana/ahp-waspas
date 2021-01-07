<?php
  session_start();
  session_destroy();
  session_start();

  if(isset($_POST['button'])){
    $_SESSION['n_criteria'] = $_POST['n_criteria'];
    $_SESSION['n_subject'] = $_POST['n_subject'];
    
    header('Location: namaKriteria.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Aplikasi SPK</title>
</head>

<body style="background-color:white;">
  <div class="container register">
    <div class="row justify-content-center register-form">
      <div class="col-md-12">
        <form method="POST" target="_self">
          <h3 class="text">AHP - WASPAS</h3>
          <div class="form-group">
            <label class="text">Masukkan jumlah kriteria</label>
            <input type="number" class="form-control" name="n_criteria" required>
          </div>
          <div class="form-group">
            <label class="text">Masukkan jumlah subjek</label>
            <input type="number" class="form-control" name="n_subject" required>
          </div>
          <button type="submit" name="button" class="btnNext">NEXT</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>