<?php

  require_once '../../core/init.php';

  global $connect;

  $id = $_POST['id'];


  $sql = "SELECT * FROM rollCall r, lesson l WHERE r.id='$id' AND r.lesson_id=l.lesson_id";

  $result = mysqli_query($connect, $sql);

  while($row = mysqli_fetch_array($result)){
?>
<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Recover <strong><?php echo $row['lesson_name']?></strong></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12 text-center">
          <input id="comment" type="text" class="form-control" value="<?php echo $row['comment']?>" placeholder="Comment">
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" id="saveRecover" value="<?php echo $id;?>">Save changes</button>
    </div>

<?php
  }
 ?>

<script>
  $('#saveRecover').click(function(){

    var id = $(this).val();
    var comment = $('#comment').val();

    $.ajax({
      url: "functions/rcReport/recoverLesson.php",
      method: "POST",
      data : {id, comment},
      success:function(data){
        $('#recoverModalContent').html(data);

      }
    });

    $('#recoverModal').modal('hide');

    getRcList();
  });

</script>
