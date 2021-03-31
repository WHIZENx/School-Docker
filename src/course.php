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
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Course</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/courses.png">
  <link href="https://fonts.googleapis.com/css?family=Kodchasan&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/course.js"></script>
  <link rel="stylesheet" href="css/course.css">
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" href="main.php">หน้าหลัก</a>
      <a id="menu" href="student.php">นักเรียน</a>
      <a id="menu" href="teacher.php">คุณครู</a>
      <a id="menu" class="active" href="course.php">รายวิชา</a>
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
      <h1>รายวิชา</h1>
      <a class="btn btn-success" style="margin-top: 10px;" href="course_add.php"><i class="fa fa-plus"></i> Add</a>
      <hr>
      <form action="course.php" method="get">
        <div class="input-group mb-3" style="width: 60%">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">ชั้นประถมศึกษาปีที่</label>
            </div>
            <select class="custom-select" id="inputGroupSelect02" onchange="insert_course_view()">
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
              <label class="input-group-text" for="inputGroupSelect03">กลุ่มสาระ</label>
            </div>
            <select class="custom-select" id="inputGroupSelect03" onchange="insert_course_view()">
             <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i < count($sec); $i++) {
                    if ($_GET['Section'] == str_replace("%20", " ", $sec[$i])) {
                        echo '<option value="'.$sec[$i].'" selected>'.$sec[$i].'</option>';
                    } else {
                        echo '<option value="'.$sec[$i].'">'.$sec[$i].'</option>';
                    }
                }
              ?>
            </select>
          </div>
          <?php
            if (isset($_GET['GradeNo'])) {
              echo '<input type="hidden" name="gradeno" id="gradeno" value="'.$_GET['GradeNo'].'">';
            } else {
              echo '<input type="hidden" name="gradeno" id="gradeno" value="" />';
            }
            if (isset($_GET['Section'])) {
              echo '<input type="hidden" name="section" id="section" value="'.$_GET['Section'].'">';
            } else {
              echo '<input type="hidden" name="section" id="section" value="" />';
            }
          ?>
          <div class="input-group mb-3" style="width: 30%">
            <div class="input-group-prepend">
              <label class="input-group-text" for="search_course"><i class="fa fa-search"></i></label>
            </div>
            <input type="text" class="form-control" id="search_course" placeholder="Course ID" name="search_course">
          </div>
          <?php
            if (isset($_GET["searchID"]) != '') {
              $sql = $course->get_course_id($_GET["searchID"]);
              echo '<a id="clear_course" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_course()" name="clear_course">Clear</a>
              <a id="search_course" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_course()" name="search_course">Search</a>
        </form>
        <br>
        <p><b>ผลการค้นหา: รหัสวิชา '.$_GET["searchID"].'</b></p>';
            } else {
              if (isset($_GET["GradeNo"]) == '' && isset($_GET["Section"]) == '' ) {
                $sql = $course->get_course_all();
                echo '<a id="search_course" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_course()" name="search_course">Search</a>
        </form>
        <br>';
              } else {
                $sql = $course->get_course($_GET["GradeNo"], $_GET["Section"]);
                echo '<a id="clear_course" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_course()" name="clear_course">Clear</a>
                <a id="search_course" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_course()" name="search_course">Search</a>
        </form>
        <br>';
              }
            }
            $result = $course->con->select($sql);    
            if ($result) { ?>
             <table id="course">
                <tr>
                <th>ID</th>
                <th>ชื่อวิชา</th>
                <th>สายวิชา</th>
                <th>หน่วยกิต</th>
                <th>ชื่อผู้สอน</th>
                <th>เปลี่ยนแปลง</th>
                </tr>
                <?php while ($rows = $course->con->fetch($result)) {
                  $course->query_course($rows, $course->i);?>
                  <tr>
                    <td align="center"><?php echo $course->courseid; ?></td>
                    <td align="center"><?php echo $course->coursename; ?></td>
                    <td align="center"><?php echo $course->program; ?></td>
                    <td align="center"><?php echo $course->credit; ?></td>
                    <td align="center"><?php
                    $sql_tid = $course->get_teacher_id($course->teacherid);
                    $result_tid = $course->con->select($sql_tid);  
                    $rows_tid = $course->con->fetch($result_tid);
                    $course->query_teacher($rows_tid, $course->i);
                    echo "$course->title $course->teafname $course->tealname";
                     ?>
                     </td>
                    <td align="center">
                      <a class="btn btn-warning" href="course_update.php?courseID=<?php echo $course->courseid?>" style="color: white;">Update</a>
                    </td>
                  </tr>
                  <?php
                };
              } else {
                echo "<h1 style='color: red;'>Course Not found in database</h1>";
              }
          ?>
    </div>
  </body>
</html>