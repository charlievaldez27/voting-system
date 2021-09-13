<?php


class SHSVoting
{
    public function READ_YEAR() {
        global $db;

        $sql = "SELECT * FROM tbl_schoolyear where Status = 'Running'";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

     public function READ_YEAR_FOR_VOTING() {
        global $db;

        $sql = "SELECT * FROM tbl_schoolyear where Status = 'Running'";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }


    public function READ_POSITION($schoolyear) {
        global $db;

        $sql = "SELECT *
                FROM tbl_position
                WHERE schoolyear = ?
                AND Category = 'SHS-Normal'
                AND Level = 'Senior High'";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $schoolyear);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }
        public function READ_REP_POSITION($schoolyear, $Representatives) {
        global $db;

        $sql = "SELECT *
                FROM tbl_position
                WHERE schoolyear = ?
                AND Category = 'SHS-Representatives'
                AND Representatives = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $schoolyear, $Representatives);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }


    public function READ_NOMINEES($schoolyear, $position) {
        global $db;

        $sql = "SELECT *
                FROM tbl_nominees
                WHERE schoolyear = ?
                AND position = ?
                AND Level = 'Senior High'
                AND Status = 'Active'";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ss", $schoolyear, $position);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function VALIDATE_VOTE($schoolyear, $position, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE schoolyear = ?
                AND position = ?
                AND voters_id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $schoolyear, $position, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function VOTE_NOMINEE($schoolyear, $position, $candidate_id, $voters_id) {
        global $db;

        //Check to see if the voter votes already
        $sql = "SELECT *
                FROM votes
                WHERE schoolyear = ?
                AND position = ?
                AND voters_id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $schoolyear, $position, $voters_id);
            $stmt->execute();
            $result = $stmt->get_result();
        } 

        if($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Sorry you have casted your vote already.</div>";
                } else {
            //Vote successful.
            // $sql = "INSERT INTO votes(schoolyear, position, candidate_id, voters_id)VALUES(?, ?, ?, ?)";
            // if(!$stmt = $db->prepare($sql)) {
            //     echo $stmt->error;
            // } else {
            //     $stmt->bind_param("ssii", $schoolyear, $position, $candidate_id, $voters_id);
            // }

            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Vote successful.</div>";
            }
            $stmt->free_result();
        }
        return $stmt;
    }

}  