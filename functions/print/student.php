<?php

  require_once '../../core/init.php';

  global $connect;

  $id = $_GET['id'];


  $sql = "SELECT * FROM student s, school sc WHERE s.id='$id' AND s.s_schoolId=sc.school_id";

  $result = mysqli_query($connect, $sql);



      while($row = mysqli_fetch_array($result)){

 ?>

<!DOCTYPE html>
<html>
<head>

  <title>Student Info</title>

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

  <link rel="stylesheet" href="../../css/card.css">
  <link rel="stylesheet" href="../../css/printPayment.css">

  <style>
      .bgLogo {
      position: relative;
      z-index: 1;
      }

      .bgLogo:before {
        content: "";
        position: absolute;
        z-index: -1;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: url("../../logo/<?php echo getLogo($row['u_id'])?>") center center;
        opacity: .4;
      }

    @media print{

    }

  </style>
</head>
<body>


    <div class="printedArea">
     <div class="row">
       <div class="col-8 text-left">
         <img src=../../logo/ela_long.jpg style="height:120px; width:auto"></img>
         <h5 class="mt-4 ml-2"><strong>Student :</strong> <?php echo $row['s_name']?></h5>
       </div>
       <div class="col-4 text-right">
         <img class="img-thumbnail studentImage" src="../../uploads/<?php echo $row['s_image']?>">
       </div>
     </div>
     <div class="row">
       <div class="col-12 text-center">
       </div>
     </div>
     <div class="row m-2">
       <table class="table table-sm table-hover">
         <tr>
           <th>TC</th>
           <td><?php echo $row['s_id']; ?></td>
         </tr>
         <tr>
           <th>School</th>
           <td><?php echo $row['school_name']; ?><span class="badge badge-pill badge-primary ml-2"><?php echo $row['s_sclass']; ?>. year</span></td>
         </tr>
         <tr>
           <th>Birthday</th>
           <td><?php echo $row['s_birthday']; ?></td>
         </tr>
         <tr>
           <th>Disease</th>
           <td><?php echo $row['s_disease']; ?></td>
         </tr>
         <tr>
           <th class="small">Registered</th>
           <td class="small"><?php echo $row['s_registerDate']; ?></td>
         </tr>
       </table>

       <table class="table table-sm table-hover table-responsive-md table-warning" style="border-radius:25px">

           <?php


             $student = $row['id'];
             $sql1 = "SELECT * FROM student s, parent p, studentParent sP  WHERE s.id='$student' AND s.s_id=sP.s_id and p.p_id=sP.p_id";
             $result1 = mysqli_query($connect, $sql1) or die("MySQL error: " . mysqli_error($connect) . "<hr>\nQuery: $sql1");
             ?>
             <tbody>

             <?php
             while ($row1 = mysqli_fetch_array($result1)) {

            ?>
           <tr>
             <td><span class="badge badge-pill badge-success"><?php echo $row1['p_relation']?></span></td>
             <td><?php echo $row1['p_name']?></td>
             <td>
               <span class="badge badge-pill badge-warning"><?php echo $row1['p_job']?></span>
             </td>
             <td><?php echo $row1['p_email']?></td>
             <td><?php echo $row1['p_phone']; ?></td>
           </tr>
           </tbody>

         <?php }
         ?>


         </table>
     </div>

<?php

}//while

 ?>
</div>
</div>
   <script>

   window.onload = function(e){
      window.print();
    }

   </script>
</body>
</html>
