<?php

  require_once '../core/init.php';

  global $connect;

  $t_id = $_POST['id'];
  $u_id = $_POST['u_id'];

  $s_id = $_POST['student_id'];
  $s_name = $_POST['student_name'];
  $date = $_POST['date'];

  $today = date('Y-m-d');


  $sqlDate = "";

  switch($date){
    case "Today":
        $sqlDate = " DATE(r.rC_time) = '$today' AND";
        break;
    case "This week":
        //$sqlDate = " YEARWEEK(r.rC_time,1) = YEARWEEK(CURDATE()) AND";
        $sqlDate = " YEARWEEK(r.rC_time - INTERVAL 1 DAY)= YEARWEEK(CURDATE()) AND";
        break;
    case "This month":
        $sqlDate = " MONTH(r.rC_time)= MONTH('$today') AND YEAR(r.rC_time)= YEAR('$today') AND";
        break;
    case "Last week":
        $sqlDate = " YEARWEEK(r.rC_time,1) = YEARWEEK(CURDATE()) AND";
        //$sqlDate = " YEARWEEK(r.rC_time,1) >= YEARWEEK(CURDATE())-1 AND YEARWEEK(r.rC_time,1) != YEARWEEK(CURDATE()) AND YEARWEEK(r.rC_time,1) <= YEARWEEK(CURDATE()) AND";
        break;
    case "Last month":
        $sqlDate = " MONTH(r.rC_time)= MONTH('$today')-1 AND YEAR(r.rC_time)= YEAR('$today') AND";
        break;
    case "This year":
        $sqlDate = " YEAR(r.rC_time)= YEAR('$today') AND";
        break;
    case "Last year":
        $sqlDate = " YEAR(r.rC_time)= YEAR('$today')-1 AND";
        break;
    case "All the time":
        $sqlDate = "";
        break;
    default:
        $sqlDate = " DATE(r.rC_time) = '$today' AND";
  }

      $sqlTeacher = "";
    if($t_id != "0"){
      $sqlTeacher = " r.added_id='$t_id' AND";
    }else{
      $sqlTeacher = "";
    }


    $sql = "";
    $sql1 = "";
  if($s_name == ''){

    if($s_id == 'All'){
      $sql = "SELECT *, r.id as r_id, s.id as student_idP FROM rollCall r, student s, lesson l, teacher t WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND " . $sqlTeacher . " t.id=r.added_id ORDER BY rc_time DESC, s_name";
      $sql1 = "SELECT *, COUNT(*) as almasi_gereken , SUM(r.rC_status) as katildigi, SUM(r.recover) as telafi FROM rollCall r, lesson l, teacher t, student s WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND " . $sqlTeacher . " t.id=r.added_id GROUP BY lesson_name";
      $sql2 = "SELECT * FROM rollCall r, student s WHERE " . $sqlDate . " " . $sqlTeacher . " " . " s.id=r.student_id AND r.u_id='$u_id' GROUP BY rC_time";
    }else if($s_id == 'Inactive'){
      $sql = "SELECT *, s.id as student_idP, r.id as r_id FROM rollCall r, student s, lesson l, teacher t WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND t.id=r.added_id AND " . $sqlTeacher . "  s.s_status='0' ORDER BY rc_time DESC, s_name";
      $sql1 = "SELECT *, COUNT(*) as almasi_gereken , SUM(r.rC_status) as katildigi, SUM(r.recover) as telafi FROM rollCall r, lesson l, teacher t, student s WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND t.id=r.added_id AND " . $sqlTeacher . "  s.s_status='0' GROUP BY lesson_name";
      $sql2 = "SELECT * FROM rollCall r, student s WHERE " . $sqlDate . " s.id=r.student_id AND " . $sqlTeacher . " s.s_status='0' AND r.u_id='$u_id' GROUP BY rC_time";
    }else{
      $sql = "SELECT *, s.id as student_idP, r.id as r_id FROM rollCall r, student s, lesson l, teacher t WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND t.id=r.added_id AND " . $sqlTeacher . " s.id='$s_id' ORDER BY rc_time DESC";
      $sql1 = "SELECT *, COUNT(*) as almasi_gereken , SUM(r.rC_status) as katildigi, SUM(r.recover) as telafi FROM rollCall r, lesson l, teacher t, student s WHERE " . $sqlDate . " r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND t.id=r.added_id AND " . $sqlTeacher . " s.id='$s_id' GROUP BY lesson_name";
      $sql2 = "SELECT * FROM rollCall r, student s WHERE " . $sqlDate . " s.id=r.student_id AND " . $sqlTeacher . " s.s_status='1' AND s.id='$s_id' AND r.u_id='$u_id' GROUP BY rC_time";
    }

  }else{
      $sql = "SELECT *, s.id as student_idP, r.id as r_id FROM rollCall r, student s, lesson l, teacher t WHERE " . $sqlDate . " s.s_name LIKE '%$s_name%' AND r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND " . $sqlTeacher . " t.id=r.added_id ORDER BY rc_time DESC, s_name";
      $sql1 = "SELECT *, COUNT(*) as almasi_gereken , SUM(r.rC_status) as katildigi, SUM(r.recover) as telafi FROM rollCall r, lesson l, teacher t, student s WHERE " . $sqlDate . " s.s_name LIKE '%$s_name%' AND r.u_id='$u_id' AND r.student_id=s.id AND l.lesson_id=r.lesson_id AND " . $sqlTeacher . " t.id=r.added_id GROUP BY lesson_name";
      $sql2 = "SELECT * FROM rollCall r, student s WHERE " . $sqlDate . " s.id=r.student_id AND " . $sqlTeacher . " s.s_name LIKE '%$s_name%' AND r.u_id='$u_id' GROUP BY rC_time";
  }


  $result = mysqli_query($connect, $sql);
  $result1 = mysqli_query($connect, $sql);

  $result2 = mysqli_query($connect, $sql2);
  $sayi = 0;
  while ($row2 = mysqli_fetch_array($result2)) {
    $sayi++;
  }

  if($sayi == 0)
    echo "<p>" . $date . " Total given lesson : Not yet </p>";
  else
    echo "<p>" . $date . " Total given lesson : " . $sayi  . " hours</p>";
 ?>

