<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Dashboard
            </h1>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
            <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src="<?= base_url('assets/js/front/home.js') ?>"></script>
<!-- SCRIPT -->