<?php
session_start();
$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = marks_db";
$credentials = "user = piyush";
$con = pg_connect( "$host $port $dbname $credentials"  );
	
 if (!$con) {
   #.. code
 }else{
         //$sql =" DECS_MARKS";
         //$result = pg_query($con,$sql);   
        $sql ="select * from FML";
	$rs = pg_query($con, $sql);
	 $chart_data="";
	 $score[] = array();
	 $students[]=array();
	 
         while ($row = pg_fetch_array($rs)) { 
            $x=$row['roll_no'];
            $y=$row['marks'];
            array_push($students,$x);
            array_push($score,$y);
        }
        $students=array_slice($students,1);
        $score=array_slice($score,1);
        $sql ="select course_name from courses where roll_no='".pg_escape_string($_SESSION['UN'])."'";
	$rs = pg_query($con, $sql);
	$count=pg_num_rows($rs);
	$arr = pg_fetch_all($rs);
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <style>  
    html,
body {
  height: 100%;
  padding: 0;
  margin: 0;
  background-color: #181c24;
}

div {
  width: 50%;
  height: 50%;
  float: left;
}

#div1 {
  background: #191c24;
}

#div2 {
  background: #191c24;
}

#div3 {
  background: #191c24;
}

#div4 {
  background: #191c24;
}
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="project_images/<?php echo $_SESSION["UN"]; ?>.jpeg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION["UN"]; ?></h6>
                        <span>Student</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>My Courses</a>
                        <div class="dropdown-menu bg-transparent border-0">
                             <ul>
                             <?php
                             while($row=pg_fetch_array($rs)){
                             ?>
                             <li> <a href=<?php echo $row["course_name"] ?>.php class="dropdown-item"><?php echo $row["course_name"] ?></a></li>
                             <?php
                             }
                             ?>
                             </ul>
                        </div>
                    </div>
                    <a href="widget.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="to-do.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>To Do</a>
                    <a href="table.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Timetable</a>
                   
                 
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="index.php" class="dropdown-item">My Profile</a>
                            <a href="to-do.php" class="dropdown-item">Upcoming events</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Chart Start -->
		<div id="div1">
		<canvas  id="chartjs_bar"></canvas> 
		 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
	
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($students);?>,
                        //labels:[0,1,2,3,4],
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                                "#25d5f2",
                                "#e60000",
                                "#e6e600",
                                "#cc33ff",
                                "#ff9999",
                                "#66ff99",
                                "#66ffff",
                                "#ff9966",
                                "#660066",
                                "#d27979",
                                "#ffff66",
                                "#00cc99",
                                "#ffcc66",
                                "#339933",
                            ],
                            data:<?php echo json_encode($score); ?>,
                            //data:[0,65,74,89,48]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                  scales: {
          y: {
            beginAtZero: true
          }
        },
 
 
                }
                });
    </script>
		</div>
<div id="div2">
	<canvas  id="chartjs_bar1"></canvas> 
		 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
	
      var ctx = document.getElementById("chartjs_bar1").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($students); ?>,
                      // labels:labels_copy,
                        //labels:[0,1,2,3,4],
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                                "#25d5f2",
                                "#e60000",
                                "#e6e600",
                                "#cc33ff",
                                "#ff9999",
                                "#66ff99",
                                "#66ffff",
                                "#ff9966",
                                "#660066",
                                "#d27979",
                                "#ffff66",
                                "#00cc99",
                                "#ffcc66",
                                "#339933",
                            ],
                            data:<?php echo json_encode($score); ?>,
                            //data:[0,65,74,89,48]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</div>
<div id="div3">
<canvas  id="chartjs_bar2"></canvas> 
		 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
	
      var ctx = document.getElementById("chartjs_bar2").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($students); ?>,
                        //labels:[0,1,2,3,4],
                        datasets: [{
                            backgroundColor: [
                                 "#ff407b",
                                "#25d5f2",
                                "#e60000",
                                "#e6e600",
                                "#cc33ff",
                                "#ff9999",
                                "#66ff99",
                                "#66ffff",
                                "#ff9966",
                                "#660066",
                                "#d27979",
                                "#ffff66",
                                "#00cc99",
                                "#ffcc66",
                                "#339933",
                            ],
                            data:<?php echo json_encode($score); ?>,
                            //data:[0,65,74,89,48]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                    
 
 
                }
                });
    </script>
</div>
<div id="div4">
<canvas  id="chartjs_bar3"  width="1000" height="1000"></canvas> 
		 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
	
      var ctx = document.getElementById("chartjs_bar3").getContext('2d');
    

                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels:<?php echo json_encode($students); ?>,
                        //labels:[0,1,2,3,4],
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                                "#25d5f2",
                                "#e60000",
                                "#e6e600",
                                "#cc33ff",
                                "#ff9999",
                                "#66ff99",
                                "#66ffff",
                                "#ff9966",
                                "#660066",
                                "#d27979",
                                "#ffff66",
                                "#00cc99",
                                "#ffcc66",
                                "#339933",
                            ],
                            data:<?php echo json_encode($score); ?>,
                            //data:[0,65,74,89,48]
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 12,
                        }
                    },
 
 
                }
                });
    </script>
</div>
 
            <!-- Chart End -->

	
            <!-- Footer Start -->
           <!-- <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author???s credit link/attribution link/backlink. If you'd like to use the template without the footer author???s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                         <!--   Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div> -->
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
