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
  include 'class/manage.php';

  $student = new GradeRoom();

  $student->insert_student();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Add Student</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/student.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/student.js"></script>
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/student.css">
  </head>
  <body>
    <div id="page-container" style="margin-top: 15px;">
      <h1>Add Student</h1>
      <form name="myForm" action="student_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-group">
          <div class="input-group" style="width: 40%;">
          <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">ปีที่เข้ารับการศึกษา</label>
            </div>
            <input type="number" class="form-control" id="styear" placeholder="ปีที่เข้ารับการศึกษา" name="styear">
        </div>
      </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">ระดับชั้นประถมศึกษาปีที่</label>
            </div>
            <select class="custom-select" id="inputGroupSelect02" onchange="insert_student_add()">
              <option selected>เลือก...</option>
              <?php
              for ($i = 1; $i <= $grade_number; $i++) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
              }
            ?>
            </select>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect03">ห้อง</label>
            </div>
            <select class="custom-select" id="inputGroupSelect03" onchange="insert_student_add()">
              <option selected>เลือก...</option>
              <?php
              for ($i = 1; $i <= $room_number; $i++) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
              }
            ?>
            </select>
          </div>
          <input type="hidden" name="gradeno" id="gradeno" value="" />
          <input type="hidden" name="roomno" id="roomno" value="" />
        </div>
        <div class="form-group">
          <span style="color:red;">* </span><label for="stdid" style="color: black">รหัสประจำตัว:</label>
          <input type="number" class="form-control" id="stdid" placeholder="Student ID" name="stdid" min=0>
        </div>
        <div class="form-row">
          <div class="col-2">
            <div class="form-group">
              <span style="color:red;">* </span><label for="ntitle" style="color: black">คำนำหน้า:</label>
              <select class="custom-select" id="inputGroupSelect04" onchange="insert_student_add()">
                <option selected>เลือก...</option>
                <option value="เด็กชาย">เด็กชาย</option>
                <option value="เด็กหญิง">เด็กหญิง</option>
              </select>
              <input type="hidden" name="ntitle" id="ntitle" value="" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="firstname" style="color: black">ชื่อ:</label>
              <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="lastname" style="color: black">นามสกุล:</label>
              <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname">
            </div>
          </div>
        </div>
        <div class="form-group">
          <span style="color:red;">* </span><label for="address" style="color: black">ที่อยู่:</label>
          <input type="text" class="form-control" id="address" placeholder="Address" name="address">
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="bdate" style="color: black">วันเกิด:</label>
              <input type="date" class="form-control" id="bdate" name="bdate">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="phone" style="color: black">เบอร์โทร: (0123456789)</label>
              <input type="tel" class="form-control" id="phone" placeholder="Phone" name="phone" pattern="[0-9]{10}">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="pname" style="color: black">ชื่อผู้ปกครอง:</label>
              <input type="text" class="form-control" id="pname" placeholder="ชื่อผู้ปกครอง" name="pname">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="pphone" style="color: black">เบอร์โทรผู้ปกครอง: (0123456789)</label>
              <input type="tel" class="form-control" id="pphone" placeholder="เบอร์โทรผู้ปกครอง" name="pphone" pattern="[0-9]{10}">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="disease" style="color: black">โรคประจำตัว:</label>
          <input type="text" class="form-control" id="disease" placeholder="Disease" name="disease">
        </div>
        <a href="student.php" class="btn btn-danger" role="button">Back</a>
        <button type="submit" class="btn btn-success">Add</button>
      </form>
    </div>
  </body>
</html>