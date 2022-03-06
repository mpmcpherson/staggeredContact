<?php
	$host = "yourHostAddress";
	$uname = "yourUserName";
	$pw = "yourPassword";
	$schema = "yourSchema";

	$msqli = new mysqli($host,$uname,$pw,$schema);

	$dbhandle = mysqli_connect($host,$uname,$pw,$schema);
?>