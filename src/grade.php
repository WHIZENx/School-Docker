<?php
  session_start();
  if(isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == "staff") {
      echo "<script>window.location.replace('main.php')</script>";
    }
  } else {
    echo "<script>window.location.replace('login.php')</script>";
  }
  
  include 'class/grade.php';
  include 'class/semester.php';
  include 'class/manage.php';

  $grade = new Score();
  $semester = new Semester();

  $grade->update_grade()
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Grade</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/point.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/grade.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/grade.css">
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" href="main.php">หน้าหลัก</a>
      <a id="menu" class="active" href="grade.php">ผลการเรียน</a>
      <div class="logout" style="float: right">
      <form name="myForm" action="login.php" method="post" enctype="multipart/form-data">
          <?php 
            if($_SESSION["permission"] == "teacher") {
              echo '<a id="menu-change-password" href="change_password.php" >Change password</a>';
            }
          ?>
          <button type="submit" id="menu-logout" name="logout">Logout</button>
        </form>
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
      <h1>ผลการเรียน</h1>
      <hr>
      <div class="form-group">
      <div id="grade" class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect04">ปีการศึกษา/เทอม</label>
        </div>
        <select class="custom-select" id="inputGroupSelect04" onchange="insert_grade()">
            <?php
            $sql = $semester->get_semester_all();
            $result = $semester->con->select($sql);

            echo "<option selected>เลือก...</option>";
            
            if ($result) {
                while ($rows = $semester->con->fetch($result)) {
                    $semester->query_semester($rows);
                    if ($_GET["Year"] == $semester->semyear && $_GET["SemesterNo"] == $semester->semterm) {
                        echo '<option value="'.$semester->semyear.'_'.$semester->semterm.'" selected>'.$semester->semyear.'/'.$semester->semterm.'</option>';
                    } else {
                        echo '<option value="'.$semester->semyear.'_'.$semester->semterm.'">'.$semester->semyear.'/'.$semester->semterm.'</option>';
                    }
              }
            }
            ?>
          </select>
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelectc">รายวิชา</label>
          </div>
          <select class="custom-select" id="inputGroupSelectc" onchange="insert_grade()">
            <option selected>เลือก...</option>
            <?php
              $sql = $grade->get_course_all();
              $result = $grade->con->select($sql);

              if ($result) {
                  while ($rows = $grade->con->fetch($result)) {
                    $grade->query_course($rows, $grade->i);
                    if (str_replace("'", "", $_GET["CourseID"]) == $grade->courseid) {
                        echo '<option value="'.$grade->courseid.':'.$coursename.'" selected>'.$grade->courseid.':'.$grade->coursename.'</option>';
                    } else {
                        echo '<option>'.$grade->courseid.': '.$grade->coursename.'</option>';   
                    }
                  }
              }
              ?>
          </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">ระดับชั้นประถมศึกษาปีที่</label>
            </div>
            <select class="custom-select" id="inputGroupSelect02" onchange="insert_grade()">
              <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i <= $grade_number; $i++) {
                    if ($_GET['GradeNo'] == $i) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
              ?>
            </select>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect03">ห้อง</label>
            </div>
            <select class="custom-select" id="inputGroupSelect03" onchange="insert_grade()">
              <option selected>เลือก...</option>
              <?php
                for ($i = 1; $i <= $room_number; $i++) {
                    if ($_GET['RoomNo'] == $i) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
              ?>
            </select>
          </div>
          <input type="hidden" name="gradeno" id="gradeno" value="" />
          <input type="hidden" name="roomno" id="roomno" value="" />
          <input type="hidden" name="semesterid" id="semesterid" value="" />
          <input type="hidden" name="courseid" id="courseid" value="" />
        <?php
            if (isset($_GET["Year"]) == '' && isset($_GET["SemesterNo"]) == '' && isset($_GET["CourseID"]) == '' && isset($_GET["GradeNo"]) == '' && isset($_GET["RoomNo"]) == '') {
              echo '
              <a id="search_grade" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_grade()" name="search_grade">Search</a>
              </form>
        <br>';
            } else {
              $sql = $grade->get_grade($_GET["GradeNo"], $_GET["RoomNo"], $_GET["Year"], $_GET["SemesterNo"], $_GET["CourseID"]);
              echo '<a id="clear_grade" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_grade()" name="clear_grade">Clear</a>
                <a id="search_grade" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_grade()" name="search_grade">Search</a>
        </form>
        <br>';

            $result = $grade->con->select($sql);
            if ($result) {
              echo '<br> <table id="grade">
                     <tr>
                      <th>No.</th>
                      <th>ID</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>คะแนนงาน</th>
                      <th>Midterm</th>
                      <th>Final</th>
                      <th>เกรด</th>
                      <th>เปลี่ยนแปลง</th>
                    </tr>';
                while ($rows = $grade->con->fetch($result)) {
                    $grade->query_student($rows, $grade->i);
                    $sql_score = $grade->get_score($_GET["Year"], $_GET["SemesterNo"], $grade->studentID, $_GET["CourseID"]);
                    $result_score = $grade->con->select($sql_score);
                    if (!$result_score) {
                        $grade->insert_score($_GET["Year"], $_GET["SemesterNo"], $grade->studentID, $_GET["CourseID"]);
                    }
                    ?>
                    <tr>
                      <td align='center'><?php echo $grade->no; ?></td>
                      <td><?php echo $grade->studentID; ?></td>
                      <td><?php echo $grade->ntitle ?><?php echo $grade->stdfname ?> <?php echo $grade->stdlname; ?></td>
                    <?php
                    while ($rows_score = $grade->con->fetch($result_score)) {
                        $grade->query_score($rows_score);
                        $sql_score_detail = $grade->get_score_detail_id($grade->id_score);
                        $result_score_detail = $grade->con->select($sql_score_detail);
                        if ($result_score_detail) {
                            while ($rows_score_detail = $grade->con->fetch($result_score_detail)) {
                                $grade->query_score_detail($rows_score_detail); ?>
                            <form name="myForm" action="grade.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="scoreid" id="scoreid" value=<?php echo $grade->id_score_detail?> />
                                <input type="hidden" name="year" id="year" value=<?php echo $_GET["Year"]?> />
                                <input type="hidden" name="semesterno" id="semesterno" value=<?php echo $_GET["SemesterNo"]?> />
                                <input type="hidden" name="courseid_g" id="courseid_g" value=<?php echo $_GET["CourseID"]?> />
                                <input type="hidden" name="gradeno_g" id="gradeno_g" value=<?php echo $_GET["GradeNo"]?> />
                                <input type="hidden" name="roomno_g" id="roomno_g" value=<?php echo $_GET["RoomNo"]?> />
                                <td align="center">
                                <?php
                                if ($grade->grade == '' || $grade->grade == '0.0') {
                                    if ($grade->grade == '0.0') {
                                    echo "<input name='midterm_score' id='midterm_score' type='hidden' value='".$grade->midterm_score."'/>";
                                    echo "<input name='final_score' id='final_score' type='hidden' value='".$grade->final_score."'/>";
                                    }
                                    echo "<input name='normal_score' id='normal_score' type=number style='width:50%'' min='0' max='50' value='".$grade->normal_score."'/>";
                                } else {
                                    echo "<b>".$grade->normal_score."</b>";
                                }?>
                                </td>
                                <td align="center" style="max-width: 100px;">
                                <?php
                                if ($grade->grade == '') {
                                    echo "<input name='midterm_score' id='midterm_score' type=number style='width:50%'' min='0' max='25' value='".$grade->midterm_score."'/>";
                                } else {
                                    echo "<b>".$grade->midterm_score."</b>";
                                }?>
                                </td>
                                <td align="center" style="max-width: 100px;">
                                <?php
                                if ($grade->grade == '') {
                                    echo "<input name='final_score' id='final_score' type=number style='width:50%'' min='0' max='25' value='".$grade->final_score."'/>";
                                } else {
                                    echo "<b>".$grade->final_score."</b>";
                                }?>
                                <td align="center" style="max-width: 100px;">
                                <?php
                                $point = $grade->normal_score+$grade->midterm_score+$grade->final_score;
                                if ($grade->grade != '') {
                                    echo "<b>".$grade->grade."</b>";
                                } else {
                                    echo '<button type="submit" name="action" value="Calculate" class="btn btn-success" style="color: white; margin-right: 10px;">Calculate</button>';
                                }?>
                                </td>
                                <td align="center" style="max-width: 100px;">
                                <?php
                                    if ($grade->grade == '') {
                                    echo '<button type="submit" name="action" value="Save" class="btn btn-warning" style="color: white;">Save</button>';
                                    } elseif ($grade->grade == '0.0') {
                                    echo '<button type="submit" name="action" value="Repair" class="btn btn-danger" style="color: white;">Repair</button>';
                                    }
                                ?>
                                </td>
                          </form>
                          <?php
                        }
                      }
                    }  
                }
                echo "</table>";
            } else {
              echo "<h1 style='color: red;'>Class ".$_GET["CourseID"]."not enroll.</h1>";
            }
          }
          ?>
    </div>
  </body>
</html>