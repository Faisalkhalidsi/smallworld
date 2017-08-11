<?php

/*
 * Crated by : Faisal Khalid
 * Email     : faisal.khalid.si@gmail.com
 * Thank you..
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of highchart
 *
 * @author http://www.roytuts.com
 */
class HighChart extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('highchartmodel', 'chart');
    }

    public function index() {
        $this->load->view('highchart');
    }

    public function get_chart_data() {
        if (isset($_POST['start']) AND isset($_POST['end'])) {
            $start_date = $_POST['start'];
            $end_date = $_POST['end'];
//            ---------------------------------------------
            $results = $this->chart->get_chart_data($start_date, $end_date);
            $results11 = $this->chart->get_chart_data11($start_date, $end_date);
            $results14 = $this->chart->get_chart_data14($start_date, $end_date);
//            -------------------------------------------------
            $secondResults = $this->chart->get_secondChart_data($start_date, $end_date);
            $secondResultsCreated = $this->chart->get_secondChartCreated_data($start_date, $end_date);
            $secondResultsFree = $this->chart->get_secondChartCreated_data($start_date, $end_date);
//            -------------------------------------------------
            $thirdResults = $this->chart->get_thirdChart_data($start_date, $end_date);
//            -------------------------------------------------
            if ($results === NULL) {
                echo json_encode('No record found');
            } else {
                $json = '[';
                $counter = 1;
                foreach ($results as $result) {
                    $json .= '[';
                    $json .= '"' . $result->date_insert . '"';
                    $json .= ',';
                    $json .= $result->total_ua;
                    $json .= ']';
                    if ($counter < count($results)) {
                        $json .= ',';
                    }
                    $counter++;
                }
                $json .= ']';
//                --------------------------------------------------

                $json11 = '[';
                $counter = 1;
                foreach ($results11 as $result) {
                    $json11 .= '[';
                    $json11 .= '"' . $result->date_insert . '"';
                    $json11 .= ',';
                    $json11 .= $result->total_ua;
                    $json11 .= ']';
                    if ($counter < count($results11)) {
                        $json11 .= ',';
                    }
                    $counter++;
                }
                $json11 .= ']';
//                --------------------------------------------------------
                $json14 = '[';
                $counter = 1;
                foreach ($results14 as $result) {
                    $json14 .= '[';
                    $json14 .= '"' . $result->date_insert . '"';
                    $json14 .= ',';
                    $json14 .= $result->total_ua;
                    $json14 .= ']';
                    if ($counter < count($results14)) {
                        $json14 .= ',';
                    }
                    $counter++;
                }
                $json14 .= ']';
//                ------------------------------------------

                $secondJson = '[';
                $counter = 1;
                foreach ($secondResults as $result) {
                    $secondJson .= '[';
                    $secondJson .= '"' . $result->date_insert . '"';
                    $secondJson .= ',';
                    $secondJson .= $result->alt_updated;
                    $secondJson .= ']';
                    if ($counter < count($secondResults)) {
                        $secondJson .= ',';
                    }
                    $counter++;
                }
                $secondJson .= ']';
//                -------------------------------------------------
                $createdJson = '[';
                $counter = 1;
                foreach ($secondResultsCreated as $result) {
                    $createdJson .= '[';
                    $createdJson .= '"' . $result->date_insert . '"';
                    $createdJson .= ',';
                    $createdJson .= $result->alt_created;
                    $createdJson .= ']';
                    if ($counter < count($secondResultsCreated)) {
                        $createdJson .= ',';
                    }
                    $counter++;
                }
                $createdJson .= ']';
//                -------------------------------------------------

                $freeJson = '[';
                $counter = 1;
                foreach ($secondResultsFree as $result) {
                    $freeJson .= '[';
                    $freeJson .= '"' . $result->date_insert . '"';
                    $freeJson .= ',';
                    $freeJson .= $result->alt_free;
                    $freeJson .= ']';
                    if ($counter < count($secondResultsFree)) {
                        $freeJson .= ',';
                    }
                    $counter++;
                }
                $freeJson .= ']';
//                -------------------------------------------------
                $hitung = 0;

                for ($i = 0; $i < count($thirdResults); $i++) {
                    $hitung++;
                }

                $usedrwoJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung; $i++) {
                    $usedrwoJson .= '[';

//                    if ($i < $hitung - 1) {
//                        $thirdResults[$i + 1]['used_rwo'] = $thirdResults[$i + 1]['used_rwo'] - $thirdResults[$i]['used_rwo'];
////                        if ($thirdResults[$i]['p_rwo'] == $thirdResults[$i + 1]['p_rwo']) {
////                            $thirdResults[$i + 1]['used_rwo'] = $thirdResults[$i + 1]['used_rwo'] - $thirdResults[$i]['used_rwo'];
////                        } else {
////                            $thirdResults[$i + 1]['used_rwo'] = (16777 - $thirdResults[$i]['used_rwo']) + $thirdResults[$i + 1]['used_rwo'];
////                        }
//                    }
                    $usedrwoJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                    $usedrwoJson .= ',';
                    $usedrwoJson .= $thirdResults[$i]['used_rwo'];
                    $usedrwoJson .= ']';
                    if ($counter < count($thirdResults)) {
                        $usedrwoJson .= ',';
                    }
                    $counter++;
                }

                $usedrwoJson .= ']';
//                -------------------------------------------------

                $alpha = array();
                $alpha['sembilan'] = $json;
                $alpha['sebelas'] = $json11;
                $alpha['empatBelas'] = $json14;
                $alpha['updated'] = $secondJson;
                $alpha['created'] = $createdJson;
                $alpha['free'] = $freeJson;
                $alpha['usedrwoJson'] = $usedrwoJson;
                echo json_encode($alpha);
            }
        } else {
            echo json_encode('Date must be selected.');
        }
    }

    public function get_chart_data_tiga() {
        if (isset($_POST['start']) AND isset($_POST['end'])) {
            $start_date = $_POST['start'];
            $end_date = $_POST['end'];
//            -------------------------------------------------
            $thirdResults = $this->chart->get_thirdChart_data($start_date, $end_date);
//            -------------------------------------------------
            if ($thirdResults === NULL) {
                echo json_encode('No record found');
            } else {
                $hitung = 0;

                for ($i = 0; $i <= count($thirdResults); $i++) {
                    $hitung++;
                }

                $usedrwoJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung; $i++) {
                    if ($i == 0 || $i == $hitung - 1) {
                        
                    } else {
                        $usedrwoJson .= '[';
                        $usedrwoJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                        $usedrwoJson .= ',';
                        if ($thirdResults[$i]['p_rwo'] == $thirdResults[$i - 1]['p_rwo']) {
                            $meiData = $thirdResults[$i]['used_rwo'] - $thirdResults[$i - 1]['used_rwo'];
                        } else {
                            $meiData = (16777 - $thirdResults[$i - 1]['used_rwo']) + $thirdResults[$i]['used_rwo'];
                        }

                        $usedrwoJson .= $meiData;
                        $usedrwoJson .= ']';
                        if ($counter < $hitung - 1) {
                            $usedrwoJson .= ',';
                        }
                    }

                    $counter++;
                }
                $usedrwoJson .= ']';
//                -----------------------------------------
                $usedgdbJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung; $i++) {
                    if ($i == 0 || $i == $hitung - 1) {
                        
                    } else {
                        $usedgdbJson .= '[';
                        $usedgdbJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                        $usedgdbJson .= ',';
                        if ($thirdResults[$i]['p_gdb'] == $thirdResults[$i - 1]['p_gdb']) {
                            $meiData = $thirdResults[$i]['used_gdb'] - $thirdResults[$i - 1]['used_gdb'];
                        } else {
                            $meiData = (16777 - $thirdResults[$i - 1]['used_gdb']) + $thirdResults[$i]['used_gdb'];
                        }

                        $usedgdbJson .= $meiData;
                        $usedgdbJson .= ']';
                        if ($counter < $hitung - 1) {
                            $usedgdbJson .= ',';
                        }
                    }

                    $counter++;
                }
                $usedgdbJson .= ']';
//                ---------------------------------------
                $regdgdbJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung - 1; $i++) {
                    if ($i == 0 || $i == $hitung - 1) {
                        
                    } else {
                        $regdgdbJson .= '[';
                        $regdgdbJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                        $regdgdbJson .= ',';

                        $meiData = $thirdResults[$i]['reguler_gdb'] - $thirdResults[$i - 1]['reguler_gdb'];

                        $regdgdbJson .= $meiData;
                        $regdgdbJson .= ']';
                        if ($counter < $hitung - 1) {
                            $regdgdbJson .= ',';
                        }
                    }

                    $counter++;
                }
                $regdgdbJson .= ']';
