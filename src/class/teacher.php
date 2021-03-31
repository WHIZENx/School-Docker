<?php
    include 'connect.php';

    class Teacher {
        public $teacherID, $title, $teafname, $tealname, $group, $bdate, $start, $address, $disease, $phone, $email, $status;
        public $i = 0;
        public $con;

        public function __construct(){
            $this->con = new DMC();
        }

        public function get_teacher_all() {
            return "SELECT * FROM teacher ORDER BY teacherID";
        }

        public function get_teacher_id($id) {
            return "SELECT * FROM teacher WHERE teacherID=$id";
        }

        public function get_teacher($section, $firstname, $lastname) {
            $array_item = array($section, $firstname, $lastname);
            $array_name = array("groupc", "Tfname", "Tlname");
            $j = 0;
            for ($i = 0; $i < count($array_item); $i++) {
                if ($array_item[$i] != '') {
                    if ($j == 0) {
                        $str = $array_name[$i]."="."'".$array_item[$i]."'";
                    } else {
                        $str .= " AND ".$array_name[$i]."="."'".$array_item[$i]."'";
                    }
                    $j += 1;
                }
            }
            return "SELECT * FROM teacher WHERE ".$str." ORDER BY teacherID";
        }

        public function query_teacher($rows, $i) {
            $this->teacherID = $rows['teacherid'];
            $this->title = $rows['title'];
            $this->teafname = $rows['Tfname'];
            $this->tealname = $rows['Tlname'];
            $this->group = $rows['groupc'];
            $this->bdate = $rows['BDate'];
            $this->start = $rows['start_work'];
            $this->address = $rows['address'];
            $this->email = $rows['email'];
            $this->disease = $rows['disease'];
            $this->phone = $rows['phone'];
            $this->status = $rows['status'];
            $this->i += 1;
        }

        public function insert_teacher() {
            if (isset($_POST['tid']) == '') {
                return False;
            }

            $teacherID = $_POST['tid'];
            $ntitle = $_POST['ntitle'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $birthday = $_POST['bdate'];
            $phone = $_POST['phone'];
            $disease = $_POST['disease'];
            $group = $_POST['typeno'];
            $start = $_POST['startwork'];

            if ($this->con->select($this->get_teacher_id($teacherID))) {
                echo '<script type="text/javascript">
                    alert("Teacher ID is duplicate!")
                </script>';
                return False;
            }

            $hashed_password = password_hash($birthday, PASSWORD_DEFAULT);

            $strSQL = "INSERT INTO teacher (teacherID,password,Tfname,Tlname,address,BDate,phone,disease,title,groupc,start_work,email,status) VALUES ($teacherID, '$hashed_password', '$firstname', '$lastname','$address','$birthday','$phone','$disease', '$ntitle','$group','$start','$email','Active')";

            $this->con->insert($strSQL);

            echo '<script type="text/javascript">
                alert("Add teacher Completed!")
                window.location.replace("teacher.php")
                </script>';
        }

        public function update_teacher() {
            if (isset($_POST['teacherID']) == '') {
                return False;
            }

            $teacherID = $_POST['teacherID'];
            $ntitle = $_POST['ntitle'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $birthday = $_POST['bdate'];
            $phone = $_POST['phone'];
            $disease = $_POST['disease'];
            $group = $_POST['typeno'];
            $start = $_POST['startwork'];
            $status = $_POST['status'];

            $strSQL = "UPDATE teacher SET title='$ntitle', Tfname='$firstname', BDate = '$birthday', Tlname='$lastname', address='$address', phone='$phone',disease='$disease', status='$status', groupc='$group', email='$email'  WHERE teacherid='$teacherID'";

            $this->con->update($strSQL);

            echo '<script type="text/javascript">
                alert("Update Infomation teacher Completed!")
                window.location.replace("teacher.php")
                </script>';
        }
    }
?>