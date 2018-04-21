<!DOCTYPE html>
<html>
<head>

  <title>Print Payment</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Kurs Yönetim Sistemi">
  <meta name="author" content="Arif Sami ŞAHİN">

  <link rel="shortcut icon" href="logo/ela.png" />
  <link rel="apple-touch-icon" href="logo/ela.png" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <link rel="stylesheet" href="../../css/card.css">
  <link rel="stylesheet" href="../../css/printPayment.css">

</head>
<body>

  <?php

    require_once '../../core/init.php';

    global $connect;

    $p_id = $_GET['p_id'];
    $s_id = $_GET['s_id'];

    if($s_id == 0){
      $sql = "SELECT * FROM payment WHERE p_id='$p_id'";
    }else{
      $sql = "SELECT * FROM payment WHERE s_id='$s_id'";
    }

    $result = mysqli_query($connect, $sql);


      if($s_id == 0){

        while($row = mysqli_fetch_array($result)){
          //echo $row['p_amount'];

   ?>

    <div class="printedArea">
     <div class="row">
       <div class="col-4 text-left">
         <h3><?php getCompNameAll($row['u_id'])?></h3>
       </div>
       <div class="col-4 text-center">
         <img class="printLogo" src="../../logo/<?php getLogo($row['u_id'])?>">
       </div>
       <div class="col-4 text-right">
         <p id="curDate"><strong>Date:</strong>

         </p>
         <small><strong>Prepared By:</strong> <br><?php if($row['p_takenBy'] == "subuser") echo getSubuserName($row['p_whoTake']); else echo getCompNameAll($row['p_whoTake']);?><small>
       </div>
     </div>
     <hr>
     <div class="row">
       <div class="col-12 text-center">
         <h4>Receipt</h4>
       </div>
     </div>
     <div class="row">
       <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Period</th>
              <th scope="col">Paid By</th>
              <th scope="col">Paid To</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td><?php echo $row['p_date']?></td>
              <td><?php echo $row['p_period']?> . Period</td>
              <td><?php echo $row['p_whoPaid']?></td>
              <td><?php if($row['p_takenBy'] == "subuser") echo getSubuserName($row['p_whoTake']); else echo getCompNameAll($row['p_whoTake']);?></td>
              <td><?php echo $row['p_amount']?> <i class='fa fa-turkish-lira'></i></td>
              <td><?php if($row['p_status'] == 1) echo "Confirmed"; else echo "Not Confirmed";?></td>
            </tr>
          </tbody>
        </table>
     </div>
   </div>

<?php

}//while

}//s_id != 0
else{
?>

  <div class="printedArea">
   <div class="row">
     <div class="col-4 text-left">
       <h3><?php getCompNameByStudent($s_id)?></h3>
     </div>
     <div class="col-4 text-center">
       <img class="printLogo" src="../../logo/<?php getLogoByStudent($s_id)?>">
     </div>
     <div class="col-4 text-right">
       <p id="curDate"><strong>Date:</strong>

       </p>
       <small><strong>Prepared By:</strong> <br><?php getCompNameByStudent($s_id)?><small>
     </div>
   </div>
   <hr>
   <div class="row">
     <div class="col-12 text-center">
       <h4>Receipt</h4>
     </div>
   </div>
   <div class="row">
     <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Period</th>
            <th scope="col">Paid By</th>
            <th scope="col">Paid To</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $i = 1;
              while($row = mysqli_fetch_array($result)){

           ?>
          <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $row['p_date']?></td>
            <td><?php echo $row['p_period']?> . Period</td>
            <td><?php echo $row['p_whoPaid']?></td>
            <td><?php if($row['p_takenBy'] == "subuser") echo getSubuserName($row['p_whoTake']); else echo getCompNameAll($row['p_whoTake']);?></td>
            <td><?php echo $row['p_amount']?> <i class='fa fa-turkish-lira'></i></td>
            <td><?php if($row['p_status'] == 1) echo "Confirmed"; else echo "Not Confirmed";?></td>
          </tr>

          <?php
        }
           ?>
        </tbody>
      </table>
   </div>

<?php


  $sql1 = "SELECT *, SUM(p_amount) as total FROM payment WHERE p_status='1' AND s_id='$s_id'";

  $result1 = mysqli_query($connect, $sql1);

  while($row1 = mysqli_fetch_array($result1)){
    if($row1['total'] == 0){
      $row1['total'] = "Not yet";
    }
    if($s_id != 0)
    echo "<p class='text-center'>Total confirmed payment: <strong>" .  $row1['total'] . "</strong> <i class='fa fa-turkish-lira'></i></p>";
  }



}//else
 ?>
</div>
   <script>

    var zaman = new Date();

    var day = zaman.getDate();
    var month = zaman.getMonth()+1;
    var year = zaman.getFullYear();
    var hour = zaman.getHours();
    var minute = zaman.getMinutes();
    var second = zaman.getSeconds();

    var tarih = day + "/" + month + "/" + year;
    var saat = hour + ":" + minute + ":" + second;

    document.getElementById("curDate").innerHTML = "<strong>Date:</strong><br>" + tarih + "<br>" + saat;

    window.onload = function(e){
      window.print();
    }

   </script>
</body>
</html>
