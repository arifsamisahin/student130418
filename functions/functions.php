<?php
  function logged_in_employee() {
    if(isset($_SESSION['e_id'])) {
        return true;
    } else {
        return false;
    }
  }

  function employeeExists($e_email) {
    // global keyword is used to access a global variable from within a function
    global $connect;

    $sql = "SELECT * FROM employee WHERE e_email = '$e_email'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
  }

  function registerEmployee() {

    global $connect;

    $e_name = $_POST['e_name'];
    $e_surname = $_POST['e_surname'];
    $e_email = $_POST['e_email'];
    $e_phone = $_POST['e_phone'];
    $e_pass = $_POST['e_pass'];

    $sql = "INSERT INTO employee (e_email, e_pass, e_name, e_surname, e_phone) VALUES ('$e_email', '$e_pass', '$e_name', '$e_surname', '$e_phone')";
    $query = $connect->query($sql);
    if($query === TRUE) {

        $sql1 = "SELECT MAX(e_id) as a FROM employee";

        $result1 = $connect->query($sql1);

        if ($result1->num_rows > 0) {
            // output data of each row
            while($row = $result1->fetch_assoc()) {
                $max_e_id = $row["a"];
            }

        date_default_timezone_set("Europe/Istanbul");
        $day = date("d");
        $month = date("m");
        $year = date("y");

        $sql = "INSERT INTO startEnd (e_id, se_start, se_finish, se_day, se_month, se_year) VALUES ('$max_e_id', '00:00:00', '00:00:01', '$day', '$month', '$year')";
        $query = $connect->query($sql);

        if($query === TRUE) {
            return true;
          } else {
            return false;
          }

        } else {
          return false;
        }


      } else {
        return false;
      }



    $connect->close();
}

  function login_employee($e_email, $e_pass) {
    global $connect;
    $employeedata = employeedata($e_email);

    if($employeedata) {
        $sql = "SELECT * FROM employee WHERE e_email = '$e_email' AND e_pass = '$e_pass'";
        $query = $connect->query($sql);

        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    $connect->close();
  }

    function employeedata($e_email) {
      global $connect;
      $sql = "SELECT * FROM employee WHERE e_email = '$e_email'";
      $query = $connect->query($sql);
      $result = $query->fetch_assoc();
      if($query->num_rows == 1) {
          return $result;
      } else {
          return false;
      }

      $connect->close();

  }

  function not_logged_in_employee() {
    if(isset($_SESSION['e_id']) === FALSE) {
        return true;
    } else {
        return false;
    }
  }

  function getEmployeeDataByUserId($e_id) {
      global $connect;

      $sql = "SELECT * FROM employee WHERE e_id = $e_id";
      $query = $connect->query($sql);
      $result = $query->fetch_assoc();
      return $result;

      $connect->close();
  }

  function logout_employee() {
    if(logged_in_employee() === TRUE){
        // remove all session variable
        session_unset();

        // destroy the session
        session_destroy();

        header('location: login_employee.php');
    }
}

  function employees_exists_by_id($e_id, $e_email) {
    global $connect;

    $sql = "SELECT * FROM employee WHERE e_email = '$e_email' AND e_id != $e_id";
    $query = $connect->query($sql);
    if($query->num_rows >= 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
  }

  function updateEmployeeInfo($e_id) {
    global $connect;

    $e_name = $_POST['e_name'];
    $e_surname = $_POST['e_surname'];
    $e_email = $_POST['e_email'];
    $e_pass = $_POST['e_pass'];

    $sql = "UPDATE employee SET e_email = '$e_email', e_pass = '$e_pass', e_name = '$e_name', e_surname = '$e_surname' WHERE e_id = $e_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
}

  function setStartTime($e_id) {

    global $connect;

    date_default_timezone_set("Europe/Istanbul");
    $day = date("d");
    $month = date("m");
    $year = date("y");
    $time = date("H:i:s");

    $sql1 = "SELECT MAX(se_id) as a FROM startEnd WHERE e_id=$e_id";

    $result1 = $connect->query($sql1);

    if ($result1->num_rows > 0) {
        // output data of each row
        while($row = $result1->fetch_assoc()) {
            $max_time_id = $row["a"];
        }
    }

    $sql2 = "SELECT * FROM startEnd WHERE se_id = $max_time_id AND se_start!=se_finish";
    $result = $connect->query($sql2);

    if($result->num_rows > 0){
      $sql = "INSERT INTO startEnd (e_id, se_start, se_finish, se_day, se_month, se_year) VALUES ('$e_id', '$time', '$time', '$day', '$month', '$year')";
      $query = $connect->query($sql);
      if($query === TRUE) {
          return true;
        } else {
          return false;
        }
    }//if
    else{
      return false;
    }
    $connect->close();

  }


  function setFinishTime($e_id) {

    global $connect;

    date_default_timezone_set("Europe/Istanbul");
    $time1 = date("H:i:s");

    //$sql = "UPDATE startEnd SET t_end ='$time' WHERE time_id = (SELECT max(time_id) FROM startEnd)";


    $sql1 = "SELECT MAX(se_id) as a FROM startEnd WHERE e_id=$e_id";

    $result = $connect->query($sql1);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $max_time_id = $row["a"];
        }
    }

    $sql2 = "SELECT * FROM startEnd WHERE se_id = $max_time_id AND se_start=se_finish";
    $result = $connect->query($sql2);

    if($result->num_rows > 0){
      $sql = "UPDATE startEnd SET se_finish ='$time1' WHERE se_id = $max_time_id";
      $query = $connect->query($sql);
      if($query === TRUE) {
          return true;
        } else {
          return false;
        }
    }//if
    else {
      return false;
    }

    $connect->close();
  }

  function addHours($e_id) {

    global $connect;
    $hours = $_POST['hours'];
    $comment = $_POST['comment'];

    if($comment == "") {
      $comment = "no comment";
    }

    date_default_timezone_set("Europe/Istanbul");
    $day = date("d");
    $month = date("m");
    $year = date("y");
    $time = date("H:i:s");

    $sql = "INSERT INTO hourOfWork (e_id, hours, how_day, how_month, how_year, how_comm, how_time) VALUES ('$e_id', '$hours', '$day', '$month', '$year', '$comment', '$time')";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
      } else {
        return false;
      }


    $connect->close();

  }

  function getEmployeeInfo() {
    global $connect;

    $sql = "SELECT e_id, e_name, e_surname, e_email, e_phone, e_pass FROM employee WHERE e_email!='admin@ela' AND e_ok = '1' ORDER BY e_name, e_surname";
    $result = $connect->query($sql);

    echo "<h1 style='text-align:center'>Active Personels</h1>";
    echo "<table> <tr><th>Name</th><th>Phone Number</th><th>E-mail</th><th>Parola</th><th>Operation</th></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["e_name"] . " " . $row["e_surname"] . "</td><td>" . $row["e_phone"] . "</td><td>" . $row["e_email"] . "</td><td>" . $row["e_pass"] . "</td><td style='width:80px; text-align:center'>" . "<button class='inactivePersonel' value='" . $row['e_id'] . "'><span>&times;</span></button></td></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";

    $sql = "SELECT e_id, e_name, e_surname, e_email, e_phone, e_pass FROM employee WHERE e_email!='admin@ela' AND e_ok = '0' ORDER BY e_name, e_surname";
    $result = $connect->query($sql);

    echo "<h1 style='text-align:center'>Inactive Personels</h1>";
    echo "<table> <tr><th>Name</th><th>Phone Number</th><th>E-mail</th><th>Parola</th><th>Operation</th></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["e_name"] . " " . $row["e_surname"] . "</td><td>" . $row["e_phone"] . "</td><td>" . $row["e_email"] . "</td><td>" . $row["e_pass"] . "</td><td style='width:80px; text-align:center'>" . "<button class='activePersonel' value='" . $row['e_id'] . "'><span>&#10003;</span></button></td></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";
  }

  function makeInactivePersonel($e_id){

    global $connect;

    $sql = "UPDATE employee SET e_ok = '0' WHERE e_id = $e_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function makeActivePersonel($e_id){

    global $connect;

    $sql = "UPDATE employee SET e_ok = '1' WHERE e_id = $e_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function confirmOk($h_id){

    global $connect;

    $sql = "UPDATE hourOfWork SET how_ok = 'confirmed' WHERE h_id = $h_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function unConfirmOk($h_id){

    global $connect;

    $sql = "UPDATE hourOfWork SET how_ok = 'waiting' WHERE h_id = $h_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function confirmOkSE($se_id){

    global $connect;

    $sql = "UPDATE startEnd SET se_ok = 'confirmed' WHERE se_id = $se_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function unConfirmOkSE($se_id){

    global $connect;

    $sql = "UPDATE startEnd SET se_ok = 'waiting' WHERE se_id = $se_id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
  }

  function loadEmployeeSb(){

    global $connect;
    $output = '';

    $sql = "SELECT e_id, e_name, e_surname FROM employee WHERE e_email!='admin@ela' AND e_ok = '1'ORDER BY e_name, e_surname";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      $output .= "<option value='" . $row['e_id'] . "'>" . $row['e_name'] . " " . $row['e_surname'] . "</option>";
    }
    return $output;


  }
  function getEmployeeWorkToday() {
    global $connect;

    $t_day = "19";
    $t_month = date("m");
    $t_year = date("y");

    $sql = "SELECT h.how_day, h.how_month, h.how_year, h.how_time, e.e_name, e.e_surname, h.hours, h.how_ok FROM employee e, hourOfWork h WHERE e.e_id = h.e_id ORDER BY h_id DESC ";
    $result = $connect->query($sql);

    echo "<table> <tr><th>Date</th><th>Time</th><th>Name</th><th>Hour of Work</th><th>Status</th></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['how_day'] . "-" . $row['how_month'] . "-20" . $row['how_year'] . "</td><td>" . $row['how_time'] . "</td><td>" . $row['e_name'] . " " . $row['e_surname'] . "</td><td>";
            echo $row['hours']. " hours</td><td>";
            echo  $row['how_ok'] . "</td></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";
    $connect->close();
  }

  function getEmployeeWorkById($e_id) {

    global $connect;

    $sql = "SELECT how_day, how_month, how_year, hours, how_time, how_ok FROM hourOfWork WHERE e_id = $e_id ORDER BY h_id DESC ";
    $result = $connect->query($sql);

    echo "<table> <tr><th>Date</th><th>Added Time</th><th>Working Time</th><th>Status</th></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["how_day"] . "-" . $row["how_month"] . "-20" . $row["how_year"] . "</td><td>" . $row["how_time"] . "</td><td>" . $row["hours"] . " hours of work</td><td>" . $row['how_ok'] . "</td></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";

  }

  function getTotalEmployeeWorkById($e_id) {

    global $connect;

    $sql = "SELECT SUM(hours) as a FROM hourOfWork WHERE e_id = $e_id AND how_ok = 'confirmed'";
    $result = $connect->query($sql);

    echo "<table style='width:200px'> <tr><th>Confirmed Total Hours</th></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["a"] . " hours of work</td><tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";
  }

  function getEmployeeWorkByIdAndTime($e_id, $time){

    global $connect;

    $sql_time = " ";
    $sql_timeSE = " ";
    $sql_totalTime = " ";
    $sql_totalTimeSE = " ";


        date_default_timezone_set("Europe/Istanbul");
    $h_day = date("d");
    $h_month = date("m");
    $h_year = date("y");

    if($time == 'today') {
      $sql_time .= "AND how_day = $h_day AND how_month = $h_month AND how_year = $h_year";
      $sql_timeSE .= "AND se_day = $h_day AND se_month = $h_month AND se_year = $h_year";

      $sql_totalTime .= "AND how_day = $h_day AND how_month = $h_month AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_day = $h_day AND se_month = $h_month AND se_year = $h_year";
    } else if ($time == 'lastMonth') {
      $sql_time .= "AND how_month = $h_month AND how_year = $h_year";
      $sql_timeSE .= "AND se_month = $h_month AND se_year = $h_year";

      $sql_totalTime .= "AND how_month = $h_month AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_month = $h_month AND se_year = $h_year";
    } else if ($time == 'lastYear') {
      $sql_time .= "AND how_year = $h_year";
      $sql_timeSE .= "AND se_year = $h_year";

      $sql_totalTime .= "AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_year = $h_year";
    }

    if($e_id == '0'){
      $sql = "SELECT h.how_day, h.how_month, h.how_year, h.hours, h.how_time, h.how_comm, h.how_ok, e.e_name, e.e_surname FROM hourOfWork h, employee e WHERE h.e_id != '0' AND e.e_id = h.e_id";
      $sqlSE = "SELECT se.se_day, se.se_month, se.se_year, TIMEDIFF(se.se_finish,se.se_start) as hoursSE, se.se_finish, se.se_comm, se.se_ok, e.e_name, e.e_surname FROM startEnd se, employee e WHERE se.e_id != '0' AND e.e_id = se.e_id";
      $sqlT = "SELECT SUM(hours) as a FROM hourOfWork WHERE e_id != '0' AND how_ok = 'confirmed'";
      $sqlTSE = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(se_finish, se_start)))) as a FROM startEnd WHERE e_id != '0' AND se_ok = 'confirmed'";

    } else {
      $sql = "SELECT h.how_day, h.how_month, h.how_year, h.hours, h.how_time, h.how_comm, h.how_ok, e.e_name, e.e_surname FROM hourOfWork h, employee e WHERE h.e_id = $e_id AND e.e_id = h.e_id";
      $sqlSE = "SELECT se.se_day, se.se_month, se.se_year, TIMEDIFF(se.se_finish,se.se_start) as hoursSE, se.se_finish, se.se_comm, se.se_ok, e.e_name, e.e_surname FROM startEnd se, employee e WHERE se.e_id = $e_id AND e.e_id = se.e_id";
      $sqlT = "SELECT SUM(hours) as a FROM hourOfWork WHERE e_id = $e_id AND how_ok = 'confirmed'";
      $sqlTSE = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(se_finish, se_start)))) as a FROM startEnd WHERE e_id = $e_id AND se_ok = 'confirmed'";

    }

    $sql .= $sql_time;
    $sql .= " ORDER BY h_id DESC ";
    $result = $connect->query($sql);

    $sqlSE .= $sql_timeSE;
    $sqlSE .= " ORDER BY se_id DESC ";
    $resultSE = $connect->query($sqlSE);



    echo "<table> <tr><th>Date</th><th>Added Time</th><th>Working Time</th><th>Comment</th><th>Status</th></tr>";

    if ($resultSE->num_rows > 0) {
        // output data of each row
        while($row = $resultSE->fetch_assoc()) {
            echo "<tr><td>" . $row["se_day"] . "-" . $row["se_month"] . "-20" . $row["se_year"] . "</td><td>" . $row["se_finish"] . "</td><td>";
            echo $row["hoursSE"] . " hours of work</td><td>" . $row['se_comm'] . "</td><td>" . $row['se_ok'] . "</td></tr>";
        }
    } else {
        //echo "0 results";
    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["how_day"] . "-" . $row["how_month"] . "-20" . $row["how_year"] . "</td><td>" . $row["how_time"] . "</td><td>";
            echo $row["hours"] . " hours of work</td><td>" . $row['how_comm'] . "</td><td>" . $row['how_ok'] . "</td></tr>";
        }
    } else {
        //echo "0 results";
    }

    echo "</table>";

    $sqlT .= $sql_totalTime;
    $resultT = $connect->query($sqlT);

    $totally = "";
    echo "<table style='width:200px'> <tr><th>Confirmed Hours By added Manually</th></tr>";
    if ($resultT->num_rows > 0) {
        // output data of each row
        while($row = $resultT->fetch_assoc()) {

              echo "<tr><td>" . $row["a"] . " hours of work</td><tr>";
              $totally = "Total ". $row['a'] . " hours";


        }
    } else {
        //echo "0 results";
    }
    echo "</table>";

    echo "</table>";

    $sqlTSE .= $sql_totalTimeSE;
    $resultTSE = $connect->query($sqlTSE);


    echo "<table style='width:300px'> <tr><th>Confirmed Hours Calculated Automatically</th></tr>";
    if ($resultTSE->num_rows > 0) {
        // output data of each row
        while($row = $resultTSE->fetch_assoc()) {
            echo "<tr><td>" . $row["a"] . " hours of work</td><tr>";
            $totally .= " + " . $row['a'] . " hours" ;
        }
    } else {
        //echo "0 results";
    }
    echo "</table>";

    echo "<table style='width:400px'> <tr><th>Total Time</th></tr>";
    echo "<tr><td>" . $totally . "</td><tr>";
    echo "</table>";

  }

  function getEmployeeWorkByIdAndTimeAdmin($e_id, $time){

    global $connect;

    $sql_time = " ";
    $sql_timeSE = " ";
    $sql_totalTime = " ";
    $sql_totalTimeSE = " ";


        date_default_timezone_set("Europe/Istanbul");
    $h_day = date("d");
    $h_month = date("m");
    $h_year = date("y");

    if($time == 'today') {
      $sql_time .= "AND how_day = $h_day AND how_month = $h_month AND how_year = $h_year";
      $sql_timeSE .= "AND se_day = $h_day AND se_month = $h_month AND se_year = $h_year";

      $sql_totalTime .= "AND how_day = $h_day AND how_month = $h_month AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_day = $h_day AND se_month = $h_month AND se_year = $h_year";
    } else if ($time == 'lastMonth') {
      $sql_time .= "AND how_month = $h_month AND how_year = $h_year";
      $sql_timeSE .= "AND se_month = $h_month AND se_year = $h_year";

      $sql_totalTime .= "AND how_month = $h_month AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_month = $h_month AND se_year = $h_year";
    } else if ($time == 'lastYear') {
      $sql_time .= "AND how_year = $h_year";
      $sql_timeSE .= "AND se_year = $h_year";

      $sql_totalTime .= "AND how_year = $h_year";
      $sql_totalTimeSE .= "AND se_year = $h_year";
    }

    if($e_id == '0'){
      $sql = "SELECT h.how_day, h.how_month, h.how_year, h.hours, h.how_time, h.how_comm, h.how_ok, h.h_id, e.e_name, e.e_surname FROM hourOfWork h, employee e WHERE h.e_id != '0' AND e.e_id = h.e_id";
      $sqlSE = "SELECT se.se_day, se.se_month, se.se_year, TIMEDIFF(se.se_finish,se.se_start) as hoursSE, se.se_finish, se.se_comm, se.se_ok, se.se_id, e.e_name, e.e_surname FROM startEnd se, employee e WHERE se.e_id != '0' AND e.e_id = se.e_id";
      $sqlT = "SELECT SUM(hours) as a FROM hourOfWork WHERE e_id != '0' AND how_ok = 'confirmed'";
      $sqlTSE = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(se_finish, se_start)))) as a FROM startEnd WHERE e_id != '0' AND se_ok = 'confirmed'";

    } else {
      $sql = "SELECT h.how_day, h.how_month, h.how_year, h.hours, h.how_time, h.how_comm, h.how_ok, h.h_id, e.e_name, e.e_surname FROM hourOfWork h, employee e WHERE h.e_id = $e_id AND e.e_id = h.e_id";
      $sqlSE = "SELECT se.se_day, se.se_month, se.se_year, TIMEDIFF(se.se_finish,se.se_start) as hoursSE, se.se_finish, se.se_comm, se.se_ok, se.se_id, e.e_name, e.e_surname FROM startEnd se, employee e WHERE se.e_id = $e_id AND e.e_id = se.e_id";
      $sqlT = "SELECT SUM(hours) as a FROM hourOfWork WHERE e_id = $e_id AND how_ok = 'confirmed'";
      $sqlTSE = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(se_finish, se_start)))) as a FROM startEnd WHERE e_id = $e_id AND se_ok = 'confirmed'";

    }

    $sql .= $sql_time;
    $sql .= " ORDER BY h_id DESC ";
    $result = $connect->query($sql);

    $sqlSE .= $sql_timeSE;
    $sqlSE .= " ORDER BY se_id DESC ";
    $resultSE = $connect->query($sqlSE);



    echo "<table> <tr><th>Date</th><th>Added Time</th><th>Personel</th><th>Working Time</th><th>Comment</th><th>Status</th></tr>";

    if ($resultSE->num_rows > 0) {
        // output data of each row
        while($row = $resultSE->fetch_assoc()) {
            echo "<tr><td>" . $row["se_day"] . "-" . $row["se_month"] . "-20" . $row["se_year"] . "</td><td>" . $row["se_finish"] . "</td><td>" . $row["e_name"]. " " . $row["e_surname"] .  "</td><td>";
            echo $row["hoursSE"] . " hours of work</td><td>" . $row['se_comm'] . "</td><td>" . $row['se_ok'] . "<button class='confirmSE' value='" . $row['se_id'] . "'><span>&#10003;</span></button>" . "<button class='unconfirmSE' value='" . $row['se_id'] . "'><span>&times;</span></button>" . "</td></tr>";
        }
    } else {
        //echo "0 results";
    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["how_day"] . "-" . $row["how_month"] . "-20" . $row["how_year"] . "</td><td>" . $row["how_time"] . "</td><td>" . $row["e_name"] . " " . $row["e_surname"] .  "</td><td>";
            echo $row["hours"] . " hours of work</td><td>" . $row['how_comm'] . "</td><td>" . $row['how_ok'] . "<button class='confirm' value='" . $row['h_id'] . "'><span>&#10003;</span></button>" . "<button class='unconfirm' value='" . $row['h_id'] . "'><span>&times;</span></button>". "</td></tr>";
        }
    } else {
        //echo "0 results";
    }

    echo "</table>";

    $sqlT .= $sql_totalTime;
    $resultT = $connect->query($sqlT);

    $totally = "";
    echo "<table style='width:200px'> <tr><th>Confirmed Hours By added Manually</th></tr>";
    if ($resultT->num_rows > 0) {
        // output data of each row
        while($row = $resultT->fetch_assoc()) {

              echo "<tr><td>" . $row["a"] . " hours of work</td><tr>";
              $totally = "Total ". $row['a'] . " hours";


        }
    } else {
        //echo "0 results";
    }
    echo "</table>";

    echo "</table>";

    $sqlTSE .= $sql_totalTimeSE;
    $resultTSE = $connect->query($sqlTSE);


    echo "<table style='width:300px'> <tr><th>Confirmed Hours Calculated Automatically</th></tr>";
    if ($resultTSE->num_rows > 0) {
        // output data of each row
        while($row = $resultTSE->fetch_assoc()) {
            echo "<tr><td>" . $row["a"] . " hours of work</td><tr>";
            $totally .= " + " . $row['a'] . " hours" ;
        }
    } else {
        //echo "0 results";
    }
    echo "</table>";

    echo "<table style='width:400px'> <tr><th>Total Time</th></tr>";
    echo "<tr><td>" . $totally . "</td><tr>";
    echo "</table>";

  }



 ?>
