<?php

/*
 * Crated by : Faisal Khalid
 * Email     : faisal.khalid.si@gmail.com
 * Thank you..
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('highchartmodel', 'chart');
    }

    public function index() {
        $this->load->view('highchartSatu');
    }

    public function file() {
        $this->load->view('highchartDua');
    }

    public function kenaikan() {
        $this->load->view('highchartTiga');
    }

    function list_data() {
        $requestData = $_REQUEST;
        if (isset($_POST['start_date'])) {
            $startDate = $_POST['start_date'];
        } else {
            $startDate = '';
        }

        if (isset($_POST['start_date'])) {
            $endDate = $_POST['end_date'];
        } else {
            $endDate = '';
        }

        $results = $this->chart->get_list_data($requestData, $startDate, $endDate);
        echo json_encode($results);
    }

    function list_data_admin() {
        $requestData = $_REQUEST;
        if (isset($_POST['start_date'])) {
            $startDate = $_POST['start_date'];
        } else {
            $startDate = '';
        }

        if (isset($_POST['start_date'])) {
            $endDate = $_POST['end_date'];
        } else {
            $endDate = '';
        }

        $results = $this->chart->get_list_data_design_admin($requestData, $startDate, $endDate);
        echo json_encode($results);
    }

}