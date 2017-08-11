<?php
$this->load->view('template/head');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-migrate-1.2.1.js"></script>
<script type='text/javascript' src="<?php echo assets_url(); ?>assets/js/jquery-ui-1.10.3-custom.min.js"></script>        
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/sugar.min.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/highcharts.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/highcharts-more.js'></script>
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/exporting.js'></script>-->
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/script.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/daterangepicker.js'></script>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<section class="content-header">
    <h1>
        Dashboard
        <!--<small>Control panel</small>-->
    </h1>

</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($projCompleted as $data) {
                            if ($data->proj_completed == NULL) {
                                echo '-';
                            } else {
                                echo $data->proj_completed;
                            }
                        }
                        ?>
                    </h3>
                    <p>Project Completed</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($projSubmitted as $data) {
                            if ($data->proj_submitted == NULL) {
                                echo '-';
                            } else {
                                echo $data->proj_submitted;
                            }
                        }
                        ?>
                        <sup style="font-size: 20px"></sup></h3>
                    <p>Project Submitted</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($totalProjCompleted as $data) {
                            if ($data->proj_completed_total == NULL) {
                                echo '-';
                            } else {
                                echo $data->proj_completed_total;
                            }
                        }
                        ?>

                    </h3>
                    <p>Total Project Completed</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($totalProjSubmitted as $data) {
                            if ($data->proj_submitted_total == NULL) {
                                echo '-';
                            } else {
                                echo $data->proj_submitted_total;
                            }
                        }
                        ?>
                    </h3>
                    <p>Total Project Submitted</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <!-- Main row -->

    <div style="margin: 10px 0 0 10px;">
        <div id="msg"></div>
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-user"></i>Jumlah User Akses</li>
                    </ul>
                    <div id="chart" style="position: relative; height: 300px;"></div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-file"></i>Monitoring Alternative</li>
                    </ul>
                    <div id="secondChart"style="position: relative; height: 300px;"></div>
                </div>
            </section>
        </div>
</section><!-- right col -->

<?php
$this->load->view('template/js');
?>

<?php
$this->load->view('template/foot');
?>