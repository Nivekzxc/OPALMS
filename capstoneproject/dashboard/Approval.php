<?php 
	include("../config/header.php");

 	if(!isset($_SESSION['Username']))
 		header("Location:../?PleaseLogInToContinue");
 	 
  ?>
 	<div class="div-top-menu">
		 <img src="../images/NBS.png" class="menu-logo" alt="NBS logo"> 
		 	<div class="menu-user-info">
		 		<ul>
		 			<li>Welcome , </li>
		 			<li><?php echo $ufirstname ?></li>
		 			<li><?php echo "<i>(".$emptype.")</i>" ?></li>
		 			<li><img src="../uploads/EmpProfilePic/<?php echo $employeeimg; ?>" alt="Profile Picture" class="img" onclick='window.location = "viewemployee.php?empid=<?php echo $employeeid; ?>"'></li>
		 		</ul>
		 	</div>
 	</div>
 	<section class="side-left fixed left">
 		<ul class="nav">
 			<?php if($emptype == "HR" || $emptype =="Human Resource"){ ?>
                        <li class="nav-item"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
						<li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-file-text"></i></span>Employee Leaves</a></li>
						<li class="nav-item"><a href="../dashboard/addemployee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
			<?php }
				elseif($emptype == "Admin"){ ?>
                        <li class="nav-item current"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
						<li class="nav-item"><a href="../dashboard/viewbranches.php"><span class="nav-icon"><i class="fa fa-building"></i></span>Branches</a></li>
						<li class="nav-item"><a href="../dashboard/addbranch.php"><span class="nav-icon"><i class="fa fa-plus"></i></span>Add Branch</a></li>
			<?php } 
				else{
					?>
					<li class="nav-item"><a href="../dashboard/viewemployee.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-address-card"></i></span>View My Profile</a></li>
                    <li class="nav-item current"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-address-card"></i></span>My Leaves</a></li>
                    <li class="nav-item"><a href="../dashboard/applyleave.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-envelope"></i></span>Apply a leave</a></li>
			<?php } ?>
                    
					<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
					<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
 	</section>
 	<section class="side-right fixed right" >
 		<div id="print-container"  style="padding-bottom:5%">
            <?php if($emptype == 'HR'){
 
 				if(isset($_GET['LeaveID'])){
 					$LeaveeID = $_GET['LeaveID'];
 					$Fullname = $ufirstname." ".$umiddlename." ".$ulastname;

 				    $selectleave = mysql_query("SELECT * FROM tbl_leave WHERE LeaveID ='$LeaveeID'");
                        $leavefetch = mysql_fetch_array($selectleave);
                                            $fLeaveID = $leavefetch['LeaveID'];
                                            $fLeaveType = $leavefetch['LeaveType'];
                                            $fLeaveFileDate = $leavefetch['LeaveFileDate'];
                                            $fLeaveDuration = $leavefetch['LeaveDuration'];
                                            $fLeaveDurationFrom = $leavefetch['LeaveDurationFrom'];
                                            $fLeaveDurationTo = $leavefetch['LeaveDurationTo'];
                                            $fLeaveContent = $leavefetch['LeaveContent'];
                                            $fLeaveAttachedFile = $leavefetch['LeaveAttachedFile'];
                                            $fLeaveFilerName = $leavefetch['LeaveFilerName'];
                                            $fLeaveFilerBranch = $leavefetch['LeaveFilerBranch'];
                                            $fLeaveFilerPosition = $leavefetch['LeaveFilerPosition'];
                                            $fLeaveFilerEmpID = $leavefetch['LeaveFilerEmpID'];
                                            $fLeaveRemaining = $leavefetch['RemainingLeaves'];
 				}
 			?>
 			<form method="POST">
 			<table class="table">
                <tr class="table_row logo">
                	<td class="table_column logo">
                		<img src="../images/NBS.png"/>
                	</td>
                </tr>
                <tr class="table_row table_part">
                	<td class="table_column">
                		Leave Application Form
                	</td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Employee Name
                        <input type="text" name="LeaveID" value="<?php echo $fLeaveID ; ?>" hidden>
                    </td>
                    <td class="table_column table_head mm-column">
                        Branch
                    </td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeeName" value="<?php echo $fLeaveFilerName ; ?>" readonly>
                	</td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeeBranch" value="<?php echo $fLeaveFilerBranch ;?>" readonly>
                	</td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Position
                    </td>
                    <td class="table_column table_head mm-column">
                        Employee ID
                    </td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeePosition" value="<?php echo $fLeaveFilerPosition ;?>" readonly>
                	</td>
                    <td class="table_column mm-column">
                        <input type="text" name="EmployeeID"  id="EMPID" value='<?php echo $fLeaveFilerEmpID; ?>' readonly>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column mm-column">
                        Leave from: <input type="date" name="LeaveFrom" id='leavefrom' value="<?php echo $fLeaveDurationFrom ?>" readonly>
                    </td>
                    <td class="table_column mm-column" >
                        Leave to: <input type="date" name="LeaveTo" id='leaveto' value="<?php echo $fLeaveDurationTo ?>" readonly>
                    </td>
                </tr>
                <tr class="table_row">
                	<td class="table_column table_head mm-column">
                		<input type="text" id="deduck" value="<?php ?> " hidden>
                        Reason for Requested Leave
                	</td>
                    <td class="table_column table_head mm-column">
                        Days Of Leave
                    </td> 
                	<td class="table_column mm-column">
                		<input type="text" name="LeaveReason" value="<?php echo $fLeaveType?> " readonly>
                	</td>
                    <td class="table_column mm-column">
                        <input type="text" name="DaysOfLeave"  id="DaysOfLeave" value='<?php echo $fLeaveDuration; ?>' readonly>

                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Important Comments
                    </td>
                    <td class="table_column ll-column">
                        <input type="text" name="LeaveForm" style="font-size:20px ; font-family:'Times New Roman' ; color:#0B0B0B" value="<?php echo $fLeaveContent?>" readonly>

                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Reference file for applying a leave
                    </td>
                    <td class="table_column ll-column">
                        <img src="../uploads/LeaveAttachedFile/<?php echo $fLeaveAttachedFile?>" name="AttachedLeaveFile" id="AttachedLeaveFile" onclick="window.location='../uploads/LeaveAttachedFile/<?php echo $fLeaveAttachedFile?>'" style='cursor:pointer'>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Date
                    </td>
                    <td class="table_column ll-column">
                        <input type="date" name="DateNow" value="<?php 
                        echo $fLeaveFileDate; ?>" id='dateNoww' onload='LeaveCredits(event)' readonly>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Supervisor Approval
                    </td>
                    <?php 
                            $Select = mysql_query("SELECT * FROM tbl_leave_approval WHERE LeaveID = '$LeaveeID'");
                                $counts = mysql_num_rows($Select);
                                if ($counts>0) {
                                        $fetching = mysql_fetch_array($Select);
                                        $Decision = $fetching['Approval'];
                                    if($Decision == 'Approved'){
                                        echo "<td class='table_column ll-column' style='background-color:green'>
                                        <div><strong><h2>Approved!!!</h2></strong></div>
                                        </td>";
                                    }
                                    else{
                                        echo "<td class='table_column ll-column' style='background-color:orange'>
                                        <div><strong><h2>Rejected....</h2></strong></div>
                                        </td>";
                                    }
                                }  
                                else{
                                        echo "<td class='table_column mm-column' style='background-color:yellow'>";?>

                                        Approved : <input type="radio" name="Approval" value='Approved'>
                                        <?php echo "</td>";
                                        echo "<td class='table_column mm-column' style='background-color:yellow'>"?>

                                        Reject : <input type="radio" name="Approval" value='Reject'>
                                        <?php echo "</td>";
                                }
                         ?>
                </tr>
                <tr class="table_row">
                	<td class="table_column ll-column">
                		<input type="submit" name="LeaveApplicationForm" value="Submit" class="submit">
                	</td>
                </tr>
            </table>
            </form>
            <?php 
                    if (isset($_POST['LeaveApplicationForm']))
                    {
                        echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
                                    <div class='w3-modal-content w3-animate-top w3-card-4'>
                                        <header class='w3-container w3-blue'>";?>
                                            <span onclick='document.getElementById("id01").style.display="none"' class='w3-button w3-display-topright'>&times;</span>
                <?php
                        $LID = $_POST['LeaveID'];
                        $EN = $_POST['EmployeeName'];
                        $EB = $_POST['EmployeeBranch'];
                        $ENum = $_POST['EmployeeID'];
                        $Appr = $_POST['Approval'];
                        $DOL = $_POST['DaysOfLeave'];

                        if($Appr =='Approved'){
                            $sql = mysql_query("INSERT INTO `tbl_leave_approval`(`LeaveID`, `EmployeeID`, `Approval`, `ApprovedByName`, `ApprovedByID`, `ApprovedByBranch`, `LeavePointsDeduct`) VALUES ('$LID','$ENum','$Appr','$Fullname','$employeeid','$EB','$DOL')");
                                $rowsaffected = mysql_affected_rows();
                                if($rowsaffected>0){
                                    echo "<div><h2><strong><i>Successfully Approved...</i></strong></h2></div>";

                                }
                                else{
                                    echo "<div><h2><strong><i>Sorry, Failed to Approve...</i></strong></h2></div>";

                                }
                            }
                            else{
                                $sql = mysql_query("INSERT INTO `tbl_leave_approval`(`LeaveID`, `EmployeeID`, `Approval`, `ApprovedByName`, `ApprovedByID`, `ApprovedByBranch`, `LeavePointsDeduct`) VALUES ('$LID','$ENum','$Appr','$Fullname','$employeeid','$EB','$DOL')");
                                $rowsaffected = mysql_affected_rows();
                                if($rowsaffected>0){
                                    echo "<div><h2><strong><i>Successfully Rejected...</i></strong></h2></div>";

                                }
                                else{
                                    echo "<div><h2><strong><i>Sorry, Failed to Reject...</i></strong></h2></div>";

                                }
                                }
                            echo "
                                            </header>
                                        </div>
                                    </div>";
                        
                    
                    }
                }
                ?>

                <?php if($emptype == 'User'){
 
                if(isset($_GET['LeaveID'])){
                    $LeaveeID = $_GET['LeaveID'];
                    $Fullname = $ufirstname." ".$umiddlename." ".$ulastname;

                    $selectleave = mysql_query("SELECT * FROM tbl_leave WHERE LeaveID ='$LeaveeID'");
                        $leavefetch = mysql_fetch_array($selectleave);
                                            $fLeaveID = $leavefetch['LeaveID'];
                                            $fLeaveType = $leavefetch['LeaveType'];
                                            $fLeaveFileDate = $leavefetch['LeaveFileDate'];
                                            $fLeaveFileDay = date("jS F Y", strtotime($fLeaveFileDate));;
                                            $fLeaveDuration = $leavefetch['LeaveDuration'];
                                            $fLeaveDurationFrom = $leavefetch['LeaveDurationFrom'];
                                            $fLeaveDurationTo = $leavefetch['LeaveDurationTo'];
                                            $fLeaveContent = $leavefetch['LeaveContent'];
                                            $fLeaveAttachedFile = $leavefetch['LeaveAttachedFile'];
                                            $fLeaveFilerName = $leavefetch['LeaveFilerName'];
                                            $fLeaveFilerBranch = $leavefetch['LeaveFilerBranch'];
                                            $fLeaveFilerPosition = $leavefetch['LeaveFilerPosition'];
                                            $fLeaveFilerEmpID = $leavefetch['LeaveFilerEmpID'];
                }
            ?>
            <form method="POST">
            <table class="table">
                <tr class="table_row logo">
                    <td class="table_column logo">
                        <img src="../images/NBS.png"/>
                    </td>
                </tr>
                <tr class="table_row table_part">
                    <td class="table_column">
                        Leave Application Form
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Employee Name
                        <input type="text" name="LeaveID" value="<?php echo $fLeaveID ; ?>" hidden>
                    </td>
                    <td class="table_column table_head mm-column">
                        Branch
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="EmployeeName" value="<?php echo $fLeaveFilerName ; ?>" readonly>
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="EmployeeBranch" value="<?php echo $fLeaveFilerBranch ;?>" readonly>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Position
                    </td>
                    <td class="table_column table_head mm-column">
                        Employee ID
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="EmployeePosition" value="<?php echo $fLeaveFilerPosition ;?>" readonly>
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="EmployeeID"  id="EMPID" value='<?php echo $fLeaveFilerEmpID; ?>' readonly>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column mm-column">
                        Leave from: <input type="date" name="LeaveFrom" id='leavefrom' value="<?php echo $fLeaveDurationFrom ?>" readonly>
                    </td>
                    <td class="table_column mm-column" >
                        Leave to: <input type="date" name="LeaveTo" id='leaveto' value="<?php echo $fLeaveDurationTo ?>" readonly>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        <input type="text" id="deduck" value="<?php ?> " hidden>
                        Reason for Requested Leave
                    </td>
                    <td class="table_column table_head mm-column">
                        Days Of Leave
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="LeaveReason" value="<?php echo $fLeaveType?> " readonly>
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="DaysOfLeave"  id="DaysOfLeave" value='<?php echo $fLeaveDuration; ?>' readonly>
                    </td> 
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Important Comments
                    </td>
                    <td class="table_column ll-column">
                        <input type="text" name="LeaveForm" style="font-size:20px ; font-family:'Times New Roman' ; color:#0B0B0B" value="<?php echo $fLeaveContent?>" readonly>

                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Reference file for applying a leave
                    </td>
                    <td class="table_column ll-column">
                        <img src="../uploads/LeaveAttachedFile/<?php echo $fLeaveAttachedFile?>" name="AttachedLeaveFile" id="AttachedLeaveFile" onclick="window.location='../uploads/LeaveAttachedFile/<?php echo $fLeaveAttachedFile?>'" style='cursor:pointer'>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Date
                    </td>
                    <td class="table_column ll-column">
                        <?php echo $fLeaveFileDate ?>
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Supervisor Approval
                    </td>
                    
                        <?php 
                            $Select = mysql_query("SELECT * FROM tbl_leave_approval WHERE LeaveID = '$LeaveeID'");
                                $counts = mysql_num_rows($Select);
                                if ($counts>0) {
                                        $fetching = mysql_fetch_array($Select);
                                        $Decision = $fetching['Approval'];
                                    if($Decision == 'Approved'){
                                        echo "<td class='table_column ll-column' style='background-color:green'>
                                        <div><strong><h2>Approved!!!</h2></strong></div>
                                        </td>";
                                    }
                                    else{
                                        echo "<td class='table_column ll-column' style='background-color:orange'>
                                        <div><strong><h2>Rejected....</h2></strong></div>
                                        </td>";
                                    }
                                }
                                    
                                else{
                                        echo "<td class='table_column ll-column' style='background-color:yellow'>
                                        <div><strong><h2>Pending....</h2></strong></div>
                                        </td>";
                                }
                         ?>
                        
                    
                </tr>
            </table>
            </form>
            <?php } ?>
 		</div>
 			<br>
            <br>
            <br>
            <br>
 	</section>
</body>
</html>