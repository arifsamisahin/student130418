<?php

  require_once '../../core/init.php';
  global $connect;

  $id = $_POST['id'];


  $sql = "SELECT * FROM student WHERE id='$id'";

  $result = mysqli_query($connect, $sql);

  while($row = mysqli_fetch_array($result)){


 ?>

<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">New Payment for <?php echo $row['s_name']?></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form>
          <div class="form-group">
            <select class="custom-select" id="period">
              <option selected hidden value="0">Select Payment Period</option>
              <option value="1">1. Payment</option>
              <option value="2">2. Payment</option>
              <option value="3">3. Payment</option>
              <option value="4">4. Payment</option>
              <option value="5">5. Payment</option>
              <option value="6">6. Payment</option>
              <option value="7">7. Payment</option>
              <option value="8">8. Payment</option>
              <option value="9">9. Payment</option>
              <option value="10">10. Payment</option>
              <option value="11">11. Payment</option>
              <option value="12">12. Payment</option>
              <option value="13">13. Payment</option>
            </select>
          </div>

          <div class="form-group">
            <label for="whoPays" class="col-form-label">Who Pays:</label>
            <input type="text" class="form-control" placeholder="Name" id="whoPays">
          </div>

          <div class="form-group">
            <label for="whoPays" class="col-form-label">Amount (TRY):</label>
            <input type="number" class="form-control" placeholder="Amount" id="amount">
          </div>

        </form>

</div>
<div class="modal-footer">
  <div id="resultPayment"></div>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-success" value="<?php echo $row['id']?>"id="confirmPayment">CONFIRM PAYMENT</button>
</div>

<?php }?>


<script>

  $('#confirmPayment').click(function(){

    $('#resultPayment').removeClass();
    $('#resultPayment').empty();

    var id = $(this).val();
    var period = $('#period').val();
    var whoPays = $('#whoPays').val();
    var amount = $('#amount').val();


    if((period == '0') || (whoPays == "") || (amount == "")){

      $('#resultPayment').addClass("alert alert-danger");
      $('#resultPayment').append("Please fill the blanks :)");
    }else{
      pay(id, period, whoPays, amount);

       getPaymentList(id);
    }


  });



</script>
