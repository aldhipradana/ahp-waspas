<?php
  session_start();

  if(!isset($_SESSION['n_criteria'])){
    header('Location: index.php');
  }

  $n_criteria = $_SESSION['n_criteria'];

  if(isset($_POST['button'])){
    $_SESSION['criteria'] = $_POST['criteria'];
    $_SESSION['weight'] = $_POST['weight'];
    $_SESSION['type'] = $_POST['type'];

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
              <th>Kriteria</th>
              <th>Bobot (%)</th>
              <th></th>
              <th>Jenis</th>
            </tr>
            <?php for($i=0; $i<$n_criteria; $i++) { ?>
              <tr>
                <td>
                  <input name="criteria[]" class="form-control" type="text" required>
                </td>
                <td>
                  <input name="weight[]" class="form-control" type="number" required>
                </td>
                <td>%</td>
                <td>
                  <select name="type[]" class="form-control custom-select">
                    <option value="benefit" selected>Benefit</option>
                    <option value="cost">Cost</option>
                  </select>
                </td>
              </tr>
            <?php } ?>
          </table>
          <button name="button" type="submit" class="btnNext">NEXT</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>