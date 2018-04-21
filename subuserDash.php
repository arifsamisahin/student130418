<?php

  require_once 'core/init.php';

  if(logged_in_subuser() === FALSE) {
    header('location: index.php');
  }

  $userdata = getSubuserDataById($_SESSION['su_id']);

  $id = 0;
  $su_id = $userdata['id'];


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
          <a class="nav-link" href="viewStudent.php" style="color:white">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rcReportsSub.php">Reports</a>
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

      </ul>
    </div>
  </nav>



  <!--page-->
  <div id="container" class="container" style="margin-top:90px">


    <div class="row">
      <div class="col-sm mb-4">
        <h2>Class Attendance</h2>
      </div>
    </div>






    <div id="classes" class="row ml-5">

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

  <!-- The class roll call Modal -->
  <div class="modal fade" id="classRollcallModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="background-image:url('bg4.jpg'); background-size:cover">


        <div id="classRc" ></div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <div class="container text-center">
            <div id="clasRcResult"></div>
          </div>
          <button id="closeRollCall" type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
        </div>
  </div>
  </div>
  </div>

<script>

  var id = <?php echo $id?>;
  var u_id = <?php echo $u_id?>;

   function addRollCallToClassByTeacher(student, degerler, nedenler, id, u_id, lesson_id){
     console.log('addRollCallToClassByTeacher');
     $.ajax({
       url:"functions/addRollCallToClassByTeacher.php",
       method: "POST",
       data: { students:student,degerler:degerler, nedenler:nedenler, id:id ,u_id:u_id, lesson_id:lesson_id},
       cache:false,
       success:function(data){
         $('#clasRcResult').html(data);

       }
     });
   }

  function getClassForRc(id, class_id){
    $.ajax({
        url:"functions/getClassForRc.php",
        method: "POST",
        data:{id:id,
              u_id:u_id,
          class_id:class_id},
        success:function(data){
          $('#classRc').html(data);
          console.log("getClassForRc.php");

        }
      });
  }


  function getOneStudentForRc(u_id,id){
    $.ajax({
        url:"functions/getOneStudentForRc.php",
        method: "POST",
        data:{u_id:u_id,id:id},
        success:function(data){
          $('#classRc').html(data);
          console.log("getOneStudentForRc.php");

        }
      });
  }


  $(document).ready(function(){
    console.log("ready");

    $('#closeRollCall').click(function(){
      $('#clasRcResult').empty();
      $('#clasRcResult').removeClass();
    });



  });


  $(window).on('load', function () {
      console.log("Window Loaded");

      $.ajax({
          url:"functions/getClassRollCall.php",
          method: "POST",
          data:{u_id:u_id},
          success:function(data){
            $('#classes').html(data);
            console.log("getClassRollCall.php");

          }
        });


 });


</script>

</body>
</html>
