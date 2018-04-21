<?php

  require_once '../../core/init.php';
  global $connect;

  $u_id = $_POST['u_id'];
  $s_name = $_POST['name'];

  $sql = "SELECT * FROM student s, class c WHERE s.s_classId=c.class_id AND s.u_id='$u_id' AND s.s_name LIKE '%$s_name%' ORDER BY s.s_status DESC, s.s_name";

  $result = mysqli_query($connect, $sql);
?>
  <div class="row ml-2">

    <?php

  while($row = mysqli_fetch_array($result)){

    if($row['s_status'] == '1'){
      echo "<div class='card'>";
    }else{
      echo "<div class='card inactive-student'>";
    }

 ?>

   <img class="studentPicture" src="uploads/<?php echo $row['s_image']?>" alt="Student Picture">
   <div class="container">
     <input type="image" data-toggle="modal" data-target=".bd-example-modal-lg" value="<?php echo $row['id']?>" class="bottom-right cardIcon paymentInfo" src="icon/info.png">
     <h4><strong><?php echo $row['s_name']?></strong></h4>
     <p class="badge badge-info"><?php echo $row['class_name']?></p>
   </div>
 </div>


 <?php
  }
  ?>
</div>

<script>
$('.paymentInfo').click(function(){
  var id = $(this).val();

  getPaymentInfo(id);

});
</script>