//                -------------------

                $regswoJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung; $i++) {
                    if ($i == 0 || $i == $hitung - 1) {
                        
                    } else {
                        $regswoJson .= '[';
                        $regswoJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                        $regswoJson .= ',';

                        $meiData = $thirdResults[$i]['reguler_rwo'] - $thirdResults[$i - 1]['reguler_rwo'];


                        $regswoJson .= $meiData;
                        $regswoJson .= ']';
                        if ($counter < $hitung - 1) {
                            $regswoJson .= ',';
                        }
                    }

                    $counter++;
                }
                $regswoJson .= ']';
//                -------------------
                $alpha = array();
                $alpha['usedrwoJson'] = $usedrwoJson;
                $alpha['usedgdbJson'] = $usedgdbJson;
                $alpha['regdgdbJson'] = $regdgdbJson;
                $alpha['regswoJson'] = $regswoJson;

                echo json_encode($alpha);
            }
        } else {
            echo json_encode('Date must be selected.');
        }
    }

    public function get_chart_data_empat() {
        if (isset($_POST['start']) AND isset($_POST['end'])) {
            $start_date = $_POST['start'];
            $end_date = $_POST['end'];
//            -------------------------------------------------
            $thirdResults = $this->chart->get_thirdChart_data($start_date, $end_date);
//            -------------------------------------------------
            if ($thirdResults === NULL) {
                echo json_encode('No record found');
            } else {
                $hitung = 0;

                for ($i = 0; $i <= count($thirdResults); $i++) {
                    $hitung++;
                }

                $tglJson = '[';
                $counter = 1;
                for ($i = 0; $i < $hitung; $i++) {
                    if ($i == 0 || $i == $hitung - 1) {
                        
                    } else {
                        $tglJson .= '[';
                        $tglJson .= '"' . $thirdResults[$i]['date_insert'] . '"';
                        $tglJson .= ']';
                        if ($counter < $hitung - 1) {
                            $tglJson .= ',';
                        }
                    }

                    $counter++;
                }
                $tglJson .= ']';

                $alpha = array();
                $alpha['data'] = $tglJson;
                echo json_encode($alpha);
            }
        } else {
            echo json_encode('Date must be selected.');
        }
    }

}

/* End of file highchart.php */
/* Location: ./application/controllers/highchart.php */

