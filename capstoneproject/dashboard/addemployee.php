<?php 
	include("../config/header.php");	
	if(!isset($_SESSION['Username']))
 		header("Location:../?PleaseLogInToContinue");
 	if($emptype != 'HR'){
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
 	<section class="side-right fixed right" >
	<div class="register-container" style="padding-bottom:5%">
	<div class="img-div">
		<img src="./images/NBS.png" class="img-logo-register">
	</div>
		<h1>Add Employee Information</h1>
		<div class="register-div ">
			<hr/>
			<div class="register-form">
			<?php $qq = mysql_query("SELECT MAX(EmployeeID) as MaxEmpID from tbl_employee");
				$fetchs = mysql_fetch_array($qq);
					$EmpIDD = $fetchs['MaxEmpID'];
					$EmpIDDD = $EmpIDD + 1;
			?>
				<form method="POST" enctype="multipart/form-data">
					<label for="EmployeeID">Employee ID</label><br>
					<input type="text" name="EmployeeID" value="<?php echo $EmpIDDD; ?>" class="register-form-input" readonly><br><br>

					<label for="FirstName">First Name</label><br>
					<input type="text" name="FirstName" placeholder="Required" class="register-form-input" required><br><br>

					<label for="MiddleName">Middle Name</label><br>
					<input type="text" name="MiddleName" placeholder="Optional" class="register-form-input" ><br><br>

					<label for="LastName">Last Name</label><br>
					<input type="text" name="LastName" placeholder="Required" class="register-form-input" required><br><br>

					<label for="Position">Position</label><br>
					<select name="Position" class="add-employee" required>
						<?php 
							$SelectPosition = mysql_query("SELECT * FROM tbl_position");
								while($fetch= mysql_fetch_array($SelectPosition)){
									echo "<option value='$fetch[PositionID]'>$fetch[PositionName]</option>";
								}
						?>
					</select><br><br>

					<label for="Branch">Branch</label><br>
					<select name="Branch" class="add-employee" required>
						<?php 
							$SelectPosition = mysql_query("SELECT * FROM tbl_branch");
								while($fetch= mysql_fetch_array($SelectPosition)){
									echo "<option>$fetch[BranchID]</option>";
								}
						?>
					</select><br><br>

					<label for="EmploType">Employee Type</label><br>
					<select name="EmploType" class="add-employee" required>
						<option>Admin</option>
						<option>HR</option>
						<option>User</option>
					</select><br><br>

					<label for="DateHired">Date Employed</label><br>
					<input type="Date" name="DateHired" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" class="add-employee" required><br><br>

					<label for="Status">Status</label><br>
					<input type="Radio" name="Status" value="Single">Single
					<span class="nav-icon"><i class="fa fa-male"></i></span>
					<input type="Radio" name="Status" value="Married">Married
					<span class="nav-icon"><i class="fa fa-female"></i><i class="fa fa-male"></i></span><br><br>

					<label for="Gender">Gender</label><br>
					<input type="Radio" name="Gender" value="Male">Male
					<span class="nav-icon"><i class="fa fa-mars"></i></span>
					<input type="Radio" name="Gender" value="Female">Female
					<span class="nav-icon"><i class="fa fa-venus"></i></span><br><br>


					<label for="fileToUpload">Employee Picture</label><br>
					<input type="file" name="fileToUpload" class="add-employee" required><br><br>

					<label for="MobileNumber">Mobile Number</label><br>
					<input type="text" name="MobileNumber" placeholder="Required" class="register-form-input" required><br><br>

					<label for="Email">Email</label><br>
					<input type="text" name="Email" placeholder="Required" class="register-form-input" required><br><br>

					<label for="Address">Address</label><br>
					<input type="text" name="Address" placeholder="Required" class="register-form-input" required><br><br>

					<label for="BirthDay">Birth Date</label><br>
					<input type="date" name="BirthDay" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" class="add-employee" required><br><br>

					<label for="BirthPlace">Birth Place</label><br>
					<input type="text" name="BirthPlace" placeholder="Required" class="register-form-input" required><br><br>

					<label for="Religion">Religion</label><br>
					<input type="text" name="Religion" placeholder="Required" class="register-form-input" required><br><br>

					<label for="Citizenship">Citizenship</label><br>
					<input type="text" name="Citizenship" placeholder="Required" class="register-form-input" required><br><br>

					<input type="submit" name="AddEmployee" value="Add Employee" class="submit"><br><br>
				</form>
				<?php 
					if (isset($_POST['AddEmployee'])) {
						echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
									<div class='w3-modal-content w3-animate-top w3-card-4'>
										<header class='w3-container w3-blue'>";?>
											<span onclick='document.getElementById("id01").style.display="none"' class='w3-button w3-display-topright'>&times;</span>
						<?php

						 $target_dir = "../uploads/EmpProfilePic/".$_POST['EmployeeID'];
							    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
							    $uploadOk = 1;
							    $UploadedImg = basename($_FILES["fileToUpload"]["name"]);
							    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							// Check if image file is a actual image or fake image
							    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
							        if($check !== false) {
							            $uploadOk = 1;
							        } else {
							            echo "File is not an image.";
							            $uploadOk = 0;
							        }

							// Check if file already exists
							        if (file_exists($target_file)) {
							            echo "Sorry, file already exists.";
							            $uploadOk = 0;
							        }
							// Check file size
							        if ($_FILES["fileToUpload"]["size"] > 5000000) {
							            echo "Sorry, your file is too large.";
							            $uploadOk = 0;
							        }
							// Allow certain file formats
							        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
							        && $imageFileType != "gif" ) {
							            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							            $uploadOk = 0;
							        }
							        // Check if $uploadOk is set to 0 by an error
							        if ($uploadOk == 0) {
							            echo "Sorry, your file was not uploaded.";
							        // if everything is ok, try to upload file
							        } 
							        else {
							                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

							                    $iEmpID = $_POST['EmployeeID'];
												$iFirstname = $_POST['FirstName'];
												$iMiddlename = $_POST['MiddleName'];
												$iLastname = $_POST['LastName'];
												$iGender = $_POST['Gender'];
												$iPosition = $_POST['Position'];
												$iBranch = $_POST['Branch'];
												$iEmployeetype = $_POST['EmploType'];
												$iDateHired = $_POST['DateHired'];
												//$iEmployeeimg = $_POST['fileToUpload'];
												$iMobilenumber = $_POST['MobileNumber'];
												$iEmail = $_POST['Email'];
												$iAddress = $_POST['Address'];
												$iBirthPlace = $_POST['BirthPlace'];
												$iStatus = $_POST['Status'];
												$iBirthDate = $_POST['BirthDay'];
												$iCitizenship = $_POST['Citizenship'];
												$iReligion = $_POST['Religion'];

							$BrID = mysql_query("SELECT BranchNumber FROM tbl_branch WHERE BranchID ='$iBranch'");
								$fetchingbr = mysql_fetch_array($BrID);
								$brr = $fetchingbr['BranchNumber'];

							$QueryInsert = mysql_query("INSERT INTO `tbl_employee` (`EmployeeID`, `FirstName`, `MiddleName`, `LastName`, `EmployeeImg`, `Gender`, `MobileNumber`, `Address`, `Email`, `Citizenship`, `Religion`, `BirthDate`, `BirthPlace`, `Status`, `DateHired`, `EmployeeType`, `BranchID`, `PositionID`) 
								VALUES
								('$iEmpID','$iFirstname','$iMiddlename','$iLastname','$iEmpID$UploadedImg','$iGender','$iMobilenumber','$iAddress','$iEmail','$iCitizenship','$iReligion','$iBirthDate','$iBirthPlace','$iStatus','$iDateHired','$iEmployeetype','$iBranch','$iPosition')");
							$RowAffected = mysql_affected_rows();
            			if ($RowAffected>0) {
            				 echo "<div><h2><strong><i>Employee Added...</strong></i></h2></div>";

            			}
            			else{
            				echo "<div><h2><strong><i>Failed to add employee...</i></strong></h2></div>";
            			}
            			
							                } else {
							                    echo "<div><h2><strong><i>Sorry, there was an error uploading your file.</i></strong></h2></div>";
							                }
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
</body>
</html>