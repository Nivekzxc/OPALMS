<?php 
	include("./config/header.php");
 ?>
 <?php 
 	if(isset($_SESSION['Username']))
 		header("Location:Dashboard");
  ?>
	<div class="div-log-in-field">
		<img src="./images/NBS.png" class="img-logo">
		<div class="">	
		</div>
		<hr/>
		<br/>
		<div class="log-in">
			<form method="POST">
				<input type="text" name="User" placeholder="Username" class="input-log-in"><br/>
				<input type="password" name="Pass" placeholder="Password" class="input-log-in"><br/>
				<input type="submit" name="LogIn" value="Log In" class="sbmit-log-in">
			</form>
				<?php
			if(isset($_POST['LogIn'])){
				$Username = $_POST['User'];
				$Password = $_POST['Pass'];

				$QueryUser = mysql_query("SELECT Username FROM tbl_account WHERE `Username` = '$Username'");
				$UserConfirm = mysql_num_rows($QueryUser);

			if($UserConfirm>0){

				$Query = mysql_query("SELECT * FROM tbl_account where `username` = '$Username' AND `password` = '$Password'");

				$checkAccount = mysql_num_rows($Query);
				echo $checkAccount;
				if($checkAccount != 0){
					session_start();
						$_SESSION['Username'] = $_POST['User'];
						$_SESSION['Password'] = $_POST['Pass'];
						header("Location:dashboard");
					}
				else{
						header("Location:?IncorrectUsername&Password");
					}
				}
				else{
					header("Location:?IncorrectUsername");
				}
			}
				?>
			<p class="p">Don't have an account? <a href="register.php">Register</a></p>
		</div>
	</div>
</body>
</html>