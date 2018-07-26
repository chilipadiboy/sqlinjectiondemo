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
					<form action="?" method="GET"> 
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
								if (isset($_GET['login'])) {   #Using get causes input to be displayed in addressbar as plaintext
									$user = $_GET['user']; 		# not escaping characters lets users input malicious scripts/code
									$password = $_GET['password'];
									$error_message = "";
									if (empty($user)) {
										$error_message .= "Please enter your username<br>";
									}if (empty($password)) {
										$error_message .= "Please enter your password<br>";
									}
									if (empty($error_message)) {
										$sql_select_user = "SELECT * FROM userlist WHERE username='$user' AND ( password='$password' )";
										// Check for sql error
										if ($conn->multi_query($sql_select_user)) { 
											do{
												if ($results = $conn -> store_result()){
													$res2= $results->fetch_all(MYSQLI_ASSOC);
													$results->free();
												}
											}while ($conn -> more_results() && $conn->next_result());
											// Check if user is found
											// print_r($res2);
											// echo '<br></br>';
											if ($res2!=null) {
														// Login successful, initializ	e session information
														if ($res2[0]['Priviledge']==1){
															echo "Logged in successfully as an <b>ADMINISTRATOR</b>";
														}else if ($res2[0]['Priviledge']==0){
															echo "Logged in successfully as a <b>USER</b>";
														}else{
															echo "Your account is configured incorrectly";
														}
													
												$retry = false;
											} else {
												echo "Invalid username or password";
												$retry = true;
											}
										} else {
											$retry = true;
										}
									} else {
										echo $error_message;
										$retry = true;
									}
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