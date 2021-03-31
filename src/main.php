<?php
  session_start();
  if(!isset($_SESSION["permission"])) {
    echo "<script>window.location.replace('login.php')</script>";
  }

  include 'class/os.php';
  manage_semester();
  update_password($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Manager Home</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/school.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" class="active" href="main.php">หน้าหลัก</a>
      <?php
        if($_SESSION["permission"] == "teacher") {
          echo '<a id="menu" href="grade.php">ผลการเรียน</a>';
        } else if($_SESSION["permission"] == "staff") {
          echo '<a id="menu" href="student.php">นักเรียน</a>
                <a id="menu" href="teacher.php">คุณครู</a>
                <a id="menu" href="course.php">รายวิชา</a>
                <a id="menu" href="class_schedule.php">ตารางเรียน</a>';
        }
      ?>
      <div class="logout" style="float: right">
        <form name="myForm" action="login.php" method="post" enctype="multipart/form-data">
          <?php 
            if($_SESSION["permission"] == "teacher") {
              echo '<a id="menu-change-password" href="change_password.php" >Change password</a>';
            }
          ?>
          <button type="submit" id="menu-logout" name="logout">Logout</button>
        </form>
      </div>
      <a id="name" style="float: right">
        <?php 
          if($_SESSION["permission"] == "teacher") {
            echo 'Teacher: '. $_SESSION["name"];
          } else if($_SESSION["permission"] == "staff") {
            echo 'Staff: '. $_SESSION["name"];
          }
        ?>
      </a>
    </div>
      <?php 
        if($_SESSION["permission"] == "teacher") {
          echo
          '<div id="main-container" style="margin-top: 25px;">
          <h1 style="text-align: center;">จัดการผลการเรียนนักเรียน</h1>
           <div class="column" style="width: 100%">
            <div align="center">
              <a href="grade.php">
                <img src="img/point.png" width="300" height="305" style="width: 62%; height: 63%;"><br>
                <h2><b>ผลการเรียน</b></h2>
              </a>
            </div>
          </div>';
        } else if($_SESSION["permission"] == "staff") {
          echo
          '<div id="main-container" style="margin-top: 25px;">
          <h1 style="text-align: center;">จัดการฐานข้อมูลของโรงเรียน</h1>
          <div class="row" style="margin-top: 20px;">
            <div class="column" style="width: 50%">
              <div align="center">
                <a href="student.php">
                  <img src="img/student.png" width="300" height="305" style="width: 63%; height: 64%;"><br>
                  <h2><b>นักเรียน</b></h2>
                </a>
              </div>
            </div>
            <div class="column" style="width: 50%">
              <div align="center">
                <a href="teacher.php">
                  <img src="img/teacher.png" width="300" height="305" style="width: 63%; height: 64%;"><br>
                  <h2><b>พนักงาน</b></h2>
                </a>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 20px;">
            <div class="column" style="width: 50%">
              <div align="center">
                <a href="course.php">
                  <img src="img/courses.png" width="300" height="305" style="width: 62%; height: 63%;"><br>
                  <h2><b>รายวิชา</b></h2>
                </a>
              </div>
            </div>
            <div class="column" style="width: 50%">
              <div align="center">
                <a href="class_schedule.php">
                  <img src="img/class_schedule.png" width="300" height="305" style="width: 63%; height: 64%;"><br>
                  <h2><b>ตารางเรียน</b></h2>
                </a>
              </div>
            </div>
          </div>';
        }
      ?>
    </div>
  </body>
</html>