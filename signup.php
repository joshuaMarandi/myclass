<?php 
	require "functions.php";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = addslashes($_POST['username']);
		$phone = addslashes($_POST['phone']);
		$reg_no = addslashes($_POST['reg_no']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$date = date('Y-m-d H:i:s');

		$query = "insert into users (username,phone,reg_no,email,password,date) values ('$username','$phone','$reg_no','$email','$password','$date')";

		$result = mysqli_query($con,$query);

		header("Location: login.php");
		die;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<title>Signup - Myclass</title>
	<style>
		body {
			background-color: silver;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 10px 20px;
			background-color: coral;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		}

		.logo {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			object-fit: cover;
		}

		.login-btn {
			background-color: coral;
			color: #fff;
			padding: 8px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
		}

		.container {
			margin: auto;
			max-width: 600px;
			background-color: #fff;
			padding: 20px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
			margin-top: 20px;
		}

		.container h2 {
			text-align: center;
			margin-bottom: 20px;
		}

		.container form {
			margin: auto;
			padding: 10px;
		}

		.container form input[type="text"],
		.container form input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 3px;
			font-size: 16px;
		}

		.container form button {
			display: block;
			width: 100%;
			padding: 10px;
			background-color: coral;
			color: #fff;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
		}

		.container form button:hover {
			background-color: #2980b9;
		}

		.container .error {
			color: #e74c3c;
			margin-top: 10px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="header">
		<div>
			<img class="logo" src="./img/must.png" alt="Logo">
		</div>
		<div>
			<a href="login.php"><button class="login-btn">Login</button></a>
		</div>
	</div>
		<div style="margin: auto;max-width: 600px" class="container">

			<h2 style="text-align: center;">Signup</h2>

			<form method="post" style="margin: auto;padding:10px;">
			    <input type="text" name="username" placeholder="Username" required><br>
			    <input type="text" name="phone" placeholder="phone" required><br>
				<input type="text" name="reg_no" placeholder="registration number" required><br>
				<input type="password" name="password" placeholder="Password" required><br>
				<input type="text" name="email" placeholder="Email" required><br>

				<button>Signup</button>
			</form>	
		</div>
	<?php require "footer.php";?>

</body>
</html>