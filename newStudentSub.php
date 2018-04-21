<?php
  require_once 'core/init.php';

  if(logged_in_subuser() === FALSE) {
    header('location: index.php');
  }

  $userdata = getSubuserDataById($_SESSION['su_id']);

  $u_id = $userdata['u_id'];


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
      <img src="logo/<?php getLogo($u_id);?>" width="50px" height="50px" style="margin-right:5px"></img>
      <a class="navbar-brand" href="index.php"><?php getCompName($u_id);?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="newStudentSub.php" style="color:white">New Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewStudentSub.php">View Students</a>
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
  <div class="container" style="margin-top:90px">
    <h1 class="pl-3 pb-3">Register a new Student </h1>


      <form>

        <div class="row">
          <div class="form-group col-md-4">
            <label for="s_name">Student Name:</label>
            <input type="text" class="form-control" autofocus="on" autocomplete="off" id="s_name" name="s_name">
          </div>
          <div class="form-group col-md-3">
            <label for="s_id">Id Number:</label>
            <input type="number" class="form-control" autocomplete="off" name="s_id" id="s_id">
          </div>
        </div>


      <div class="form-group">
        <label for="birthday">Birthday:</label>
          <div class="row" name="birthday">
              <div class="form-group col-md-2">
                <select class="form-control" name="b_day" id="b_day">
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
              <select class="form-control" name="b_month" id="b_month">
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
              <select class="form-control" name="b_year" id="b_year">
                <option hidden value='0'>Year</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2003">2003</option>
                <option value="2002">2002</option>
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
          <label for="s_phone">Phone Number:</label>
          <input type="text" class="form-control" autocomplete="off" name="s_phone" id="s_phone">
        </div>
        <div class="form-group col-md-3">
          <label for="s_classId">Ela class:</label>
          <select class="form-control" name="s_classId" id="s_classId">
            <option hidden value="0">Select a class</option>
            <?php echo loadClassSb($userdata['u_id']);?>
          </select>
        </div>
        <div class=" form-group col-md-6">
          <button type="button" id="settingsClasses" class="btn btn-warning" data-toggle="modal" data-target="#settingsClass"><img src="icon/settings.png" width="32px" height="32px"> Classes</button>

          <button type="button" id="settingsLessons" class="btn btn-warning" data-toggle="modal" data-target="#settingsLesson"><img src="icon/settings.png" width="32px" height="32px"> Lessons</button>
        </div>
    </div>

    <div class="row">
      <div class="input-group col-md-8 my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Education </span>
        </div>
        <select class="form-control" id="s_schoolId" name="s_schoolId">
          <option hidden value="0">Select a School</option>
          <?php echo loadSchoolSb($userdata['u_id']);?>
        </select>
        <select class="form-control col-md-3" name="s_sclass" id="s_sclass">
          <option hidden value="0">Class</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
      </div>
      <div class="col-md-4">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#settingsSchool"><img src="icon/settings.png" width="32px" height="32px"> Schools</button>
      </div>
    </div>



      <div class="row mt-2">
      <div class="form-group col-md-4">
        <label for="s_disease">Any Disaese:</label>
        <input type="text" class="form-control" id="s_disease" autocomplete="off" name="s_disease" value="No disease">
      </div>
    </div>

    <h2 class="mb-3">Parents</h2>


      <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">1. Parent</span>
      </div>
      <select class="form-control col-md-2" name="p1_relation" id="p1_relation">
        <option hidden value="0">Relationship</option>
        <option value="Mother">Mother</option>
        <option value="Father">Father</option>
        <option value="Grandfather">Grandfather</option>
        <option value="Grandmother">Grandmother</option>
        <option value="Uncle">Uncle</option>
        <option value="Aunt">Aunt</option>
        <option value="Teacher">Teacher</option>
        <option value="Brother">Brother</option>
        <option value="Sister">Sister</option>
        <option value="Others">Others</option>
      </select>
      <input type="text" class="form-control col-md-3" placeholder="Name" autocomplete="off" name="p1_name" id="p1_name">
      <input type="text" class="form-control col-md-2" placeholder="Job" autocomplete="off" name="p1_job" id="p1_job">
      <input type="text" class="form-control col-md-2" placeholder="Phone Number" autocomplete="off" name="p1_phone" id="p1_phone">
      <input type="text" class="form-control col-md-2" placeholder="E-mail" autocomplete="off" name="p1_email" id="p1_email">
    </div>


      <div class="input-group mt-3">
      <div class="input-group-prepend">
        <span class="input-group-text">2. Parent</span>
      </div>
      <select class="form-control col-md-2" name="p2_relation" id="p2_relation">
        <option hidden value="0">Relationship</option>
        <option value="Mother">Mother</option>
        <option value="Father">Father</option>
        <option value="Grandfather">Grandfather</option>
        <option value="Grandmother">Grandmother</option>
        <option value="Uncle">Uncle</option>
        <option value="Aunt">Aunt</option>
        <option value="Teacher">Teacher</option>
        <option value="Brother">Brother</option>
        <option value="Sister">Sister</option>
        <option value="Others">Others</option>
      </select>
      <input type="text" class="form-control col-md-3" placeholder="Name" autocomplete="off" name="p2_name" id="p2_name">
      <input type="text" class="form-control col-md-2" placeholder="Job" autocomplete="off" name="p2_job" id="p2_job">
      <input type="text" class="form-control col-md-2" placeholder="Phone Number" autocomplete="off" name="p2_phone" id="p2_phone">
      <input type="text" class="form-control col-md-2" placeholder="E-mail" autocomplete="off" name="p2_email" id="p2_email">
    </div>


      <div class="col-md-12 text-center my-5">
      <button id="registerStudent" type="button" class="btn btn-success">REGISTER STUDENT</button>
      <div id="resultRegister"></div>
      <div id="resultParent1"></div>
      <div id="resultParent2"></div>

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





  <!-- The lesson Settings Modal -->
