<?php
    include 'class/connect.php';

    function manage_semester() {
        $con = new DMC();

        $date = date("Y");

        $sql = "SELECT SemID FROM semester WHERE Year=CONCAT('$date','1')";

        $qry = $con->select($sql);

        if (isset($qry) == '') {
            $sql_v1 = "INSERT INTO semester (SemID, Year, SemesterNo) VALUES (CONCAT('$date','1'), '$date', '1')";
            $sql_v2 = "INSERT INTO semester (SemID, Year, SemesterNo) VALUES (CONCAT('$date','2'), '$date', '2')";

            $con->insert($sql_v1);
            $con->insert($sql_v2);
        }
    }

    function login($username, $password) {
        if (isset($_POST['submit']) == '') {
            return False;
        }

        $con = new DMC();
        
        $sql = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
        $qry = $con->select($sql);

        if ($qry) {
            session_start();
            $_SESSION["permission"] = "staff";
            $rows = $con->fetch($qry);
            $_SESSION["name"] = $rows['username'];
            echo '<script type="text/javascript">
                    window.location.replace("main.php")
                </script>';
        }

        $password = implode('-', array_reverse(explode('/', $password)));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM teacher WHERE teacherid='$username'";
        $qry = $con->select($sql);

        if ($qry) {
            $rows = $con->fetch($qry);
            if(password_verify($password, $rows['password'])) {
                session_start();
                $_SESSION["permission"] = "teacher";
                $_SESSION["id"] = $rows['teacherid'];
                $_SESSION["name"] = $rows['title'].' '.$rows['Tfname'].' '.$rows['Tlname'];
                echo '<script type="text/javascript">
                        window.location.replace("main.php")
                    </script>';
            }
        }
        
        echo '<script type="text/javascript">
                alert("ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!")
            </script>';
            return False;
    }

    function logout() {
        session_start();  
        unset($_SESSION['permission']);
        unset($_SESSION['id']); 
        unset($_SESSION['name']);  
        session_destroy();  
        header("Location: login.php");
    }

    function update_password($teacherid) {
        if (isset($_POST['new_password']) == '') {
            return False;
        }

        $con = new DMC();

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        $password = implode('-', array_reverse(explode('/', $current_password)));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM teacher WHERE teacherid=$teacherid";
        $qry = $con->select($sql);

        if ($qry) {
            $rows = $con->fetch($qry);
            if(password_verify($password, $rows['password'])) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $strSQL = "UPDATE teacher SET password='$hashed_password'WHERE teacherid='$teacherid'";

                $con->update($strSQL);

                unset($_POST);
                echo '<script type="text/javascript">
                    alert("เปลี่ยนรหัสผ่านเสร็จสิ้น!")
                    window.location.replace("main.php")
                </script>';
                return True;
            }
        }

        echo '<script type="text/javascript">
                alert("รหัสผ่านปัจจุบันไม่ถูกต้อง!")
            </script>';
            return False;

    }
?>