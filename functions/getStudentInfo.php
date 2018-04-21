<?php

  require_once '../core/init.php';

  global $connect;

  //$s_id = $_POST['s_id'];
  $s_id = $_POST['s_id'];
  $u_id = $_POST['u_id'];

  $sql = "SELECT id, DAY(s_birthday) as day, MONTH(s_birthday) as month, YEAR(s_birthday) as year, s_id, s_name, s_schoolId, s_sclass, s_phone, s_disease, s_classId, s_registerDate, s_gender, s_status, s_image, class_id, class_name, school_name, school_id FROM student s, class c, school sc WHERE s.s_id='$s_id' AND s.u_id='$u_id' AND s.s_classId=c.class_id AND s.s_schoolId=sc.school_id";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {

?>


<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"><?php echo $row['s_name'];?></h4>
  <?php if($row['s_status'] == '1'){
    echo "<button value='" . $row['s_id'] . "' type='button' class='btn btn-outline-danger btn-sm ml-2' id='btnInactivateStudents'>Inactivate</button>";
  } else{
    echo "<button value='" . $row['s_id'] . "' type='button' class='btn btn-outline-success btn-sm ml-2' id='btnActivateStudents'>Activate</button>";
  }?>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>


<!-- Modal body -->
<div class="modal-body" >

  <form enctype="multipart/form-data" id="fupForm" >
   <div class="row">
     <div class="form-group col-md-4">
       <label for="s_name">Student Name:</label>
       <input type="text" class="form-control" autocomplete="off" id="s_name" name="s_name" value="<?php echo $row['s_name']?>">
     </div>
     <div class="form-group col-md-4">
       <label for="s_id">Id Number:</label>
       <input type="number" class="form-control" autocomplete="off" name="s_id" id="s_id" value="<?php echo $row['s_id']?>">
    </div>
    <div class="form-group col-md-4">
            <div class="form-group">
               <label for="file">Select Image</label>
               <input type="file" accept="image/*" class="form-control" id="file" name="file"/>
           </div>
           <input type="submit" name="submit" class="btn btn-danger submitBtn" value="SAVE"/>
      </div>
      </div>
    </form>



 <div class="form-group">
   <label for="birthday">Birthday:</label>
     <div class="row" name="birthday">
         <div class="form-group col-md-2">
           <select class="form-control" name="b_day" id="b_day">
             <option selected hidden value="<?php echo $row['day']?>"><?php echo $row['day']?></option>
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
           <option selected hidden value="<?php echo $row['month']?>"><?php echo $row['month']?></option>
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
           <option selected hidden value="<?php echo $row['year']?>"><?php echo $row['year']?></option>
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
     <input type="text" class="form-control" autocomplete="off" value="<?php echo $row['s_phone']?>"name="s_phone" id="s_phone">
   </div>
   <div class="form-group col-md-3">
     <label for="s_classId">Ela class:</label>
     <select class="form-control" name="s_classId" id="s_classId">
       <option selected hidden value="<?php echo $row['s_classId']?>"><?php echo $row['class_name']?></option>
       <?php echo loadClassSb($u_id);?>
     </select>
   </div>

 </div>

 <div class="row">
 <div class="input-group col-md-8 my-2">
   <div class="input-group-prepend">
     <span class="input-group-text" id="">Education </span>
   </div>
   <select class="form-control" id="s_schoolId" name="s_schoolId">
     <option selected hidden value="<?php echo $row['s_schoolId']?>"><?php echo $row['school_name']?></option>
     <?php echo loadSchoolSb($u_id);?>
   </select>
   <select class="form-control col-md-3" name="s_sclass" id="s_sclass">
     <option selected hidden value="<?php echo $row['s_sclass']?>"><?php echo $row['s_sclass']?></option>
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
 </div>



 <div class="row mt-2">
 <div class="form-group col-md-4">
   <label for="s_disease">Any Disaese:</label>
   <input type="text" class="form-control" id="s_disease" autocomplete="off" name="s_disease" value="<?php echo $row['s_disease']?>">
 </div>

 </div>

 <div class="row">

 <div class="col-sm-12 text-center">
       <button id="updateStudent" value="<?php echo $row['s_id'] ;?>" type="button" class="btn btn-success">Update Info</button>
     </div>
</div>

<input type="image" class="searchImage printPayment" src="icon/print.png" value="functions/print/student.php?id=<?php echo $row['id']?>" alt="print student"></input>
</div>


<script type="text/javascript" src="jquery/printThis.js"></script>

 <script>

 $('.printPayment').click(function(){
   var link = $(this).val();
   window.open(link, 'name', 'width=900, height=600');
 });

$(document).ready(function(e){


 $("#fupForm").on('submit', function(e){
     e.preventDefault();
     $.ajax({
         type: 'POST',
         url: 'functions/uploadImage.php',
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData:false,

     });

     setTimeout(function(){
       $('#btnSearchStudent').click();
   },1000);
 });

 //file type validation
 $("#file").change(function() {
     var file = this.files[0];
     var imagefile = file.type;
     var match= ["image/jpeg","image/png","image/jpg"];
     if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
         alert('Please select a valid image file (JPEG/JPG/PNG).');
         $("#file").val('');
         return false;
     }
     console.log('change');
 });
 });

