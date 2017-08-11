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
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/highcharts-more.js'></script>-->
<!--<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/exporting.js'></script>-->
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/script.js'></script>
<script type='text/javascript' src='<?php echo assets_url(); ?>assets/js/daterangepicker.js'></script>


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<section class="content-header">
    <h1>
        Jumlah User Akses Aplikasi Small World PNI/IBRITE
    </h1>

</section>

<body>
    <div style="margin: 10px 0 0 10px;">

        <form class="form-horizontal">
            <fieldset>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-calendar"></i> </span> <input
                        type="text" name="range" id="range" />
                </div>
            </fieldset>
        </form>
        <div id="msg"></div>
        <div id="chart"></div>
    </div>
</body>
<?php
$this->load->view('template/js');
?>

<?php
$this->load->view('template/foot');
?>



