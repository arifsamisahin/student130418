<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];

  $sql = "SELECT * FROM subuser WHERE u_id='$u_id' ORDER BY su_status DESC, su_name";

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
        if($row['su_status'] == '1'){
          echo "<tr>";
        }else{
          echo "<tr class='table-danger'>";
        }
      ?>
      <th scope="row"><?php echo $number?></th>
      <td><?php echo $row['su_name']?></td>
      <td><?php echo $row['su_phone']?></td>
      <td><?php echo $row['su_email']?></td>
      <td><?php echo $row['su_birthday']?></td>
      <td><?php echo $row['su_username']?></td>
      <td><?php echo $row['su_pass']?></td>
      <td><?php echo $row['su_registerDate']?></td>
      <td>
        <button value="<?php echo $row['id']?>" type="button" class="updateInfoTeacher btn btn-outline-success btn-sm" data-toggle="modal" data-target="#updateTeacherModal">Update Info</button>
      </td>
    </tr>

    <?php
    ++$number;
    }?>

  </tbody>
</table>
