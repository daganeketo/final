<?php
session_start();
if(!isset($_SESSION["RegState"]) || ($_SESSION["RegState"] != 4)) {
	header("location: login.php");
	exit();
} else {
	$_SESSION["RegState"] = 4;
	$_SESSION["Message"] = "Login Successful";
} 
	$lables = "";
	$data_t = "";
	require_once("php/config.php");
	// Create connection
	$conn = new mysqli(SERVER,USER,PASSWORD,DATABASE);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM PLogs";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $lables = $lables . "\"" . $row["LoopOrder"] . "\",";
        $data_t = $data_t  . $row["ElapsedTime"] . ",";
    }
	} else {
    echo "";
	}
	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Lab 3">
  <meta name="author" content="Krishna Kafley">
  <title>Lab 3 Admin Page</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">My WebRx2 Dashboard</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        
		<li id="Lab11" class="nav-item" data-toggle="tooltip" data-placement="right" title="Lab1.1">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponentsI" data-parent="#exampleAccordion">
		  <i class= "fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Add Medicine</span>
          </a>
        </li>
        <li id="Lab12" class="nav-item" data-toggle="tooltip" data-placement="right" title="Lab1.2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponentsII" data-parent="#exampleAccordion">
		  <i class= "fa fa-fw fa-table"></i>
            <span class="nav-link-text">Add Doctor</span>
          </a>
        </li>
        <li id="Lab13" class="nav-item" data-toggle="tooltip" data-placement="right" title="Lab1.3">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponentsIII" data-parent="#exampleAccordion">
		  <i class= "fa fa-fw fa-window-maximize"></i>
            <span class="nav-link-text">Add Pharmacy</span>
          </a>
        </li>
        <li id="AddAlergies" class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Add Alergies</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Accounts">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user-circle"></i>
            <span class="nav-link-text">Add Emergency Contacts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logs">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseLogs" data-parent="#exampleAccordion">
           <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Review</span>
          </a>
		  <ul class="sidenav-second-level collapse" id="collapseLogs">
            <li>
              <a href="#">Usage Policy</a>
            </li>
            <li>
              <a href="#">Terms and Condition</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard [<?php echo $_SESSION['Message']?>] </li>
      </ol>
      <!-- Icon Cards-->
	 <div id="DashboardView">
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">My Doctor</div>
            </div>
            <a id="ShowLab11" class="card-footer text-white clearfix small z-1" style="cursor:pointer">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
		  </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">My Pharmacy</div>
            </div>
            <a id="ShowLab12" class="card-footer text-white clearfix small z-1"  style="cursor:pointer">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-window-maximize"></i>
              </div>
              <div class="mr-5">My Allergies</div>
            </div>
            <a  id="ShowLab13" class="card-footer text-white clearfix small
			z-1"  style="cursor:pointer">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-book"></i>
              </div>
              <div class="mr-5">My Emergency Contacts</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      
    
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My Medicines</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
			  </thead>
			  <tr>
			  <td>Name</td>
			  <td>Profession</td>
			  <td>City</td>
			  <td>Age</td>
			  <td>Date Hired</td>
			  <td>Salary</td>
			  </tr>
			  <tbody>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Cedric Kelly</td>
                  <td>Senior Javascript Developer</td>
                  <td>Edinburgh</td>
                  <td>22</td>
                  <td>2012/03/29</td>
                  <td>$433,060</td>
                </tr>
                
                
                <tr>
                  <td>Cara Stevens</td>
                  <td>Sales Assistant</td>
                  <td>New York</td>
                  <td>46</td>
                  <td>2011/12/06</td>
                  <td>$145,600</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
      </div>
	</div>
	<div id="Lab11View">
	Please enter the details below to add medicine.
	<form>
		<input type="text" name="MedName" placeholder="Medicine Name">
		<input type="text" name="MedName" placeholder="Medicine Name">
		<br>
		<input id="Lab11Run" type="submit" value= "Run" class = "btn btn=medium btn-primary">
	</form>
	<div id="Lab11RunStatus"> </div>
	
	<button id="Lab11Results" class="btn btn-medium btn-primary"> Show Result </button>
	
	<div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-area-chart"></i> Lab1.1 Product Matrices:
			</div>
			<div id="data" class="card-body">
			  <canvas id="Lab11ProductMatrices" width="100%" height="30"></canvas>
			</div>
			<div class ="card-footer small text-muted">Updated</div>
	</div>
	
