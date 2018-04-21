<?php

  require_once 'core/init.php';

  if(logged_in() === FALSE) {
    header('location: index.php');
  }

  $userdata = getUserDataByUserId($_SESSION['u_id']);

  $u_id = $userdata['u_id'];

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
      <img class="logo" src="logo/<?php echo $userdata['u_logo'];?>" alt="logo">
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
          <a class="nav-link" href="viewStudent.php" >Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewTeacher.php">Teachers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewUser.php" style="color:white">Users</a>
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
  <div id="container" class="container" style="margin-top:90px">

    <div class="row">

      <div id="reminder" class="col-lg-12 p-3"><?php echo birthdayReminderSu($u_id);?></div>
    </div>


    <div class="row">
      <div class="col-sm" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="main">
        <h1>Users</h1>
      </div>


    </div>


    <div class="accordion" id="accordion">

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


  <!-- The update teacher Modal -->
  <div class="modal fade" id="updateTeacherModal" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="background-image:url('bg4.jpg'); background-size:cover">


        <div id="teacherInfoModal" ></div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <div class="container text-center">
            <div id="resultUpdateTeacher"></div>
          </div>
        </div>
  </div>
  </div>
  </div>

<script>


var u_id = <?php echo $userdata['u_id']?>;


  function getTeacherList(){
    $.ajax({
        url:"functions/getSubusers.php",
        method: "POST",
        data:{u_id:u_id},
        success:function(data){
          $('#accordion').html(data);
          console.log("Teachers fetched");
        }
      });
  }


  function getTeacherInfo(id){
    $.ajax({
        url:"functions/getSubuserInfo.php",
        method: "POST",
        data:{id:id},
        success:function(data){
          $('#teacherInfoModal').html(data);
          console.log("Teacher info fetched");

        }
      });
  }

  $('document').ready(function(){
    console.log("doc ready");

    REinit();

  });//doc ready

  function REinit(){

    getTeacherList();


    setTimeout(function(){
      //update teacher modal
      $('.updateInfoTeacher').click(function(){

        var id = $(this).val();

        getTeacherInfo(id);

        $('#resultUpdateTeacher').empty();
        $('#resultUpdateTeacher').removeClass();



        console.log("Clicked " + id + " to update info");
      });//click function
    },500);
  }

</script>
</body>
</html>
