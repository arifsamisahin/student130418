<?php

  require_once '../core/init.php';

  global $connect;

  //$s_id = $_POST['s_id'];
  $s_id = $_POST['s_id'];
  $u_id = $_POST['u_id'];

  //$userdata = getUserDataByUserId($_SESSION['u_id']);

  //$u_id = $userdata['u_id'];

  $sql = "SELECT * FROM student WHERE s_id=$s_id AND u_id=$u_id";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {
?>
    <div class="modal-header">
      <h4 class="modal-title"><?php echo $row['s_name']?>'s parents</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
      <table class="table table-sm table-hover table-responsive-md table-warning">

        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">1. Parent</span>
        </div>
        <select class="form-control col-md-2" name="p1_relation" id="p1_relation">
          <option hidden value="0">Relationship</option>
          <option value="Mother">Mother</option>
          <option value="Father">Father</option>
          <option value="Grandfather">Grandfather</option>
          <option value="Grandmother">Grandmother</option>
          <option value="Uncle">Uncle</option>
          <option value="Aunt">Aunt</option>
          <option value="Teacher">Teacher</option>
          <option value="Others">Others</option>
        </select>
        <input type="text" class="form-control col-md-3" placeholder="Name" autocomplete="off" name="p1_name" id="p1_name">
        <input type="text" class="form-control col-md-2" placeholder="Job" autocomplete="off" name="p1_job" id="p1_job">
        <input type="text" class="form-control col-md-2" placeholder="Phone Number" autocomplete="off" name="p1_phone" id="p1_phone">
        <input type="text" class="form-control col-md-2" placeholder="E-mail" autocomplete="off" name="p1_email" id="p1_email">
      </div>

      <div class="col-sm-12 text-center m-3">
            <button id="addParent" value="<?php echo $row['s_id'] ;?>" type="button" class="btn btn-success">Add New Parent</button>
          </div>



            <p class="pl-2"><strong>Parents</strong></p>
          <?php


            $student = $row['s_id'];
            $sql1 = "SELECT * FROM student s, parent p, studentParent sP  WHERE s.s_id='$student' AND s.u_id='$u_id' AND s.s_id=sP.s_id AND p.p_id=sP.p_id";
            $result1 = mysqli_query($connect, $sql1) or die("MySQL error: " . mysqli_error($connect) . "<hr>\nQuery: $sql1");
            ?>
            <tbody>

            <?php
            while ($row1 = mysqli_fetch_array($result1)) {

           ?>
          <tr>
            <td><span class="badge badge-pill badge-success"><?php echo $row1['p_relation']?></span></td>
            <td><?php echo $row1['p_name']?></td>
            <td>
              <span class="badge badge-pill badge-warning"><?php echo $row1['p_job']?></span>
            </td>
            <td><?php echo $row1['p_email']?></td>
            <td class="text-right"><a href="tel:<?php echo $row1['p_phone'];?>"><img src="icon/phone.png" class="img-rounded mr-2" alt="Cinque Terre" width="30px" height="30px"></a><?php echo $row1['p_phone']; ?></td>
              <td class="text-right"><button value='<?php echo $row1['p_id']?>' type='button' class='deleteParent btn btn-outline-danger btn-sm '>Delete</button></td>

          </tr>
          </tbody>

        <?php }
        ?>


      </table>

<?php
  }
?>

</div>

<script>

    var u_id = <?php echo $u_id;?>;
    var s_id = <?php echo $s_id;?>;


    function getParentInfo(){
      $.ajax({
          url:"functions/getParentInfo.php",
          method: "POST",
          data:{u_id, u_id,
                s_id:s_id},
          success:function(data){
            $('#parentInfoModal').html(data);

            $('#btnSearchStudent').click();
          }
        });

    }
  $('#addParent').click(function(){

    var s_id=$(this).val();

    var p1_relation = $('#p1_relation').val();
    var p1_name = $('#p1_name').val();
    var p1_job = $('#p1_job').val();
    var p1_phone = $('#p1_phone').val();
    var p1_email = $('#p1_email').val();

    if ((p1_relation != '0') && (p1_name != '') && (p1_job != '') && (p1_phone != '') && (p1_email != '')){
      $.ajax({
        url:"functions/addParent.php",
        method: "POST",
        data:{u_id:u_id,
              s_id:s_id,
              name:p1_name,
              job:p1_job,
              phone:p1_phone,
              email:p1_email,
              relation:p1_relation
            },
        success:function(data){

          $('#resultParent').addClass("alert alert-success mt-3");
          $('#resultParent').html(data);


          getParentInfo();


        }
      }); //ajax

    }

  });


    $('.deleteParent').click(function(){

      var p_id = $(this).val();

      $.ajax({
          url:"functions/deleteParent.php",
          method: "POST",
          data:{p_id:p_id},
          success:function(data){
            $('#resultParent').addClass("alert alert-success mt-3");
            $('#resultParent').html(data);

            getParentInfo();

            $('#btnSearchStudent').click();
          }
        });

    });
</script>