<table class="table table-hover table-responsive-md">
  <thead>
      <tr class="table-primary">
      <th></th>
      <th>Date</th>
      <?php if($t_id =="0")
            echo "<th>Teacher Name</th>";
      ?>
      <th>Name</th>
      <th>Lesson</th>
      <th>Status</th>
      <th>Process</th>
    </tr>
  </thead>
  <tbody>
  <?php

    $number = 1;
    $button = "";


    while ($row = mysqli_fetch_array($result)) {
  ?>


      <?php

        $recoverDate = date_create($row['recover_date']);
        if(($row['recover'] == '0') && ($row['rC_status'] == '0')){
          echo "<tr class='table-danger'>";
          $button = "<button value='" . $row['r_id'] . "' type='button' class='btn btnRecover btn-outline-danger btn-sm' data-toggle='modal' data-target='#recoverModal'>Recover </button>";
          $button .= " <button value='" . $row['r_id'] . "' type='button' class='btnUndoAbsent btn btn-outline-success btn-sm'>Undo</button>";
        }else if(($row['recover'] == '1') && ($row['rC_status'] == '0')){
          echo "<tr class='table-warning'>";
          $button = "<button class='btnRecover btn badge badge-success' data-toggle='modal' data-target='#recoverModal' value='" . $row['r_id'] ."'>" . $row['comment'] . " Recovered at<br>" . (date_format($recoverDate, 'd-m-Y')) . "</button>";
          $button .= " <button value='" . $row['r_id'] . "' type='button' class='btnUndoRecovered btn btn-outline-success btn-sm'>Undo</button>";
        }else if(($row['recover'] == '0') && ($row['rC_status'] == '1')){
          echo "<tr class='table-success'>";
          $button = "<button value='" . $row['r_id'] . "' type='button' class='btnUndo btn btn-outline-success btn-sm'>Undo</button>";
        }else{
          echo "<tr>";
          $button = "<button value='" . $row['r_id'] . "' type='button' class='btnUndo btn btn-outline-success btn-sm'>Undo</button>";
        }
      ?>
      <th scope="row"><?php echo $number;?></th>
      <td><?php echo $row['rC_time']?></td>
      <?php if($t_id == "0")
            echo "<td>" . $row['t_name'] . "</td>";
      ?>
      <td><?php echo $row['s_name']?></td>
      <td><?php echo $row['lesson_name'];

        ?></td>
      <td><?php if($row['rC_status'] == '1'){
                  echo "Attended<br>";
                }
                else{
                  //echo "Absent (" . $row['reason'] == '' ? '' : 'bos degil' .  ")<br>";
                  echo "Absent " . ($row['reason'] == '' ? "<button class='btnGetReason btn badge badge-secondary' data-toggle='modal' data-target='#reasonModal' value='" . $row['r_id'] ."'>reason</button>" : "<button class='btnGetReason btn badge badge-primary' data-toggle='modal' data-target='#reasonModal' value='" . $row['r_id'] . "'>" .  $row['reason']. "</button>") . "<br>";
                }
                  $new =  date_create($row['rC_time']);
                  if(($row['rC_status'] == '0') && ($row['recover'] == '0') && ( $today == date_format($new, "Y-m-d"))){
                    echo "<a class='btn btn-warning btn-sm' href='sms:";
                    echo getStudentParentPhone($row['student_idP']);
                    echo "?body=Bugün öğrenciniz " . $row['s_name'] . " \"" . $row['lesson_name'] . "\" dersine katılmamıştır, bilgilerinize.. ";
                    echo getCompNameByStudent($row['student_idP']) ;
                    echo "'>Send SMS</a>";}

                  ?></td>
      <td class="text-right">
        <?php
          echo $button;

            if( $today == date_format($new, "Y-m-d")){
              echo " <button value='" . $row['r_id'] . "' type='button' class='btnDelete btn btn-outline-secondary btn-sm'>&times;</button>";

            }
         ?>

      </td>
    </tr>

    <?php
    ++$number;
    }?>

  </tbody>
