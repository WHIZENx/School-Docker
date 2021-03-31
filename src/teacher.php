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

?>

<!DOCTYPE html>
<html lang="th">
<head>
  <title>Staff</title>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="img/x-icon" href="img/teacher.png">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/teacher.js"></script>
  <link rel="stylesheet" href="css/teacher.css">
  </head>
  <body>
    <div class="topnav">
      <a style="color: white; float: left; text-align: center; padding: 14px 35px; text-decoration: none; font-size: 17px; background-color: gray;">School</a>
      <a id="menu" href="main.php">หน้าหลัก</a>
      <a id="menu" href="student.php">นักเรียน</a>
      <a id="menu" class="active" href="teacher.php">คุณครู</a>
      <a id="menu" href="course.php">รายวิชา</a>
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
      <h1>คุณครู</h1>
      <a class="btn btn-success" href="teacher_add.php" style="margin-top: 10px;"><i class="fa fa-plus"></i> Add</a>
      <hr>
      <form action="teacher.php" method="get">
        <div class="input-group mb-3" style="width: 80%">
            <div class="input-group-prepend">
              <label class="input-group-text">ชื่อ</label>
            </div>
            <?php
              if (isset($_GET['Firstname'])) {
                echo '<input type="text" class="form-control" id="search_tf" placeholder="ชื่อ" name="search_tf" value="'.$_GET['Firstname'].'">';
              } else {
                echo '<input type="text" class="form-control" id="search_tf" placeholder="ชื่อ" name="search_tf">';
              }
            ?>
            <div class="input-group-prepend">
              <label class="input-group-text">นามสกุล</label>
            </div>
            <?php
              if (isset($_GET['Lastname'])) {
                echo '<input type="text" class="form-control" id="search_tl" placeholder="นามสกุล" name="search_tl" value="'.$_GET['Lastname'].'">';
              } else {
                echo '<input type="text" class="form-control" id="search_tl" placeholder="นามสกุล" name="search_tl">';
              }
            ?>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect03">กลุ่มสาระ</label>
            </div>
            <select class="custom-select" id="inputGroupSelect03" onchange="insert_teacher()">
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
            if (isset($_GET['Section'])) {
              echo '<input type="hidden" name="section" id="section" value="'.$_GET['Section'].'">';
            } else {
              echo '<input type="hidden" name="section" id="section" value="" />';
            }
          ?>
          <div class="input-group mb-3" style="width: 30%">
            <div class="input-group-prepend">
              <label class="input-group-text" for="search_stdid"><i class="fa fa-search"></i></label>
            </div>
            <input type="number" class="form-control" id="search_teaid" placeholder="Teacher ID" name="search_teaid">
          </div>
        <?php
          if (isset($_GET["searchID"]) != '') {
            $sql = $teacher->get_teacher_id($_GET["searchID"]);
            echo '<a id="clear_teaid" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_teacherid()" name="clear_teaid">Clear</a>
            <a id="search_teaid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_teacherid()" name="search_teaid">Search</a>
      </form>
      <br>
      <p><b>ผลการค้นหา: รหัสครู '.$_GET["searchID"].'</b></p>';
          } else {
            if (isset($_GET["Section"]) == '' && isset($_GET["Firstname"]) == '' && isset($_GET["Lastname"]) == '') {
              $sql = $teacher->get_teacher_all();
              echo '<a id="search_teaid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_teacherid()" name="search_teaid">Search</a>
              </form>
              <br>';
            } else {
              $sql = $teacher->get_teacher($_GET["Section"], $_GET["Firstname"], $_GET["Lastname"]);
              echo '<a id="clear_teaid" class="btn btn-danger" style="color: white; cursor: pointer;" onclick="clear_teacherid()" name="clear_teaid">Clear</a>
              <a id="search_teaid" class="btn btn-info" style="color: white; cursor: pointer;" onclick="search_teacherid()" name="search_teaid">Search</a>
              </form>
              <br>';
            }
          } 
         $result = $teacher->con->select($sql); 
         if ($result) { ?>      
	        <table id="teacher">
	        <tr>
	          <th>No.</th>
	          <th>TEACHER ID</th>
	          <th>ชื่อ-นามสกุล</th>
	          <th>กลุ่มสาระ</th>
            <th>สถานะการสอน</th>
	          <th>เปลี่ยนแปลง</th>
	        </tr>
              <?php while ($rows = $teacher->con->fetch($result)) {
                  $teacher->query_teacher($rows, $teacher->i);?>
                <tr>
                  <td align="center"><?php echo $teacher->i; ?></td>
                  <td align="center"><?php echo $teacher->teacherID; ?></td>
                  <td><?php echo $teacher->title.' '; ?><?php echo $teacher->teafname ?> <?php echo $teacher->tealname; ?></td>
                  <td align="center"><?php echo $teacher->group; ?></td>
                  <td class="<?php echo $teacher->status ?>" style="text-align: center;"><b><?php echo $teacher->status ?></b></td>
                  <td align="center">
                    <a class="btn btn-warning" href="teacher_update.php?teacherid=<?php echo $teacher->teacherID; ?>" style="color: white;">Update</a>
                  </td>
                </tr>
                <?php
                }
                echo "</table>";
            } else {
              echo "<h1 style='color: red;'>Teacher Not found in database</h1>";
            }  
          ?>
      </table>
    </div>
  </body>
</html>