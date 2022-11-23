<?php
session_start();
unset($_SESSION["UN"]);
echo "
<script>
	window.history.forward();
	function noBack(){
		window.history.forward();
	}
</script>";
header("location: signin.php");
?>
