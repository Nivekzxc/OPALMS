<?php 
	include("../config/header.php");	
	if(!isset($_SESSION['Username']))
 		header("Location:../?PleaseLogInToContinue");
 	if ($emptype != 'Admin') {
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
		<h1>Add Branch</h1>
		<div class="register-div ">
			<hr/>
			<div class="register-form">
				<form method="POST" >
					<label for="BranchName">Branch Name</label><br>
					<input type="text" name="BranchName" placeholder="Required" class="register-form-input" required><br><br>

					<label for="BranchAddress">Branch Address</label><br>
					<input type="text" name="BranchAddress" placeholder="Required" class="register-form-input" required><br><br>

					<label for="BranchContact">Branch Contact Number</label><br>
					<input type="text" name="BranchContact" placeholder="Required" class="register-form-input" required><br><br>

					<input type="submit" name="AddBranch" value="Add Branch" class="submit"><br><br>
				</form>
				<?php 
					if (isset($_POST['AddBranch'])) {
						echo "<div id='id01' class='w3-modal' style='display:block ;text-align:center'>
									<div class='w3-modal-content w3-animate-top w3-card-4'>
										<header class='w3-container w3-blue'>";?>
											<span onclick='document.getElementById("id01").style.display="none"' class='w3-button w3-display-topright'>&times;</span>
						<?php

						$Neym = $_POST['BranchName'];
						$kontak = $_POST['BranchContact'];
						$lugar = $_POST['BranchAddress'];

							

							$QueryInsert = mysql_query("INSERT INTO `tbl_branch`(`BranchID`, `BranchAddress`, `BranchNumber`, `BranchContact`) VALUES ('$Neym','$lugar','','$kontak')");
							$RowAffected = mysql_affected_rows();
            			if ($RowAffected>0) {
            				 echo "<div><h2><strong><i>Branch Added...</strong></i></h2></div>";

            			}
            			else{
            				echo "<div><h2><strong><i>Failed to add branch...</i></strong></h2></div>";
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