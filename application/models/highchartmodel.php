<?php

/*
 * Crated by : Faisal Khalid
 * Email     : faisal.khalid.si@gmail.com
 * Thank you..
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of highchartmodel
 *
 * @author http://roytuts.com
 */
class HighChartModel extends CI_Model {

    private $monitoring = 'monitoring';
    private $user_access = 'user_access';

    function __construct() {
        
    }

    function get_chart_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->user_access . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date) .
                " and HOUR(time_insert) = '09' order by date_insert asc";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_chart_data11($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->user_access . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date) .
                " and HOUR(time_insert) = '11' order by date_insert asc";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_chart_data14($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->user_access . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date) .
                " and HOUR(time_insert) = '14' group by date_insert"
                . " order by date_insert asc";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_secondChart_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->monitoring . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date)
                . "group by date_insert order by date_insert asc ";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_secondChartCreated_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->monitoring . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date)
                . "group by date_insert order by date_insert asc  ";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_secondChartFree_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->monitoring . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date)
                . "group by date_insert order by date_insert asc  ";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_thirdChart_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->monitoring . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date)
                . "group by date_insert order by date_insert asc  ";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }

    function get_thirdChart2_data($start_date, $end_date) {
        $sql = "SELECT * FROM `" . $this->monitoring . "`
		WHERE DATE(date_insert)>=" . $this->db->escape($start_date) .
                " AND DATE(date_insert)<=" . $this->db->escape($end_date)
                . "group by date_insert order by date_insert asc  ";
        $query = $this->db->query($sql);
        $results = $query->result();
        return $results;
    }

    function get_list_data_design_admin($requestData, $startDate, $endDate) {
        $requestData = $_REQUEST;
        if (($startDate != '') && ($endDate != '')) {
            $columns = array(
                // datatable column index  => database column name
                0 => 'date_insert',
                1 => 'reguler_rwo',
                2 => 'reguler_gdb'
            );

//         getting total number records without any search
            $sql = "SELECT date_insert,reguler_rwo,reguler_gdb";
            $sql .= " FROM monitoring";
            $query = $this->db->query($sql);
            $totalData = $query->num_rows();
            $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

            $sql = "SELECT date_insert,reguler_rwo,reguler_gdb";
            $sql .= " FROM monitoring WHERE DATE(date_insert)>=" . $this->db->escape($startDate) .
                    " AND DATE(date_insert)<=" . $this->db->escape($endDate);
            if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql .= " AND ( date_insert LIKE '" . $requestData['search']['value'] . "%' ";
                $sql .= " OR p_rwo LIKE '" . $requestData['search']['value'] . "%' ";

                $sql .= " OR used_rwo LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR p_gdb LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR used_gdb LIKE '" . $requestData['search']['value'] . "%' )";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   desc  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
            $query = $this->db->query($sql);
            $query = $query->result_array();

            $data = array();
            for ($i = 0; $i < count($query); $i++) {
                $nestedData = array();
                $nestedData[] = $query[$i]['date_insert'];
                $nestedData[] = $query[$i]['reguler_rwo'];
                $nestedData[] = $query[$i]['reguler_gdb'];
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal" => intval($totalData), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data   // total data array
            );

            return $json_data;  // send data as json format
        } else {
            $columns = array(
                // datatable column index  => database column name
                0 => 'date_insert',
                1 => 'reguler_rwo',
                2 => 'reguler_gdb'
            );

//         getting total number records without any search
            $sql = "SELECT date_insert,reguler_rwo,reguler_gdb";
            $sql .= " FROM monitoring";
            $query = $this->db->query($sql);
            $totalData = $query->num_rows();
            $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

            $sql = "SELECT date_insert,reguler_rwo,reguler_gdb";
            $sql .= " FROM monitoring WHERE 1=1";
            if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql .= " AND ( date_insert LIKE '" . $requestData['search']['value'] . "%' ";
                $sql .= " OR reguler_rwo LIKE '" . $requestData['search']['value'] . "%' ";

                $sql .= " OR reguler_gdb LIKE '" . $requestData['search']['value'] . "%' )";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   desc  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
            $query = $this->db->query($sql);
            $query = $query->result_array();
//        $query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

            $data = array();
            for ($i = 0; $i < count($query); $i++) {
                $nestedData = array();
                $nestedData[] = $query[$i]['date_insert'];
                $nestedData[] = $query[$i]['reguler_rwo'];
                $nestedData[] = $query[$i]['reguler_gdb'];
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal" => intval($totalData), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data   // total data array
            );

            return $json_data;  // send data as json format
        }
    }

    function get_list_data($requestData, $startDate, $endDate) {
        $requestData = $_REQUEST;
        if (($startDate != '') && ($endDate != '')) {
            $columns = array(
                // datatable column index  => database column name
                0 => 'date_insert',
                1 => 'p_rwo',
                2 => 'used_rwo',
                3 => 'p_gdb',
                4 => 'used_gdb'
            );

//         getting total number records without any search
            $sql = "SELECT date_insert,p_rwo,used_rwo,p_gdb,used_gdb";
            $sql .= " FROM monitoring";
            $query = $this->db->query($sql);
            $totalData = $query->num_rows();
            $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

            $sql = "SELECT date_insert,p_rwo,used_rwo,p_gdb,used_gdb";
            $sql .= " FROM monitoring WHERE DATE(date_insert)>=" . $this->db->escape($startDate) .
                    " AND DATE(date_insert)<=" . $this->db->escape($endDate);
            if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql .= " AND ( date_insert LIKE '" . $requestData['search']['value'] . "%' ";
                $sql .= " OR p_rwo LIKE '" . $requestData['search']['value'] . "%' ";

                $sql .= " OR used_rwo LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR p_gdb LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR used_gdb LIKE '" . $requestData['search']['value'] . "%' )";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   desc  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
            $query = $this->db->query($sql);
            $query = $query->result_array();
//        $query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

            $data = array();
            for ($i = 0; $i < count($query); $i++) {
                $nestedData = array();
                $nestedData[] = $query[$i]['date_insert'];
                $nestedData[] = $query[$i]['p_rwo'];
                $nestedData[] = $query[$i]['used_rwo'];
                $nestedData[] = $query[$i]['p_gdb'];
                $nestedData[] = $query[$i]['used_gdb'];
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal" => intval($totalData), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data   // total data array
            );

            return $json_data;  // send data as json format
        } else {
            $columns = array(
                // datatable column index  => database column name
                0 => 'date_insert',
                1 => 'p_rwo',
                2 => 'used_rwo',
                3 => 'p_gdb',
                4 => 'used_gdb'
            );

//         getting total number records without any search
            $sql = "SELECT date_insert,p_rwo,used_rwo,p_gdb,used_gdb";
            $sql .= " FROM monitoring";
            $query = $this->db->query($sql);
            $totalData = $query->num_rows();
            $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

            $sql = "SELECT date_insert,p_rwo,used_rwo,p_gdb,used_gdb";
            $sql .= " FROM monitoring WHERE 1=1";
            if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql .= " AND ( date_insert LIKE '" . $requestData['search']['value'] . "%' ";
                $sql .= " OR p_rwo LIKE '" . $requestData['search']['value'] . "%' ";

                $sql .= " OR used_rwo LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR p_gdb LIKE '" . $requestData['search']['value'] . "%' )";
                $sql .= " OR used_gdb LIKE '" . $requestData['search']['value'] . "%' )";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   desc  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
            $query = $this->db->query($sql);
            $query = $query->result_array();
//        $query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");



            $data = array();
            for ($i = 0; $i < count($query); $i++) {
                $nestedData = array();
                $nestedData[] = $query[$i]['date_insert'];
                $nestedData[] = $query[$i]['p_rwo'];
                $nestedData[] = $query[$i]['used_rwo'];
                $nestedData[] = $query[$i]['p_gdb'];
                $nestedData[] = $query[$i]['used_gdb'];
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal" => intval($totalData), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data   // total data array
            );

            return $json_data;  // send data as json format
        }
    }

}
/* End of file highchartmodel.php */
/* Location: ./application/models/highchartmodel.php */

