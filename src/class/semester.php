<?php
    class Semester {

        public $semyear, $semterm;
        public $con;

        public function __construct() {
            $this->con = new DMC();
        }

        public function get_semester_all() {
            return "SELECT * FROM semester ORDER BY SemID";
        }

        public function query_semester($rows) {
            $this->semyear = $rows['Year'];
            $this->semterm = $rows['SemesterNo'];
        }

    }
?>