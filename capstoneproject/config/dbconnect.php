<?php 
	$Kunek = mysql_connect("localhost","root","");
		if(!$Kunek)
			die("di makaKunek!".mysql_error());

	$SelectDB = mysql_select_db("OPALMS",$Kunek);
		if(!$SelectDB)
			die("please create a database");
?>