</div>
	<div id="Lab12View">
	Lab1.2 Matrix Multiplication Order Study. Find out which multiplication order is the fastest for same input size.<br><br>
	<form>
		<input type="number" name="Size1" placeholder="Matrix Size(3 -12)">
		<br>
		<input id="Lab12Run" type="submit" value= "Run" class = "btn btn=medium btn-primary">
	</form>
	<div id="Lab12RunStatus"> </div>
	<button id="DisplayData" class="btn btn-medium btn-primary" onclick="showRows();">Display Data</button>
	<br><br>
	<div id="display_board" class="card mb-3">
       <div class="card-header">
         <i class="fa fa-table"></i> Permutation Speed Information</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>LoopOrder</th>
                  <th>Size</th>
                  <th>Elapsed Time</th>
                </tr>
              </thead>
			  
              <tbody id="table_body">
			  
              </tbody>
			</table>
          </div>
        </div>
		<div class ="card-footer small text-muted">Updated</div>
      </div>
	  <div class="col-md-5">
        <canvas id="myChart"></canvas>
    </div>
	</div>
	
	<div id="Lab13View">
	Lab1.3 How does the result change when the process is automated for multiple inputs?  Here we run matrix size from 10 to input size with increment of 10 everytime. 
	<form>
		<input type="number" name="Size2" placeholder="Highest Matrix Size">
		<br>
		<input id="Lab13Run" type="submit" value= "Run" class = "btn btn=medium btn-primary">
	</form>
	<button id="Lab13Plot" class="btn btn-medium btn-primary">Show Time Plot for highest size</button>
	<div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-area-chart"></i> Lab1.3 Running Times 
			</div>
			<div class="card-body">
			  <canvas id="Lab11Chart" width="100%" height="30"></canvas>
			</div>
			<div class ="card-footer small text-muted">Updated</div>
		</div>
	</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Krishna 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="php/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
  
  <script>
		var Lab11BtnState =0;
		$(document).ready(function(){
			var RegState = <?php echo $_SESSION["RegState"];?>;
			if (RegState == 4){
				$("#DashboardView").show();
				$("#Lab11View").hide();
				$("#Lab12View").hide();
				$("#Lab13View").hide();
			}
			
			$("#Lab11").click(function(){
				$("#Lab11View").show();
				$("#Lab12View").hide();
				$("#Lab13View").hide();
				$("#DashboardView").hide();
			})
			$("#ShowLab11").click(function(){
				$("#Lab11View").show();
				$("#Lab12View").hide();
				$("#Lab13View").hide();
				$("#DashboardView").hide();
			})
			$("#Lab12").click(function(){
				$("#Lab12View").show();
				$("#Lab11View").hide();
				$("#Lab13View").hide();
				$("#DashboardView").hide();
			})
			$("#ShowLab12").click(function(){
				$("#Lab11View").hide();
				$("#Lab12View").show();
				$("#Lab13View").hide();
				$("#DashboardView").hide();
			})
			
			$("#Lab13").click(function(){
				$("#Lab13View").show();
				$("#Lab12View").hide();
				$("#Lab11View").hide();
				$("#DashboardView").hide();
			})
			$("#ShowLab13").click(function(){
				$("#Lab13View").show();
				$("#Lab12View").hide();
				$("#Lab11View").hide();
				$("#DashboardView").hide();
			})
		
			$("#Lab11Run").click(function(){
				event.preventDefault();
				var formData = {
					'Size' : $('input[name=Size]').val()
			};
			$.ajax({
				type:'GET',
				url: 'php/lab11run.php',
				async:true,
				data: formData,
				dataType: 'html',
				encode: true
			}).always(function(data) {
				//log data to the console so we can see
				console.log(data);
				//here we will handle errors and validation messages
				$("#Lab11RunStatus").html(data);
				//location.reload();
			});
			event.preventDefault();
		})
			$("#Lab11Results").click(function(){
				if(Lab11BtnState ==0){
					$("#Lab11Results").html("Clear");
					$("#data").show();
					Lab11BtnState = 1;
					
				} else {
					$("#Lab11Results").html("Show Results");
					$("#data").hide();
					Lab11BtnState = 0;
				}
				
				event.preventDefault();
				$.ajax({
					type:'GET',
					url:'php/lab11Results.php',
					async: true,
					dataType:'html',
					encode: true
				}).always(function(data) {
					$("#data").html(data);
				});
					event.preventDefault();
			})
			
			$("#Lab12Run").click(function(){
				event.preventDefault();
				var formData = {
					'Size1' : $('input[name=Size1]').val()
			};
			$.ajax({
				type:'GET',
				url: 'php/lab12run.php',
				async:true,
				data: formData,
				dataType: 'html',
				encode: true
			}).always(function(data) {
				//log data to the console so we can see
				console.log(data);
				//here we will handle errors and validation messages
				$("#Lab12RunStatus").html(data);
				//location.reload();
			});
			event.preventDefault();
		})
		
		/*
		$("#Lab12Plot").click(function(event){
		if (Lab12PlotState == 0) {
			$("#Lab12Plot").html("Clear");
			Lab12PlotState = 1;
			event.preventDefault();
			$.ajax({
				type: 'GET', 
				url: 'php/lab11GetData.php',
				async: true,
				dataType: 'json',   
				encode: true
			}).always(function(data) {	
				// log data to the console so we can see
				console.log(data); 
				// here we will handle errors and validation messages
				var LoopOrder = [];
				var ElapsedTime2 = [];
				for (var i in data) {
						LoopOrder.push("Loop Order " + data[i].LoopOrder);
						ElapsedTime2.push(data[i].ElapsedTime);
				}
				var chartData = {
					labels: LoopOrder,
					datasets: [
					{
						label: "Elapsed Time",
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: ElapsedTime2
					}]
				};
				var ctx = document.getElementById("Lab12Chart");
				var myLineChart = new Chart(ctx, {
				  type: 'bar',
				  data: chartData
				  /*,  
				  options: {
					scales: {
					  xAxes: [{
						time: {
						  unit: 'second'
						},
						gridLines: {
						  display: false
						},
						ticks: {
						  maxTicksLimit: 6
						}
					  }],
					  yAxes: [{
						ticks: {
						  min: 0,
						  max: 15000,
						  maxTicksLimit: 5
						},
						gridLines: {
						  display: true
						}
					  }],
					},
					legend: {
					  display: true
					}
				  } //comment out upto here...
				});
			});
		} else {
			$("#Lab12Plot").html("Plot");
			var ctx = $("#Lab12Chart");
			var myLineChart = new Chart(ctx, {
				  type: 'bar',
			data: chartData});
			myLineChart.destroy();
			Lab12PlotState = 0;
		}
		// make ajax/sync call
		event.preventDefault();	
	})	
		
		
		*/
		})
		
	</script>
	
	<script>
	function showRows()
    {
        var n = $("#n").val();
        var data = {n: n};
        $.ajax({
            url: "php/lab12Results.php",
            data: data,
            type: "get",
            success: function (result) {

                //alert(result);
                $("#table_body").html(result);

            }});
            
            
   
    var ctxB = document.getElementById("myChart").getContext('2d');
	
    var myChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: [<?php echo $lables ?>],
            datasets: [{
                    label: 'Permutation Execution Time',
                    data: [<?php echo $data_t ?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
                    borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
    }
	</script>
  
</body>

</html>
