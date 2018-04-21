<?php

  require_once '../../core/init.php';

  global $connect;

  $id = $_POST['id'];

  $sql = "SELECT * FROM rollCall r, student s WHERE r.id='$id' AND r.student_id=s.id";

  $result = mysqli_query($connect, $sql);

  while($row = mysqli_fetch_array($result)){
?>
<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Why <strong><?php echo $row['s_name']?></strong> was absent?</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12 text-center">
          <input id="reason" type="text" class="form-control" value="<?php echo $row['reason']?>"placeholder="Reason?">
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" id="saveReason" value="<?php echo $id;?>">Save changes</button>
    </div>

<?php
  }
 ?>

<script>
  $('#saveReason').click(function(){

    var id = $(this).val();
    var reason = $('#reason').val();

    $.ajax({
      url: "functions/rcReport/updateReason.php",
      method: "POST",
      data : {id, reason}
    });

    $('#reasonModal').modal('hide');

    getRcList();
  });

</script>
