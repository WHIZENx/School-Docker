<?php
    include 'class/course.php';

    class Schedule extends Course {

        public $year, $term, $gradeno, $roomname, $select_courseid;
        public $i = 0;
        public $days = array("วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์");
        public $times = array("08.30-09.30", "09.30-10.30", "10.30-11.30", "13.00-14.00", "14.00-15.00", "15.00-16.00");

        public function get_course_schedule_all() {
            return "SELECT * FROM schedule ORDER BY scheduleid";
        }

        public function get_course_schedule_id($id) {
            return "SELECT * FROM schedule WHERE scheduleid='$id'";
        }

        public function query_course_schedule($rows, $i) {
            $this->year = $rows['Year'];
            $this->term = $rows['SemesterNo'];
            $this->gradeno = $rows['gradeno'];
            $this->roomname = $rows['roomname'];
            $this->i += 1;
        }

        public function insert_schedule($scheduleid) {
            if (isset($_POST['semesterid']) == '') {
                return False;
            }

            $semester = $_POST['semesterid'];
            $term = $_POST['termid'];
            $gradeNo = $_POST['gradeno'];
            $roomNo = $_POST['roomno'];

            $strSQL = "INSERT INTO schedule (scheduleid,SemesterNo,Year,gradeno,roomname) VALUES ('$scheduleid',$term,$semester,$gradeNo,$roomNo)";

            $this->con->insert($strSQL);

            echo '<script type="text/javascript">
                    alert("Add Schedule Completed!")
                    window.location.replace("class_schedule.php")
                </script>';
        }

        public function update_schedule() {
            if (isset($_POST['semesterid']) == '') {
                return False;
            }

            $semester = $_POST['semesterid'];
            $term = $_POST['termid'];
            $gradeNo = $_POST['gradeno'];
            $roomNo = $_POST['roomno'];

            $scheduleid = $semester.'_'.$term.'_'.$gradeNo.'_'.$roomNo;

            for ($i = 1; $i <= 5; $i++) {
                for ($j = 1; $j <= 6; $j++) {
                    $int = $_POST['int'.($j).'_'.($i).''];
                    $ind = $_POST['ind'.($j).'_'.($i).''];
                    $cid = $_POST['cid'.($j).'_'.($i).''];
                    $strSQL = "UPDATE schedule_detail SET courseid='$cid' WHERE idschedule='$scheduleid' AND timeno='$int' AND dayno='$ind'";
                    $this->con->update($strSQL);
                }
            }

            echo '<script type="text/javascript">
                    alert("Update Schedule Completed!")
                    window.location.replace("class_schedule.php")
                </script>';
        }
    }

    class ScheduleDetail extends Schedule {

        public $schedule_courseid;

        public function get_schedule_detail_id($year, $term, $grade, $room, $time, $day) {
            return "SELECT * FROM schedule_detail WHERE idschedule=CONCAT(".$year.",'_',".$term.",'_',".$grade.",'_',".$room.") AND timeno='$time' AND dayno='$day'";
        }

        public function query_schedule_detail($rows) {
            $this->schedule_courseid = $rows['courseid'];
        }

        public function insert_schedule_detail() {
            if (isset($_POST['semesterid']) == '') {
                return False;
            }

            $semester = $_POST['semesterid'];
            $term = $_POST['termid'];
            $gradeNo = $_POST['gradeno'];
            $roomNo = $_POST['roomno'];

            $scheduleid = $semester.'_'.$term.'_'.$gradeNo.'_'.$roomNo;

            if ($this->con->select($this->get_course_schedule_id($scheduleid))) {
                echo '<script type="text/javascript">
                    alert("Schedule is duplicate!")
                </script>';
                return False;
            }

            for ($i = 1; $i <= 5; $i++) {
                for ($j = 1; $j <= 6; $j++) {
                    if ($_POST['cid'.($j).'_'.($i).''] == NULL) {
                        echo '<script type="text/javascript">
                            alert("โปรดลงวิชาเรียนให้ครบตาราง!")
                        </script>';
                        return False;
                    }
                }
            }

            for ($i = 1; $i <= 5; $i++) {
                for ($j = 1; $j <= 6; $j++) {
                    $int = $_POST['int'.($j).'_'.($i).''];
                    $ind = $_POST['ind'.($j).'_'.($i).''];
                    $cid = $_POST['cid'.($j).'_'.($i).''];
                    $strSQL = "INSERT INTO schedule_detail (idschedule, timeno, dayno, courseid) VALUES ('$scheduleid','$int','$ind','$cid')";
                    $this->con->insert($strSQL);
                }
            }

            $this->insert_schedule($scheduleid);
        }
    }
?>