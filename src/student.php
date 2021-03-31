<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "teacher") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/student.php';
  include 'class/semester.php';
  include 'class/manage.php';

  $student = new Student();
  $semester = new Semester();

  $grade = new GradeRoom();
  $grade->promote_student($grade_number);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Student</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/student.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/student.js"></script>
  <link rel="stylesheet" href="css/student.css">
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" href="main.php">หน้าหลัก</a>
      <a id="menu" class="active" href="student.php">นักเรียน</a>
      <a id="menu" href="teacher.php">คุณครู</a>
      <a id="menu" href="course.php">รายวิชา</a>
      <a id="menu" href="class_schedule.php">ตารางเรียน</a>
      <div class="logout" style="float: right">
        <form name="myForm" action="login.php" method="post" enctype="multipart/form-data"><button type="submit" id="menu-logout" name="logout">Logout</button></form>
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
    <div id="main-container" style="margin-top: 15px;">
      <h1>นักเรียน</h1>
      <a class="btn btn-success" style="margin-top: 10px;" href="student_add.php"><i class="fa fa-plus"></i> Add</a>
      <button class="btn btn-info" style="margin-top: 10px; color: white;" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-bullhorn"></i> Promote</button>
      <hr>
      <form action="student.php" method="get">
        <div class="input-group mb-3" style="width: 60%">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">ชั้นประถมศึกษาปีที่</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" onchange="insert_student()">
              <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i <= $grade_number; $i++) {
                    if (isset($_GET['GradeNo']) && $_GET['GradeNo'] == $i) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
              ?>
            </select>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">ห้อง</label>
            </div>
            <select class="custom-select" id="inputGroupSelect02" onchange="insert_student()">
              <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i <= $room_number; $i++) {
                    if (isset($_GET['RoomNo']) && $_GET['RoomNo'] == $i) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
              ?>
            </select>
          </div>
          <div class="input-group mb-3" style="width: 60%">
          	<div class="input-group-prepend">
              <label class="input-group-text">ชื่อ</label>
            </div>
            <?php
              if (isset($_GET['Firstname'])) {
                echo '<input type="text" class="form-control" id="search_stdf" placeholder="ชื่อ" name="search_stdf" value="'.$_GET['Firstname'].'">';
              } else {
                echo '<input type="text" class="form-control" id="search_stdf" placeholder="ชื่อ" name="search_stdf">';
              }
            ?>
            <div class="input-group-prepend">
              <label class="input-group-text"">นามสกุล</label>
            </div>
            <?php
              if (isset($_GET['Lastname'])) {
                echo '<input type="text" class="form-control" id="search_stdl" placeholder="นามสกุล" name="search_stdl" value="'.$_GET['Lastname'].'">';
              } else {
                echo '<input type="text" class="form-control" id="search_stdl" placeholder="นามสกุล" name="search_stdl">';
              }
            ?>
          </div>
          <?php
            if (isset($_GET['GradeNo'])) {
              echo '<input type="hidden" name="gradeno" id="gradeno" value="'.$_GET['GradeNo'].'">';
            } else {
              echo '<input type="hidden" name="gradeno" id="gradeno" value="" />';
            }
            if (isset($_GET['RoomNo'])) {
              echo '<input type="hidden" name="roomno" id="roomno" value="'.$_GET['RoomNo'].'">';
            } else {
              echo '<input type="hidden" name="roomno" id="roomno" value="" />';
            }
          ?>
          <div class="input-group mb-3" style="width: 30%">
            <div class="input-group-prepend">
              <label class="input-group-text" for="search_stdid"><i class="fa fa-search"></i></label>
            </div>
            <input type="number" class="form-control" id="search_stdid" placeholder="Student ID" name="search_stdid">
          </div>
        <?php
            if (isset($_GET["searchID"]) != '') {
              $sql = $student->get_student_id($_GET["searchID"]);
              echo '<a id="clear_stdid" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_stdid()" name="clear_stdid">Clear</a>
              <a id="search_stdid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_stdid()" name="search_stdid">Search</a>
        </form>
        <br>
        <p><b>ผลการค้นหา: รหัสนักเรียน '.$_GET["searchID"].'</b></p>';
            } else {
              if (isset($_GET["GradeNo"]) == '' && isset($_GET["RoomNo"]) == '' && isset($_GET["Firstname"]) == '' && isset($_GET["Lastname"]) == '') {
                $sql = $student->get_student_all();
                echo '<a id="search_stdid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_stdid()" name="search_stdid">Search</a>
                </form>
                <br>';
              } else {
                $sql = $student->get_student($_GET["GradeNo"], $_GET["RoomNo"], $_GET["Firstname"], $_GET["Lastname"]);
                echo '<a id="clear_stdid" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_stdid()" name="clear_stdid">Clear</a>
                <a id="search_stdid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_stdid()" name="search_stdid">Search</a>
                </form>
                <br>';
              }
            }

            $result = $student->con->select($sql);
            if ($result) { ?>
              <table id="student">
              <tr>
                <th>No.</th>
                <th>STUDENT ID</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>สถานะการศึกษา</th>
                <th>เปลี่ยนแปลง</th>
              </tr>
              <?php while ($rows = $student->con->fetch($result)) {
                      $student->query_student($rows, $student->i);?>
                     <tr>
                      <td align="center"><?php echo $student->i; ?></td>
                      <td align="center"><?php echo $student->studentID; ?></td>
                      <td><?php echo $student->ntitle.' '; ?><?php echo $student->stdfname ?> <?php echo $student->stdlname; ?></td>
                      <td style="text-align: center;"><?php echo $student->phone; ?></td>
                      <td class="<?php echo $student->status ?>" style="text-align: center;"><b><?php echo $student->status ?></b></td>
                      <td align="center">
                        <a class="btn btn-warning" href="student_update.php?studentID=<?php echo $student->studentID ?>" style="color: white;">Update</a>
                      </td>
                    </tr>
                    <?php
                }
                echo "</table>";
            } else {
              echo "<h1 style='color: red;'>Student Not found in database</h1>";
            }
          ?>
    </div>

    <form id="form_promote" action="student.php" method="post">
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันการเลื่อนชั้นเรียนทั้งหมด</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            คุณต้องการจะเลื่อนชั้นนักเรียนเรียนทั้งหมดใช่หรือไม่?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-success" name="submit">Yes</button>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>