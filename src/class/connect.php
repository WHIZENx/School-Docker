<?php
class DMC {
    public $host   = 'db';
    public $user   = 'root';
    public $pass   = '123456';
    public $dbname = 'school';

    public $link;
    public $error;

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        $this->link = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );
        if (!$this->link) {
            $this->error = "Connection fail" . $this->link->connect_error;
            return false;
        }
        $this->link->set_charset("utf8");
    }
    
    // Select or Read data
    public function select($query) {
        $result = $this->link->query($query) or
        die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Insert data
    public function insert($query) {
        $insert_row = $this->link->query($query) or
        die($this->link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Update data
    public function update($query) {
        $update_row = $this->link->query($query) or
        die($this->link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    // Delete data
    public function delete($query) {
        $delete_row = $this->link->query($query) or
        die($this->link->error . __LINE__);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }
	
    // Fetch data
	public function fetch($query) {
		$result = $query->fetch_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
	}
}
