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

  $course_schedule->update_schedule();
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
  <link rel="stylesheet" href="css/center.css">
  <link rel="stylesheet" href="css/course_schedule.css">
  </head>
  <body>
    <div id="page-container" style="min-width: 500px; padding: 30px;">
      <h1>แก้ไขตารางเรียน</h1>
      <form name="myForm" action="class_schedule_update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm_update()">
      <div class="form-group">
        <div id="staff" class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect04">ตารางเรียน</label>
          </div>
          <select class="custom-select" id="inputGroupSelect04" onchange="insert_classes_update()">
          <?php
          echo "<option selected>เลือก...</option>";

            $sql = $course_schedule->get_course_schedule_all();
            $result = $course_schedule->con->select($sql);

            if ($result) {
                while ($rows = $course_schedule->con->fetch($result)) {
                    $course_schedule->query_course_schedule($rows, $course_schedule->i);
                    if ($_GET["Year"] == $course_schedule->year && $_GET["Term"] == $course_schedule->term && $_GET["Gradeno"] == $course_schedule->gradeno && $_GET["Roomno"] == $course_schedule->roomname) {
                        echo '<option value="'.$course_schedule->year.'_'.$course_schedule->term.'_'.$course_schedule->gradeno.'_'.$course_schedule->roomname.'" selected>'.$course_schedule->year.'/'.$course_schedule->term.' ประถมศึกษาปีที่ '.$course_schedule->gradeno.' ห้อง '.$course_schedule->roomname.'</option>';
                    } else {
                        echo '<option value="'.$course_schedule->year.'_'.$course_schedule->term.'_'.$course_schedule->gradeno.'_'.$course_schedule->roomname.'">'.$course_schedule->year.'/'.$course_schedule->term.' ประถมศึกษาปีที่ '.$course_schedule->gradeno.' ห้อง '.$course_schedule->roomname.'</option>';
                    }
                
              }
            }
            echo '</select>';?>
            <input type="hidden" name="semesterid" id="semesterid" value="" />
            <input type="hidden" name="termid" id="termid" value="" />
            <input type="hidden" name="gradeno" id="gradeno" value="" />
            <input type="hidden" name="roomno" id="roomno" value="" />
        </div>
      </div>
      <?php
        if (isset($_GET["Year"]) == '' && isset($_GET["Term"]) == '' && isset($_GET["Gradeno"]) == '' && isset($_GET["Roomno"]) == '') {
            echo '<table id="schedule-update" style="display: none;">';
        } else {
            echo '<table id="schedule-update" style="display: block;">';
        ?>
        <tr>
          <th>วัน / เวลา</th>
          <th>08.30-09.30</th>
          <th>09.30-10.30</th>
          <th>10.30-11.30</th>
          <th>11.30-13.00</th>
          <th>13.00-14.00</th>
          <th>14.00-15.00</th>
          <th>15.00-16.00</th>
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
                        if ($j > 3) {
                            echo '<td id="class" class="'.$j.'_'.($i+1).'" onclick="showpopup('.$j.', '.($i+1).')" data-toggle="modal" data-target="#courseCenter">';
                            $sql = $course_schedule->get_schedule_detail_id($_GET["Year"], $_GET["Term"], $_GET["Gradeno"], $_GET["Roomno"], $j, $i+1);
                        } else {
                            echo '<td id="class" class="'.($j+1).'_'.($i+1).'" onclick="showpopup('.($j+1).', '.($i+1).')" data-toggle="modal" data-target="#courseCenter">';
                            $sql = $course_schedule->get_schedule_detail_id($_GET["Year"], $_GET["Term"], $_GET["Gradeno"], $_GET["Roomno"], $j+1, $i+1);
                        }

                        $result = $course_schedule->con->select($sql);

                        if ($result) {
                            $rows = $course_schedule->con->fetch($result);
                            $course_schedule->query_schedule_detail($rows);
                            $sql_c = $course_schedule->get_course_id($course_schedule->schedule_courseid);
                            $result_c = $course_schedule->con->select($sql_c);
                            $rows_c = $course_schedule->con->fetch($result_c);
                            $course_schedule->query_course($rows_c, $course_schedule->i);
                           
                            if ($j > 3) {
                                echo '<p id="id'.$j.'_'.($i+1).'">'.$course_schedule->courseid.'</p>
                                <a id="n'.$j.'_'.($i+1).'">'.$course_schedule->coursename.'</a></td>
                                <input type="hidden" name="int'.$j.'_'.($i+1).'" id="int'.$j.'_'.($i+1).'" value="" />
                                <input type="hidden" name="ind'.$j.'_'.($i+1).'" id="ind'.$j.'_'.($i+1).'" value="" />
                                <input type="hidden" name="cid'.$j.'_'.($i+1).'" id="cid'.$j.'_'.($i+1).'" value="'.$course_schedule->courseid.'" />';
                            } else {
                                echo '<p id="id'.($j+1).'_'.($i+1).'">'.$course_schedule->courseid.'</p>
                                <a id="n'.($j+1).'_'.($i+1).'">'.$course_schedule->coursename.'</a></td>
                                <input type="hidden" name="int'.($j+1).'_'.($i+1).'" id="int'.($j+1).'_'.($i+1).'" value="" />
                                <input type="hidden" name="ind'.($j+1).'_'.($i+1).'" id="ind'.($j+1).'_'.($i+1).'" value="" />
                                <input type="hidden" name="cid'.($j+1).'_'.($i+1).'" id="cid'.($j+1).'_'.($i+1).'" value="'.$course_schedule->courseid.'" />';
                            }
                        }
                    }
                } ?>
                </tr> <?php
            }
        }?>
      </table>
      <input type="hidden" name="time" id="time" value="" />
      <input type="hidden" name="day" id="day" value="" />
      <a href="class_schedule.php" class="btn btn-danger" role="button" style="margin-top: 20px;">Cancel</a>
      <button id="update" type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-warning" style="color:white; margin-top: 20px; display: none;">Confirm</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="courseCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelectc">รายวิชา</label>
              </div>
              <select class="custom-select" id="inputGroupSelectc" onchange="">
                <option selected>เลือก...</option>
                <?php
                  $sql = $course_schedule->get_course_all();
                  $result = $course_schedule->con->select($sql);

                  if ($result) {
                      while ($rows = $course_schedule->con->fetch($result)) {
                        $course_schedule->query_course($rows, $course_schedule->i);
                        echo '<option value="'.$course_schedule->courseid.':'.$course_schedule->coursename.'">'.$course_schedule->courseid.': '.$course_schedule->coursename.'</option>';   
                      }
                  }
                  ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-success" onclick="addcourse()" data-dismiss="modal">บันทึก</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันการแก้ไขตารางเรียน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          คุณต้องการจะแก้ไขตารางเรียนนี้ใช่หรือไม่?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>
  </body>
</html>