<?php
class Result {
	    public function READ_YEAR() {
        global $db;

        $sql = "SELECT * FROM tbl_schoolyear where Status = 'Ended' ";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    //  public function READ_NOMINEES($schoolyear, $position) {
    //     global $db;

    //     $sql = "SELECT *
    //             FROM tbl_nominees
    //             WHERE schoolyear = ?
    //             AND position = ?
    //             AND Status = 'Active'";
    //     if(!$stmt = $db->prepare($sql)) {
    //         echo $stmt->error;
    //     } else {
    //         $stmt->bind_param("ss", $schoolyear, $position);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //     }
    //     $stmt->free_result();
    //     return $result;
    // }


    public function READ_NOM_BY_YEAR_POS($schoolyear, $position) {
        global $db;

        $sql = "SELECT *
                FROM tbl_nominees
                WHERE tbl_nominees.schoolyear = ?
                AND tbl_nominees.position = ? 
                AND Level = 'Tertiary'
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

    public function COUNT_VOTES($candidate_id) {
        global $db;

        $sql = "SELECT candidate_id
                FROM votes
                WHERE candidate_id = ?
                ";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $candidate_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function results($candidate_id) {
        global $db;

        $sql = "SELECT candidate_id
                FROM votes
                WHERE candidate_id = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $candidate_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }


    public function READ_POS_BY_YEAR($schoolyear) {
        global $db;

        $sql = "SELECT *
                FROM tbl_position
                WHERE Level = 'Tertiary'
                AND schoolyear = ?";
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


}