<?php
    include 'connect.php';

    class Student {
        public $studentID, $ntitle, $stdfname, $stdlname, $address, $birthday, $phone, $parent_name, $parent_phone, $disease, $styear, $status;
        public $i = 0;
        public $con;

        public function __construct() {
            $this->con = new DMC();
        }

        public function get_student_all() {
            return "SELECT * FROM student ORDER BY studentID";
        }

        public function get_student_id($id) {
            return "SELECT * FROM student WHERE studentID=$id";
        }

        public function get_student_status($id, $status) {
            return "SELECT * FROM student WHERE studentID='$id' AND status='$status'";
        }

        public function get_student($grade_no, $room_no, $firstname, $lastname) {
            $array_item = array($grade_no, $room_no, $firstname, $lastname);
            $array_name = array("GradeNo", "RoomNumber", "stdfname", "stdlname");
            $j = 0;
            $j_2 = 0;
            $str_mode = 0;
            for ($i = 0; $i < count($array_item); $i++) {
                if ($array_item[$i] != '') {
                    $str_mode = 1;
                    if ($j == 0) {
                        $str = $array_name[$i]."="."'".$array_item[$i]."'";
                    } else {
                        $str .= " AND ".$array_name[$i]."="."'".$array_item[$i]."'";
                    }
                    $j += 1;
                    if ($i > 1) {
                        if ($str != NULL) {
                            $str_mode = 2;
                        }
                        if ($j_2 == 0) {
                            $str_2 = $array_name[$i]." LIKE "."'".$array_item[$i]."'";
                        } else {
                            $str_2 .= " AND ".$array_name[$i]." LIKE "."'".$array_item[$i]."'";
                        }
                        $j_2 += 1;
                    }
                }
            }
            if ($str_mode == 0) {
                return "SELECT * FROM student WHERE ".$str_2." ORDER BY studentID";
            } else if ($str_mode == 1) {
                return "SELECT * FROM student WHERE studentID IN (SELECT studentID FROM grade_c WHERE ".$str.") ORDER BY studentID";
            } else if ($str_mode == 2) {
                return "SELECT * FROM student WHERE ".$str_2." AND studentID IN (SELECT studentID FROM grade_c WHERE ".$str.") ORDER BY studentID";
            }
        }

        public function query_student($rows, $i) {
            $this->studentID = $rows['studentID'];
            $this->ntitle = $rows['ntitle'];
            $this->stdfname = $rows['stdfname'];
            $this->stdlname = $rows['stdlname'];
            $this->address = $rows['address'];
            $this->phone = $rows['phone'];
            $this->parent_name = $rows['pname'];
            $this->parent_phone = $rows['pphone'];
            $this->disease = $rows['disease'];
            $this->styear = $rows['start_year'];
            $this->status = $rows['status'];
            $this->i += 1;
        }

        public function insert_student() {
            if (isset($_POST['stdid']) == '') {
                return False;
            }

            $studentID = $_POST['stdid'];
            $ntitle = $_POST['ntitle'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $birthday = $_POST['bdate'];
            $phone = $_POST['phone'];
            $pname = $_POST['pname'];
            $pphone = $_POST['pphone'];
            $disease = $_POST['disease'];
            $gradeNo = $_POST['gradeno'];
            $roomNo = $_POST['roomno'];
            $styear = $_POST['styear'];

            if ($this->con->select($this->get_student_id($studentID))) {
                echo '<script type="text/javascript">
                    alert("Student ID is duplicate!")
                </script>';
                return False;
            }

            $strSQL = "INSERT INTO student (studentID,ntitle,stdfname,stdlname,address,birthday,phone,pname,pphone,disease,start_year,status) VALUES ($studentID, '$ntitle', '$firstname', '$lastname','$address','$birthday','$phone','$pname','$pphone','$disease', '$styear','Active')";

            $strSQL2 = "INSERT INTO grade_c (GradeNo, RoomNumber, studentID) VALUES ('$gradeNo','$roomNo','$studentID')";

            $this->con->insert($strSQL);
            $this->con->insert($strSQL2);

            echo '<script type="text/javascript">
                    alert("Add Student Completed!")
                    window.location.replace("student.php")
                </script>';
        }

        public function update_student() {
            if (isset($_POST['studentID']) == '') {
                return False;
            }

            $stdid = $_POST['studentID'];
            $ntitle = $_POST['ntitle'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $pname = $_POST['pname'];
            $pphone = $_POST['pphone'];
            $disease = $_POST['disease'];
            $status = $_POST['status'];

            $gradeno = $_POST['gradeno'];
            $roomno = $_POST['roomno'];

            $strSQL = "UPDATE student SET ntitle='$ntitle', stdfname='$firstname', stdlname='$lastname', address='$address', phone='$phone', pname='$pname', pphone='$pphone', disease='$disease', status='$status' WHERE studentID='$stdid'";

            $strSQL2 = "UPDATE grade_c SET GradeNo='$gradeno', RoomNumber='$roomno' WHERE studentID='$stdid'";

            $this->con->update($strSQL);
            $this->con->update($strSQL2);
                    
            echo '<script type="text/javascript">
                    alert("Update Infomation Student Completed!")
                    window.location.replace("student.php")
                </script>';
        }
    }

    class GradeRoom extends Student {
    	public $grade_number, $room_number, $id;

    	public function get_grade_room_byid($id) {
    		return "SELECT * FROM grade_c g WHERE g.studentID=".$id."";
    	}

        public function get_grade_all() {
    		return "SELECT * FROM grade_c";
    	}

    	public function query_grade_room($rows) {
            $this->grade_number = $rows['GradeNo'];
            $this->room_number = $rows['RoomNumber'];
            $this->id = $rows['studentID'];
        }

        public function promote_student($grade_count) {
            if (isset($_POST['submit']) == '') {
                return False;
            }

            $sql = $this->get_grade_all();
            $result = $this->con->select($sql);
            if ($result) {
                while ($rows = $this->con->fetch($result)) {
                    $this->query_grade_room($rows);
                    $intval = intval($this->grade_number)+1;
                    $sql_student = $this->get_student_status($this->id, "Inactive");
                    $result_student = $this->con->select($sql_student);
                    if (!$result_student) {
                        if ($intval > $grade_count) {
                            $strSQL = "UPDATE student SET status='Graduate' WHERE studentID='$this->id'";
                        } else {
                            $strSQL = "UPDATE grade_c SET GradeNo='$intval' WHERE studentID='$this->id'";
                        }
                        $this->con->update($strSQL);
                    }
                }
            }

            $_POST['submit'] = '';

            echo '<script type="text/javascript">
                    alert("Promote student Completed!")
                    window.location.replace("student.php")
                </script>';
        }
    }
?>