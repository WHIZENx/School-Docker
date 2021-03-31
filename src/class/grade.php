<?php

    include 'connect.php';

    class Grade {
        public $studentID, $ntitle, $stdfname, $stdlname, $address, $birthday, $phone, $parent_name, $parent_phone, $disease, $status;
        public $courseid, $grade, $program, $coursename, $classroom, $credit, $teacherid;
        public $i = 0, $no = 0;
        public $con;

        public function __construct() {
            $this->con = new DMC();
        }

        public function get_student_all() {
            return "SELECT * FROM student ORDER BY studentID";
        }

        public function get_course_all() {
            return "SELECT * FROM course ORDER BY courseid";
        }

        public function query_course($rows, $i) {
            $this->courseid = $rows['courseid'];
            $this->grade = $rows['grade'];
            $this->program = $rows['program'];
            $this->coursename = $rows['coursename'];
            $this->classroom = $rows['classroom'];
            $this->credit = $rows['credit'];
            $this->teacherid = $rows['teacherid'];
            $this->i += 1;
        }

        public function get_grade($gradeno, $roomno, $year, $semester, $courseid) {
            return "SELECT * FROM student s INNER JOIN grade_c g ON g.studentID=s.studentID AND g.GradeNo='$gradeno' AND g.RoomNumber='$roomno' INNER JOIN schedule sch ON g.GradeNo=sch.gradeno AND g.RoomNumber=sch.roomname AND sch.Year='$year' AND sch.SemesterNo='$semester' AND sch.scheduleid IN (SELECT idschedule FROM schedule_detail WHERE courseid=".$courseid.") ORDER BY s.studentID";
        }

        public function query_student($rows, $no) {
            $this->studentID = $rows['studentID'];
            $this->ntitle = $rows['ntitle'];
            $this->stdfname = $rows['stdfname'];
            $this->stdlname = $rows['stdlname'];
            $this->address = $rows['address'];
            $this->phone = $rows['phone'];
            $this->parent_name = $rows['pname'];
            $this->parent_phone = $rows['pphone'];
            $this->disease = $rows['disease'];
            $this->status = $rows['status'];
            $this->no += 1;
        }

        public function update_grade() {
            if (isset($_POST['action']) == '') {
                return False;
            }

            $scoreID = $_POST['scoreid'];
            $Year = $_POST['year'];
            $SemesterNo = $_POST['semesterno'];
            $CourseID = $_POST['courseid_g'];
            $DegNo = $_POST['degno'];
            $GradeNo = $_POST['gradeno_g'];
            $RoomNo = $_POST['roomno_g'];

            $normal_score = $_POST['normal_score'];
            $midterm_score = $_POST['midterm_score'];
            $final_score = $_POST['final_score'];

            $strSQL = "UPDATE detail_score SET normal_score=$normal_score, midterm_score=$midterm_score, final_score=$final_score WHERE scoreid='$scoreID'";

            if ($_POST['action'] == 'Calculate' || $_POST['action'] == 'Repair') {
                $point = $normal_score+$midterm_score+$final_score;
                if ($point >= 80) {
                  $grade_ch = '4.0';
                } elseif ($point >= 75) {
                  $grade_ch = '3.5';
                } elseif ($point >= 70) {
                  $grade_ch = '3.0';
                } elseif ($point >= 65) {
                  $grade_ch = '2.5';
                } elseif ($point >= 60) {
                  $grade_ch = '2.0';
                } elseif ($point >= 55) {
                  $grade_ch = '1.5';
                }  elseif ($point >= 50) {
                  $grade_ch = '1.0';
                } else {
                  $grade_ch = '0.0';
                }
                if ($_POST['action'] == 'Repair') {
                  $strSQL_grade = "UPDATE detail_score SET grade='1.0' WHERE scoreid='$scoreID'";
                  echo '<script type="text/javascript">
                          alert("Solve Grade 0 Completed!");
                        </script>';
                } else {
                  $strSQL_grade = "UPDATE detail_score SET grade=$grade_ch WHERE scoreid='$scoreID'";
                  echo '<script type="text/javascript">
                          alert("Calculate Grade Completed!");
                        </script>';
                }
                $this->con->update($strSQL_grade);
              } else {
                echo '<script type="text/javascript">
                        alert("Save Grade Completed!");
                      </script>';
              }

            $this->con->update($strSQL);
                    
            echo '<script type="text/javascript">
                    window.location.replace("grade.php?&Year='.$Year.'&SemesterNo='.$SemesterNo.'&CourseID=%27'.$CourseID.'%27&GradeNo='.$GradeNo.'&RoomNo='.$RoomNo.'");
                </script>';
        }
    }

    class Score extends Grade {

        public $id_score, $id_score_detail, $grade, $midterm_score, $final_score, $normal_score;

        public function get_score($year, $semester, $studentid, $courseid) {
            return "SELECT * FROM score WHERE scoreid=CONCAT(".$year.",'_',".$semester.",'_',".$studentid.",'_',".$courseid.")";
        }

        public function query_score($rows) {
            $this->id_score = $rows['scoreid'];
        }

        public function insert_score($year, $semester, $studentid, $courseid) {
            $add_score = "INSERT INTO score (scoreid, studentid, courseid) VALUES (CONCAT(".$year.",'_',".$semester.",'_',".$studentid.",'_',".$courseid."), ".$studentid.", ".$courseid.")";
            $add_score_detial = "INSERT INTO detail_score (scoreid, normal_score, midterm_score, final_score, grade) VALUES (CONCAT(".$year.",'_',".$semester.",'_',".$studentid.",'_',".$courseid."), 0, 0, 0, '')";

            $this->con->insert($add_score);
            $this->con->insert($add_score_detial);
                
            echo "<script>location.reload();</script>";
        }

        public function get_score_detail_id($id) {
            return "SELECT * FROM detail_score WHERE scoreid='$id'";
        }

        public function query_score_detail($rows) {
            $this->id_score_detail = $rows['scoreid'];
            $this->grade = $rows['grade'];
            $this->normal_score = $rows['normal_score'];
            $this->midterm_score = $rows['midterm_score'];
            $this->final_score = $rows['final_score'];
        }
    }
?>