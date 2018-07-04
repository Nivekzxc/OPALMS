<?php 
	include('../config/header.php');
	if($emptype == 'HR') {

		if (isset($_GET['empid'])) {
			$DeleteID = $_GET['empid'];

						$QueryDelete = mysql_query("DELETE FROM tbl_employee WHERE EmployeeID='$DeleteID' ");
							$RowsAffected = mysql_affected_rows();
							if($RowsAffected>0){
								$QueryDeleteAccount = mysql_query("DELETE FROM tbl_account WHERE EmployeeID = '$DeleteID'");
								
								header("location:index.php?employee=$DeleteID?deleted");
							}
							else{
								header("location:index.php?delete=Failed");
							}
					}
		}
	else
		header("location:index.php?AccessDenied");
?>