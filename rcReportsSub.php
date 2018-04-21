<?php

  require_once 'core/init.php';

  if(logged_in_subuser() === FALSE) {
    header('location: index.php');
  }

    $userdata = getSubuserDataById($_SESSION['su_id']);

    $su_id = $userdata['id'];

    $u_id = $userdata['u_id'];

    $id = 0;
?>

<!DOCTYPE html>
<html>
<head>

  <title>ELA Student</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Kurs Yönetim Sistemi">
  <meta name="author" content="Arif Sami ŞAHİN">

  <link rel="shortcut icon" href="logo/ela.png" />
  <link rel="apple-touch-icon" href="logo/ela.png" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>


  <link rel="stylesheet" href="loader/style.css">

  <link rel="stylesheet" href="css/view.css">

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
      <img class="logo" src="logo/<?php echo getLogo($u_id)?>" alt="logo">
      <a class="navbar-brand" href="index.php"><?php echo getCompName($u_id)?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="newStudentSub.php">New Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewStudentSub.php">View Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rcReportsSub.php" style="color:white">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewPayment.php">Payments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subProfile.php">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="functions/logoutSu.php">Log Out</a>
        </li>
        <button class="btn btn-outline-secondary" type="button" id="printRc" ><img id="printImage" class="searchImage" src="icon/print.png" alt="print image"></button>


      </ul>
    </div>
  </nav>



  <!--page-->
  <div id="container" class="container" style="margin-top:90px">

    <div class="row">
    <div class="col-md mb-2">
      <h2>Attendance Reports</h2>
    </div>
    </div>

    <div class="row">

      <div class="col-lg-3">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Name" id="studentName">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="button" id="btnSearchStudent" ><img id="searchImage" class="searchImage" src="icon/search.png" alt="serach image"></button>
            </div>
        </div>

    </div>

      <div class="col-lg-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text">Date</label>
            </div>
            <select class="form-control" name="studentSb" id="date">
              <option selected value="Today">Today</option>
              <option value="This week">This week</option>
              <option value="This month">This month</option>
              <option value="Last week">Last week</option>
              <option value="Last month">Last month</option>
              <option value="This year">This year</option>
              <option value="Last year">Last year</option>
              <option value="All the time">All the time</option>
            </select>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text">Teacher</label>
            </div>
            <select class="form-control" name="teacherSb" id="teacherSb">
              <option selected value="0">All Teachers</option>
              <?php echo loadTeacherSb($u_id);?>
              <option value="Inactive">Inactive Teachers</option>
            </select>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text">Student</label>
            </div>
            <select class="form-control" name="studentSb" id="studentSb">
              <option selected value="All">All Students</option>
              <?php echo loadStudentSb($u_id);?>
              <option value="Inactive">Inactive Students</option>
            </select>
        </div>
      </div>

    </div>


    <div id="students">

    </div>


  </div>



  <!--Footer-->
  <footer class="page-footer font-small indigo pt-0 mt-5">

      <!--Social buttons-->
      <div class="text-center">

          <a class="fb-ic" href="https://www.facebook.com/EnglishLanguageActivities/" target="_blank" style="color:black">
                <i class="fa fa-facebook fa-sm white-text mr-3 fa-1x"> </i>
          </a>

          <a class="ins-ic" href="https://www.instagram.com/ela_social/" target="_blank" style="color:black">
               <i class="fa fa-instagram fa-sm black-text fa-1x"> </i>
           </a>

      </div>
      <!--/.Social buttons-->

      <!--Copyright-->
      <div class="footer-copyright py-3 text-center">
          © 2018 Copyright:
          <a href="http://www.eladilaktiviteleri.com/" target="_blank" style="color:black">English Language Activities</a>
      </div>
      <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

<script>



  var id = <?php echo $id?>;
  var u_id = <?php echo $u_id?>;

  var student_id = $('#studentSb').val();
  var student_name = $('#studentName').val();
  var date = "";

  console.log(student_id + " student selected");


  function getRcList(){

    console.log(date);

    setTimeout(function(){
    $.ajax({
        url:"functions/getRcReports.php",
        method: "POST",
        data:{u_id:u_id,
              student_id:student_id,
              id:id,
              student_name,student_name,
              date:date
            },
        success:function(data){
          $('#students').html(data);
          console.log("Students fetched");
        }
      });

    }, 300);
  }



  $('document').ready(function(){
    console.log("doc ready");

    REinit();

  });//doc ready

  function REinit(){
    getRcList();
  }


  $('#date').change(function(){

    date = $('#date').val();
    getRcList();
  });//change function

  $('#studentSb').change(function(){

    student_id = $('#studentSb').val();

    $('#studentName').val('');
    student_name = "";
    getRcList();
  });//change function

  $('#teacherSb').change(function(){

    id = $('#teacherSb').val();

    getRcList();
  });//change function

  //search student
  $('#btnSearchStudent').click(function(){

    student_name = $('#studentName').val();
    student_id = "All";
    $('#studentSb').val('All');

    console.log(student_name + " searched")

    getRcList();

  });//click function

  $('#studentName').keydown(function (e){
      if(e.keyCode == 13){
         $('#btnSearchStudent').click();
      }
  });

  $( "#studentName" ).keyup(function() {

    if($('#studentName').val() == ''){
        student_id = "All";
        $('#studentSb').val('All');
        $('#btnSearchStudent').click();
    }
  });

  $('#printRc').click(function(){
    window.print();

  });
</script>

</body>
</html>
