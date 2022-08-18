

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == true): ?>

        <div class="col-md-12 col-xs-12">
          <form class="form-inline" action="<?php echo base_url('dashboard/') ?>" method="POST">
            <div class="form-group">
              <label for="date">Year</label>
              <select class="form-control" name="select_year" id="select_year">
                <?php foreach ($report_years as $key => $value): ?>
                  <option value="<?php echo $value ?>" <?php if($value == $selected_year) { echo "selected"; } ?>><?php echo $value; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
        
        <br>

        <div class="row">
          <div class="col-lg-6 col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Quantity</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart1" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>


            <!-- small box -->
            <!-- <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php //echo $total_products ?></h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php //echo base_url('products/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-xs-6">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Total Sales</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart2" style="height:250px"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>

            <!-- small box -->
            <!-- <div class="small-box bg-green">
              <div class="inner">
                <h3><?php //echo $total_paid_orders ?></h3>

                <p>Total Paid Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php //echo base_url('orders/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-xs-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php //echo $total_users; ?></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?php //echo base_url('users/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-xs-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-red">
              <div class="inner">
                <h3><?php //echo $total_stores ?></h3>

                <p>Total Stores</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-home"></i>
              </div>
              <a href="<?php //echo base_url('stores/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        </div>
        <!-- /.row -->
      <?php endif; ?>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
    }); 
  </script>


<script type="text/javascript">


//catch the dataset from control
var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;
$(function () {
/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */
 var areaChartData = {
  labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label               : 'Electronics',
      fillColor           : 'rgba(210, 214, 222, 1)',
      strokeColor         : 'rgba(210, 214, 222, 1)',
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : report_data
    }
  ]
}

//-------------
//- BAR CHART -
//-------------
var barChartCanvas                   = $('#barChart1').get(0).getContext('2d')
var barChart                         = new Chart(barChartCanvas)
var barChartData                     = areaChartData
barChartData.datasets[0].fillColor   = '#00a65a';
barChartData.datasets[0].strokeColor = '#00a65a';
barChartData.datasets[0].pointColor  = '#00a65a';
var barChartOptions                  = {
  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
  scaleBeginAtZero        : true,
  //Boolean - Whether grid lines are shown across the chart
  scaleShowGridLines      : true,
  //String - Colour of the grid lines
  scaleGridLineColor      : 'rgba(0,0,0,.05)',
  //Number - Width of the grid lines
  scaleGridLineWidth      : 1,
  //Boolean - Whether to show horizontal lines (except X axis)
  scaleShowHorizontalLines: true,
  //Boolean - Whether to show vertical lines (except Y axis)
  scaleShowVerticalLines  : true,
  //Boolean - If there is a stroke on each bar
  barShowStroke           : true,
  //Number - Pixel width of the bar stroke
  barStrokeWidth          : 2,
  //Number - Spacing between each of the X value sets
  barValueSpacing         : 5,
  //Number - Spacing between data sets within X values
  barDatasetSpacing       : 1,
  //String - A legend template
  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
  //Boolean - whether to make the chart responsive
  responsive              : true,
  maintainAspectRatio     : true
}

barChartOptions.datasetFill = false
barChart.Bar(barChartData, barChartOptions)
})


var report_data1 = <?php echo '[' . implode(',', $results1) . ']'; ?>;
$(function () {
/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */
 var areaChartData = {
  labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label               : 'Electronics',
      fillColor           : 'rgba(210, 214, 222, 1)',
      strokeColor         : 'rgba(210, 214, 222, 1)',
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : report_data1
    }
  ]
}

//-------------
//- BAR CHART -
//-------------
var barChartCanvas                   = $('#barChart2').get(0).getContext('2d')
var barChart                         = new Chart(barChartCanvas)
var barChartData                     = areaChartData
barChartData.datasets[0].fillColor   = '#00a65a';
barChartData.datasets[0].strokeColor = '#00a65a';
barChartData.datasets[0].pointColor  = '#00a65a';
var barChartOptions                  = {
  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
  scaleBeginAtZero        : true,
  //Boolean - Whether grid lines are shown across the chart
  scaleShowGridLines      : true,
  //String - Colour of the grid lines
  scaleGridLineColor      : 'rgba(0,0,0,.05)',
  //Number - Width of the grid lines
  scaleGridLineWidth      : 1,
  //Boolean - Whether to show horizontal lines (except X axis)
  scaleShowHorizontalLines: true,
  //Boolean - Whether to show vertical lines (except Y axis)
  scaleShowVerticalLines  : true,
  //Boolean - If there is a stroke on each bar
  barShowStroke           : true,
  //Number - Pixel width of the bar stroke
  barStrokeWidth          : 2,
  //Number - Spacing between each of the X value sets
  barValueSpacing         : 5,
  //Number - Spacing between data sets within X values
  barDatasetSpacing       : 1,
  //String - A legend template
  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
  //Boolean - whether to make the chart responsive
  responsive              : true,
  maintainAspectRatio     : true
}

barChartOptions.datasetFill = false
barChart.Bar(barChartData, barChartOptions)
})

</script>

