<?php

  require_once 'core/init.php';

  if(logged_in_teacher() === FALSE) {
    header('location: index.php');
  }

  $userdata = getTeacherDataById($_SESSION['id']);

  $t_id = $userdata['t_id'];
  $id = $userdata['id'];

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
      <img class="logo" src="logo/<?php echo getTeacherLogo($id)?>" alt="logo">
      <a class="navbar-brand" href="index.php"><?php echo getTeacherComp($id)?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="teacherDash.php" >Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rcReports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teacherProfile.php" style="color:white">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="functions/logoutT.php">Log Out</a>
        </li>

      </ul>
    </div>
  </nav>



  <!--page-->
  <div id="container" class="container" style="margin-top:60px">

    <div class="row">
      <div class="col-md mt-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="main">
        <h1>My Profile</h1>
      </div>
    </div>

    <div id="profileTeacher" class="mt-3">
    </div>

    <div id="resultUpdateTeacher" class="col-md-12 text-center">

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

    function getTeacherInfoBySelf(id){
      $.ajax({
          url:"functions/getTeacherInfoForT.php",
          method: "POST",
          data:{id:id},
          success:function(data){
            $('#profileTeacher').html(data);
            console.log("Teacher info fetched");

          }
        });
    }

    $(window).on('load', function () {
      getTeacherInfoBySelf(id);
 });







</script>

</body>
</html>