<div class="modal fade" id="settingsLesson">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content" style="background-image:url('bg.jpg'); background-size:cover">

    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title"><img src="icon/settings.png" width="32px" height="32px"> Manage Lessons</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">

              <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><img src="icon/add.png" width="32px" height="32px"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><img src="icon/update.png" width="32px" height="32px"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><img src="icon/remove.png" width="32px" height="32px"></a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

      <div class="tab-pane active" id="home" role="tabpanel">
        <!--add LESSON-->
        <div class="container text-center mt-3">
          <form>
            <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="Lesson Name" id="lesson_name" name="lesson_name">
            <button id="addLesson" type="button" class="btn btn-primary m-3">Create New Lesson</button>
          </form>
          <div id="resultLesson"></div>
        </div><!--add LESSON-->
      </div>

      <div class="tab-pane" id="profile" role="tabpanel">
        <!--update LESSON-->
        <div class="container text-center mt-3">

            <select class="form-control" id="s_lessonIdUpdate">
              <option hidden value="0">Select a Lesson</option>
              <?php echo loadLessonSb($userdata['u_id']);?>
            </select>
            <div class="form-group mt-3">
              <label for="school_nameUpdate">New Name:</label>
              <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="Lesson Name" id="lesson_nameUpdate" name="lesson_nameUpdate">
            </div>
            <button id="updateLesson" type="button" class="btn btn-primary m-3">Update Lesson</button>

          <div id="resultLessonUpdate"></div>
        </div><!--update LESSON-->
      </div>

      <div class="tab-pane" id="messages" role="tabpanel">
        <!--remove LESSON-->
        <div class="container text-center mt-3">
          <form>
            <select class="form-control" id="s_lessonIdRemove">
              <option hidden value="0">Select a Lesson</option>
              <?php echo loadLessonSb($userdata['u_id']);?>
            </select>
            <button id="removeLesson" type="button" class="btn btn-primary m-3">Remove Lesson</button>
          </form>
          <div id="resultLessonRemove"></div>
        </div><!--remove LESSON-->
      </div>
    </div>

    </div>

  </div>
</div>
</div>


  <!-- The School Settings Modal -->
