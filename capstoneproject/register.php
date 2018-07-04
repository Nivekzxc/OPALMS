<?php 
	include("./config/header.php");	
?>
<?php 
 	if(isset($_SESSION['Username']))
 		header("Location:Dashboard");
  ?>
	<div class="register-container">
	<div class="img-div">
		<img src="./images/NBS.png" class="img-logo-register">
	</div>
		<h1>Register</h1>
		<div class="register-div ">
			<hr/>
			<div class="register-form">
				<form method="POST">
					<label for="EmployeeID">Employee ID</label><br>
					<input type="text" name="EmployeeID" placeholder="Company ID number" class="register-form-input"><br><br>

					<label for="Username">Username</label><br>
					<input type="text" name="Username" placeholder="" class="register-form-input"><br><br>

					<label for="Password">Password</label><br>
					<input type="password" name="Password" placeholder="" class="register-form-input"><br><br>

					<input type="submit" name="Register" value="Register" class="submit">

				</form>
				<?php if(isset($_POST['Register'])){
						$EmpID = $_POST['EmployeeID'];
						$Username = $_POST['Username'];
						$Password = $_POST['Password'];

						$CheckEmployee = mysql_query("SELECT EmployeeID FROM tbl_employee WHERE EmployeeID = '$EmpID'");
						
						$CheckEmp = mysql_num_rows($CheckEmployee);

						if($CheckEmp>0){

							$CheckAccount = mysql_query("SELECT * FROM tbl_account WHERE EmployeeID = '$EmpID'");
							$CheckAcc = mysql_num_rows($CheckAccount);

							if($CheckAcc>0){
								echo "<div class='w3-modal' id='id01' style='display:block ; text-align:center'>
									<div class='w3-modal-content w3-animate-top'>
										<div class='w3-container w3-yellow'>";?>
										<span onclick="document.getElementById('id01').style.display='none'" 
      									class="w3-button w3-display-topright">&times;</span>
						<?php echo "<h2><i>Employee ID has already have an account...</i></h2>
									</div>
								</div>
							</div>";
							}
							else{
								$query = mysql_query("INSERT INTO `tbl_account`(`AccountID`, `Username`, `Password`, `EmployeeID`) VALUES ('','$Username','$Password','$EmpID')");
								$affected = mysql_affected_rows();

								if ($affected>0) {
									echo "<div class='w3-modal' id='id01' style='display:block ; text-align:center'>
											<div class='w3-modal-content w3-animate-top'>
												<div class='w3-container w3-green'>";?>
												<span onclick="document.getElementById('id01').style.display='none'" 
		      									class="w3-button w3-display-topright">&times;</span>
								<?php echo "<h2><i>Your Account is Registered...</i></h2>
												</div>
											</div>
										</div>";
								}
								else{
									echo "<div class='w3-modal' id='id01' style='display:block ; text-align:center'>
											<div class='w3-modal-content w3-animate-top'>
												<div class='w3-container w3-red'>";?>
												<span onclick="document.getElementById('id01').style.display='none'" 
		      									class="w3-button w3-display-topright">&times;</span>
								<?php echo "<h2><i>Sorry your account is failed to register...</i></h2>
												</div>
											</div>
										</div>";
								}
							}
						}
						else {
							echo "<div class='w3-modal' id='id01' style='display:block ; text-align:center'>
									<div class='w3-modal-content w3-animate-top'>
										<div class='w3-container w3-orange'>";?>
										<span onclick="document.getElementById('id01').style.display='none'" 
      									class="w3-button w3-display-topright">&times;</span>
						<?php echo "<h2><i>Employee Number Does not exist...</i></h2>
									</div>
								</div>
							</div>";
						}
					}
				?>
				<button type="button" class="submit" onclick="window.location.href='index.php?PleaseLogIn'">
				Log In</button>
			</div>
		</div>
	</div>
	</form>
</body>
</html>