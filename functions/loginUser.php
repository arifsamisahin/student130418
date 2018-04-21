<?php

  session_start();
  require_once '../core/db_connect.php';
  require_once '../core/functions.php';
  require_once '../core/functionsTeacher.php';
  require_once '../core/functionsSubuser.php';

  $username = $_POST['u_username'];
  $password = $_POST['u_pass'];


       if(userExists($username) == TRUE) {
           $login = login($username, $password);
           if($login) {
               $userdata = userdata($username);

               $_SESSION['u_id'] = $userdata['u_id'];

               echo "<script>window.location.href = './viewStudent.php';</script>";
               exit();

           } else {
               echo "<div class='alert alert-danger mt-3'>* Incorrect user password!</div>";
           }
       } else {
          if(teacherExists($username) == TRUE){
            $loginT = loginT($username, $password);
            if($loginT){
              $userdata = teacherdata($username);

              $_SESSION['id'] = $userdata['id'];

              echo "<script>window.location.href = './teacherDash.php';</script>";
              exit();

            } else{
              echo "<div class='alert alert-danger mt-3'>* Incorrect teacher password!</div>";
            }
          }else{
            if(subuserExists($username) == TRUE){
              $loginSub = loginSub($username, $password);
              if($loginSub){
                $userdata = subuserdata($username);

                $_SESSION['su_id'] = $userdata['id'];

                echo "<script>window.location.href = './viewStudentSub.php';</script>";
                exit();

              } else{
                echo "<div class='alert alert-danger mt-3'>* Incorrect suser password!</div>";
              }
            }else{
                echo "<div class='alert alert-danger mt-3'>* This user doesn't exist!</div>";
              }
          }
        }

 ?>
