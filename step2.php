<?php
  session_start();

  if(!isset($_SESSION['criteria'])){
    header('Location: namaKriteria.php');
  }

  $n_criteria = $_SESSION['n_criteria'];
  $n_subject = $_SESSION['n_subject'];

  $criteria = $_SESSION['criteria'];
  // $weight = $_SESSION['weight'];
  // $type = $_SESSION['type'];

  if(isset($_POST['button'])){
    $_SESSION['subject'] = $_POST['subject'];
    $_SESSION['value'] = $_POST['value'];
    
    header('Location: step3.php');
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
    <div class="row register-form">
      <div class="col-md-12">
        <form method="POST" target="_self">
          <table class="table text">
            <?php for($i=0; $i<$n_subject + 1; $i++) { ?>
              <tr>
                <?php for($j=0; $j<$n_criteria + 1; $j++) { ?>
                  <?php if($i==0 && $j==0) { ?>
                    <th>Subjek</th>
                  <?php } else if($i==0) { ?>
                    <th><?php echo $criteria[$j - 1] ?></th>
                  <?php } else if($j==0) {?>
                    <td><input name="subject[]" class="form-control" type="text" required></td>
                  <?php } else {?>
                    <td><input name="value[]" class="form-control" type="number" required></td>
                  <?php } ?>
                <?php } ?>
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