</table>

    <?php



    $result1 = mysqli_query($connect, $sql1);

    $toplam_katildigi = 0;
    $toplam_telafi = 0;
    $toplam_almasi_gereken = 0;
    $toplam_sonuc_aldigi = 0;

?>

  <div class="row">
    <div class="col-md-6">
    </div>
    <div class="col-lg-6 text-right mt-2">

      <table class="table table-sm table-hover table-responsive-md">
      <thead>
        <tr>
          <h4><strong><?php echo $date ?> SUMMARY</strong></h4>
        </tr>
        <tr>
          <th>Lesson</th>
          <th>Must Taken</th>
          <th>Attended</th>
          <th>Recovered</th>
          <th>Total Taken</th>
          <th>Attendance Rate</th>
        </tr>
      </thead>
      <tbody>
        <?php

      while ($row1 = mysqli_fetch_array($result1)) {

        $sonuc_aldigi = $row1['telafi']+$row1['katildigi'];

        $toplam_katildigi += $row1['katildigi'];
        $toplam_telafi += $row1['telafi'];
        $toplam_almasi_gereken += $row1['almasi_gereken'];
        $toplam_sonuc_aldigi += $sonuc_aldigi;

  ?>
        <tr>
          <td><?php echo $row1['lesson_name']; ?></td>
          <td><?php echo $row1['almasi_gereken'] ;?></td>
          <td><?php echo $row1['katildigi'] ;?></td>
          <td><?php echo $row1['telafi'] ;?></td>
          <td><?php echo $sonuc_aldigi ;?></td>
          <td><?php echo "%" . round($sonuc_aldigi/($row1['almasi_gereken'])*100) ;?></td>
        </tr>


          <?php }?>

        <tr class="table-info">
          <td><strong>TOTAL</strong></td>
          <td><strong><?php echo $toplam_almasi_gereken ?></strong></td>
          <td><strong><?php echo $toplam_katildigi ?></strong></td>
          <td><strong><?php echo $toplam_telafi ?></strong></td>
          <td><strong><?php echo $toplam_sonuc_aldigi ?></strong></td>
          <td><strong><?php if($toplam_almasi_gereken == '0'){
            echo "0";
          }else{
            echo "%" . round($toplam_sonuc_aldigi/$toplam_almasi_gereken*100);
          } ?></strong></td>
        </tr>
      </tbody>
      </table>

    </div>
    </div>

    <!--REASON MODAL--->
    <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="reasonModalContent" class="modal-content">


        </div>
      </div>
    </div>

    <!--RECOVER MODAL--->
    <div class="modal fade" id="recoverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="recoverModalContent" class="modal-content">


        </div>
      </div>
    </div>


