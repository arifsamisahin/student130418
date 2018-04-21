<?php

  require_once '../core/init.php';

  $u_id = $_POST['u_id'];
  $classId = $_POST['class_id'];

        global $connect;



        if($classId == '0'){
          $sqlClass = " ";
          $active = "AND s.s_status='1' ";
        }else if($classId == '10000'){
          $active = "AND s.s_status='0' ";
          $sqlClass = " ";
        }else{
          $sqlClass = "AND s.s_classId='$classId' ";
          $active = "AND s.s_status='1' ";
        }

        $sql = "SELECT * FROM student s, class c, school sc  WHERE s.u_id='$u_id' AND s.s_classId=c.class_id AND s.s_schoolId=sc.school_id ";
        $sql .= $active ;
        $sql .= $sqlClass ;
        $sql .="ORDER BY s_name";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($result)) {
          ?>

          <?php
          if($row['s_status'] == '1'){
            echo "<table class='table table-hover table-info mb-0 mt-3'>";
          }else{
            echo "<table class='table table-hover table-danger mb-0 mt-3'>";
          }
              ?>

        <tbody>
          <tr data-toggle="collapse" data-target="#<?php echo $row['s_id']; ?>" aria-expanded="false" aria-controls="<?php echo $row['s_id']; ?>">
            <td><?php echo $row['s_name']; ?><span class="badge badge-pill badge-info ml-2"><?php echo $row['class_name']; ?></span></td>
            <td class="text-right"><a href="tel:<?php echo $row['s_phone'];?>"><img src="icon/phone.png" class="phoneIcon img-rounded mr-2" alt="phone icon"></a><?php echo $row['s_phone']; ?></td>
          </tr>
        </tbody>

      </table>

      <div id="<?php echo $row['s_id']; ?>" class="collapse p-3 mt-0" aria-labelledby="<?php echo $row['s_id']; ?>" data-parent="#container" style="background-color: rgba(255,255,255,0.5); border-bottom-right-radius:50px">
        <div class="row">

          <div class="col text-center mb-3">
            <img class="img-thumbnail studentImage" src="uploads/<?php echo $row['s_image']?>" alt="Student Profile Picture">
          </div>

          <div class="col-sm-10 mt-3">
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
                <td class="small"><?php echo $row['s_registerDate']; ?> <button value="<?php echo $row['s_id'] ;?>" type="button" class="updateInfo btn btn-outline-success btn-sm" data-toggle="modal" data-target="#updateStudentModal">Update Info</button></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <p class="pl-2"><strong>Parents</strong></p>
          </div>
        <div class="col-sm-6 text-right">
          <button value='<?php echo $row['s_id']?>' type='button' class='manageParent btn btn-outline-warning btn-sm pull right' data-toggle='modal' data-target='#addParentModal'><img class="parentIcon" src='icon/parent.png' alt="parent Icon"> Manage Parents</button>
        </div>
        </div>

        <table class="table table-sm table-hover table-responsive-md table-warning" style="border-radius:25px">

            <?php


              $student = $row['s_id'];
              $sql1 = "SELECT * FROM student s, parent p, studentParent sP  WHERE s.s_id='$student' AND s.u_id='$u_id' AND s.s_id=sP.s_id and p.p_id=sP.p_id";
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
              <td><a href="tel:<?php echo $row1['p_phone'];?>"><img src="icon/phone.png" class="img-rounded mr-2 phoneIcon" alt="Cinque Terre"></a><?php echo $row1['p_phone']; ?></td>
            </tr>
            </tbody>

          <?php }
          ?>


          </table>
        </div>



<?php } ?>
