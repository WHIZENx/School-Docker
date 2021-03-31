<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "teacher") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/schedule.php';

  $course_schedule = new ScheduleDetail();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Class Schedule</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/class_schedule.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/course_schedule.js"></script>
  <link rel="stylesheet" href="css/course_schedule.css">  
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" href="main.php">หน้าหลัก</a>
      <a id="menu" href="student.php">นักเรียน</a>
      <a id="menu" href="teacher.php">คุณครู</a>
      <a id="menu" href="course.php">รายวิชา</a>
      <a id="menu" class="active" href="class_schedule.php">ตารางเรียน</a>
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
    <div id="main-container" style="margin-top: 25px; width: 100%; max-width: 1280px;">
      <h1>ตารางเรียน</h1>
      <a class="btn btn-success" style="margin-top: 10px;" href="class_schedule_add.php"><i class="fa fa-plus"></i> Add</a>
      <a class="btn btn-warning" style="margin-top: 10px; color: white;" href="class_schedule_update.php">Update</a>
      <hr>
      <form>
      <div class="form-group">
        <div id="staff" class="input-group mb-3">
          <?php
            echo '<div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect04">ตารางเรียน</label>
          </div>
          <select class="custom-select" id="inputGroupSelect04">
            <option selected>เลือก...</option>';

            $sql = $course_schedule->get_course_schedule_all();
            $result = $course_schedule->con->select($sql);

            if ($result) {
                while ($rows = $course_schedule->con->fetch($result)) {
                    $course_schedule->query_course_schedule($rows, $course_schedule->i);
                    if ($_GET["Year"] == $course_schedule->year && $_GET["Term"] == $course_schedule->term && $_GET["GradeNo"] == $course_schedule->gradeno && $_GET["RoomNo"] == $course_schedule->roomname) {
                        echo '<option value="'.$course_schedule->year.'_'.$course_schedule->term.'_'.$course_schedule->gradeno.'_'.$course_schedule->roomname.'" selected>'.$course_schedule->year.'/'.$course_schedule->term.' ประถมศึกษาปีที่ '.$course_schedule->gradeno.' ห้อง '.$course_schedule->roomname.'</option>';
                    } else {
                        echo '<option value="'.$course_schedule->year.'_'.$course_schedule->term.'_'.$course_schedule->gradeno.'_'.$course_schedule->roomname.'">'.$course_schedule->year.'/'.$course_schedule->term.' ประถมศึกษาปีที่ '.$course_schedule->gradeno.' ห้อง '.$course_schedule->roomname.'</option>';
                    }
              }
            }
            echo '</select>';?>
            <input type="hidden" name="semesterid" id="semesterid" value="" />
            <input type="hidden" name="gradeno" id="gradeno" value="" />
            <input type="hidden" name="roomno" id="roomno" value="" />
        </div>
      </div>
      <?php
        if (isset($_GET["Year"]) == '' && isset($_GET["Term"]) == '' && isset($_GET["GradeNo"]) == '' && isset($_GET["RoomNo"]) == '') {
            echo '
              <a id="search_schedule" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_schedule()" name="search_schedule">Search</a>
              </form>
            <br>
            <table id="schedule" style="display: none;">';
                } else {
                echo '<a id="clear_schedule" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_schedule()" name="clear_schedule">Clear</a>
                    <a id="search_schedule" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_schedule()" name="search_schedule">Search</a>
            </form>
            <br>
            <table id="schedule" style="display: block;">';
        }?>
        <tr>
          <th align="center">วัน / เวลา</th>
          <th align="center">08.30-09.30</th>
          <th align="center">09.30-10.30</th>
          <th align="center">10.30-11.30</th>
          <th align="center">11.30-13.00</th>
          <th align="center">13.00-14.00</th>
          <th align="center">14.00-15.00</th>
          <th align="center">15.00-16.00</th>
        </tr>
            <?php
            for ($i = 0; $i <= 4; $i++) { ?>
                <tr>
                <td><?php echo $course_schedule->days[$i];?></td>
                <?php
                for ($j = 0; $j <= 6; $j++) { ?>
                    <?php
                    if ($j == 3) {
                        if ($i == 4) {
                            echo '<td id="break-last"></td>';
                        } else {
                          if ($i == 2) {
                              echo '<td id="break">พักเที่ยง</td>';
                          } else {
                              echo '<td id="break"></td>';
                          }
                        }
                    } else {
                        echo '<td id="class">';
                        if ($j > 3) {
                            $sql = $course_schedule->get_schedule_detail_id($_GET["Year"], $_GET["Term"], $_GET["GradeNo"], $_GET["RoomNo"], $j, $i+1);
                        } else {
                            $sql = $course_schedule->get_schedule_detail_id($_GET["Year"], $_GET["Term"], $_GET["GradeNo"], $_GET["RoomNo"], $j+1, $i+1);
                        }
                        
                        $result = $course_schedule->con->select($sql);

                        if ($result) {
                            $rows = $course_schedule->con->fetch($result);
                            $course_schedule->query_schedule_detail($rows);
                            $sql_c = $course_schedule->get_course_id($course_schedule->schedule_courseid);
                            $result_c = $course_schedule->con->select($sql_c);
                            $rows_c = $course_schedule->con->fetch($result_c);
                            $course_schedule->query_course($rows_c, $course_schedule->i);
                            echo "<p>$course_schedule->courseid</p>
                                    <a>$course_schedule->coursename</a></td>";
                        }
                    }
                }?>
                </tr>
            <?php
            }
            ?>
        </tr>
      </table>
    </div>
  </body>
</html>