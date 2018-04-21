<?php

  require_once '../core/init.php';

  global $connect;


  $id = $_POST['id'];

  $sql = "SELECT id, u_id, DAY(su_birthday) as day, MONTH(su_birthday) as month, YEAR(su_birthday) as year, su_name, su_id, su_gender, su_email, su_phone, su_username, su_pass, su_status FROM subuser WHERE id='$id'";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {

?>


  <div class="row">
    <div class="form-group col-md-4">
      <label for="t_name">Name:</label>
      <input type="text" class="form-control" autocomplete="off" id="t_name" name="t_name" value="<?php echo $row['su_name']?>">
    </div>
    <div class="form-group col-md-3">
      <label for="s_id">Id Number:</label>
      <input type="number" class="form-control" autocomplete="off" name="t_id" id="t_id" value="<?php echo $row['su_id']?>">
    </div>
  </div>

<div class="form-group">
  <label for="birthday">Birthday:</label>
    <div class="row" name="birthday">
        <div class="form-group col-md-2">
          <select class="form-control" name="t_day" id="t_day">
            <option selected hidden value="<?php echo $row['day']?>"><?php echo $row['day']?></option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <select class="form-control" name="t_month" id="t_month">
          <option selected hidden value="<?php echo $row['month']?>"><?php echo $row['month']?></option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <select class="form-control" name="t_year" id="t_year">
          <option selected hidden value="<?php echo $row['year']?>"><?php echo $row['year']?></option>
        </select>
      </div>



</div>
</div>


<div class="row">
  <div class="form-group col-md-3">
    <label for="t_phone">E-mail:</label>
    <input type="email" class="form-control" autocomplete="off" name="t_email" id="t_email" value="<?php echo $row['su_email']?>">
  </div>
  <div class="form-group col-md-3">
    <label for="t_phone">Phone Number:</label>
    <input type="text" class="form-control" autocomplete="off" name="t_phone" id="t_phone" value="<?php echo $row['su_phone']?>">
  </div>

</div>


<div class="row mt-2">
<div class="form-group col-md-4">
  <label for="s_disease">Username:</label>
  <input type="text" class="form-control" id="t_username" autocomplete="off" name="t_username" value="<?php echo $row['su_username']?>">
</div>

<div class="form-group col-md-3">
  <label for="s_disease">Password:</label>
  <input type="text" class="form-control" id="t_pass" autocomplete="off" name="t_pass" value="<?php echo $row['su_pass']?>">
</div>
</div>

 <div class="row">

 <div class="col-sm-12 text-center">
       <button id="updateTeacher" value="<?php echo $row['id'] ;?>" type="button" class="btn btn-success">Update Info</button>
     </div>

</div>



 <script>

    $('#t_name').prop('disabled', true);
    $('#t_id').prop('disabled', true);
    $('#t_day').prop('disabled', true);
    $('#t_month').prop('disabled', true);
    $('#t_year').prop('disabled', true);

    $('#updateTeacher').click(function(){

      var id = $(this).val();

      var warning = "";
      var isOk = true;


      $('#resultUpdateTeacher').empty();
      $('#resultUpdateTeacher').removeClass();


      var email = $('#t_email').val();
      var phone = $('#t_phone').val();
      var username = $('#t_username').val();
      var pass = $('#t_pass').val();


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
          url:"functions/updateSubuserBySelf.php",
          method: "POST",
          data:{id:id,
                email:email,
                phone:phone,
                username:username,
                pass:pass,
                },
          success:function(data){

              $('#resultUpdateTeacher').html(data);
              getTeacherInfoBySelf(id);

          }
        });

      }else{
        $('#resultUpdateTeacher').addClass('alert alert-danger mt-3');
        $('#resultUpdateTeacher').append("<strong>Warning!</strong><br>" + warning);
      }

    });

 </script>

<?php } ?>