<div class="modal fade" id="settingsSchool">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content" style="background-image:url('bg.jpg'); background-size:cover">

    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title"><img src="icon/settings.png" width="32px" height="32px"> Manage Schools</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">

              <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#homes" role="tab"><img src="icon/add.png" width="32px" height="32px"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#profiles" role="tab"><img src="icon/update.png" width="32px" height="32px"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messagess" role="tab"><img src="icon/remove.png" width="32px" height="32px"></a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

      <div class="tab-pane active" id="homes" role="tabpanel">
        <!--add SCHOOL-->
        <div class="container text-center mt-3">
          <form>
            <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="School Name" id="school_name" name="school_name">
            <button id="addSchool" type="button" class="btn btn-primary m-3">Add New School</button>
          </form>
          <div id="resultSchool"></div>
        </div><!--add SCHOOL-->
      </div>

      <div class="tab-pane" id="profiles" role="tabpanel">
        <!--update SCHOOL-->
        <div class="container text-center mt-3">

            <select class="form-control" id="s_schoolIdUpdate">
              <option hidden value="0">Select a School</option>
              <?php echo loadSchoolSb($userdata['u_id']);?>
            </select>
            <div class="form-group mt-3">
              <label for="school_nameUpdate">New Name:</label>
              <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="School Name" id="school_nameUpdate" name="school_nameUpdate">
            </div>
            <button id="updateSchool" type="button" class="btn btn-primary m-3">Update School</button>

          <div id="resultSchoolUpdate"></div>
        </div><!--update SCHOOL-->
      </div>

      <div class="tab-pane" id="messagess" role="tabpanel">
        <!--remove SCHOOL-->
        <div class="container text-center mt-3">
          <form>
            <select class="form-control" id="s_schoolIdRemove">
              <option hidden value="0">Select a School</option>
              <?php echo loadSchoolSb($userdata['u_id']);?>
            </select>
            <button id="removeSchool" type="button" class="btn btn-primary m-3">Remove School</button>
          </form>
          <div id="resultSchoolRemove"></div>
        </div><!--remove SCHOOL-->
      </div>
    </div>

    </div>

  </div>
</div>
</div>



<!-- The Class Settings Modal -->
<div class="modal fade" id="settingsClass">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content" style="background-image:url('bg.jpg'); background-size:cover">

  <!-- Modal Header -->
  <div class="modal-header">
    <h4 class="modal-title"><img src="icon/settings.png" width="32px" height="32px"> Manage Classes</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>

  <!-- Modal body -->
  <div class="modal-body">

            <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#homeC" role="tab"><img src="icon/add.png" width="32px" height="32px"></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#profileC" role="tab"><img src="icon/update.png" width="32px" height="32px"></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#messagesC" role="tab"><img src="icon/remove.png" width="32px" height="32px"></a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div class="tab-pane active" id="homeC" role="tabpanel">
      <!--add CLASS-->
      <div class="container text-center mt-3">

        <form>
            <div class="form-group row">
              <label for="class_name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="New Class Name" id="class_name" name="class_name">
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Capacity</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="class_capacity" name="class_capacity" autocomplete="off" placeholder="Total Capacity Of Class">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button id="addClass" type="button" class="btn btn-primary m-3">Create a New Class</button>
              </div>
            </div>
          </form>
        <div id="resultClass"></div>
      </div><!--add CLASS-->
    </div>

    <div class="tab-pane" id="profileC" role="tabpanel">
      <!--update CLASS-->
      <div class="container text-center mt-3">


          <form>
              <div class="form-group row">
                <select class="form-control" id="s_classIdUpdate">
                  <option hidden value="0">Select a Class</option>
                  <?php echo loadClassSb($userdata['u_id']);?>
                </select>
              </div>

              <div class="form-group row">
                <label for="class_nameUpdate" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" autofocus="on" autocomplete="off" placeholder="New Class Name" id="class_nameUpdate" name="class_nameUpdate">
                </div>
              </div>

              <div class="form-group row">
                <label for="class_capacityUpdate" class="col-sm-2 col-form-label">New Capacity</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="class_capacityUpdate" name="class_capacityUpdate" autocomplete="off" placeholder="New Capacity Of Class">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button id="updateClass" type="button" class="btn btn-primary m-3">Update This Class</button>
                </div>
              </div>
            </form>
        <div id="resultClassUpdate"></div>
      </div><!--update CLASS-->
    </div>

    <div class="tab-pane" id="messagesC" role="tabpanel">
      <!--remove CLASS-->
      <div class="container text-center mt-3">
        <form>
          <select class="form-control" id="s_classIdRemove">
            <option hidden value="0">Select a Class</option>
            <?php echo loadClassSb($userdata['u_id']);?>
          </select>
          <button id="removeClass" type="button" class="btn btn-primary m-3">Remove Class</button>
        </form>
        <div id="resultClassRemove"></div>
      </div><!--remove CLASS-->
    </div>
  </div>

  </div>