<script>





  $('.btnDelete').click(function(){

    var rC = $(this).val();

    if(confirm("Are you sure that you want to delete this record?")){
      deleteRc(rC);
    }

  });


  $('.btnUndo').click(function(){

    var rC = $(this).val();

    console.log("Undo clicked id : " + rC);

    $.ajax({
        url:"functions/rcUndo.php",
        method: "POST",
        data:{rC,rC
            },
        success:function(data){
          console.log("Undo success id : " + rC);
          getRcList();
        }
      });

  });

  $('.btnUndoAbsent').click(function(){

    var rC = $(this).val();

    console.log("UndoAbsent clicked id : " + rC);

    $.ajax({
        url:"functions/rcUndoAbsent.php",
        method: "POST",
        data:{rC,rC
            },
        success:function(data){
          console.log("Undo success id : " + rC);
          getRcList();
        }
      });

  });

  $('.btnUndoRecovered').click(function(){

    var rC = $(this).val();

    console.log("UndoRecovered clicked id : " + rC);

    $.ajax({
        url:"functions/rcUndoRecovered.php",
        method: "POST",
        data:{rC,rC
            },
        success:function(data){
          console.log("Undo success id : " + rC);
          getRcList();
        }
      });

  });


  $('.btnRecover').click(function(){

    var id = $(this).val();

    getRecover(id);
    /*$.ajax({
        url:"functions/rcRecover.php",
        method: "POST",
        data:{rC,rC
            },
        success:function(data){
          console.log("Recover success id : " + rC);
          getRcList();
        }
      });*/

  });

  $('.btnRecovered').click(function(){

    var rC = $(this).val();

    console.log("Recovered clicked id : " + rC);

    $.ajax({
        url:"functions/rcRecovered.php",
        method: "POST",
        data:{rC,rC
            },
        success:function(data){
          console.log("Recovered success id : " + rC);
          getRcList();
        }
      });

  });


  function deleteRc(id){
    $.ajax({
        url:"functions/rcDelete.php",
        method: "POST",
        data:{id:id},
        success:function(data){
          getRcList();
          console.log("record deleted succesfully");
        }
      });
  }


  $('.btnGetReason').click(function(){

    var id = $(this).val();
    getReason(id);

  });

  function getReason(id){

    $.ajax({
        url:"functions/rcReport/getAbsentReason.php",
        method: "POST",
        data:{id},
        success:function(data){
          $('#reasonModalContent').html(data);
          console.log(id + " reason fetched");
        }
    });
  }

  function getRecover(id){

    $.ajax({
        url:"functions/rcReport/getRecoverLesson.php",
        method: "POST",
        data:{id},
        success:function(data){
          $('#recoverModalContent').html(data);
          console.log(id + " fetched to recover");
        }
    });
  }

</script>
