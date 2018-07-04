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
                    <li class="nav-item current"><a href="../dashboard/viewemployee.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-address-card"></i></span>View My Profile</a></li>
                    <li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-address-card"></i></span>My Leaves</a></li>
                    <li class="nav-item"><a href="../dashboard/applyleave.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-envelope"></i></span>Apply a leave</a></li>
			<?php } ?>
                    
					<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
					<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
 	</section>
 	<section class="side-right fixed right">
 		<div class="container"  style="padding-bottom:5%">
 		<?php 

 		if (isset($_GET['empid'])) {
 			$empid = $_GET['empid'];
            if ($empid == '') {
                    header('location:viewemployee.php?empid=$employeeid');
                }
                else{
 			$Query = mysql_query("SELECT * FROM tbl_employee WHERE EmployeeID = '$empid'");
 				$FetchingData = mysql_fetch_array($Query);
	 				$fname = $FetchingData['FirstName'];
	 				$mname = $FetchingData['MiddleName'];
	 				$lname = $FetchingData['LastName'];
	 				$Gender = $FetchingData['Gender'];
	 				$Address = $FetchingData['Address'];
	 				$employtype = $FetchingData['EmployeeType'];
                    $employimg = $FetchingData['EmployeeImg'];
 					$Branch = $FetchingData['BranchID'];
 					$BirthPlace = $FetchingData['BirthPlace'];
 					$Status = $FetchingData['Status'];
 					$Citizenship = $FetchingData['Citizenship'];
 					$Phone = $FetchingData['MobileNumber'];
 					$mail = $FetchingData['Email'];
 					$Birthdate = $FetchingData['BirthDate'];
 					$Birthday = date("jS F Y", strtotime($Birthdate));
 					$Date = $FetchingData['DateHired'];
 					$datehired = date("jS F Y", strtotime($Date));
 					$Fullname = $fname." ".$mname." ".$lname;
 					$posit = $FetchingData['PositionID'];
 					$getposit = mysql_query("SELECT PositionName FROM `tbl_employee`, `tbl_position` WHERE EmployeeID ='$empid' AND tbl_employee.`PositionID` = tbl_position.`PositionID`");
 					$fetchposit = mysql_fetch_array($getposit);
 						$Positionnya = $fetchposit['PositionName'];
 				}
                if ($emptype == 'User' && $empid != $employeeid) {
                    header("location:viewemployee.php?empid=$employeeid");
                }
                else{
 		?>
 				<table class="table">
                        <tr class="table_row logo">
                            <td class="table_column logo">
                                <img src="../images/NBS.png"/>
                                <p><i>Employee Records</i></p>
                            </td>
                        </tr>
                        <tr class="table_row table_part">
                            <td class="table_column">
                                PERSONAL DATA
                            </td>
                        </tr>
                        <tr class="table_row">
                            <td class="table_column table_head m-column">
                            <span class="nav-icon"><i class="fa fa-id-badge"></i></span>
                                Employee ID
                            </td>
                            <td class="table_column m-column">
                              	<?php echo $empid ?>
                            </td><br>
                            <td class="table_column p-column">
                               <img src="../uploads/EmpProfilePic/<?php echo $employimg;?>" alt="<?php echo $Fullname; ?>">
                            </td>
                        </tr>
                        <tr class="table_row">
                            <td class="table_column table_head m-column">
                            <span class="nav-icon"><i class="fa fa-user-circle"></i></span>
                                Full Name
                            </td>
                            <td class="table_column m-column">
                                <?php echo $Fullname; ?>
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-handshake-o"></i></span>
                                Position
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-calendar"></i></span>
                                Date Employed
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-transgender"></i></span>
                                Gender
                            </td>
                            <td class="table_column s-column">
                               <?php echo $Positionnya; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $datehired; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Gender; ?>
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-building"></i></span>
                                Branch
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-map-marker"></i></span>
                                Address
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-map"></i></span>
                                BirthPlace
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Branch; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Address; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $BirthPlace; ?>
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-birthday-cake"></i></span>
                                Birthday
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-male"></i></span>
                                Status
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-location-arrow"></i></span>
                                Citizenship
                            </td>
                            <td class="table_column s-column">
                               <?php echo $Birthday; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Status; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Citizenship; ?>
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-envelope"></i></span>
                                Email
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-address-book"></i></span>
                                Phone Number
                            </td>
                            <td class="table_column table_head s-column">
                            <span class="nav-icon"><i class="fa fa-user-secret"></i></span>
                                Employee Type
                            </td>
                            <td class="table_column s-column">
                               <?php echo $mail; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $Phone; ?>
                            </td>
                            <td class="table_column s-column">
                                <?php echo $employtype; ?>
                            </td>
                        </tr>

                    </table>
                <?php }
                }
                 ?>
                
 		</div>
 	</section>
</body>
</html>