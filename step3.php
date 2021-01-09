<?php
  session_start();

  if(!isset($_SESSION['subject'])){
    header('Location: step2.php');
  }

  // Inisialisasi
  $n_criteria = $_SESSION['n_criteria'];
  $n_subject = $_SESSION['n_subject'];
  $criteria = $_SESSION['criteria'];
  $weight = $_SESSION['weight'];
  $subject = $_SESSION['subject'];
  $value = $_SESSION['value'];
  $limit = array();
  $Q = array();

  // Normalisasi matriks
  // a.) Mencari nilai minimal atau maksimal sesuai tipe 
  for($i=0; $i<$n_criteria; $i++){
    $max = $value[$i];
      
    for($j=0; $j<$n_subject * $n_criteria; $j+=$n_criteria){
      $index = $j + $i;
      if($max < $value[$index]){
        $max = $value[$index];
      }
    }

    $limit[$i] = $max;
  }

  // b.) Menghitung normalisasi
  for($i=0; $i<$n_criteria; $i++){
    for($j=0; $j<$n_subject * $n_criteria; $j+=$n_criteria){
      $index = $j + $i;
      $value[$index] = $value[$index] / $limit[$i];
    }
  }

  // c.) Menghitung Qi
  for($i=0; $i<$n_subject; $i++){
    // step 1
    $row = 0;
    for($j=0; $j<$n_criteria; $j++){
      $index = $j + ($i * $n_criteria);
      $col = $value[$index] * $weight[$j+1] / 100;
      $row += $col;
     
    }

    $Q[$i] = 0.5 * $row;

    // step 2
    $row = 1;
    for($j=0; $j<$n_criteria; $j++){
      $index = $j + ($i * $n_criteria);
      $col = pow($value[$index], ($weight[$j+1] / 100));
      $row *= $col;
    }
    $Q[$i] = 0.5 * $row + $Q[$i];
  }

  // d.) Mengurutkan berdasarkan nilai terbesar
  for($i=0; $i<$n_subject; $i++){
    $Q[$i] = array($Q[$i], $subject[$i]);
  }

  sort($Q);
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
          <table class="table text">
            <tr style="text-align:center;">
              <th>Subjek</th>
              <th>Nilai</th>
              <th>Peringkat</th>
            </tr>
            <?php for($i = $n_subject-1; $i >= 0; $i--){ ?>
              <tr style="text-align:center;">
                <td><?php echo $Q[$i][1]; ?></td>
                <td><?php echo $Q[$i][0]; ?></td>
                <td><?php echo $n_subject - $i; ?></td>
              </tr>
            <?php } ?>
          </table>
          <a href="index.php" style="color:white;"><button class="btnNext" type="button">Hitung Lagi</button></a>
        </form>
      </div>
    </div>
  </div>

</body>

</html>