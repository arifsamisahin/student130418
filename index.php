<?php
  require_once 'core/init.php';

  if(logged_in() === TRUE) {
    header('location: viewStudent.php');
  }else if(logged_in_teacher() === TRUE){
    header('location: teacherDash.php');
  }else if(logged_in_subuser() === TRUE){
    header('location: subuserDash.php');
  }
 ?>

<!DOCTYPE html>
<html>
<head>

  <title>ELA Student</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="Kurs Yönetim Sistemi">
    <meta name="author" content="Arif Sami ŞAHİN">

    <link rel="shortcut icon" href="logo/ela.png" />
    <link rel="apple-touch-icon" href="logo/ela.png" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="loader/style.css">
  <style>
  body, html {
      height: 100%;
      background-repeat: no-repeat;
      background-image: linear-gradient(rgba(38, 48, 127,0.8), rgba(212, 33, 37, 0.8));

  }

  .card-container.card {
      max-width: 350px;
      padding: 40px 40px;
  }

  .btn {
      font-weight: 700;
      height: 36px;
      -moz-user-select: none;
      -webkit-user-select: none;
      user-select: none;
      cursor: default;
  }

  /*
   * Card component
   */
  .card {
      background-color: #F7F7F7;
      /* just in case there no content*/
      padding: 20px 25px 30px;
      margin: 0 auto 25px;
      margin-top: 50px;
      /* shadows and rounded borders */
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px;
      -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  }

  .profile-img-card {
      width: 200px;
      height: 200px;
      margin: 0 auto 10px;
      display: block;
      -moz-border-radius: 50%;
      -webkit-border-radius: 50%;
      border-radius: 50%;
  }

  /*
   * Form styles
   */
  .profile-name-card {
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      margin: 10px 0 0;
      min-height: 1em;
  }

  .reauth-email {
      display: block;
      color: #404040;
      line-height: 2;
      margin-bottom: 10px;
      font-size: 14px;
      text-align: center;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }

  .form-signin #inputEmail,
  .form-signin #inputPassword {
      direction: ltr;
      height: 44px;
      font-size: 16px;
  }

  .form-signin input[type=email],
  .form-signin input[type=password],
  .form-signin input[type=text],
  .form-signin button {
      width: 100%;
      display: block;
      margin-bottom: 10px;
      z-index: 1;
      position: relative;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }

  .form-signin .form-control:focus {
      border-color: rgb(104, 145, 162);
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
  }

  .btn.btn-signin {
      /*background-color: #4d90fe; */
      background-color: rgb(38, 48, 127);
      /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
      padding: 0px;
      font-weight: 700;
      font-size: 14px;
      height: 36px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border-radius: 3px;
      border: none;
      -o-transition: all 0.218s;
      -moz-transition: all 0.218s;
      -webkit-transition: all 0.218s;
      transition: all 0.218s;
  }

  .btn.btn-signin:hover,
  .btn.btn-signin:active,
  .btn.btn-signin:focus {
      background-color: rgb(212, 33, 37);
  }

  .forgot-password {
      color: rgb(104, 145, 162);
  }

  .forgot-password:hover,
  .forgot-password:active,
  .forgot-password:focus{
      color: rgb(12, 97, 33);
  }
  </style>

</head>
<body>

  <!--LOADER-->
  <script src="loader.js"></script>
  <div class="body hide" id="loader">
    <div class="loader loader-1">
      <div class="loader-outter"></div>
      <div class="loader-inner"></div>
    </div>
  </div>

  <div class="container">
         <div class="card card-container">
             <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
             <img class="profile-img-card" src="logo/ela.png" />
             <p class="profile-name-card">ELA STUDENTS</p>
             <div class="form-signin">
                 <span class="reauth-email"></span>
                 <input type="text" id="u_username" class="form-control" placeholder="Username"  autofocus>
                 <input type="password" id="u_pass" class="form-control" placeholder="Password" >
                 <!--div id="remember" class="checkbox">
                     <label>
                         <input type="checkbox" value="remember-me"> Remember me
                     </label>
                 </div-->
                 <button id="btnSignin" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                 <div id="resultSignin"></div>
             </div><!-- /form -->
             <!--a href="#" class="forgot-password">
                 Forgot the password?
             </a-->
         </div><!-- /card-container -->
     </div><!-- /container -->

     <script>

     $(document).keydown(function (e){
         if(e.keyCode == 13){
            $('#btnSignin').click();
         }
     });

        $(document).ready(function(){
          console.log("ready");

            $("#btnSignin").click(function(){

              $('#resultSignin').empty();
              $('#resultSignin').removeClass();

              var u_username = $('#u_username').val();
              var u_pass = $('#u_pass').val();

              if((u_username!='') && (u_pass!='')){
                $.ajax({
                  url:"functions/loginUser.php",
                  method: "POST",
                  data:{u_username:u_username,
                        u_pass:u_pass
                        },
                  success:function(data){
                    $('#resultSignin').html(data);
                  }

                });
              }else{
                $('#resultSignin').addClass("alert alert-danger mt-3");
                $('#resultSignin').append("* Please enter username and password!");
              }
          });

        });//ready

     </script>
</body>
</html>
