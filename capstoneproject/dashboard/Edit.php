<?php 
	include("../config/header.php");	
	if(!isset($_SESSION['Username']))
 		header("Location:../?PleaseLogInToContinue");
 	if ($emptype == 'User') {
 		header("location:index.php");
 	}
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
						<li class="nav-item current"><a href="../dashboard/addemployee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
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
 	<?php 
		if(isset($_GET['empid'])) {
			if ($emptype != 'HR') {
				header("location:index.php?accessdenied");
			}
			else{
 			$EmpEditID = $_GET['empid']; ?>
 	<section class="side-right fixed right" >
	<div class="register-container" style="padding-bottom:5%">
	<div class="img-div">
		<img src="./images/NBS.png" class="img-logo-register">
	</div>
		<h1>Edit Employee Info</h1>
		<div class="register-div ">
			<hr/>
			<?php 
				$Query = mysql_query("SELECT * FROM tbl_employee WHERE EmployeeID = '$EmpEditID'");
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
 					$Religion = $FetchingData['Religion'];
 					$Birthdate = $FetchingData['BirthDate'];
 					
					
 					$Date = $FetchingData['DateHired'];
 					$Fullname = $fname." ".$mname." ".$lname;
 					$posit = $FetchingData['PositionID'];
 					$getposit = mysql_query("SELECT PositionName FROM `tbl_employee`, `tbl_position` WHERE EmployeeID ='$EmpEditID' AND tbl_employee.`PositionID` = tbl_position.`PositionID`");
 					$fetchposit = mysql_fetch_array($getposit);
 						$Positionnya = $fetchposit['PositionName'];
			 ?>
			<div class="register-form">
				<form method="POST" >
					<label for="FirstName">First Name</label><br>
					<input type="text" name="FirstName" value="<?php echo $fname; ?>" class="register-form-input" required><br><br>

					<label for="MiddleName">Middle Name</label><br>
					<input type="text" name="MiddleName" value="<?php echo $mname; ?>" class="register-form-input" ><br><br>

					<label for="LastName">Last Name</label><br>
					<input type="text" name="LastName" value="<?php echo $lname; ?>" class="register-form-input" required><br><br>

					<label for="Position">Position</label><br>
					<select name="Position" class="add-employee" required>
						<?php 
							$SelectPosition = mysql_query("SELECT * FROM tbl_position");
							$SelectPositionID = mysql_query("SELECT * FROM tbl_position WHERE PositionName = '$Positionnya'");
								$fetchposition = mysql_fetch_array($SelectPositionID);
									echo "<option value='$fetchposition[PositionID]'>$fetchposition[PositionName]</option>";
								while($fetch= mysql_fetch_array($SelectPosition)){
									echo "<option value='$fetch[PositionID]'>$fetch[PositionName]</option>";
								}
						?>
					</select><br><br>

					<label for="Branch">Branch</label><br>
					<select name="Branch" class="add-employee" required>
						<?php 
							$SelectPosition = mysql_query("SELECT * FROM tbl_branch");
									echo "<option>$Branch</option>";
								while($fetch= mysql_fetch_array($SelectPosition)){
									echo "<option>$fetch[BranchID]</option>";
								}
						?>
					</select><br><br>

					<label for="EmploType">Employee Type</label><br>
					<select name="EmploType" class="add-employee" required>
						<?php echo "<option>$employtype</option>"; ?>
						<option>Admin</option>
						<option>HR</option>
						<option>User</option>
					</select><br><br>

					<label for="DateHired">Date Employed</label><br>
					<input type="Date" name="DateHired" value="<?php echo $Date; ?>" class="add-employee" required><br><br>

					<label for="Status">Status</label><br>
					<input type="Radio" name="Status" value="Single" <?php if($Status =='Single'){ echo 'checked'; } ?>>Single
					<span class="nav-icon"><i class="fa fa-male"></i></span>
					<input type="Radio" name="Status" value="Married" <?php if($Status =='Married'){ echo 'checked'; } ?>>Married
					<span class="nav-icon"><i class="fa fa-female"></i><i class="fa fa-male"></i></span><br><br>

					<label for="Gender">Gender</label><br>
					<input type="Radio" name="Gender" value="Male" <?php if($Gender =='Male'){ echo 'checked'; } ?>>Male
					<span class="nav-icon"><i class="fa fa-mars"></i></span>
					<input type="Radio" name="Gender" value="Female" <?php if($Gender =='Female'){ echo 'checked'; } ?>>Female
					<span class="nav-icon"><i class="fa fa-venus"></i></span><br><br>

					<label for="MobileNumber">Mobile Number</label><br>
					<input type="text" name="MobileNumber" value="<?php echo $Phone; ?>" class="register-form-input" required><br><br>

					<label for="Email">Email</label><br>
					<input type="text" name="Email" value="<?php echo $mail; ?>" class="register-form-input" required><br><br>

					<label for="Address">Address</label><br>
					<input type="text" name="Address" value="<?php echo $Address; ?>" class="register-form-input" required><br><br>

					<label for="BirthDay">Birth Date</label><br>
					<input type="date" name="BirthDay" value="<?php echo $Birthdate; ?>" class="add-employee" required><br><br>

					<label for="BirthPlace">Birth Place</label><br>
					<input type="text" name="BirthPlace" value="<?php echo $BirthPlace; ?>" class="register-form-input" required><br><br>

					<label for="Religion">Religion</label><br>
					<input type="text" name="Religion" value="<?php echo $Religion; ?>" class="register-form-input" required><br><br>

					<label for="Citizenship">Citizenship</label><br>
					<input type="text" name="Citizenship" value="<?php echo $Citizenship; ?>" class="register-form-input" required><br><br>

					<input type="submit" name="UpdateEmployee" value="Update Employee Info..." class="submit"><br><br>
				</form>
				<?php 
					if (isset($_POST['UpdateEmployee'])) {
						echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
									<div class='w3-modal-content w3-animate-top w3-card-4'>
										<header class='w3-container w3-blue'>";?>
											<span onclick='document.getElementById("id01").style.display="none";
											window.location= "viewemployee.php?empid=<?php echo $EmpEditID;?>"' class='w3-button w3-display-topright'>&times;</span>
						<?php

						$rFirstname = $_POST['FirstName'];
						$rMiddlename = $_POST['MiddleName'];
						$rLastname = $_POST['LastName'];
						$rGender = $_POST['Gender'];
						$rPosition = $_POST['Position'];
						$rBranch = $_POST['Branch'];
						$rEmployeetype = $_POST['EmploType'];
						$rDateHired = $_POST['DateHired'];
						$rMobilenumber = $_POST['MobileNumber'];
						$rEmail = $_POST['Email'];
						$rAddress = $_POST['Address'];
						$rBirthPlace = $_POST['BirthPlace'];
						$rStatus = $_POST['Status'];
						$rBirthDate = $_POST['BirthDay'];
						$rCitizenship = $_POST['Citizenship'];
						$rReligion = $_POST['Religion'];

							

							$QueryUpdate = mysql_query("UPDATE `tbl_employee` SET `FirstName`= '$rFirstname',`MiddleName`= '$rMiddlename',`LastName`= '$rLastname',`Gender`= '$rGender',`MobileNumber`= '$rMobilenumber',`Address`= '$rAddress',`Email`= '$rEmail',`Citizenship`= '$rCitizenship',`Religion`= '$rReligion',`BirthDate`= '$rBirthDate',`BirthPlace`= '$rBirthPlace',`Status`= '$rStatus',`DateHired`= '$rDateHired',`EmployeeType`= '$rEmployeetype',`BranchID`= '$rBranch',`PositionID`= '$rPosition' WHERE `EmployeeID`= '$EmpEditID'");
							$RowAffected = mysql_affected_rows();
            			if ($RowAffected>0) {
            				 echo "<div><h2><strong><i>EmployeeID : $EmpEditID ($fname $mname $lname) has been Updated...</strong></i></h2></div>";

            			}
            			else{
            				echo "<div><h2><strong><i>Failed to Edit Employee...</i></strong></h2></div>";
            			}
            			echo "
											</header>
										</div>
									</div>";
					}
				?>
			</div>
		</div>
	</div>
	</section>
 	</section>
 	<?php }} ?>
 	<?php 
		if(isset($_GET['branch'])) {
			if ($emptype != 'Admin') {
				header("location:index.php?accessdenied");
			}
			else{
 			$BranchEditID = $_GET['branch']; ?>
 	<section class="side-right fixed right" >
	<div class="register-container" style="padding-bottom:5%">
	<div class="img-div">
		<img src="./images/NBS.png" class="img-logo-register">
	</div>
		<h1>Edit Branch Info</h1>
		<div class="register-div ">
			<hr/>
			<?php 
				$Query = mysql_query("SELECT * FROM tbl_branch WHERE BranchNumber = '$BranchEditID'");
 				$FetchingData = mysql_fetch_array($Query);
	 				$BID = $FetchingData['BranchID'];
	 				$BAddress = $FetchingData['BranchAddress'];
	 				$BContact = $FetchingData['BranchContact'];
	 				
			 ?>
			<div class="register-form">
				<form method="POST" >
					<label for="BranchName">Branch Name</label><br>
					<input type="text" name="BranchName" value="<?php echo $BID; ?>" class="register-form-input" required><br><br>

					<label for="BranchAddress">Branch Address</label><br>
					<input type="text" name="BranchAddress" value="<?php echo $BAddress; ?>" class="register-form-input" ><br><br>

					<label for="BranchContact">Branch Contact</label><br>
					<input type="text" name="BranchContact" value="<?php echo $BContact; ?>" class="register-form-input" required><br><br>

					<input type="submit" name="UpdateBranch" value="Update Branch Info..." class="submit"><br><br>
				</form>
				<?php 
					if (isset($_POST['UpdateBranch'])) {
						echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
									<div class='w3-modal-content w3-animate-top w3-card-4'>
										<header class='w3-container w3-blue'>";?>
											<span onclick='document.getElementById("id01").style.display="none"' class='w3-button w3-display-topright'>&times;</span>
						<?php

						$Neym = $_POST['BranchName'];
						$kontak = $_POST['BranchContact'];
						$lugar = $_POST['BranchAddress'];

							

							$QueryUpdate = mysql_query("UPDATE `tbl_branch` SET `BranchID`= '$Neym',`BranchAddress`= '$lugar', `BranchContact`= '$kontak' WHERE `BranchNumber` = '$BranchEditID'");
							$RowAffected = mysql_affected_rows();
            			if ($RowAffected>0) {
            				 echo "<div><h2><strong><i>Branch Updated...<br>BranchName : $Neym <br> BranchNumber: $BranchEditID</strong></i></h2></div>";
            				 header("location:viewbranches.php");

            			}
            			else{
            				echo "<div><h2><strong><i>Failed to update branch...</i></strong></h2></div>";
            			}
            			echo "
											</header>
										</div>
									</div>";
					}
				?>
			</div>
		</div>
	</div>
	</section>
 	</section>
 	<?php }} ?>
</body>
</html>