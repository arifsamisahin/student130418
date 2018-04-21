<?php

  require_once '../../core/init.php';

  global $connect;

  $s_id = $_POST['s_id'];
  $u_id = $_POST['u_id'];

  $whoCheck = $_POST['takenBy'];

  if($s_id == 0){
    $sql = "SELECT * FROM payment p, student s WHERE p.u_id='$u_id' AND p.s_id=s.id ORDER BY p.p_date DESC LIMIT 3";
  }else{
    $sql = "SELECT * FROM payment p, student s WHERE p.s_id='$s_id' AND p.s_id=s.id ORDER BY p.p_date DESC";

  }


  $result = mysqli_query($connect, $sql);
?>
  <div class="table-responsive-lg">
      <table class="table table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Paid By</th>
            <th scope="col">Amount</th>
            <th scope="col">Period</th>
            <th scope="col">Taken By</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>

<?php
  $i = 1;
  while($row = mysqli_fetch_array($result)){
 ?>


           <tr <?php if($row['p_status'] == 0) echo "class='table-danger'";?>>
             <th scope="row"><?php echo $i;?></th>
             <td><?php echo $row['p_date']?></td>
             <td><?php echo $row['p_whoPaid'] ; if($s_id == 0) echo "<br><small>" . $row['s_name'] . "</small>" ;?></td>
             <td><?php echo $row['p_amount']?> <i class='fa fa-turkish-lira'></i></td>
             <td><?php echo $row['p_period']?>. Period</td>
             <td><?php if($row['p_takenBy'] == "subuser") echo getSubuserName($row['p_whoTake']); else echo getCompName($row['p_whoTake']); ?></td>
             <td><?php if($whoCheck == "user"){
               if($row['p_status'] == 0){ echo "<input type='image' class='miniIcon paymentOk' value='" . $row['p_id'] . "' src='icon/ok.png'> Not Confirmed";} else{ echo "Confirmed <input type='image' class='miniIcon paymentUndo' value='" . $row['p_id'] . "' src='icon/undo.png'>";}
             }else if($whoCheck == "subuser"){
               if($row['p_status'] == 0) echo "Not Confirmed"; else echo "Confirmed";
             }
              echo "<input type='image' class='miniIcon printPayment' src='icon/print.png' value='functions/print/payment.php?p_id=" . $row['p_id']. "&s_id=0'></input>";
                           ?></td>

           </tr>


<?php $i++;
} ?>

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

       ?>

<script>

  var s_id = <?php echo $s_id;?>;

  $('.paymentOk').click(function(){

    var p_id = $(this).val();

    paymentOk(p_id);
    getPaymentList(s_id);
  });

  $('.paymentUndo').click(function(){

    var p_id = $(this).val();

    paymentUndo(p_id);
    getPaymentList(s_id);
  });

  $('.printPayment').click(function(){
    var link = $(this).val();
    window.open(link, 'name', 'width=900, height=600');
  });



</script>
