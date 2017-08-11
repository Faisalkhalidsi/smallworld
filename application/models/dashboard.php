<?php

/*
 * Crated by : Faisal Khalid
 * Email     : faisal.khalid.si@gmail.com
 * Thank you..
 */

class Dashboard extends CI_Model {

    private $monitoring = 'monitoring';
    private $user_access = 'user_access';

    public function projCompleted() {
        $this->load->database();
        $data = $this->db->query("SELECT date_insert, proj_completed FROM `" . $this->monitoring . "` where date_insert < curdate() order by date_insert desc limit 1");
        return $data->result();
    }

    public function totalProjCompleted() {
        $this->load->database();
        $data = $this->db->query("SELECT date_insert, proj_completed_total FROM `" . $this->monitoring . "` where date_insert < curdate() order by date_insert desc limit 1");
        return $data->result();
    }

    public function ProjSubmitted() {
        $this->load->database();
        $data = $this->db->query("SELECT date_insert, proj_submitted FROM `" . $this->monitoring . "` where date_insert < curdate() order by date_insert desc limit 1;");
        return $data->result();
    }

    public function totalProjSubmitted() {
        $this->load->database();
        $data = $this->db->query("SELECT date_insert, proj_submitted_total FROM `" . $this->monitoring . "` where date_insert < curdate() order by date_insert desc limit 1");
        return $data->result();
    }

}
