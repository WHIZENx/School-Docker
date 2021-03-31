<?php
  include 'class/os.php';
  if(isset($_POST["logout"])) {
    logout();
  }

  session_start();
  if(isset($_SESSION["permission"])) {
    echo "<script>window.location.replace('main.php')</script>";
  }
  
  login($_POST['username'], $_POST['password']);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Login</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/icon.ico">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/login.js"></script>
  <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div id="page-container">
      <h1>Login</h1>
      <form name="myForm" action="login.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="Enter username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
        <div style="margin-bottom: 8px;"><a data-toggle="modal" data-target="#exampleModal" href="#"><b>Help?</b></a></div>
        <button type="submit" class="btn btn-primary" style="color:white;" name="submit">Submit</buttona>
      </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">โปรดอ่านก่อน</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><b>รหัสของ Staff</b></p>
            <p>Username: s1234</p>
            <p>Password: 123456</p>
            <p>ดูแลส่วนการจัดการ: คุณครู, นักเรียน, วิชา, ตารางเรียน</p>
            <hr>
            <p><b>รหัสของ Teacher</b></p>
            <p>Username: TeacherID (รหัสผู้ใช้หลัก 10001)</p>
            <p>Password: วันเกิด DD/MM/YY (รหัสผ่านหลัก 123456)</p>
            <p>ดูแลส่วนการจัดการ: เกรด</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>