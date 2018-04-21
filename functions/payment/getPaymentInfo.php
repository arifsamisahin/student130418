<?php

  require_once '../../core/init.php';
  global $connect;

  $id = $_POST['id'];


  $sql = "SELECT * FROM student WHERE id='$id'";

  $result = mysqli_query($connect, $sql);

  while($row = mysqli_fetch_array($result)){


 ?>

<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Payments of <?php echo $row['s_name']?></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="text-right">

  </div>

  <div id="paymentList" class="mt-3">



  </div>

</div>
<div class="modal-footer">
  <input type='image' class='miniIcon printPayment' src='icon/print.png' value='functions/print/payment.php?p_id="0&s_id=<?php echo $row['id']?>'></input>
  <button class="btn btn-primary btnNewPayment" data-toggle="modal" data-target=".newPayment" value="<?php echo $row['id']?>">New Payment</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

<?php }?>


<script>

  $('.btnNewPayment').click(function(){
    var id = $(this).val();

    getNewPayment(id);

  });

  $('document').ready(function(){

    var id = $('.btnNewPayment').val();

    console.log("deneme");

    getPaymentList(id);
  });//doc ready


</script>
