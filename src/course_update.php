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

  $course = new Course();

  $course->update_course();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Update Course</title>
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
    <div id="page-container" style="margin-top: 15px; width: 90%;">
      <h1>Update Course</h1>
      <p style="font-size: 25px;">
      <?php
        $sql = $course->get_course_id($_GET["courseID"]);
        $qry = $course->con->select($sql); 

        if ($qry) {
            $rows = $course->con->fetch($qry);
            $course->query_course($rows, $course->i);
            echo 'วิชา '.$course->coursename.' สำหรับประถมศึกษาปีที่ '.$course->grade.'';
        }
        ;?></p>
        <hr>
        <?php
            if ($qry) {
                echo '<form name="myForm" action="course_update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm_update()">
                    <label for="stdid" style="color: black; font-size: 20px;"><b>รหัสวิชา: '.$course->courseid.'</b></label>
                    <input type="hidden" name="teacherID" id="teacherID" value="'.$course->courseid.'" />
                    <div class="form-group">
                    <span style="color:red;">* </span><label for="name" style="color: black">อาจารย์ผู้สอน:</label>
                    <select class="custom-select" id="inputGroupSelect04" onchange="insert_course_update()">
                    ';

                $sql = $course->get_teacher_all();
                $qry = $course->con->select($sql);      
                if ($qry) {
                while ($rows = $course->con->fetch($qry)) {
                    $course->query_teacher($rows, $course->i);
                    if ($course->teacherID == $course->teacherid) {
                      echo '<option value="'.$course->teacherID.'" selected>'.$course->teacherID.': '.$course->title.''.$course->teafname.' '.$course->tealname.' ('.$course->group.')</option>';
                    } else {
                      echo '<option value="'.$course->teacherID.'">'.$course->teacherID.': '.$course->title.''.$course->teafname.' '.$course->tealname.' ('.$course->group.')</option>';
                    }
                }
            }
            echo '
            </select>
            <input type="hidden" id="tid" name="tid" value="'.$course->teacherid.'">
            </div>
            <div class="form-group">
                <span style="color:red;">* </span><label for="cname" style="color: black">ชื่อวิชา:</label>
                <input type="text" class="form-control" id="cname" placeholder="Course Name" value="'.$course->coursename.'" name="cname">
            </div>
            <div class="form-group">
                <span style="color:red;">* </span><label for="disease" style="color: black">หน่วยกิต:</label>
                <input type="text" class="form-control" id="credit" placeholder="หน่วยกิต" value="'.$course->credit.'" name="credit">
            </div>
            <a href="course.php" class="btn btn-danger" role="button">Back</a>
            <button type="submit" class="btn btn-success">Update</button>
            </form>';
        } else {
          echo '<h1 style="color: red;">Student Not found in database</h1>
          <a href="course.php" class="btn btn-danger" role="button">Back</a>';
        }?>
    </div>
  </body>
</html>