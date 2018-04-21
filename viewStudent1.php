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

  <style>

  body{
    font-family: 'Ubuntu', sans-serif;
  }
  .card {
      position: relative;
      box-shadow: 4px 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 40%;
      max-width:200px;
      height: auto;
      margin:10px;
      border-radius: 5px;
  }


  .card img{
    border-radius: 5px 5px 0 0;
  }

  .card h4{
    margin-top: 15px;
  }

  .card .inner-phone {
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .card .container{
    position: relative;
    
  }
  .card .container .inner-settings {
    position: absolute;
    bottom: 10px;
    right: 10px;
  }

  .card .inner-phone:hover {
    cursor: pointer;
  }

  .card .phoneIcon{
    margin-left: 5px;
    width: 30px;
    height: 30px;
  }
  .card:hover {
      box-shadow: 8px 16px 16px 0 rgba(0,0,0,0.2);

  }

  .inactive-student{
    opacity: 0.6;
  }

  .studentPicture{
    width: 100%;
  }

  .logo{
    width: 48px;
    height: 48px;
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
          <a class="nav-link" href="viewStudent.php" style="color:white">Students</a>
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
          <a class="nav-link" href="functions/logout.php">Log Out</a>
        </li>

      </ul>
    </div>
  </nav>



  <script>

  var u_id = <?php echo $userdata['u_id'];?>;


  /// PLACE HERE ALL YOUR DOC.READY SCRIPTS
  function REinit() {
        console.log("REinit();");





        //update student modal
        $('.updateInfo').click(function(){

          var s_id = $(this).val();

          $('#resultUpdate').empty();
          $('#resultUpdate').removeClass();

          $.ajax({
              url:"functions/getStudentInfo.php",
              method: "POST",
              data:{u_id:u_id, s_id:s_id},
              success:function(data){
                $('#studentInfoModal').html(data);
                console.log("Student info fetched");

              }
            });

          console.log('clicked to ' + s_id);
        });//click function




        //manage parent
        $('.manageParent').click(function(){

          var s_id = $(this).val();

          $('#resultParent').empty();
          $('#resultParent').removeClass();
          console.log(s_id);

            $.ajax({
                url:"functions/getParentInfo.php",
                method: "POST",
                data:{u_id, u_id,
                      s_id:s_id},
                success:function(data){
                  $('#parentInfoModal').html(data);
                }
              });

        });//click function


  }//REinit

  $(document).ready(function(){

    REinit();

    console.log('index onready');
    //select class
    $('#studentsByClassSb').change(function(){

      var classId = $('#studentsByClassSb').val();
      $('#studentName').val("");
      $.ajax({
          url:"functions/getStudentsByClass.php",
          method: "POST",
          data:{u_id:u_id, class_id:classId},
          success:function(data){
            $('#accordion').html(data);
            console.log("Selected update Students");
            REinit();
          }
        });
    });//change function

    //search student
    $('#btnSearchStudent').click(function(){

      var sName = $('#studentName').val();
      $('#studentsByClassSb').val('0');

        $.ajax({
            url:"functions/getStudentsByName.php",
            method: "POST",
            data:{u_id, u_id,
                  s_name:sName},
            success:function(data){
              $('#accordion').html(data);
              console.log("Searching");
              REinit();
            }
          });

    });//click function

    $('#studentName').keydown(function (e){
        if(e.keyCode == 13){
           $('#btnSearchStudent').click();
        }
    });

    $( "#studentName" ).keyup(function() {

      if($('#studentName').val() == ''){
         console.log("search is empty");
         $('#btnSearchStudent').click();
      }
    });



  }); //ready

  </script>


<script>


// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);


// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Gender'],
  ['Male', <?php echo countActiveStudentByGender(1, $u_id);?>],
  ['Female', <?php echo countActiveStudentByGender(0, $u_id);?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Total <?php echo countActiveStudent($u_id);?> Active Students  ', 'width':380, 'height':270};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

function drawChart1() {

  var data1 = google.visualization.arrayToDataTable([
  ['Task', 'Classes'],
  <?php echo loadClassChart($u_id);?>
]);

  // Optional; add a title and set the width and height of the chart
  var options1 = {'title':'Total <?php echo countActiveClass($u_id);?> Class  ', 'width':380, 'height':270};

  // Display the chart inside the <div> element with id="piechart"
  var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
  chart1.draw(data1, options1);
}


</script>
  <!--page-->
  <div id="container" class="container" style="margin-top:90px">


    <div class="row">
      <div class="col-sm" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="main">
        <h1>Students</h1>
      </div>





      <div class="col-md-3">
        <div class="input-group mb-3">

            <input type="text" class="form-control" placeholder="Name" id="studentName">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="button" id="btnSearchStudent" ><img id="searchImage" class="searchImage" src="icon/search.png" alt="serach image"></button>
            </div>

        </div>

    </div>

      <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text">Class</label>
            </div>
            <select class="form-control" name="studentsByClassSb" id="studentsByClassSb">
              <option selected value="0">All Students</option>
              <?php echo loadClassSb($userdata['u_id']);?>
              <option value="10000">Inactive Students</option>
            </select>
        </div>

      </div>
    </div>

      <div id="collapseTwo" class="collapse show" data-parent="#container">
      <div class="row">
        <div id="piechart" class="col-md-4"></div>
        <div id="piechart1" class="col-md-4"></div>
        <div id="reminder" class="col-lg-4 p-3"><?php echo birthdayReminder($u_id);?></div>
      </div>
    </div>

    <div class="accordion" id="accordion">

      <div class="row">

      <?php
        require_once 'core/init.php';
        global $connect;

        $classId = 0;


        if($classId == '0'){
          $sqlClass = " ";
        }else{
          $sqlClass = "AND s.s_classId='$classId' ";
        }

        $sql = "SELECT * FROM student s WHERE s.s_status='1' AND s.u_id='$u_id' ";
        $sql .= $sqlClass ;
        $sql .="ORDER BY s_name";
        $result = mysqli_query($connect, $sql) ;
        while ($row = mysqli_fetch_array($result)) {

          ?>

          <?php
          if($row['s_status'] == '1'){
            echo "<div class='card'>";
          }else{
            echo "<div class='card inactive-student'>";
          }
              ?>

                <img class="studentPicture" src="uploads/<?php echo $row['s_image']?>" alt="Student Picture">
                <a href="tel:<?php echo $row['s_phone']?>"><img class="phoneIcon inner-phone" src="icon/phone.png"></a>
                <div class="container">
                  <img class="phoneIcon inner-settings" src="icon/settings.png">
                  <h4><strong><?php echo $row['s_name']?></strong></h4>
                  <p class="badge badge-info"><?php echo $row['s_classId']?></p>
                </div>
              </div>

<?php } ?>


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


  <!-- The update student Modal -->
  <div class="modal fade" id="updateStudentModal" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="background-image:url('bg4.jpg'); background-size:cover">


        <div id="studentInfoModal" ></div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <div class="container text-center">
            <div id="resultUpdate"></div>
          </div>
        </div>
  </div>
</div>
</div>


  <!-- Add parent Modal -->
  <div class="modal fade" id="addParentModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="background-image:url('bg4.jpg'); background-size:cover">

        <div id="parentInfoModal">



      </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="resultParent">

        </div>

      </div>
    </div>
  </div>

</body>
</html>
