<?php

  require_once 'core/init.php';

  $takenBy = "";

  if(logged_in() === TRUE) {
    $takenBy = "user";
    $userdata = getUserDataByUserId($_SESSION['u_id']);
    $u_id = $userdata['u_id'];
    $su_id = "0";
  }else if(logged_in_subuser() === TRUE){
    $takenBy = "subuser";
    $userdata = getSubuserDataById($_SESSION['su_id']);
    $u_id = $userdata['u_id'];
    $su_id = $userdata['id'];
  }else{
    header('location: index.php');
  }



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

  <link rel="stylesheet" href="css/card.css">

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


    <!--USER navbar-->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top <?php if($takenBy == "subuser") echo 'hide'?>">
      <img class="logo" src="logo/<?php echo getLogo($u_id);?>" alt="logo">
      <a class="navbar-brand" href="index.php"><?php echo getCompName($u_id);?></a>
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
          <a class="nav-link" href="viewPayment.php" style="color:white">Payments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="functions/logout.php">Log Out</a>
        </li>

      </ul>
    </div>
  </nav>

  <!--SUBUSER navbar-->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top <?php if($takenBy == "user") echo 'hide'?>">
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
        <a class="nav-link" href="rcReportsSub.php">Reports</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewPayment.php" style="color:white">Payments</a>
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
      <div class="col-sm">
        <h1>Payments</h1>
      </div>

      <div class="col-sm-4 mt-2">
        <div class="input-group">
        <input type="text" class="form-control" placeholder="Student Name" id="studentName">
        <div class="input-group-prepend">
          <button class="btn btn-outline-secondary" type="button" id="btnSearchStudent" ><img id="btnSearchStudent" class="miniIcon" src="icon/search.png" alt="serach image"></button>
        </div>
      </div>
      </div>
    </div>

    <div class="row mt-3 <?php if($takenBy == 'subuser') echo 'hide';?>">
      <div class="col-lg-6" id="paymentListDash">
      </div>
      <div class="chart-container col-lg-6" style="position: relative; height:auto; width:100%">
        <canvas id="myChart"></canvas>
      </div>
    </div>


    <div id="students" class="mt-3">



    </div>



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

  <!--VIEW PAYMENTS-->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="paymentInfo">

      </div>
    </div>
  </div>


  <!--NEW PAYMENT-->
  <div class="modal fade newPayment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="newPayment">

      </div>
    </div>
  </div>

  <script src="node_modules/chart.js/dist/Chart.js"></script>
  <script>

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        <?php echo lineChart($u_id);?>
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });

  </script>

<script>

    var u_id = <?php echo $userdata['u_id'];?>;
    var takenBy = "<?php echo $takenBy;?>";

    var su_id = "0";

    if(takenBy == "subuser"){
      su_id = <?php echo $su_id?>;
    }


    var name = "";


    function getStudentsP(){
      $.ajax({
        url:"functions/payment/getStudentCards.php",
        method: "POST",
        data:{
          u_id:u_id, name:name
        },
        success:function(data){
          $('#students').html(data);
          console.log("Students fetched");
        }

      });
    }

    function getPaymentList(s_id){
      setTimeout(function(){
      $.ajax({
        url:"functions/payment/getPaymentList.php",
        method: "POST",
        data:{
          s_id, u_id, takenBy
        },
        success:function(data){
          $('#paymentList').html(data);
          console.log("Get Payment List");
        }


      });

    }, 500);


      getPaymentListDash(0);
    }

    function getPaymentListDash(s_id){
      setTimeout(function(){
      $.ajax({
        url:"functions/payment/getPaymentList.php",
        method: "POST",
        data:{
          s_id, u_id, takenBy
        },
        success:function(data){
          $('#paymentListDash').html(data);
          console.log("Get Payment List DASH");
        }

      });

    }, 300);

    }
    function getPaymentInfo(id){
      $.ajax({
        url:"functions/payment/getPaymentInfo.php",
        method: "POST",
        data:{
          id:id
        },
        success:function(data){
          $('#paymentInfo').html(data);
          console.log("Payment info fetched");
        }

      });
    }

    function getNewPayment(id){
      $.ajax({
        url:"functions/payment/newPayment.php",
        method: "POST",
        data:{
          id:id
        },
        success:function(data){
          $('#newPayment').html(data);
          console.log("Payment info fetched");
        }

      });
    }

    function pay(id, period, whoPays, amount){
      $.ajax({
        url:"functions/payment/confirmPayment.php",
        method: "POST",
        data:{
          id:id, period:period, whoPays:whoPays, amount:amount, takenBy:takenBy, u_id:u_id, su_id:su_id
        },
        success:function(data){
          $('#resultPayment').html(data);
        }

      });
    }

    function paymentOk(p_id){
      $.ajax({
        url:"functions/payment/paymentOk.php",
        method: "POST",
        data:{
          p_id
        }
      });
    }

    function paymentUndo(p_id){
      $.ajax({
        url:"functions/payment/paymentUndo.php",
        method: "POST",
        data:{
          p_id
        }
      });
    }

    $('document').ready(function(){
      console.log("doc ready");

      console.log(takenBy);
      REinit();

    });//doc ready

    function REinit(){
      getStudentsP();
      getPaymentListDash(0);
    }

    $('#btnSearchStudent').click(function(){
      name = $('#studentName').val();

      getStudentsP();
    });

    $('#studentName').keydown(function (e){
        if(e.keyCode == 13){
           $('#btnSearchStudent').click();
        }
    });

    $( "#studentName" ).keyup(function() {

      if($('#studentName').val() == ''){
         $('#btnSearchStudent').click();
      }
    });

</script>


</body>
</html>
