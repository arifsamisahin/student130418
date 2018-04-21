<?php

  require_once '../../core/init.php';
  global $connect;

  $u_id = $_POST['u_id'];

  $sql = "SELECT * FROM teacher WHERE u_id='$u_id' ORDER BY t_status DESC, t_name";

  $gender = "";
  $result = mysqli_query($connect, $sql);
?>
  <div class="row ml-2">

    <?php

  while($row = mysqli_fetch_array($result)){

    if($row['t_status'] == '1'){
      echo "<div class='card'>";
    }else{
      echo "<div class='card inactive-student'>";
    }

 ?>

   <img class="studentPicture" src="uploads/<?php echo $row['t_image']?>" alt="Teacher Picture">
   <div class="container">
     <input type="image" data-toggle="modal" data-target="#updateTeacherModal" value="<?php echo $row['id']?>" class="bottom-right cardIcon updateInfoTeacher" src="icon/info.png">
     <h4><strong><?php echo $row['t_name']?></strong></h4>
     <p class="badge badge-info"><?php echo $row['t_username']?></p>
   </div>
 </div>


 <?php
  $gender = $row['t_gender'];
  }
  ?>
</div>

<script>


  console.log('update reinit');
  var gender = <?php echo $gender?>;
  var u_id = <?php echo $u_id?>;

  if(gender =='0'){
    $('a[data-toggle="happy"]').not('[data-title="0"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="happy"][data-title="0"]').removeClass('notActive').addClass('active');
  }

 $('#radioBtn a').on('click', function(){
   var sel = $(this).data('title');
   var tog = $(this).data('toggle');
   $('#'+tog).prop('value', sel);

   $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
   $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

   gender = sel;

 });

  $('#updateTeacher').click(function(){

    var id = $(this).val();

    var warning = "";
    var isOk = true;


    $('#resultUpdateTeacher').empty();
    $('#resultUpdateTeacher').removeClass();

    //u_id
    var name = $('#t_name').val();
    var t_id = $('#t_id').val();
    var day = $('#t_day').val();
    var month = $('#t_month').val();
    var year = $('#t_year').val();
    //Gender
    var email = $('#t_email').val();
    var phone = $('#t_phone').val();
    var username = $('#t_username').val();
    var pass = $('#t_pass').val();


    if (name == ""){
      warning += "* Please enter a name!<br>";
      isOk = false;
    }

    if (t_id == ""){
      warning += "* Please enter an id number!<br>";
      isOk = false;
    }

    if ((day == "0") || (month == "0") || (year == "0")){
      warning += "* Please select birthday!<br>";
      isOk = false;
    }

    if (email == ""){
      warning += "* Please enter an email address!<br>";
      isOk = false;
    }

    if (phone == ""){
      warning += "* Please enter phone number!<br>";
      isOk = false;
    }

    if (username == ""){
      warning += "* Please enter an username!<br>";
      isOk = false;
    }

    if (pass == ""){
      warning += "* Please enter a password!<br>";
      isOk = false;
    }

    if(isOk){
      //register teacher
      $.ajax({
        url:"functions/updateTeacher.php",
        method: "POST",
        data:{id:id,
              u_id:u_id,
              t_id:t_id,
              gender:gender,
              name:name,
              day:day,
              month:month,
              year:year,
              email:email,
              phone:phone,
              username:username,
              pass:pass,
              },
        success:function(data){

            $('#resultUpdateTeacher').html(data);
            getTeacherInfo(id);
            REinit();
        }
      });

    }else{
      $('#resultUpdateTeacher').addClass('alert alert-danger mt-3');
      $('#resultUpdateTeacher').append("<strong>Warning!</strong><br>" + warning);
    }

  });


  $('#btnInactivateTeacher').click(function(){

    var id = $(this).val();

    console.log(id);
    $.ajax({
      url:"functions/inactivateTeacher.php",
      method:"POST",
      data:{id},
      success:function(data){
        $('#resultUpdateTeacher').html(data);
        getTeacherInfo(id);
        REinit();
      }
    });


  });

  $('#btnActivateTeacher').click(function(){

    var id = $(this).val();

    console.log(id);
    $.ajax({
      url:"functions/activateTeacher.php",
      method:"POST",
      data:{id},
      success:function(data){
        $('#resultUpdateTeacher').html(data);
        getTeacherInfo(id);
        REinit();
      }
    });


  });


</script>