</div>
</div>
</div>
<script>

          var u_id = <?php echo $u_id; ?>;

          var gender = 1;

          $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);

            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

            gender = sel;
          });

          $('#s_schoolIdUpdate').change(function() {
            var x = $('#s_schoolIdUpdate option:selected').text();
            $('#school_nameUpdate').val(x);
          });

          $('#s_lessonIdUpdate').change(function() {
            var x = $('#s_lessonIdUpdate option:selected').text();
            $('#lesson_nameUpdate').val(x);
          });

          $(document).ready(function(){

            console.log("Javascript is running...");



            $('.modal').on('shown.bs.modal', function() {
              $(this).find('[autofocus]').focus();
              });

            //REGISTER STUDENT
            $('#registerStudent').click(function(){

              var warning = "";
              var isOk = true;
              $('#resultRegister').empty();
              $('#resultRegister').removeClass();



              var s_name = $('#s_name').val();
              var s_id = $('#s_id').val();
              var b_day = $('#b_day').val();
              var b_month = $('#b_month').val();
              var b_year = $('#b_year').val();
              var s_phone = $('#s_phone').val();
              var s_classId = $('#s_classId').val();
              var s_schoolId = $('#s_schoolId').val();
              var s_sclass = $('#s_sclass').val();
              var s_disease = $('#s_disease').val();

              var p1_relation = $('#p1_relation').val();
              var p1_name = $('#p1_name').val();
              var p1_job = $('#p1_job').val();
              var p1_phone = $('#p1_phone').val();
              var p1_email = $('#p1_email').val();

              var p2_relation = $('#p2_relation').val();
              var p2_name = $('#p2_name').val();
              var p2_job = $('#p2_job').val();
              var p2_phone = $('#p2_phone').val();
              var p2_email = $('#p2_email').val();

              if (s_name == ""){
                warning += "Enter a student name<br>";
                isOk = false;
              }
              if (s_id == ""){
                warning += "Enter a student Id Number<br>";
                isOk = false;
              }

              if (s_classId == "0"){
                warning += "Select ELA class<br>";
                isOk = false;
              }
              if (s_sclass == "0"){
                warning += "Select school class<br>";
                isOk = false;
              }
              if (s_schoolId == "0"){
                warning += "Select school<br>";
                isOk = false;
              }

              if ((b_day == "0") || (b_month == "0") || (b_year == "0")){
                warning += "Select birthday<br>";
                isOk = false;
              }

              if (s_phone == ""){
                warning += "Enter phone number<br>";
                isOk = false;
              }

              if(isOk){

                //register STUDENT
                $.ajax({
                  url:"functions/addStudent.php",
                  method: "POST",
                  data:{u_id:u_id,
                        s_name:s_name,
                        s_id:s_id,
                        b_day:b_day,
                        b_month:b_month,
                        b_year:b_year,
                        s_phone:s_phone,
                        s_classId:s_classId,
                        s_sclass:s_sclass,
                        s_schoolId:s_schoolId,
                        s_disease:s_disease,
                        s_gender:gender
                        },
                  success:function(data){

                      $('#resultRegister').addClass("alert alert-success mt-3");
                      $('#resultRegister').html(data);

                  }
                });

          setTimeout(function(){
                //register 1. parent if inputs are filled
                if ((p1_relation != '0') && (p1_name != '') && (p1_job != '') && (p1_phone != '') && (p1_email != '')){

                  $.ajax({
                    url:"functions/addParent.php",
                    method: "POST",
                    data:{u_id:u_id,
                          s_id:s_id,
                          name:p1_name,
                          job:p1_job,
                          phone:p1_phone,
                          email:p1_email,
                          relation:p1_relation
                        },
                    success:function(data){
                      $('#resultParent1').html(data);
                      console.log("php addparent called");
                    }
                  }); //ajax

                }

                //register 2. parent if inputs are filled
                if ((p2_relation != '0') && (p2_name != '') && (p2_job != '') && (p2_phone != '') && (p2_email != '')){
                  //register
                  $.ajax({
                    url:"functions/addParent.php",
                    method: "POST",
                    data:{u_id:u_id,
                          s_id:s_id,
                          name:p2_name,
                          job:p2_job,
                          phone:p2_phone,
                          email:p2_email,
                          relation:p2_relation
                        },
                    success:function(data){
                      $('#resultParent2').html(data);
                      console.log("php addparent called");
                    }
                  }); //ajax
                }
          },1000);



                //everything will be empy after succesfull
              }else{
                $('#resultRegister').addClass("alert alert-warning mt-3");
                $('#resultRegister').append("<strong>Warning!</strong><br>" + warning);
              }
            }); //onclick


            /*MODAL LESSON SETTINGS OPERATIONS
            */
            //add new lesson to database
            $('#addLesson').click(function(){
              console.log("Add Lesson click");
              var lessonName = $('#lesson_name').val();

              $('#resultLesson').empty();
              $('#resultLesson').removeClass();

              if(lessonName != ''){
                $.ajax({
                  url:"functions/addLesson.php",
                  method: "POST",
                  data:{u_id:u_id, lesson_name:lessonName},
                  success:function(data){
                    $('#resultLesson').html(data);
                    $('#lesson_name').val('');
                    console.log(lessonName + " added to database");

                    updateLessonSelectBox();
                  }
                });
              }//if
              else{
                $('#resultLesson').addClass("alert alert-warning mt-3");
                $('#resultLesson').append("<strong>Please enter a lesson name!</strong>");
              }
            });

            //remove lesson from database
            $('#removeLesson').click(function(){

              $('#resultLessonRemove').empty();
              $('#resultLessonRemove').removeClass();

              console.log("Remove Lesson click");
              var lessonId = $('#s_lessonIdRemove').val();
              if(lessonId != '0'){
                $.ajax({
                  url:"functions/removeLesson.php",
                  method: "POST",
                  data:{lesson_id:lessonId},
                  success:function(data){
                    $('#resultLessonRemove').html(data);
                    console.log(lessonId + " removed from database");

                    updateLessonSelectBox();
                  }
                });
            }//if
            else{
              $('#resultSchoolRemove').addClass("alert alert-warning mt-3");
              $('#resultSchoolRemove').append("<strong>Please select school!</strong>");
            }
            });


            //update lesson
            $('#updateLesson').click(function(){
              console.log("Update Lesson click");

              $('#resultLessonRemove').empty();
              $('#resultLessonRemove').removeClass();

              var lessonId = $('#s_lessonIdUpdate').val();
              var newName = $('#lesson_nameUpdate').val();
              if(lessonId != '0'){
                $.ajax({
                  url:"functions/updateLesson.php",
                  method: "POST",
                  data:{lesson_id:lessonId,
                        new_name:newName},
                  success:function(data){
                    $('#resultLessonUpdate').removeClass();
                    $('#resultLessonUpdate').html(data);
                    console.log(lessonId + " updated");

                    updateLessonSelectBox();
                  }
                });
            }//if
            else{
              $('#resultLessonUpdate').addClass("alert alert-warning mt-3");
              $('#resultLessonUpdate').append("<strong>Please select a lesson!</strong>");
            }
            });


            /*MODAL SCHOOL SETTINGS OPERATIONS
            */
            //add new school to database
            $('#addSchool').click(function(){
              console.log("Add School click");
              var schoolName = $('#school_name').val();

              $('#resultSchool').empty();
              $('#resultSchool').removeClass();

              if(schoolName != ''){
                $.ajax({
                  url:"functions/addSchool.php",
                  method: "POST",
                  data:{u_id:u_id, school_name:schoolName},
                  success:function(data){
                    $('#resultSchool').html(data);
                    $('#school_name').val('');
                    console.log(schoolName + " added to database");

                    updateSchoolSelectBox();
                  }
                });
              }//if
              else{
                $('#resultSchool').addClass("alert alert-warning mt-3");
                $('#resultSchool').append("<strong>Please enter a school name!</strong>");
              }
            });

            //remove school from database
            $('#removeSchool').click(function(){

              $('#resultSchoolRemove').empty();
              $('#resultSchoolRemove').removeClass();

              console.log("Remove School click");
              var schoolId = $('#s_schoolIdRemove').val();
              if(schoolId != '0'){
                $.ajax({
                  url:"functions/removeSchool.php",
                  method: "POST",
                  data:{school_id:schoolId},
                  success:function(data){
                    $('#resultSchoolRemove').html(data);
                    console.log(schoolId + " removed from database");

                    updateSchoolSelectBox();
                  }
                });
            }//if
            else{
              $('#resultSchoolRemove').addClass("alert alert-warning mt-3");
              $('#resultSchoolRemove').append("<strong>Please select school!</strong>");
            }
            });


            //update school
            $('#updateSchool').click(function(){
              console.log("Update School click");

              $('#resultSchoolRemove').empty();
              $('#resultSchoolRemove').removeClass();

              var schoolId = $('#s_schoolIdUpdate').val();
              var newName = $('#school_nameUpdate').val();
              if(schoolId != '0'){
                $.ajax({
                  url:"functions/updateSchool.php",
                  method: "POST",
                  data:{school_id:schoolId,
                        new_name:newName},
                  success:function(data){
                    $('#resultSchoolUpdate').removeClass();
                    $('#resultSchoolUpdate').html(data);
                    console.log(schoolId + " updated");

                    updateSchoolSelectBox();
                  }
                });
            }//if
            else{
              $('#resultSchoolUpdate').addClass("alert alert-warning mt-3");
              $('#resultSchoolUpdate').append("<strong>Please select school!</strong>");
            }
            });

            /*MODAL CLASS SETTINGS OPERATIONS
            */
            //add new class to database
            $('#addClass').click(function(){
              console.log("Add Class click");
              var className = $('#class_name').val();
              var classCap = $('#class_capacity').val();

              $('#resultClass').empty();
              $('#resultClass').removeClass();

              if((className != '') && (classCap != '') && (classCap > '0')){
                $.ajax({
                  url:"functions/addClass.php",
                  method: "POST",
                  data:{u_id:u_id, class_name:className,
                        class_cap:classCap},
                  success:function(data){
                    $('#resultClass').html(data);
                    $('#class_name').val('');
                    $('#class_capacity').val('');
                    console.log(className + " class added to database");

                    updateClassSelectBox();
                  }
                });
              }//if
              else{
                $('#resultClass').addClass("alert alert-warning mt-3");
                $('#resultClass').append("<strong>Please fill properly!</strong>");
              }
            });

            //update class fromdatabase
            $('#updateClass').click(function(){
              console.log("Update Class click");
              var classId = $('#s_classIdUpdate').val();
              var className = $('#class_nameUpdate').val();
              var classCap = $('#class_capacityUpdate').val();

              $('#resultClassUpdate').empty();
              $('#resultClassUpdate').removeClass();

              if((className != '') && (classCap != '') && (classId != '0')){
                $.ajax({
                  url:"functions/updateClass.php",
                  method: "POST",
                  data:{class_id:classId,
                        class_name:className,
                        class_cap:classCap},
                  success:function(data){
                    $('#resultClassUpdate').html(data);
                    $('#class_nameUpdate').val('');
                    $('#class_capacityUpdate').val('');
                    console.log(className + " class updated");

                    updateClassSelectBox();
                  }
                });
              }//if
              else{
                $('#resultClassUpdate').addClass("alert alert-warning mt-3");
                $('#resultClassUpdate').append("<strong>Please give info!</strong>");
              }
            });

            //remove class from database
            $('#removeClass').click(function(){

              $('#resultClassRemove').empty();
              $('#resultClassRemove').removeClass();

              console.log("Remove Class click");
              var classId = $('#s_classIdRemove').val();
              if(classId != '0'){
                $.ajax({
                  url:"functions/removeClass.php",
                  method: "POST",
                  data:{class_id:classId},
                  success:function(data){
                    $('#resultClassRemove').html(data);
                    console.log("Class removed from database");

                    updateClassSelectBox();
                  }
                });
            }//if
            else{
              $('#resultClassRemove').addClass("alert alert-warning mt-3");
              $('#resultClassRemove').append("<strong>Please select class!</strong>");
            }
            });





          }); //ready

          //lesson selectbox update function
          function updateLessonSelectBox(){
            $.ajax({
              url:"functions/loadLessonSb.php",
              method:"POST",
              data:{u_id:u_id},
              success:function(data){
                $('#s_lessonIdUpdate').html(data);
                $('#s_lessonIdRemove').html(data);
                console.log("Lesson selectboxs are updated");
              }
            });
          }//function

          //school selectbox update function
          function updateSchoolSelectBox(){
            $.ajax({
              url:"functions/loadSchoolSb.php",
              method:"POST",
              data:{u_id:u_id},
              success:function(data){
                $('#s_schoolId').html(data);
                $('#s_schoolIdUpdate').html(data);
                $('#s_schoolIdRemove').html(data);
                console.log("School selectboxs are updated updated");
              }
            });
          }//function

          //class selectbox update function
          function updateClassSelectBox(){
            $.ajax({
              url:"functions/loadClassSb.php",
              method:"POST",
              data:{u_id:u_id},
              success:function(data){
                $('#s_classId').html(data);
                $('#s_classIdUpdate').html(data);
                $('#s_classIdRemove').html(data);
                console.log("Class selectboxs are updated updated");
              }
            });
          }//function

</script>

</body>
</html>
