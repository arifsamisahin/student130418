<?php
  require_once 'core/init.php';

  if(logged_in() === FALSE) {
    header('location: index.php');
  }

  $userdata = getUserDataByUserId($_SESSION['u_id']);
 ?>


<!DOCTYPE html>
<html>
<head>

  <title>ELA Student</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="Kurs Yönetim Sistemi">
  <meta name="author" content="Arif Sami ŞAHİN">

  <link rel="shortcut icon" href="logo/ela.png" />
  <link rel="apple-touch-icon" href="logo/ela.png" />

  <link rel="stylesheet" href="loader/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
      body {
       background-image: url("bg4.jpg");
       background-size: cover;
      }

      #radioBtn .notActive{
        color: #3276b1;
        background-color: white;
      }
  </style>
</head>
<body>

  <!--LOADER-->
  <script src="loader.js"></script>
  <div class="body hide" id="loader">
    <div class="loader loader-1">
      <div class="loader-outter"></div>
      <div class="loader-inner"></div>
    </div>
  </div>


    <!--navbar-->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
      <img src="logo/<?php echo $userdata['u_logo'];?>" width="50px" height="50px" style="margin-right:5px"></img>
      <a class="navbar-brand" href="index.php"><?php echo $userdata['u_cnAbbr'];?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add New
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="newStudent.php">Student</a>
          <a class="dropdown-item" href="newTeacher.php">Teacher</a>
          <a class="dropdown-item" href="newUser.php">User</a>
        </div>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="viewStudent.php">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewTeacher.php">Teachers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewUser.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rcReportsTop.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewPayment.php">Payments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="functions/logout.php">Log Out</a>
        </li>
      </ul>
    </div>
  </nav>


  <!--page-->
  <div class="container" style="margin-top:90px">
    <h1 class="pl-3 pb-3">Register a new Teacher </h1>


      <form>

        <div class="row">
          <div class="form-group col-md-4">
            <label for="t_name">Teacher Name:</label>
            <input type="text" class="form-control" autofocus="on" autocomplete="off" id="t_name" name="t_name">
          </div>
          <div class="form-group col-md-3">
            <label for="s_id">Id Number:</label>
            <input type="number" class="form-control" autocomplete="off" name="t_id" id="t_id">
          </div>
        </div>

      <div class="form-group">
        <label for="birthday">Birthday:</label>
          <div class="row" name="birthday">
              <div class="form-group col-md-2">
                <select class="form-control" name="t_day" id="t_day">
                  <option hidden value='0'>Day</option>
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
                <option hidden value='0'>Month</option>
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
                <option hidden value='0'>Year</option>
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
                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>
                <option value="1979">1979</option>
                <option value="1978">1978</option>
                <option value="1977">1977</option>
                <option value="1976">1976</option>
                <option value="1975">1975</option>
                <option value="1974">1974</option>
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
          <input type="email" class="form-control" autocomplete="off" name="t_email" id="t_email" placeholder="">
        </div>
        <div class="form-group col-md-3">
          <label for="t_phone">Phone Number:</label>
          <input type="text" class="form-control" autocomplete="off" name="t_phone" id="t_phone" placeholder="ex. 05453251576">
        </div>

    </div>


      <div class="row mt-2">
      <div class="form-group col-md-4">
        <label for="s_disease">Username:</label>
        <input type="text" class="form-control" id="t_username" autocomplete="off" name="t_username">
      </div>

      <div class="form-group col-md-3">
        <label for="s_disease">Password:</label>
        <input type="text" class="form-control" id="t_pass" autocomplete="off" name="t_pass" value="123">
      </div>
    </div>




      <div class="col-md-12 text-center my-5">
      <button id="registerTeacher" type="button" class="btn btn-success">REGISTER TEACHER</button>
      <div id="resultRegisterTeacher"></div>

    </div>
  </form>

  </div>

  <!--Footer-->
  <footer class="page-footer font-small indigo pt-0">


      <!--Copyright-->
      <div class="footer-copyright py-3 text-center">
          © 2018 Copyright:
          <a href="http://www.eladilaktiviteleri.com/" target="_blank" style="color:black">English Language Activities</a>
      </div>
      <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

<script>
  var gender = 1;

  var u_id = <?php echo $userdata['u_id'];?>;

  console.log("set gender : " + gender);
  $('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);

    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

    gender = sel;
    console.log("set gender : " + gender);
  });


  $(document).ready(function(){
    console.log("doc ready");


    $('#registerTeacher').click(function(){
        console.log("register teacher clicked");

        $('#resultRegisterTeacher').empty();
        $('#resultRegisterTeacher').removeClass();


        var warning = "";
        var isOk = true;

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

        console.log(u_id);
        console.log(t_id);
        console.log(name);
        console.log(day);
        console.log(month);
        console.log(year);
        console.log(gender);
        console.log(email);
        console.log(phone);
        console.log(username);
        console.log(pass);

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

          //register STUDENT
          $.ajax({
            url:"functions/addTeacher.php",
            method: "POST",
            data:{u_id:u_id,
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

                $('#resultRegisterTeacher').html(data);

            }
          });

        }else{
          $('#resultRegisterTeacher').addClass('alert alert-danger mt-3');
          $('#resultRegisterTeacher').append("<strong>Warning!</strong><br>" + warning);
        }


    });



  });//doc ready

</script>

</body>
</html>
