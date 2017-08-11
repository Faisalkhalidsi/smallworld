<?php
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/faisal.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">

<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-migrate-1.2.1.js"></script>
<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-ui-1.10.3-custom.min.js"></script>        
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/sugar.min.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/highcharts.js'></script>
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/highcharts-more.js'></script>-->
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/exporting.js'></script>-->
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/scriptTiga.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/daterangepicker.js'></script>
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/moment.min.js'></script>-->
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/bootstrap-datetimepicker.min.js'></script>-->
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/faisalCustom.js'></script>
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/fnMultiFilter.js'></script>-->

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<section class="content-header">
    <h1>
        Monitoring Kenaikan File
    </h1>
</section>

<form class="form-horizontal">
    <fieldset>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-calendar"></i> </span> <input
                type="text" name="range" id="range" />
        </div>
    </fieldset>
</form>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-bar-chart"></i>Kenaikan File GIS</li>
                    </ul>
                    <div id="thirdChart" style="position: relative; height: 250px;"></div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-bar-chart"></i>Kenaikan File Design Admin</li>
                    </ul>
                    <div id="thirdChartDua"style="position: relative; height: 250px;"></div>

                </div>
            </section>
        </div>
    </div>
</div>

<hr>
<fieldset>
    <div class="input-prepend">
        <span class="add-on"><i class="icon-calendar"></i> </span> <input
            type="text" name="secondRange" id="secondRange" />
        <input type="hidden" name="start-date" id="start-date" />
        <input type="hidden" name="end-date" id="end-date" />
    </div>
</fieldset>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-table"></i>Posisi File GIS</li>
                    </ul>
                    <table id="gis-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2">Tanggal</th>
                                <th colspan="2"><b>rwo.ds</b></th>
                                <th colspan="2"><b>gdb.ds</b></th>
                            </tr>
                            <tr>
                                <td><b>Posisi Superfile<br></b></td>
                                <td><b>Terpakai</b></td>
                                <td><b>Posisi Superfile<br></b></td>
                                <td><b>Terpakai</b></td>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-table"></i>Posisi File Design Admin</li>
                    </ul>
                    <table id="design-admin-grid" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td><b>Tanggal</b></td>
                                <td><b>Reguler rwo</b></td>
                                <td><b>Reguler gdb<br></b></td>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>


<div id="msg"></div>



<?php
$this->load->view('template/js');
?>

<?php
$this->load->view('template/foot');
?>