var gender = <?php echo $row['s_gender']?>;
var id = <?php echo $row['id']?>;
var s_id = <?php echo $row['s_id']?>;
var u_id = <?php echo $u_id;?>;
if(gender =='0'){
  $('a[data-toggle="happy"]').not('[data-title="0"]').removeClass('active').addClass('notActive');
  $('a[data-toggle="happy"][data-title="0"]').removeClass('notActive').addClass('active');
}
 $('#radioBtn a').on('click', function(){
   var sel = $(this).data('title');
   var tog = $(this).data('toggle');
   $('#'+tog).prop('value', sel);

   $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
   $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

   gender = sel;

 });
 //update student information
 $('#updateStudent').click(function(){


   var s_id = $(this).val();
   console.log('clicked to update info of ' + s_id + ' of ' + u_id + ' ' + id);

   var warning = "";
   var isOk = true;
   $('#resultUpdate').empty();
   $('#resultUpdate').removeClass();


   var s_name = $('#s_name').val();
   var s_idNew = $('#s_id').val();
   var b_day = $('#b_day').val();
   var b_month = $('#b_month').val();
   var b_year = $('#b_year').val();
   var s_phone = $('#s_phone').val();
   var s_classId = $('#s_classId').val();
   var s_schoolId = $('#s_schoolId').val();
   var s_sclass = $('#s_sclass').val();
   var s_disease = $('#s_disease').val();


   if (s_name == ""){
     warning += "Enter a student name<br>";
     isOk = false;
   }
   if (s_idNew == ""){
     warning += "Enter a student Id Number<br>";
     isOk = false;
   }

   if (s_phone == ""){
     warning += "Enter phone number<br>";
     isOk = false;
   }

   //update STUDENT
   if(isOk){
     $.ajax({
       url:"functions/updateStudent.php",
       method: "POST",
       data:{id:id,
            s_id:s_id,
            u_id:u_id,
              s_idNew:s_idNew,
             s_name:s_name,
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
           $('#resultUpdate').addClass("alert alert-success mt-3");
           $('#resultUpdate').html(data);

           updateClassSelectBox();

           $.ajax({
               url:"functions/getStudentInfo.php",
               method: "POST",
               data:{u_id:u_id, s_id:s_idNew},
               success:function(data){
                 $('#studentInfoModal').html(data);
                 console.log("Student info fetched");

               }
             });


           $('#btnSearchStudent').click();
       }
 });
}else{
 $('#resultUpdate').addClass("alert alert-warning mt-3");
 $('#resultUpdate').append("<strong>Warning!</strong><br>" + warning);
}
});

//class selectbox update function
function updateClassSelectBox(){
  $.ajax({
    url:"functions/loadClassSb.php",
    method:"POST",
    data:{u_id:u_id},
    success:function(data){
      $('#studentsByClassSb').empty();
      $('#studentsByClassSb').html(data);
      $('#studentsByClassSb').append('<option selected value="0">All Students</option>');
      $('#studentsByClassSb').append('<option value="10000">Inactive Students</option>');
      console.log("Class selectbox are updated");
    }
  });
}//function

$('#btnInactivateStudents').click(function(){
  var s_id = $(this).val();

  $.ajax({
    url:"functions/inactivateStudent.php",
    method:"POST",
    data:{s_id:s_id,u_id:u_id},
    success:function(data){
      $('#resultUpdate').empty();

      $('#resultUpdate').removeClass();
      $('#resultUpdate').html(data);

	updateClassSelectBox();

      $.ajax({
          url:"functions/getStudentInfo.php",
          method: "POST",
          data:{u_id:u_id, s_id:s_id},
          success:function(data){
            $('#studentInfoModal').html(data);
            console.log("Student info fetched");

          }
        });


      $('#btnSearchStudent').click();
    }
  });

});


$('#btnActivateStudents').click(function(){
  var s_id = $(this).val();

  $.ajax({
    url:"functions/activateStudent.php",
    method:"POST",
    data:{s_id:s_id,u_id:u_id},
    success:function(data){
      $('#resultUpdate').empty();

      $('#resultUpdate').removeClass();
      $('#resultUpdate').html(data);

	updateClassSelectBox();
      $.ajax({
          url:"functions/getStudentInfo.php",
          method: "POST",
          data:{u_id:u_id, s_id:s_id},
          success:function(data){
            $('#studentInfoModal').html(data);
            console.log("Student info fetched");

          }
        });


      $('#btnSearchStudent').click();
    }
  });

});




 </script>
<?php } ?>
