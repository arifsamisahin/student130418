<?php

  require_once '../core/init.php';

  global $connect;


  $id = $_POST['id'];

  $sql = "SELECT id, u_id, DAY(su_birthday) as day, MONTH(su_birthday) as month, YEAR(su_birthday) as year, su_name, su_id, su_gender, su_email, su_phone, su_username, su_pass, su_status FROM subuser WHERE id='$id'";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {

?>



<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"><?php echo $row['su_name'];?></h4>
  <?php if($row['su_status'] == '1'){
    echo "<button value='" . $row['id'] . "' type='button' class='btn btn-outline-danger btn-sm ml-2' id='btnInactivateTeacher'>Inactivate</button>";
  } else{
    echo "<button value='" . $row['id'] . "' type='button' class='btn btn-outline-success btn-sm ml-2' id='btnActivateTeacher'>Activate</button>";
  }?>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>


<!-- Modal body -->
<div class="modal-body" >

  <div class="row">
    <div class="form-group col-md-4">
      <label for="t_name">Teacher Name:</label>
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
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <select class="form-control" name="t_month" id="t_month">
          <option selected hidden value="<?php echo $row['month']?>"><?php echo $row['month']?></option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <select class="form-control" name="t_year" id="t_year">
          <option selected hidden value="<?php echo $row['year']?>"><?php echo $row['year']?></option>
          <option value="2001">2001</option>
          <option value="2000">2000</option>
          <option value="1999">1999</option>
          <option value="1998">1998</option>
          <option value="1997">1997</option>
          <option value="1996">1996</option>
          <option value="1995">1995</option>
          <option value="1994">1994</option>
          <option value="1993">1993</option>
          <option value="1992">1992</option>
          <option value="1991">1991</option>
          <option value="1990">1990</option>
          <option value="1990">1989</option>
          <option value="1990">1988</option>
          <option value="1990">1987</option>
          <option value="1990">1986</option>
          <option value="1990">1985</option>
          <option value="1990">1984</option>
          <option value="1990">1983</option>
          <option value="1990">1982</option>
          <option value="1990">1981</option>
          <option value="1990">1980</option>
          <option value="1990">1979</option>
          <option value="1990">1978</option>
          <option value="1990">1977</option>
          <option value="1990">1976</option>
          <option value="1990">1975</option>
          <option value="1990">1974</option>
        </select>
      </div>


      <div class="form-group col-md-2">
        <div class="form-group">
          <label for="happy" class="col-sm-4 col-md-4 control-label text-right">Gender</label>
          <div class="col-sm-7 col-md-7">
            <div class="input-group">
              <div id="radioBtn" class="btn-group">
                <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="1">Male</a>
                <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="0">Female</a>
              </div>
              <input type="hidden" name="happy" id="happy">
            </div>
          </div>
        </div>
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


</div>


 <script>

$(document).ready(function(e){

  console.log('update reinit');
  var gender = <?php echo $row['su_gender']?>;
  var u_id = <?php echo $row['u_id']?>;

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
        url:"functions/updateSubuser.php",
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
      url:"functions/inactivateSubuser.php",
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
      url:"functions/activateSubuser.php",
      method:"POST",
      data:{id},
      success:function(data){
        $('#resultUpdateTeacher').html(data);
        getTeacherInfo(id);
        REinit();
      }
    });


  });

 });


 </script>

<?php } ?>
