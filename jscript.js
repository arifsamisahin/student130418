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

    var u_id = $(this).val();

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
              s_disease:s_disease
              },
        success:function(data){

            $('#resultRegister').addClass("alert alert-success mt-3");
            $('#resultRegister').html(data);

        }
      });

      //register 1. parent if inputs are filled
      if ((p1_relation != '0') && (p1_name != '') && (p1_job != '') && (p1_phone != '') && (p1_email != '')){
        $.ajax({
          url:"functions/addParent.php",
          method: "POST",
          data:{
                s_id:s_id,
                name:p1_name,
                job:p1_job,
                phone:p1_phone,
                email:p1_email,
                relation:p1_relation
              },
          success:function(data){
            $('#resultParent1').html(data);
            console.log("1. parent registered");
          }
        }); //ajax

      }

      //register 2. parent if inputs are filled
      if ((p2_relation != '0') && (p2_name != '') && (p2_job != '') && (p2_phone != '') && (p2_email != '')){
        //register
        $.ajax({
          url:"functions/addParent.php",
          method: "POST",
          data:{
                s_id:s_id,
                name:p2_name,
                job:p2_job,
                phone:p2_phone,
                email:p2_email,
                relation:p2_relation
              },
          success:function(data){
            $('#resultParent2').html(data);
            console.log("2. parent registered");
          }
        }); //ajax
      }



      //everything will be empy after succesfull
    }else{
      $('#resultRegister').addClass("alert alert-warning mt-3");
      $('#resultRegister').append("<strong>Warning!</strong><br>" + warning);
    }
  }); //onclick


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
        data:{school_name:schoolName},
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

    if((className != '') && (classCap != '')){
      $.ajax({
        url:"functions/addClass.php",
        method: "POST",
        data:{class_name:className,
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
      $('#resultClass').append("<strong>Please give an info!</strong>");
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

//school selectbox update function
function updateSchoolSelectBox(){
  $.ajax({
    url:"functions/loadSchoolSb.php",
    method:"GET",
    dataType:"html",
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
    method:"GET",
    dataType:"html",
    success:function(data){
      $('#s_classId').html(data);
      $('#s_classIdUpdate').html(data);
      //$('#s_schoolIdRemove').html(data);
      console.log("Class selectboxs are updated updated");
    }
  });
}//function
