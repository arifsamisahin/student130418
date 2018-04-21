<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];

  $sql = "SELECT * FROM class WHERE class_status='1' AND u_id='$u_id'";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {
?>


          <div class="col-sm mb-3">
            <li class="btnRollcall card btn hvr-curl-top-right" style="width: 14rem;" value="<?php echo $row['class_id']?>" data-toggle="modal" data-target="#classRollcallModal">

              <div class="card-body">
                <h4 class="card-title"><?php echo $row['class_name']?></h4>
                <p class="card-text"><span class="badge badge-pill badge-info ml-2"><strong><?php echo countActiveStudentByClass($row['class_id'])?></strong></span> students<br>
                                    Capacity: <?php echo $row['class_cap']?>
                </p>
              </div>
            </li>
          </div>




        <?php }
        ?>

        <div class="col-sm mb-3">
          <li class="btnRollcall card btn hvr-curl-top-right" style="width: 14rem;" value="0" data-toggle="modal" data-target="#classRollcallModal">

            <div class="card-body">
              <h4 class="card-title">One Student</h4>
              <p class="card-text">You can roll call one<br>
                                  student here

              </p>
            </div>
          </li>
        </div>

<script>
        $('.btnRollcall').click(function(){
          var class_id = $(this).val();

          if(class_id == "0"){
            getOneStudentForRc(u_id, id);
          }else{

          console.log("class id is :" + class_id);

          $('#classRc').empty();

          getClassForRc(id, class_id);
          }
        });
</script>
