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
						<li class="nav-item"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
						<li class="nav-item"><a href="../dashboard/viewbranches.php"><span class="nav-icon"><i class="fa fa-building"></i></span>Branches</a></li>
						<li class="nav-item"><a href="../dashboard/addbranch.php"><span class="nav-icon"><i class="fa fa-plus"></i></span>Add Branch</a></li>
			<?php } 
				else{
					?>
					<li class="nav-item"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-address-card"></i></span>View My Profile</a></li>
					<li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-address-card"></i></span>My Leaves</a></li>
                    <li class="nav-item"><a href="../dashboard/applyleave.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-envelope"></i></span>Apply a leave</a></li>
			<?php } ?>
					
					<li class="nav-item current"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
					<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
 	</section>
 	<section class="side-right fixed right">
 		<div class="div-settings"  style="padding-bottom:5%">
 			<div class="div-settings-head">
 				<h1>Settings</h1>
 			</div>
 			<hr>
 			<div class="div-paliit">
		 			<div class="div-change-settings">
		 				<form method="POST">
		 				<label for="NewUsername">New Username</label><br>
			 			<input type="text" name="NewUsername" value="<?php echo $myusername;?>"><br><br>

			 			<label for="NewPassword">New Password</label><br>
			 			<input type="password" name="NewPassword" value="<?php echo $mypassword ?>"><br><br>

			 			<label for="OldPass">Current Password</label><br>
			 			<input type="password" name="OldPass"><br><br>
			 			<input type="Submit" name="ChangeAcc" class="submit" value="Change Account Info"><br>

			 			</form>
			 			<?php 
 					if (isset($_POST['ChangeAcc'])) {
 						$NewUserN = $_POST['NewUsername'];
 						$NewPass = $_POST['NewPassword'];
 						$OldPass = $_POST['OldPass'];
 							if($OldPass == $mypassword){
 									$UpdateQuery = mysql_query("UPDATE `tbl_account` SET Username = '$NewUserN' , Password='$NewPass' WHERE EmployeeID = '$employeeid'");
 									$getupdate = mysql_affected_rows();

 									if ($getupdate>0) {
 										header("location:settings.php?UpdateUsername=Success&Username=$NewUserN");

 									}
 									else{
 										header("location:settings.php?UpdateUsername=Failed");
 									}

 							}
 							else{
 								header("location:settings.php?NotMatch=OldPassword");
 							}
 						}
 						if(isset($_GET['NotMatch'])){
 							$Update = $_GET['NotMatch'];
 							if ($Update == 'OldPassword') {
 								echo "<div class='UpdateFailed'><strong><i>Old Password does not match...</strong></i></div>";
 							}
 						}

 						if(isset($_GET['UpdateUsername'])){
 							$Update = $_GET['UpdateUsername'];
 							if ($Update == 'Success') {
 								echo "<div class='UpdateSuccess'><strong><i>Update Account Success!!!</strong></i></div>";
 							}
 							else{
 								echo "<div class='UpdateFailed'><strong><i>Update Account Failed!!!</strong></i></div>";
 							}
 						}
 					?>
		 			</div>
		 		</div>
 		</div>
 	</section>
</body>
</html>