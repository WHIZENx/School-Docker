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

  $teacher = new Teacher();

  $teacher->update_teacher();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Update Teacher</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/student.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/teacher.js"></script>
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/teacher.css">
  <script type="text/javascript">
  </script>
  </head>
  <body>
    <div id="page-container" style="margin-top: 15px;">
      <h1>Update Teacher</h1>
      <hr>
      <?php
        $sql = $teacher->get_teacher_id($_GET["teacherid"]);
        $qry = $teacher->con->select($sql); 

        if ($qry) {
          $rows = $teacher->con->fetch($qry);
          $teacher->query_teacher($rows, $teacher->i);
            echo '<form name="myForm" action="teacher_update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm_update()">
              <label for="stdid" style="color: black; font-size: 20px;"><b>รหัสประจำตัว: '.$teacher->teacherID.'</b></label>
              <input type="hidden" name="teacherID" id="teacherID" value="'.$teacher->teacherID.'" />
              <div class="form-row">
                <div class="col-2">
                  <div class="form-group">
                    <label for="ntitle" style="color: black">คำนำหน้า:</label>
                    <select class="custom-select" id="inputGroupSelect01" onchange="update_student()">';
                      if ($teacher->title == 'เด็กชาย')
                        echo '<option value="เด็กชาย" selected>เด็กชาย</option>';
                      else
                        echo '<option value="เด็กชาย">เด็กชาย</option>';
                      if ($teacher->title == 'เด็กหญิง')
                        echo '<option value="เด็กหญิง" selected>เด็กหญิง</option>';
                      else
                        echo '<option value="เด็กหญิง">เด็กหญิง</option>';
                      if ($teacher->title == 'นาย')
                        echo '<option value="นาย" selected>นาย</option>';
                      else
                        echo '<option value="นาย">นาย</option>';
                      if ($teacher->title == 'นางสาว')
                        echo '<option value="นางสาว" selected>นางสาว</option>';
                      else
                        echo '<option value="นางสาว">นางสาว</option>';
                    echo '</select>
                    <input type="hidden" name="ntitle" id="ntitle" value="'.$teacher->title.'" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="firstname" style="color: black">ชื่อ:</label>
                    <input type="text" class="form-control" id="firstname" placeholder="First Name" value="'.$teacher->teafname.'" name="firstname">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="lastname" style="color: black">นามสกุล:</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="'.$teacher->tealname.'" name="lastname">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <span style="color:red;">* </span><label for="address" style="color: black">ที่อยู่:</label>
                <input type="text" class="form-control" id="address" placeholder="Address" value="'.$teacher->address.'" name="address">
              </div>
              <div class="form-group">
		        <label for="address" style="color: black">Email:</label>
		        <input type="text" class="form-control" id="email" value="'.$teacher->email.'" placeholder="Email" name="email">
		      </div>
		      <div class="form-group">
		        <span style="color:red;">* </span><label for="bdate" style="color: black">วันเกิด:</label>
            	<input type="date" class="form-control" id="bdate" value="'.$teacher->bdate.'" name="bdate">
		      </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="phone" style="color: black">เบอร์โทร:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone" value="'.$teacher->phone.'" name="phone">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <span style="color:red;">* </span><label for="pname" style="color: black">กลุ่มสาระ:</label>
                    <select class="custom-select" id="inputGroupSelect02" onchange="update_student()">';
                      if ($teacher->group == 'ภาษาไทย')
                        echo '<option value="ภาษาไทย" selected>ภาษาไทย</option>';
                      else
                        echo '<option value="ภาษาไทย">ภาษาไทย</option>';
                      if ($teacher->group == 'คณิตศาสตร์')
                        echo '<option value="คณิตศาสตร์" selected>คณิตศาสตร์</option>';
                      else
                        echo '<option value="คณิตศาสตร์">คณิตศาสตร์</option>';
                      if ($teacher->group == 'สังคมศึกษา ศาสนาและวัฒนธรรม')
                        echo '<option value="สังคมศึกษา ศาสนาและวัฒนธรรม" selected>สังคมศึกษา ศาสนาและวัฒนธรรม</option>';
                      else
                        echo '<option value="สังคมศึกษา ศาสนาและวัฒนธรรม">สังคมศึกษา ศาสนาและวัฒนธรรม</option>';
                      if ($teacher->group == 'วิทยาศาสตร์')
                        echo '<option value="วิทยาศาสตร์" selected>วิทยาศาสตร์</option>';
                      else
                        echo '<option value="วิทยาศาสตร์">วิทยาศาสตร์</option>';
                      if ($teacher->group == 'ภาษาต่างประเทศ')
                        echo '<option value="ภาษาต่างประเทศ" selected>ภาษาต่างประเทศ</option>';
                      else
                        echo '<option value="ภาษาต่างประเทศ">ภาษาต่างประเทศ</option>';
                      if ($teacher->group == 'สุขศึกษาและพละศึกษา')
                        echo '<option value="สุขศึกษาและพละศึกษา" selected>สุขศึกษาและพละศึกษา</option>';
                      else
                        echo '<option value="สุขศึกษาและพละศึกษา">สุขศึกษาและพละศึกษา</option>';
                      if ($teacher->group == 'ศิลปะ')
                        echo '<option value="ศิลปะ" selected>ศิลปะ</option>';
                      else
                        echo '<option value="ศิลปะ">ศิลปะ</option>';
                      if ($teacher->group == 'การงานอาชีพและเทคโนโลยี')
                        echo '<option value="การงานอาชีพและเทคโนโลยี" selected>การงานอาชีพและเทคโนโลยี</option>';
                      else
                        echo '<option value="การงานอาชีพและเทคโนโลยี">การงานอาชีพและเทคโนโลยี</option>';
                    echo '</select>
                    <input type="hidden" name="typeno" id="typeno" value="'.$teacher->group.'" />
                  </div>
              </div>
              </div>
              <div class="form-group">
                <label for="disease" style="color: black">โรคประจำตัว:</label>
                <input type="text" class="form-control" id="disease" placeholder="Disease" value="'.$teacher->disease.'" name="disease">
              </div>
              <div class="form-group">
              <label for="status" style="color: black">สถานะ:</label>
                <div class="row" style="margin-left: 20px;">
                <div class="col-2 custom-control custom-radio">';
                if ($teacher->status == 'Active') {
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
                if ($teacher->status == 'Inactive') {
                  echo '<input type="radio" class="custom-control-input" id="Group2" name="status" value="Inactive" checked>';
                } else {
                  echo '<input type="radio" class="custom-control-input" id="Group2" name="status" value="Inactive">';
                }
                echo '
                <label class="custom-control-label" for="Group2" style="color: red;"><b>Inactive</b></label>
              </div>
              </div>
              <br>
              <a href="teacher.php" class="btn btn-danger" role="button">Back</a>
              <button type="submit" class="btn btn-success">Update</button>
            </form>';
        } else {
          echo '<h1 style="color: red;">Student Not found in database</h1>
          <a href="student.php" class="btn btn-danger" role="button">Back</a>';
        }?>
    </div>
  </body>
</html>