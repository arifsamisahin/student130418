<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];

  $sql = "SELECT * FROM teacher WHERE u_id='$u_id' ORDER BY t_status DESC, t_name";

  $result = mysqli_query($connect, $sql);

?>
<table class="table table-hover table-responsive-lg">
  <thead>
      <tr class="table-primary">
      <th>#</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Birthday</th>
      <th>Username</th>
      <th>Password</th>
      <th>Register Date</th>
      <th>Process</th>
    </tr>
  </thead>
  <tbody>
  <?php

    $number = 1;
    while ($row = mysqli_fetch_array($result)) {
  ?>

      <?php
        if($row['t_status'] == '1'){
          echo "<tr>";
        }else{
          echo "<tr class='table-danger'>";
        }
      ?>
      <th scope="row"><?php echo $number?></th>
      <td><?php echo $row['t_name']?></td>
      <td><?php echo $row['t_phone']?></td>
      <td><?php echo $row['t_email']?></td>
      <td><?php echo $row['t_birthday']?></td>
      <td><?php echo $row['t_username']?></td>
      <td><?php echo $row['t_pass']?></td>
      <td><?php echo $row['t_registerDate']?></td>
      <td>
        <button value="<?php echo $row['id']?>" type="button" class="updateInfoTeacher btn btn-outline-success btn-sm" data-toggle="modal" data-target="#updateTeacherModal">Update Info</button>
      </td>
    </tr>

    <?php
    ++$number;
    }?>

  </tbody>
</table>
