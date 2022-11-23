<?php
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
        $sql ="select * from DECS";
	$rs = pg_query($con, $sql);
	 $chart_data="";
	 $score[] = array(0);
	 $students[]=array(0);
         while ($row = pg_fetch_array($rs)) { 
            $x=$row['roll_no'];
            $y=$row['marks'];
            array_push($students,$x);
            array_push($score,$y);
        }
 }
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:60%;hieght:20%;text-align:center">
            <h2 class="page-header" >Analytics Reports </h2>
            <div>Marks </div>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">

      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                   
                    
                        labels:<?php echo json_encode($students); ?>,
                        //labels:[0,1,2,3,4],
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                                "#25d5f2",
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
</html>
