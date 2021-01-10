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
  $rank = 1;

  // echo 'value <pre>';
  // print_r($value);
  // echo '</pre>';

  // Normalisasi matriks
  // a.) Mencari nilai minimal atau maksimal sesuai tipe 
  $max_value = [];
  foreach ($value as $crit => $alternative) {
    $max_value[$crit] = max($alternative);
  }

  // echo 'max <pre>';
  // print_r($max_value);
  // echo '</pre>';

  // b.) Menghitung normalisasi
  $normalized_alternatives = [];
  foreach ($value as $crit => $alternative) {
    foreach ($alternative as $alt => $val) {
      $normalized_alternatives[$alt][$crit] = $val / $max_value[$crit];
    }
  }

  // echo 'normalized <pre>';
  // print_r($normalized_alternatives);
  // echo '</pre>';

  // echo 'weight <pre>';
  // print_r($weight);
  // echo '</pre>';

  // c.) Menghitung Qi
  $final_alternative = [];
  foreach ($normalized_alternatives as $n_alt => $alternative) {
    $alt_name = $subject[$n_alt];
    $final_alternative[$alt_name] = 0;

    foreach ($alternative as $criteria => $value) {
      $final_alternative[$alt_name] += $value * $weight[$criteria];
    }
  }

  // echo 'result <pre>';
  // print_r($final_alternative);
  // echo '</pre>';

  // echo 'subject <pre>';
  // print_r($subject);
  // echo '</pre>';

  // d.) Mengurutkan berdasarkan nilai terbesar
  arsort($final_alternative);
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
            <?php foreach ($final_alternative as $key => $value) { ?>
              <tr style="text-align:center;">
                <td><?php echo $key; ?></td>
                <td><?php echo number_format($value, 4); ?></td>
                <td><?php echo $rank; ?></td>
              </tr>
            <?php $rank++; } ?>
          </table>
          <a href="index.php" style="color:white;"><button class="btnNext" type="button">Hitung Lagi</button></a>
        </form>
      </div>
    </div>
  </div>

</body>

</html>