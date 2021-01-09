<?php
  session_start();

  if(!isset($_SESSION['n_criteria'])){
    header('Location: index.php');
  }

  $n_criteria = $_SESSION['n_criteria'];
  $criteria = $_SESSION['criteria'];

  if(isset($_POST['button'])){

    $_SESSION['weight'] = $_POST['weight'];

    $weight = $_SESSION['weight'];


    foreach($weight as $key => $value){
      $total[$key] = 0;

      foreach($value as $key1 => $value1){

        if(!isset($sum[$key1])){
          $sum[$key1] = 0;
        }
      
        $sum[$key1] += $value1;

      }
    }

   
    $mysum = array();
    for( $i=1; $i<= $n_criteria; $i++){
      $mysum[$i] = $sum[$i];
    }
    foreach($weight as $key => $value){
     foreach($value as $key1 => $value1){

        $hasil[$key1] = ($value1 / $mysum[$key1]); 
        $total[$key] += ($value1 / $mysum[$key1]); 
        
      }
        $total[$key] = $total[$key] / $n_criteria; 

    }
    
    $_SESSION['weight'] = $total;
    print_r($_SESSION['weight']);

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
                <?php foreach( $criteria as $key=>$value ) { 
                    echo "<td>$value</td>";
                } ?>
            </tr>
            <?php 
            $rowCount = 0;
            foreach( $criteria as $key=>$value ) {     
                ++$rowCount;
                $colCount = 0;
                echo "<tr><td>$value</td>";
                for($i=0; $i<count($criteria) ;$i++){     
                ++$colCount;
                    if( $rowCount === $colCount){
                        ?> 
                            <td> <input type="text" class="form-control <?php echo"row".$rowCount." col".$colCount; ?>" name="weight[<?=  $rowCount; ?>][<?=  $colCount; ?>]" placeholder="1" value="1" > </td> 
                        <?php
                    }else{
                        ?> 
                            <td> <input type="text" class="form-control <?php echo"row".$rowCount." col".$colCount; ?>" name="weight[<?=  $rowCount; ?>][<?=  $colCount; ?>]"> </td>
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