<!DOCTYPE html>
<html>
<head>
  <title>qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq</title>
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

  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <style>

  body{
    font-family: 'Ubuntu', sans-serif;
  }
  .card {
      position: relative;
      box-shadow: 4px 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 40%;
      max-width:200px;
      height: auto;
      margin:10px;
      border-radius: 5px;
  }


  .card img{
    border-radius: 5px 5px 0 0;
  }

  .card h4{
    margin-top: 15px;
  }

  .card .inner-phone {
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .card .container{
    position: relative;
    height: auto;
  }


  .card .inner-phone:hover {
    cursor: pointer;
  }

  .card .phoneIcon{
    margin-left: 5px;
    width: 30px;
    height: 30px;
  }

  .card .settingsIcon{
    margin-left: 5px;
    width: 24px;
    height: 24px;
    position: absolute;
    bottom: 10px;
    right: 10px;
  }

  .card:hover {
      box-shadow: 8px 16px 16px 0 rgba(0,0,0,0.2);
  }

  .inactive-student{
    opacity: 0.6;
  }

  .studentPicture{
    width: 100%;
  }

  .logo{
    width: 48px;
    height: 48px;
  }


  </style>
  </head>
  <body>

<div class="container">

  <div class="row ml-2">
  <div class="card ">
    <img class="studentPicture" src="../../uploads/team.png" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>
  <div class="card ">
    <img class="studentPicture" src="../../uploads/DSCN3998.JPG" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>
  <div class="card ">
    <img class="studentPicture" src="../../uploads/profileM.png" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>
  <div class="card ">
    <img class="studentPicture" src="../../uploads/profileF.png" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>
  <div class="card ">
    <img class="studentPicture" src="../../uploads/profileM.png" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>
  <div class="card ">
    <img class="studentPicture" src="../../uploads/profileF.png" alt="Student Picture">
    <a href="tel:05453251571"><img class="phoneIcon inner-phone" src="../../icon/phone.png"></a>
    <div class="container">
      <img class="settingsIcon inner-settings" src="../../icon/settings.png">
      <h4><strong>Arif Sami SAHIN</strong></h4>
      <p class="badge badge-info">New Zeland</p>
    </div>
  </div>


</div>

</div>

</body>
</html>

<script>

  $('.phoneIcon').click(function(){
    console.log('phone clicked');
  });
</script>
