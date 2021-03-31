<?php
    include 'class/teacher.php';

    class Course extends Teacher {
        public $courseid, $grade, $program, $coursename, $credit, $teacherid;
        public $i = 0;

        public function get_course_all() {
            return "SELECT * FROM course ORDER BY courseid";
        }

        public function get_course_id($id) {
            return "SELECT * FROM course WHERE courseid='$id'";
        }

        public function get_course($grade_no, $section) {
            $array_item = array($grade_no, $section);
            $array_name = array("grade", "coursename");
            $j = 0;
            for ($i = 0; $i < count($array_item); $i++) {
                if ($array_item[$i] != '') {
                    if ($j == 0) {
                        $str = $array_name[$i]." LIKE "."'%".$array_item[$i]."%'";
                    } else {
                        $str .= " AND ".$array_name[$i]." LIKE "."'%".$array_item[$i]."%'";
                    }
                    $j += 1;
                }
            }
            return "SELECT * FROM course WHERE ".$str." ORDER BY courseid";
        }

        public function query_course($rows, $i) {
            $this->courseid = $rows['courseid'];
            $this->grade = $rows['grade'];
            $this->program = $rows['program'];
            $this->coursename = $rows['coursename'];
            $this->credit = $rows['credit'];
            $this->teacherid = $rows['teacherid'];
            $this->i += 1;
        }

        public function insert_course() {
            if (isset($_POST['cid']) == '') {
                return False;
            }

            $courseID = $_POST['cid'];
            $tid = $_POST['tid'];
            $credit = $_POST['credit'];
            $cname = $_POST['cname'];
            $gradeNo = $_POST['gradeno'];
            $prono = $_POST['prono'];

            if ($this->con->select($this->get_course_id($courseID))) {
                echo '<script type="text/javascript">
                    alert("Course ID is duplicate!")
                </script>';
                return False;
            }

            $strSQL = "INSERT INTO course (courseid, grade, program, coursename, credit, teacherid) VALUES ('$courseID', '$gradeNo', '$prono','$cname','$credit','$tid')";

            $this->con->insert($strSQL);

            echo '<script type="text/javascript">
                    alert("Add Course Completed!")
                    window.location.replace("course.php")
                </script>';
        }

        public function update_course() {
            if (isset($_POST['teacherID']) == '') {
                return False;
            }

            $tid = $_POST['teacherID'];
            $cname = $_POST['cname'];
            $credit = $_POST['credit'];

            $strSQL = "UPDATE course SET coursename='$cname', credit='$credit' WHERE courseid='$tid'";

            $this->con->update($strSQL);
                    
            echo '<script type="text/javascript">
                    alert("Update Infomation Course Completed!")
                    window.location.replace("course.php")
                </script>';
        }
    }
?>