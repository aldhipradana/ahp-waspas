
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Aplikasi SPK</title>
  <style>

h2 {
  background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  padding:10px 0px;
}
  </style>
</head>

<body style="background-color:white;">
<?php
  session_start();
  session_destroy();
  session_start();

  if(isset($_POST['button'])){
    $n_criteria = $_POST['n_criteria'];
    if( ($n_criteria > 2) && ($n_criteria < 5) ){
      $_SESSION['n_subject'] = $_POST['n_subject'];
      $_SESSION['n_criteria'] = $_POST['n_criteria'];
      header('Location: namaKriteria.php');
    }
  }
?>
<marquee> <h2>Selamat Datang Di Aplikasi SPK Dengan Metode AHP-WASPAS</h2></marquee>
<img src="img.gif" style="display:block;margin:0px auto 20px !important;">
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