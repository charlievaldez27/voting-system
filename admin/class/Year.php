<?php

class Year{

		    public function READ_YEAR() {
        global $db;

        $sql = "SELECT * FROM tbl_schoolyear";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

 public function READ_YEAR_FOR_VOTING() {
        global $conn;

        $sql = "SELECT * FROM tbl_schoolyear where Status = 'Active'";
        if(!$stmt = $conn->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

}