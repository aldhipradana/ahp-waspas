<?php
  session_start();

  if(!isset($_SESSION['n_criteria'])){
    header('Location: index.php');
  }

  $n_criteria = $_SESSION['n_criteria'];

  if(isset($_POST['button'])){
    $_SESSION['criteria'] = $_POST['criteria'];

    header('Location: bobotKriteria.php');
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
              <th>Nama Kriteria</th>
            </tr>
            <?php for($i=0; $i<$n_criteria; $i++) { ?>
              <tr>
                <td>
                  <input name="criteria[]" class="form-control" type="text" placeholder="Nama Kriteria " required>
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