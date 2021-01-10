<?php
session_start();

if (!isset($_SESSION['n_criteria'])) {
  header('Location: index.php');
}

$n_criteria = $_SESSION['n_criteria'];
$criteria = $_SESSION['criteria'];

if (isset($_POST['button'])) {

  $_SESSION['weight'] = $_POST['weight'];

  $weight = $_SESSION['weight'];

  $converted_weight = [];
  foreach ($weight as $n_row => $row) {
    foreach ($row as $n_column => $value) {
      // auto fill missing value to 1/reversed matrix
      if (empty($weight[$n_row][$n_column])) {
        $converted_weight[$n_row][$n_column] = 1 / $weight[$n_column][$n_row];
      } else {
        $converted_weight[$n_row][$n_column] = $value;
      }
    }
  }

  $sum_attr = [];
  foreach ($converted_weight as $n_row => $row) {
    foreach ($row as $n_column => $value) {
      if (!isset($sum_attr[$n_column])) {
        $sum_attr[$n_column] = 0;
      }
      $sum_attr[$n_column] += $value;
      
      // echo '`' . number_format($value, 2) . '` | ';   # for debug only
    }
    // echo '<br>'; # for debug only
  }

  /**
   * for debug only
    foreach ($sum_attr as $key => $value) {
      echo '`' . number_format($value, 2) . '` | ';
    }
    echo '<br>';
  */

  $normalized_matrix = [];
  foreach ($converted_weight as $n_row => $row) {
    foreach ($row as $n_column => $value) {
      // divide converted matrix with sum of attr weight
      $normalized_matrix[$n_row][$n_column] = $value/$sum_attr[$n_column];
    }
  }

  /**
   * for debug only
   * 
    foreach ($normalized_matrix as $n_row => $row) {
      foreach ($row as $n_column => $value) {
        echo '`' . number_format($value, 2) . '` | ';   # for debug only
      }
      echo '<br>'; # for debug only
    }
  */

  $final_weight = [];
  foreach ($normalized_matrix as $n_row => $row) {
    $final_weight[$n_row] = array_sum($row)/count($normalized_matrix);
  }

  /**
   * for debug only
   *
    foreach ($final_weight as $key => $value) {
      echo number_format($value, 2) . '<br>'; # for debug only
    }
  */

  // $mysum = array();
  // for( $i=1; $i<= $n_criteria; $i++){
  //   $mysum[$i] = $sum[$i];
  // }
  // foreach($weight as $key => $value){
  //  foreach($value as $key1 => $value1){

  //     $hasil[$key1] = ($value1 / $mysum[$key1]); 
  //     $total[$key] += ($value1 / $mysum[$key1]); 

  //   }
  //     $total[$key] = $total[$key] / $n_criteria; 

  // }

  /**
   * consistency check
   */

  //  $converted_weight * $final_weight
  $matrix = [];
  foreach ($converted_weight as $n_row => $row) {
    foreach ($row as $n_column => $value) {
      if (!isset($matrix[$n_row])) {
        $matrix[$n_row] = 0;
      }

      $matrix[$n_row] += $value * $final_weight[$n_column];
    }
  }

  /**
   * for debug only
   *
    foreach ($matrix as $key => $value) {
      echo number_format($value, 3) . '<br>'; # for debug only
    }
  */

  // get lambda_max value
  $lambda = 0;
  foreach ($matrix as $key => $value) {
    $lambda += $value / $final_weight[$key];
  }
  $lambda_max = $lambda / count($final_weight);

  // echo 'lambda_max = '. number_format($lambda_max, 3); # for debug only
  
  // get CI value
  $CI = ($lambda_max - count($final_weight)) / (count($final_weight) - 1);
  // echo 'CI = '. number_format($CI, 3); # for debug only
  
  // get CR value
  $IR = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];
  $CR = $CI / $IR[count($final_weight)];
  // echo '<br>CR = '. number_format($CR, 3); # for debug only
  if ($CR > 0.1) {
    echo 'Mohon maaf nilai rasio konsistensi < 0.1';
    echo '<br>Nilai rasio konsistensi saat ini = ' . number_format($CR, 3);
    echo '<br>Mohon ulangi melakukan pengisian bobot kriteria';
    die();
  }

  $_SESSION['weight'] = $final_weight;
  // print_r($_SESSION['weight'], true);
  // var_dump($_SESSION['weight']);

  header('Location: step2.php');


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
    <div class="row justify-content-center ">
      <div class="col-md-12">
        <form method="POST" target="_self">
          <table class="table text">
            <tr>
              <td>
                Penilaian Kriteria
              </td>
              <?php foreach ($criteria as $key => $value) {
                echo "<td>$value</td>";
              } ?>
            </tr>
            <?php
            $rowCount = 0;
            foreach ($criteria as $key => $value) {
              ++$rowCount;
              $colCount = 0;
              echo "<tr><td>$value</td>";
              for ($i = 0; $i < count($criteria); $i++) {
                ++$colCount;
                if ($rowCount === $colCount) {
                  ?>
                  <td> <input type="text" class="form-control <?php echo "row" . $rowCount . " col" . $colCount; ?>" name="weight[<?= $rowCount; ?>][<?= $colCount; ?>]" placeholder="1" value="1"> </td>
                <?php
                    } else {
                      ?>
                  <td> <input type="text" class="form-control <?php echo "row" . $rowCount . " col" . $colCount; ?>" name="weight[<?= $rowCount; ?>][<?= $colCount; ?>]"> </td>
            <?php
                }
              }
            } ?>
          </table>
          <button name="button" type="submit" class="btnNext">NEXT</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>