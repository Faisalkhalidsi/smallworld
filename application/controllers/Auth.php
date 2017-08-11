<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        $this->load->model('dashboard');
        $data['projCompleted'] = $this->dashboard->projCompleted();
        $data['totalProjCompleted'] = $this->dashboard->totalProjCompleted();
        $data['projSubmitted'] = $this->dashboard->projSubmitted();
        $data['totalProjSubmitted'] = $this->dashboard->totalProjSubmitted();
        $this->load->view('highchart', $data);
    }

}
