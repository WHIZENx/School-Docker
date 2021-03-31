<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "teacher") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/course.php';
  include 'class/manage.php';

  $course = new Course();

  $course->insert_course();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Add Course</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/courses.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/course.js"></script>
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/course.css">
  </head>
  <body>
    <div id="page-container" style="margin-top: 15px;">
      <h1>Add Course</h1>
      <form name="myForm" action="course_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">ระดับชั้นประถมศึกษาปีที่</label>
            </div>
            <select class="custom-select" id="inputGroupSelect02" onchange="insert_course()">
              <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i <= $grade_number; $i++) {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
              ?>
            </select>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect03">สาย</label>
            </div>
            <select class="custom-select" id="inputGroupSelect03" onchange="insert_course()">
              <option selected>เลือก...</option>
              <option value="ภาคปกติ">ภาคปกติ</option>
              <option value="วิทย์-คณิต">วิทย์-คณิต</option>
              <option value="ศิลป์">ศิลป์</option>
            </select>
          </div>
          <input type="hidden" name="gradeno" id="gradeno" value="" />
          <input type="hidden" name="prono" id="prono" value="" />
        </div>
        <div class="form-group">
          <span style="color:red;">* </span><label for="name" style="color: black">อาจารย์ผู้สอน:</label>
          <select class="custom-select" id="inputGroupSelect04" onchange="insert_course()">
            <option selected>เลือก...</option>
            <?php
            $sql = $course->get_teacher_all();
            $qry = $course->con->select($sql);

            if ($qry) {
              while ($rows = $course->con->fetch($qry)) {
                $course->query_teacher($rows, $course->i);
                echo '<option value="'.$course->teacherID.'">'.$course->teacherID.': '.$course->title.''.$course->teafname.' '.$course->tealname.' ('.$course->group.')</option>';   
              }
            }?>
          </select>
          <input type="hidden" id="tid" name="tid" value="">
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="cid" style="color: black">รหัสวิชา:</label>
              <input type="text" class="form-control" id="cid" placeholder="Course ID" name="cid" min=0>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <span style="color:red;">* </span><label for="cname" style="color: black">ชื่อวิชา:</label>
              <input type="text" class="form-control" id="cname" placeholder="Course Name" name="cname">
            </div>
          </div>
        </div>
        <div class="form-group">
          <span style="color:red;">* </span><label for="credit" style="color: black">หน่วยกิต:</label>
          <input type="text" class="form-control" id="credit" placeholder="หน่วยกิต" name="credit">
        </div>
        <a href="course.php" class="btn btn-danger" role="button">Back</a>
        <button type="submit" class="btn btn-success">Add</button>
      </form>
    </div>
  </body>
</html>