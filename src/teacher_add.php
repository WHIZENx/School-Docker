<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "teacher") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/teacher.php';
  include 'class/manage.php';

  $teacher = new Teacher();

  $teacher->insert_teacher();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Add Teacher</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/teacher.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/teacher.js"></script>
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/teacher.css">
  </head>
  <body>
    <div id="page-container" style="margin-top: 15px;">
      <h1>Add Teacher</h1>
      <form name="myForm" action="teacher_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <div class="form-group">
        <div id="staff" class="input-group mb-3">
          <div id="toptions" class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">กลุ่มสาระ</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01" onchange="insert_staff()">
            <option selected>เลือก...</option>
            <?php
                for ($i = 1; $i < count($sec); $i++) {
                    echo '<option value="'.$sec[$i].'">'.$sec[$i].'</option>';
                }
              ?>
          </select>
          <input type="hidden" name="typeno" id="typeno" value="" />
        </div>
      </div>
      <div class="form-group">
        <span style="color:red;">* </span><label for="tid" style="color: black">รหัสประจำตัว:</label>
        <input type="number" class="form-control" id="tid" placeholder="Teacher ID" name="tid" min=0>
      </div>
      <div class="form-row">
          <div class="col-2">
            <div class="form-group">
              <span style="color:red;">* </span><label for="ntitle" style="color: black">คำนำหน้า:</label>
              <select class="custom-select" id="inputGroupSelect02" onchange="insert_staff()">
                <option selected>เลือก...</option>
                <option value="นาย">นาย</option>
                <option value="นางสาว">นางสาว</option>
                <option value="นาง">นาง</option>
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
        <label for="address" style="color: black">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Email" name="email">
      </div>
      <div class="form-group">
         <span style="color:red;">* </span><label for="address" style="color: black">ที่อยู่:</label>
        <input type="varchar" class="form-control" id="address" placeholder="Address" name="address">
      </div>
      <div class="form-row">
        <div class="col">
          <div class="form-group">
             <span style="color:red;">* </span><label for="bdate" style="color: black">วันเกิด:</label>
            <input type="date" class="form-control" id="bdate" name="bdate">
          </div>
        </div>
        <input type="hidden" name="startwork" id="startwork" value="" />
        <div class="col">
          <div class="form-group">
            <span style="color:red;">* </span><label for="phone" style="color: black">เบอร์โทร: (0123456789)</label>
            <input type="tel" class="form-control" id="phone" placeholder="Phone" name="phone" pattern="[0-9]{10}">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="disease" style="color: black">โรคประจำตัว:</label>
        <input type="text" class="form-control" id="disease" placeholder="Disease" name="disease">
      </div>
      <a href="teacher.php" class="btn btn-danger" role="button">Back</a>
      <button type="submit" class="btn btn-success">Add</button>
      </form>
    </div>
  </body>
</html>