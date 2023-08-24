<!DOCTYPE html>
<html>
<head>
  <title>Myclass</title>

  <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- Your CSS and other head elements here -->
  <style>
    /* Header styles */
    header {
      background-color:coral;
      padding: 10px;
	  display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      width: 50px;
      height: 50px;
	  border-radius: 50%;
    }

    .header-title {
      font-size: 24px;
      color: #ffffff;
      margin: 0;
    }

    .header-tabs {
      display: flex;
    }

    .header-tab {
      padding: 20px;
      font-size: 16px;
      color: #ffffff;
      text-decoration: none;
	  text-align: center;
    }

    .header-tab:hover {
      background-color: #2980b9;
    }

    .header-menu-icon {
      font-size: 40px;
      color:#ffffff;
      cursor: pointer;
    }

    /* Dropdown menu styles */
    .dropdown-menu {
      position: absolute;
      top: 60px;
      right: 10px;
      background-color:grey;
      border-radius: 5px;
      display: none;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: #333333;
    }

    .dropdown-menu a:hover {
      background-color: #e1e1e1;
    }
  </style>
</head>
<body>
  <header>
    <img src="./img/must.png" alt="Logo" class="logo">
    <div class="header-tabs">
<a href="login.php" class="header-tab">login</a>
      <a href="signup.php" class="header-tab">signup now</a>
    </div>
  </header>

  <!-- Your content goes here -->

  <script>
    function toggleDropdownMenu() {
      const dropdownMenu = document.getElementById("dropdownMenu");
      dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    }
  </script>
</body>
</html>









<?php 

	require "functions.php";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		$phone = addslashes($_POST['phone']);
		$password = addslashes($_POST['password']);

		$query = "select * from users where phone = '$phone' && password = '$password' limit 1";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0){

			$row = mysqli_fetch_assoc($result);

			$_SESSION['info'] = $row;
			header("Location: profile.php");
			die;
		}else{
			$error = "wrong phone or password";
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - my website</title>
	<style>
		body {
			background-color: #f0f0f0;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			margin: auto;
			max-width: 600px;
			background-color: #fff;
			padding: 20px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
			margin-top: 50px;
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
	<div class="container">
		<?php 
			if (!empty($error)) {
				echo "<div class='error'>" . $error . "</div>";
			}
		?>
		<h2>Login</h2>
		<form method="post">
			<input type="text" name="phone" placeholder="Phone number" required>
			<input type="password" name="password" placeholder="Password" required>
			<button>Login</button>
		</form>
	</div>
</body>
<?php require "footer.php";?>
</html>
