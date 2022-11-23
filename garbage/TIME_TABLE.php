<?php
session_start();
$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = marks_db";
$credentials = "user = piyush";
$con = pg_connect("$host $port $dbname $credentials");
	
 if (!$con) {
   echo "CONNECTION FAILED";
 }else{
 	$query = "SELECT time_table.* FROM time_table"; 
	//$query="select time_table.* from (select * from courses where roll_no='".pg_escape_string($_SESSION['UN'])."') as T1  natural join time_table";
$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");

while ($row = pg_fetch_row($rs)) {
  echo "$row[0] $row[1] $row[2] $row[3] $row[4]\n";
}

pg_close($con); 

 	
 }
?>
