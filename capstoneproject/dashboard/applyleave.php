<?php 
	include("../config/header.php");

 	if(!isset($_SESSION['Username']))
 		header("Location:../?PleaseLogInToContinue");
 	// if($emptype == 'Admin' || $emptype == 'HR')
 	// 	header("location:index.php?AccessDenied");
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
                    <li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-address-card"></i></span>My Leaves</a></li>
                    <li class="nav-item"><a href="../dashboard/applyleave.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-envelope"></i></span>Apply a leave</a></li>
			<?php } ?>
                    
					<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
					<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
 	</section>
 	<section class="side-right fixed right" >
 		<div id="print-container"  style="padding-bottom:5%">
 			<?php 
 				if(isset($_GET['empid'])){
 					$EmployyID = $_GET['empid'];
 					$Fullname = $ufirstname." ".$umiddlename." ".$ulastname;

 					$getempinfo = mysql_query("SELECT * FROM tbl_employee WHERE EmployeeID = '$EmployyID'");
 						$fetch = mysql_fetch_array($getempinfo);
 							$PositionID = $fetch['PositionID'];
 							$Branch = $fetch['BranchID'];
 						$selectposit = mysql_query("SELECT * FROM tbl_position WHERE PositionID = '$PositionID'");
							$fetchposit = mysql_fetch_array($selectposit);
							$position = $fetchposit['PositionName'];
                             $SelectLeaveID = mysql_query("SELECT MAX(LeaveID) as MaxLeaveID FROM tbl_leave");
                                 $fetchLeaveID = mysql_fetch_array($SelectLeaveID);
                                     $MaxLeaveID = $fetchLeaveID['MaxLeaveID'];
                                     $MaxxLeaveID = $MaxLeaveID + 1 ;
                            $SelectLeaveDeduct = mysql_query("SELECT `tbl_leave_approval`.`LeavePointsDeduct` , `tbl_leave`.`LeaveType` FROM tbl_leave_approval , tbl_leave WHERE `tbl_leave`.`LeaveID` = `tbl_leave_approval`.`LeaveID` AND `tbl_leave`.`LeaveFilerEmpID` = '$EmployyID'");
                            $Count = mysql_num_rows($SelectLeaveDeduct);
                            if ($Count>0) {
                                $LeaveDeduct = 0 ;
                                $Total = 0;
                                while($FetchDeduct = mysql_fetch_array($SelectLeaveDeduct)){
                                    $Dedak = $FetchDeduct['LeavePointsDeduct'];
                                    $DedakType = $FetchDeduct['LeaveType'];
                                    $LivDedak = $FetchDeduct['LeavePointsDeduct'];
                                        if ($DedakType == 'Forced/Mandatory Leave') {
                                            $deduction = 24;
                                        }
                                        if ($DedakType == 'Rehabilitation Leave'){
                                            $deduction = 12;
                                        }
                                        if ($DedakType == 'Sick Leave'){
                                            $deduction = 24;
                                        }
                                        if ($DedakType == 'Special Emergency Leave'){
                                            $deduction = 24;
                                        }
                                        if ($DedakType == 'Study Leave'){
                                            $deduction = 18.25;
                                        }
                                        if ($DedakType == 'Vacation Leave'){
                                            $deduction = 24;
                                        }
                                        if ($DedakType == 'Paternity Leave'){
                                            $deduction = 52.14;
                                        }
                                        if ($DedakType == 'Maternity Leave'){
                                            $deduction = 12.16;
                                        }
                                        $TotalDeduct = $deduction * $Dedak;
                                        $Total = $TotalDeduct + $Total;
                                        $LeaveDeduct = $Total;
                                }
                            }
                            else{
                                $LeaveDeduct = 0;
                            }
                            $queryleave = mysql_query("SELECT * FROM tbl_leave WHERE LeaveFilerEmpID = '$employeeid'");
                            while($mysqlfetch = mysql_fetch_array($queryleave)){
                                $fetch = $mysqlfetch['LeaveFileDate'];
                                if($fetch == date("Y-m-d")){
                                    $disabled = 1;
                                }
                                else{
                                    $disabled = 0;
                                }
                            }

 				}
 			?>
 			<form method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="LeaveID" value="<?php echo $MaxxLeaveID ; ?>" hidden>
                    </td>
                    <td class="table_column table_head mm-column">
                        Branch
                    </td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeeName" value="<?php echo $Fullname;?>" readonly>
                	</td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeeBranch" value="<?php echo $Branch;?>" readonly>
                	</td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Employee Number
                    </td>
                    <td class="table_column table_head mm-column">
                        Position
                    </td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeeNumber" value="<?php echo $EmployyID;?>" readonly>
                	</td>
                	<td class="table_column mm-column">
                		<input type="text" name="EmployeePosition" value="<?php echo $position;?>" readonly>
                	</td>
                </tr>
                <tr class="table_row">
                    <td class="table_column xs-column">
                        Leave from: <input type="date" name="LeaveFrom" id='leavefrom' value="<?php 
                        date_default_timezone_set("Asia/Manila");
                        echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" required>
                    </td>
                    <td class="table_column xs-column" >
                        Leave to: <input type="date" name="LeaveTo" id='leaveto' value="<?php 
                        date_default_timezone_set("Asia/Manila");
                        echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" onchange="handler(event);" required>
                    </td>
                    <td class="table_column xs-column">
                        Leave Days <input type="text" name="DaysOfLeave"  id="DaysOfLeave" readonly>
                    </td>
                    
                    <td class="table_column xs-column" id='leaveto'>
                        Remaining Leaves Credits: <input type="text" name="Remaining" id='Remaining' placeholder='Click here' readonly required>
                        
                        <input type="text" name="alaws" value="<?php echo $uDateHired ?>" id='dateHire' hidden>
                    </td>
                </tr>
                <tr class="table_row">
                	<td class="table_column table_head mm-column">
                		<input type="text" id="deduck" value="<?php echo $LeaveDeduct ?> " hidden>
                        Reason for Requested Leave
                	</td>
                    <td class="table_column table_head mm-column">
                        Selected Leave Available in Days
                        <input type="text" id="iGender" value="<?php echo $uGender ; ?>" hidden>
                        <input type="text" id="iStatus" value="<?php echo $uStatus ; ?>" hidden>
                        <input type="text" id="Deductionn" hidden>
                    </td>   
                	<td class="table_column mm-column">
                		<select name="LeaveType" style="height:50px ; width:100% ; border:none" onchange="displayAvailable(event)">
                            <?php $QueryLeaveType = mysql_query("SELECT * FROM tbl_leave_type");
                                                
                                                echo "<option>Select a leave type</option>";
                                        while($fetchLeave = mysql_fetch_array($QueryLeaveType)){
                                                echo "<option value='$fetchLeave[LeaveType]'>$fetchLeave[LeaveType]</option>";
                                        }
                                        if($uGender == 'Male' && $uStatus == 'Married'){
                                            echo "<option value='Paternity Leave'>Paternity Leave</option>";
                                        }
                                        else{
                                            if($uGender == 'Female' && $uStatus == 'Married'){
                                                echo "<option value='Maternity Leave'>Maternity Leave</option>";
                                            }
                                            else{
                                                // echo "<option>Wala</option>";
                                            }
                                        }
                                        
                             ?>    
                        </select>
                	</td>
                    <td class="table_column mm-column">
                        <input type="text" id='AvailableLeaves' name='SubtractingLeaveBalance' readonly>

                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Important Comments
                    </td>
                    <td class="table_column ll-column">
                        <input type="text" name="LeaveForm" style="font-size:20px ; font-family:'Times New Roman' ; color:#0B0B0B" placeholder="Required..." required>

                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head ll-column">
                        Reference file for applying a leave
                    </td>
                    <td class="table_column ll-column">
                        <input type="file" name="AttachedLeaveFile" id="AttachedLeaveFile">
                    </td>
                </tr>
                <tr class="table_row">
                    <td class="table_column table_head mm-column">
                        Date
                    </td>
                    <td class="table_column table_head mm-column">
                        Supervisor Approval
                    </td>
                    <td class="table_column mm-column">
                        <input type="date" name="DateNow" value="<?php 
                        date_default_timezone_set("Asia/Manila");
                        echo date("Y-m-d"); ?>" id='dateNoww' onload='LeaveCredits(event)' readonly>
                    </td>
                    <td class="table_column mm-column">
                        <input type="text" name="Approval" placeholder="Approve/Reject" readonly>
                    </td>
                </tr>
                <tr class="table_row">
                	<td class="table_column ll-column">
                		<input type="submit" name="LeaveApplicationForm" class="submit" id='SubmitButton' <?php 
                        if($disabled>0){
                            echo "disabled"." ";
                            echo "title='Disabled'"." ";
                            echo "value='Disabled'";
                        }
                        else{
                            echo "title='Submit'"." ";
                            echo "value='Submit'";
                        }
                        ?>>
                	</td>
                </tr>
            </table>
            </form>
            <?php 
                    if (isset($_POST['LeaveApplicationForm']))
                    {
                        echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
                                    <div class='w3-modal-content w3-animate-top w3-card-4'>
                                        <header class='w3-container w3-blue'>";
                                        ?>
                                            <span onclick='document.getElementById("id01").style.display="none"' class='w3-button w3-display-topright' onclick="window.location='index.php'">&times;</span>
                <?php
                        $iLeaveDuration = $_POST['DaysOfLeave'];
                        $iLeaveBalance = $_POST['SubtractingLeaveBalance'];
                        // if($iLeaveBalance < 180){
                        //     echo "<div><h2><strong><i>Sorry you can only apply a leave if you're an employee of 6months...</i></strong></h2></div>";
                        //     }
                        
                        if($_POST['DaysOfLeave'] <= $_POST['SubtractingLeaveBalance'] ){
                                $target_dir = "../uploads/LeaveAttachedFile/".$_POST['LeaveID'];
                                $target_file = $target_dir . basename($_FILES["AttachedLeaveFile"]["name"]);
                                $uploadOk = 1;
                                $UploadedImg = basename($_FILES["AttachedLeaveFile"]["name"]);
                                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                                $check = getimagesize($_FILES["AttachedLeaveFile"]["tmp_name"]);
                                    if($check !== false)
                                    {
                                        $uploadOk = 1;
                                    }
                                    else
                                    {
                                        echo "File is not an image.";
                                        $uploadOk = 0;
                                    }

                            // Check if file already exists
                                    if (file_exists($target_file)) 
                                    {
                                        echo "Sorry, file already exists.";
                                        $uploadOk = 0;
                                    }
                            // Check file size
                                    if ($_FILES["AttachedLeaveFile"]["size"] > 7000000) 
                                    {
                                        echo "Sorry, your file is too large.";
                                        $uploadOk = 0;
                                    }
                            // Allow certain file formats
                                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                    && $imageFileType != "gif" ) 
                                    {
                                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                        $uploadOk = 0;
                                    }
                                    // Check if $uploadOk is set to 0 by an error
                                    if ($uploadOk == 0) 
                                    {
                                        echo "Sorry, your file was not uploaded.";
                                    // if everything is ok, try to upload file
                                    }  
                                    else{
                                            if (move_uploaded_file($_FILES["AttachedLeaveFile"]["tmp_name"], $target_file))
                                            {

                                            $iLeaveID = $_POST['LeaveID'];
                                            $iLeaveType = $_POST['LeaveType'];
                                            $iLeaveFileDate = $_POST['DateNow'];
                                            
                                            $iLeaveDurationFrom = $_POST['LeaveFrom'];
                                            // $iLeaveDurationFrom = date("jS F Y", strtotime($iLeaveDurationFr));
                                            $iLeaveDurationTo = $_POST['LeaveTo'];
                                            // $iLeaveDurationTo = date("jS F Y", strtotime($iLeaveDurationT));
                                            $iLeaveContent = $_POST['LeaveForm'];
                                            $iLeaveFilerName = $_POST['EmployeeName'];
                                            $iLeaveFilerBranch = $_POST['EmployeeBranch'];
                                            $iLeaveFilerPosition= $_POST['EmployeePosition'];
                                            $iLeaveFilerEmpID= $_POST['EmployeeNumber'];
                                            $iLeaveRemaining= $_POST['Remaining'];
                            $querry = mysql_query("SELECT * FROM tbl_leave WHERE `LeaveFilerEmpID`='$employeeid'");
                            while($mysqlqqq = mysql_fetch_array($querry)){
                                $From = $mysqlqqq['LeaveDurationFrom'];
                                $To = $mysqlqqq['LeaveDurationTo'];
                                $Type = $mysqlqqq['LeaveType'];
                                $Duration = $mysqlqqq['LeaveDuration'];
                                if($From == $iLeaveDurationFrom && $To == $iLeaveDurationTo && $Type == $iLeaveType){
                                    
                                    $existing = 1;
                                }
                                else{
                                    $existing = 0;
                                }
                            }

                            if($existing == 0){
                            $QueryInsert = mysql_query("INSERT INTO `tbl_leave`(`LeaveID`, `LeaveType`, `LeaveFileDate`, `LeaveDuration`, `LeaveDurationFrom`, `LeaveDurationTo`, `LeaveContent`, `LeaveAttachedFile`, `LeaveFilerName`, `LeaveFilerBranch`, `LeaveFilerPosition`, `LeaveFilerEmpID`, `RemainingLeaves`) VALUES 
                                ('$iLeaveID','$iLeaveType','$iLeaveFileDate','$iLeaveDuration','$iLeaveDurationFrom','$iLeaveDurationTo','$iLeaveContent','$iLeaveID$UploadedImg','$iLeaveFilerName','$iLeaveFilerBranch','$iLeaveFilerPosition','$iLeaveFilerEmpID','$iLeaveRemaining')");
                            $RowAffected = mysql_affected_rows();
                                            
                            if ($RowAffected>0) {
                                 echo "<div><h2><strong><i>Leave Application Submitted...</strong></i></h2></div>";
                                                }
                            else{
                                echo "<div><h2><strong><i>Failed to submit Leave Application...".$RowAffected."</i></strong></h2></div>";
                                }
                            }
                            else{
                                echo"<div><h2><strong><i>Leave is already existing...</i></strong></h2></div>";
                            }
                            }
                            else{
                                                echo "<div><h2><strong><i>Sorry, there was an error uploading your file.</i></strong></h2></div>";
                            }
                            }   
                            }
                            if($iLeaveDuration > $iLeaveBalance){
                            echo "<div><h2><strong><i>You have not enough leave balance...</i></strong></h2></div>";
                            }

                            echo "
                                            </header>
                                        </div>
                                    </div>";
                    
                    }
                ?>
         
 		</div>
 			<br>
            <br>
            <br>
            <br>
 	</section>
</body>
</html>