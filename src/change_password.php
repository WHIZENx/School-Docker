<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "staff") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/os.php';
  
  update_password($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Change Password</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/password.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/change_password.js"></script>
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div id="page-container" style="min-width: 500px; padding: 30px;">
      <h1>เปลี่ยนรหัสผ่าน</h1>
      <form name="myForm" action="change_password.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="current_password">รหัสผ่านปัจจุบัน</label>
              </div>
              <input type="password" class="form-control" id="current_password" placeholder="Password" name="current_password">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="new_password">รหัสผ่านใหม่</label>
              </div>
              <input type="password" class="form-control" id="new_password" placeholder="Password" name="new_password">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="check_password">ยืนยันรหัสผ่านใหม่</label>
              </div>
              <input type="password" class="form-control" id="check_password" placeholder="Password" name="check_password">
            </div>
            <a href="main.php" class="btn btn-danger" role="button">กลับ</a>
            <button type="submit" class="btn btn-success">เปลี่ยน</button>
        </form>
    </div>
  </body>
</html>