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

  $student->update_student();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Update Student</title>
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
      <h1>Update Student</h1>
      <p style="font-size: 25px;">
        <?php 
        $sql = $student->get_grade_room_byid($_GET["studentID"]);
        $sql_student = $student->get_student_id($_GET["studentID"]);

        $qry_student = $student->con->select($sql_student);
        if ($qry_student) {
          $rows = $student->con->fetch($qry_student);
          $student->query_student($rows, $student->i);
          echo 'ปีที่เข้ารับการศึกษา '.$student->styear.'<br>';
          echo ''.$student->ntitle.''.$student->stdfname.' '.$student->stdlname.' อยู่ระดับชั้น';
        }

        $qry = $student->con->select($sql); 
        if ($qry)
          $rows = $student->con->fetch($qry);
          $student->query_grade_room($rows);?>
          <span style="color:red;">*</span>ประถมศึกษาปีที่ <select class="custom-select" id="inputGroupSelect01" style="width: 50px; display: inline-block;" onchange="update_student()">
            <?php
              for ($i = 1; $i <= $grade_number; $i++) {
                  if ($student->grade_number == $i) {
                      echo '<option value="'.$i.'" selected>'.$i.'</option>';
                  } else {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                  }
              }
            ?>
          </select><span style="color:red;">*</span>ห้อง <select class="custom-select" id="inputGroupSelect02" style="width: 50px; display: inline-block;" onchange="update_student()">
          <?php
              for ($i = 1; $i <= $room_number; $i++) {
                  if ($student->room_number == $i) {
                      echo '<option value="'.$i.'" selected>'.$i.'</option>';
                  } else {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                  }
              }
            ?>
          </select>
        </p>
      <hr>
      <?php
        if ($qry) {
            $qry = $student->con->select($sql_student); 
            $rows = $student->con->fetch($qry);
            $student->query_student($rows, $student->i);
            echo '<form name="myForm" action="student_update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
              <label for="stdid" style="color: black; font-size: 20px;"><b>รหัสประจำตัว: '.$student->id.'</b></label>
              <input type="hidden" name="studentID" id="studentID" value="'.$student->id.'" />
              <div class="form-row">
                <div class="col-2">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="ntitle" style="color: black">คำนำหน้า:</label>
                    <select class="custom-select" id="inputGroupSelect03" onchange="update_student()">';
                      if ($student->ntitle == 'เด็กชาย')
                        echo '<option value="เด็กชาย" selected>เด็กชาย</option>';
                      else
                        echo '<option value="เด็กชาย">เด็กชาย</option>';
                      if ($student->ntitle == 'เด็กหญิง')
                        echo '<option value="เด็กหญิง" selected>เด็กหญิง</option>';
                      else
                        echo '<option value="เด็กหญิง">เด็กหญิง</option>';
                    echo '</select>
                    <input type="hidden" name="gradeno" id="gradeno" value="'.$student->grade_number.'" />
                    <input type="hidden" name="roomno" id="roomno" value="'.$student->room_number.'" />
                    <input type="hidden" name="ntitle" id="ntitle" value="'.$student->ntitle.'" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="firstname" style="color: black">ชื่อ:</label>
                    <input type="text" class="form-control" id="firstname" placeholder="First Name" value="'.$student->stdfname.'" name="firstname">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="lastname" style="color: black">นามสกุล:</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="'.$student->stdlname.'" name="lastname">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <span style="color:red;">* </span><label for="address" style="color: black">ที่อยู่:</label>
                <input type="text" class="form-control" id="address" placeholder="Address" value="'.$student->address.'" name="address">
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="phone" style="color: black">เบอร์โทร: (0123456789)</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone" value="'.$student->phone.'" name="phone"pattern="[0-9]{10}">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="pname" style="color: black">ชื่อผู้ปกครอง:</label>
                    <input type="text" class="form-control" id="pname" placeholder="ชื่อผู้ปกครอง" value="'.$student->parent_name.'" name="pname">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="pphone" style="color: black">เบอร์โทรผู้ปกครอง: (0123456789)</label>
                    <input type="text" class="form-control" id="pphone" placeholder="เบอร์โทรผู้ปกครอง" value="'.$student->parent_phone.'" name="pphone"pattern="[0-9]{10}">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="disease" style="color: black">โรคประจำตัว:</label>
                <input type="text" class="form-control" id="disease" placeholder="Disease" value="'.$student->disease.'" name="disease">
              </div>
              <div class="form-group">
              <label for="status" style="color: black">สถานะการศึกษา:</label>
                <div class="row" style="margin-left: 20px;">
                  <div class="col-2 custom-control custom-radio">';
                    if ($student->status == 'Active') {
                      echo '
                        <input type="radio" class="custom-control-input" id="Group1" name="status" value="Active" checked>';
                    } else {
                      echo '
                        <input type="radio" class="custom-control-input" id="Group1" name="status" value="Active">';
                    }
                    echo '
                    <label class="custom-control-label" for="Group1" style="color: green;"><b>Active</b></label>
                  </div>
                  <div class="col-2 custom-control custom-radio">';
                    if ($student->status == 'Inactive') {
                      echo '<input type="radio" class="custom-control-input" id="Group2" name="status" value="Inactive" checked>';
                    } else {
                      echo '<input type="radio" class="custom-control-input" id="Group2" name="status" value="Inactive">';
                    }
                    echo '
                    <label class="custom-control-label" for="Group2" style="color: red;"><b>Inactive</b></label>
                  </div>
                  <div class="col-2 custom-control custom-radio">';
                    if ($student->status == 'Drop') {
                      echo '<input type="radio" class="custom-control-input" id="Group3" name="status" value="Drop" checked>';
                    } else {
                      echo '<input type="radio" class="custom-control-input" id="Group3" name="status" value="Drop">';
                    }
                    echo '
                    <label class="custom-control-label" for="Group3" style="color: orange;"><b>Drop</b></label>
                  </div>
                  <div class="col-2 custom-control custom-radio">';
                    if ($student->status == 'Graduate') {
                      echo '<input type="radio" class="custom-control-input" id="Group4" name="status" value="Graduate" checked>';
                    } else {
                      echo '<input type="radio" class="custom-control-input" id="Group4" name="status" value="Graduate">';
                    }
                    echo '
                    <label class="custom-control-label" for="Group4" style="color: blue;"><b>Graduate</b></label>
                  </div>
                </div>
              </div>
              <a href="student.php" class="btn btn-danger" role="button">Back</a>
              <button type="submit" class="btn btn-success">Update</button>
            </form>';
        } else {
          echo '<h1 style="color: red;">Student Not found in database</h1>
          <a href="student.php" class="btn btn-danger" role="button">Back</a>';
        }?>
    </div>
  </body>
</html>