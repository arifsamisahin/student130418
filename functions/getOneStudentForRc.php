<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $id = $_POST['id'];

  ?>


  <div class="modal-header">
          <h5 class="modal-title">Roll Call For one Student</h5>

        </div>
        <div class="modal-body">


          <div class="row justify-content-center my-3">
            <div class="col-md-4">
          <select class="form-control" id="studentId">
            <option hidden value="0">Select a Student</option>
            <?php echo loadStudentSb($u_id);?>
          </select>
        </div>
        </div>

          <div class="row justify-content-center my-3">
            <div class="col-md-4">
          <select class="form-control" id="lessonId">
            <option hidden value="0">Select a Lesson</option>
            <?php echo loadLessonSb($u_id);?>
          </select>
        </div>
        </div>

        <?php
          if($id == "0"){
            echo "<div class='row justify-content-center my-3'>" ;
                  echo  "<div class='col-md-4'>" ;
            echo "<select class='form-control' id='teacherId'><option hidden value='0'>Select a Teacher</option>" ;

            echo  loadTeacherSb($u_id) ;
            echo "</select>" ;
          echo "</div>" ;
          echo "</div>" ;
          }

         ?>


          <div class="row mt-3">

          <div class="col-sm-12 text-center">
            <label class="switch">
              <input id="cB" type="checkbox" checked>
              <span class="slider round"></span>
              </label>
          </div>

          <div class="col-md-12 text-center hide reason" id="div2">
            <div class="form-group">
              <input type="text" class="form-control" id="reason2" placeholder="Reason">
            </div>
          </div>
         </div>

          <div class="row mt-3">

          <div class="col-sm-12 text-center">
            <button id='btnSubmitRollCallOne' type='button' class='btn btn-success'>Get Attendance</button>
              </div>
         </div>

      </div>

  <script>

    $('#btnSubmitRollCallOne').click(function(){

      $('#clasRcResult').removeClass();
      $('#clasRcResult').empty();

      console.log("btnSubmitRollCallOne");

      var lessonid = $('#lessonId').val();
      var student_id = $('#studentId').val();
      var status = $('#cB').prop('checked');

      <?php
          if($id != '0'){
            echo "var teacherId = " . $id ;
          }else{
            echo "var teacherId = $('#teacherId').val();";
          }
       ?>


      console.log(teacherId + "-----------");

      var studentArray = new Array();
      studentArray.push(student_id);

      var students = JSON.stringify(studentArray);

      var degerArray = new Array();
      degerArray.push(status);

      var degerler = JSON.stringify(degerArray);

      var reasons = new Array();
      reasons.push($('#reason2').val());
      var nedenler = JSON.stringify(reasons);
      console.log(nedenler);


      if((lessonid=="0") || (student_id=="0") || (teacherId=="0")){
        $('#clasRcResult').addClass("alert alert-warning mt-3");
        $('#clasRcResult').append("<strong>Please select all the things!</strong>");
      }else{

        addRollCallToClassByTeacher(students, degerler, nedenler, teacherId, u_id, lessonid);

        console.log('user_id' + u_id);
        console.log('teacher_id' + teacherId);
        console.log('student id ' + students);
        console.log('lesson_id ' + lessonid);
        console.log('Status ' + degerler);
      }

    });

    $('#cB').change(function(){
      if($(this).prop('checked')){
        $('#div2').addClass('hide');
      }else{
        $('#div2').removeClass('hide');

      }
    });


  </script>
