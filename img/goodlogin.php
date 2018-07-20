<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<meta charset="UTF-8">
		<title>Super Legitimate Login Page</title>
	</head>
	<body>
		<div>
			<div class="login-box-inner">
				<div>
					<img src="img/db-logo.svg" alt="Schenker Logo">
				</div>
				<div class="lab" >
					<label>Sign in</label>
				</div>
					<form action="?" method="POST">
					<div>
						<div class="box">
							<input type="text" name="user" placeholder="Username"></input>
						</div>
						<div class="box">
							<input type="text" name="password" placeholder="Password"></input>
						</div>
					</div>
					<div>
						<p>
							<?php
								require 'connect.php';
								if(isset($_POST['login'])) {
									$user = $conn->real_escape_string($_POST['user']);
									$pass = $conn->real_escape_string($_POST['password']);
									$error_message = "";
									if(empty($user)) {
										$error_message .= "Please enter your username<br>";
									}
									if(empty($pass)) {
										$error_message .= "Please enter your password<br>";
									}
									if(empty($error_message)) {
										#$sql_select_user = "SELECT * FROM userlist WHERE username='$user' AND password='$password'";
										$stmt->bind_param("ss",$user,$pass);
										$stmt->execute(); 
										$res =  mysqli_stmt_get_result($stmt);
										$row = mysqli_fetch_array($res);
										#$res = $conn->query($sql_select_user);
										if($res) {
											echo '<br></br>';
											if (!empty($row)) {
												// Login successful, initialize session information
												if ($row['Type']==1){
													echo "Logged in as an <b>ADMINISTRATOR</b>";
												} else if($row['Type']==0){
													echo "Logged in as a <b>USER</b>";
												} else {
													echo "No such user";
												}
												session_start();
												$retry = false;
											} else {
												echo "Invalid username and password combination.";
												$retry = true;
											}
										} else {
											$retry = true;
										}
									} else {
										echo $error_message;
										$retry = true;
									}
									$stmt->close();
								}
							?>
						</p>
					</div>
					<div>
						<button type="submit" name="login">Sign in</button>
					</div>
			</div>
		</div>
		
	</body>
</html>