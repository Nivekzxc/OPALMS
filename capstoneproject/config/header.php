<?php
	include("dbconnect.php");
    session_start();
    if (isset($_GET['Username'])) {
      $_SESSION['Username'] = $_GET['Username'];
    }
    if (isset($_SESSION['Username'])){

        $username = $_SESSION['Username'];
    }
    else{
        $username = '';
    }
      $accountdetails = mysql_query("SELECT * FROM tbl_account WHERE username='$username' ");
      $accountdetailscount = mysql_num_rows($accountdetails);
    if($accountdetailscount == 1){
        while($fetch = mysql_fetch_array($accountdetails)){
            $id = $fetch['AccountID'];
            $myusername = $fetch['Username'];
            $mypassword = $fetch['Password'];
            $employeeid = $fetch['EmployeeID'];
        }

        $userdetails = mysql_query("SELECT * FROM tbl_employee WHERE employeeid = '$employeeid'");

        while($fetch2 = mysql_fetch_array($userdetails)){
          $ufirstname = $fetch2['FirstName'];
          $umiddlename = $fetch2['MiddleName'];
          $ulastname = $fetch2['LastName'];
          $emptype = $fetch2['EmployeeType'];
          $employeeimg = $fetch2['EmployeeImg'];
          $uBranchID = $fetch2['BranchID'];
          $uGender = $fetch2['Gender'];
          $uStatus = $fetch2['Status'];
          $uDateHired = $fetch2['DateHired'];
        }
     }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Profiling and Leave Management</title>
	<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style1.css" />
  <link rel="stylesheet" type="text/css" href="../css/style2.css" />
  <link rel="stylesheet" type="text/css" href="./css/style1.css"/>
  <link rel="stylesheet" type="text/css" href="./css/style2.css"/>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
  <link rel="stylesheet" type="text/css" href="../css/Home.css"/>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.css"/>
  <script type="text/javascript" src="../js/myjs.js"></script>
</head>
<body onload='LeaveCredits(this.value)'>