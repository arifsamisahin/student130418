<?php

  require_once '../core/init.php';

  global $connect;

  $class_id = $_POST['class_id'];
  $id = $_POST['id'];
  $u_id = $_POST['u_id'];


  $sql1 = "SELECT class_name FROM class WHERE class_id='$class_id'";

  $result1 = mysqli_query($connect, $sql1);

  $class_name = "";

  while ($row1 = mysqli_fetch_array($result1)) {
    $class_name = $row1['class_name'];
  }
  ?>


  <div class="modal-header">
          <h5 class="modal-title">Roll Call For <?php echo $class_name; ?></h5>

        </div>
        <div class="modal-body">

          <?php
              if($id == 0){
                echo "<div class='row justify-content-center my-3'>
                  <div class='col-md-4'>
                <select class='form-control' id='teacherId'>
                  <option hidden value='0'>Select a Teacher</option>";
                  echo loadTeacherSb($u_id);
              echo  "</select>
              </div>
              </div>";
              }
           ?>



          <div class="row justify-content-center my-3">
            <div class="col-md-4">
          <select class="form-control" id="lessonId">
            <option hidden value="0">Select a Lesson</option>
            <?php echo loadLessonSb($u_id);?>
          </select>
        </div>
        </div>

          <ul class="list-group">

  <?php

  $sql = "SELECT * FROM student WHERE s_status='1' AND s_classId='$class_id'";

  $result = mysqli_query($connect, $sql);

?>


        <?php

          $rowNumber = 0;

          $students = array();
          while ($row = mysqli_fetch_array($result)) {

            $rowNumber++;

            array_push($students, $row['id']);
            ?>



              <li class="list-group-item d-flex justify-content-between align-items-center seffaf">

                <div class="col-mg-4 align-right">
                    <p><?php echo $row['s_name']?></p>
                  </div>

              <div class="col-mg-4 align-right mx-3">
                <label class="switch">
                  <input id="t<?php echo $row['id']?>" class="yoklama" type="checkbox" checked>
                  <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-mg-4 align-right hide reason" id="div<?php echo $row['id']?>">
                  <div class="form-group">
                    <input type="text" class="form-control" id="reason<?php echo $row['id']?>" placeholder="Reason">
                  </div>
                </div>
              </li>



             <?php

            }

            $jsonStudent = json_encode($students);

            ?>
          </ul>

          <div class="row mt-3">

          <div class="col-sm-12 text-center">
            <?php
                    if(countActiveStudentByClass($class_id) == '0'){
                      echo "<button id='btnSubmitRollCall' value='$id' type='button' class='btn btn-success' disabled>Get Attendance</button>";

                    }else{
                      echo "<button id='btnSubmitRollCall' value='$id' type='button' class='btn btn-success'>Get Attendance</button>";
                    }
           ?>

              </div>
         </div>

      </div>

      <script>

      var rowNumber = <?php echo $rowNumber?>;


          $('#btnSubmitRollCall').click(function(){

            var lesson_id = $('#lessonId').val();
            $('#clasRcResult').empty();
            $('#clasRcResult').removeClass();


            console.log("Total " + rowNumber + " students");

            var values = new Array();

            <?php
                for($i=0 ; $i<$rowNumber ; $i++){
                  echo "var t" . $i . " = $('#t" . $students[$i] . "').prop('checked');";
                  echo "values.push(t" . $i . ");";
                }
             ?>


             var degerler = JSON.stringify(values);
             console.log(degerler);

            var reasons = new Array();

            <?php
                for($i=0 ; $i<$rowNumber ; $i++){
                  echo "var reason" . $i . " = $('#reason" . $students[$i] . "').val();";
                  echo "reasons.push(reason" . $i . ");";
                }
             ?>

             var nedenler = JSON.stringify(reasons);
             console.log(reasons);

            var dataStudent = <?php echo $jsonStudent?>;
            var student = JSON.stringify(dataStudent);
            console.log(dataStudent);


            var id = $(this).val();

            if(id == 0){
              console.log("bu id degeri 0");
              id = $('#teacherId').val();
            }

            var lesson_id = $('#lessonId').val();

            console.log('btnSubmitRollCall clicked');
            console.log('Teacher id : ' + id);
            console.log('Lesson id : ' + lesson_id);





            if((lesson_id == '0') || (id == '0')){
              $('#clasRcResult').addClass("alert alert-warning mt-3");
              $('#clasRcResult').append("<strong>Please select something :)</strong>");
            }else{
              //insert roll call code here

              addRollCallToClassByTeacher(student, degerler, nedenler, id, u_id, lesson_id);



            }
          });



          $("input:checkbox").change(function() {
            var someObj = {};



            $("input:checkbox").each(function() {
              var cbId = $(this).attr('id');

              var divider = cbId.split('t');

              var reason = "div";



                if ($(this).is(":checked")) {
                    console.log(divider[1] + " " + $(this).prop('checked'));
                    console.log(reason.concat(divider[1]) + " " + $(this).prop('checked'));
                    var element = document.getElementById(reason.concat(divider[1]));

                    $(element).addClass('hide');

                } else {
                  console.log(cbId + " " + $(this).prop('checked'));
                  console.log(reason.concat(divider[1]) + " " + $(this).prop('checked'));

                  var element = document.getElementById(reason.concat(divider[1]));

                  $(element).removeClass('hide');


                }
            });

        });



      </script>
