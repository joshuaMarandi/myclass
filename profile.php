<!DOCTYPE html>
<html>
<head>
  <title>Myclass</title>
  <!-- Your CSS and other head elements here -->
  <style>
    /* Header styles */
    header {
      background-color: black;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      width: 50px;
      height: 50px;
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
      padding: 10px 20px;
      font-size: 16px;
      color: #ffffff;
      text-decoration: none;
    }

    .header-tab:hover {
      background-color: bisque;
    }

    .header-menu-icon {
      font-size: 40px;
      color: #ffffff;
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
    <img src="./img/myclass.png" alt="Logo" class="logo" style="border-radius:50%">
    <div class="header-tabs">
      <a href="index.php" class="header-tab">Posts</a>
    </div>
    <div class="header-menu-icon" onclick="toggleDropdownMenu()">&#9776;</div>
    <div class="dropdown-menu" id="dropdownMenu">
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
      <a href="contacts.php">Contacts</a>
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

	check_login();

	if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'post_delete')
	{
		//delete your post
		$id = $_GET['id'] ?? 0;
		$user_id = $_SESSION['info']['id'];

		$query = "select * from posts where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0){

			$row = mysqli_fetch_assoc($result);
			if(file_exists($row['image'])){
				unlink($row['image']);
			}

		}

		$query = "delete from posts where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);

		header("Location: profile.php");
		die;

	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == "post_edit")
	{
		//post edit
		$id = $_GET['id'] ?? 0;
		$user_id = $_SESSION['info']['id'];

		$image_added = true;
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);

				$query = "select * from posts where id = '$id' && user_id = '$user_id' limit 1";
				$result = mysqli_query($con,$query);
				if(mysqli_num_rows($result) > 0){

					$row = mysqli_fetch_assoc($result);
					if(file_exists($row['image'])){
						unlink($row['image']);
					}

				}

			$image_added = true;
		}

		$post = addslashes($_POST['post']);

		if($image_added == true){
			$query = "update posts set post = '$post',image = '$image' where id = '$id' && user_id = '$user_id' limit 1";
		}else{
			$query = "update posts set post = '$post' where id = '$id' && user_id = '$user_id' limit 1";
		}

		$result = mysqli_query($con,$query);
 
		header("Location: profile.php");
		die;
	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete')
	{
		//delete your profile
		$id = $_SESSION['info']['id'];
		$query = "delete from users where id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if(file_exists($_SESSION['info']['image'])){
			unlink($_SESSION['info']['image']);
		}

		$query = "delete from posts where user_id = '$id'";
		$result = mysqli_query($con,$query);

		header("Location: logout.php");
		die;

	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username']))
	{
		//profile edit
		$image_added = false;
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);

			if(file_exists($_SESSION['info']['image'])){
				unlink($_SESSION['info']['image']);
			}

			$image_added = true;
		}

		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$id = $_SESSION['info']['id'];

		if($image_added == true){
			$query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where id = '$id' limit 1";
		}else{
			$query = "update users set username = '$username',email = '$email',password = '$password' where id = '$id' limit 1";
		}

		$result = mysqli_query($con,$query);

		$query = "select * from users where id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0){

			$_SESSION['info'] = mysqli_fetch_assoc($result);
		}

		header("Location: profile.php");
		die;
	}
	elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['post']))
	{
		//adding post
		$image = "";
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);
 
		}

		$post = addslashes($_POST['post']);
		$user_id = $_SESSION['info']['id'];
		$date = date('Y-m-d H:i:s');

		$query = "insert into posts (user_id,post,image,date) values ('$user_id','$post','$image','$date')";

		$result = mysqli_query($con,$query);
 
		header("Location: profile.php");
		die;
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile - Myclass</title>
</head>
<body style="background-color:white">
		<div style="margin: auto;max-width: 600px; object-fit: cover;" >

			<?php if(!empty($_GET['action']) && $_GET['action'] == 'post_delete' && !empty($_GET['id'])):?>
				
				<?php 
					$id = (int)$_GET['id'];
					$query = "select * from posts where id = '$id' limit 1";
					$result = mysqli_query($con,$query);
				?>

				<?php if(mysqli_num_rows($result) > 0):?>
					<?php $row = mysqli_fetch_assoc($result);?>
					
					<h3>Are you sure you want to delete this post?!</h3>
					<form method="post" enctype="multipart/form-data" style="margin: auto; padding:10px;">
						
						<img src="<?=$row['image']?>" style="width:100%;height:auto;object-fit: cover;"><br>
						<div><?=$row['post']?></div><br>
						<input type="hidden" name="action" value="post_delete">

						<button>Delete</button>
						<a href="profile.php">
							<button type="button">Cancel</button>
						</a>
					</form>
				<?php endif;?>
			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'post_edit' && !empty($_GET['id'])):?>

				<?php 
					$id = (int)$_GET['id'];
					$query = "select * from posts where id = '$id' limit 1";
					$result = mysqli_query($con,$query);
				?>

				<?php if(mysqli_num_rows($result) > 0):?>
					<?php $row = mysqli_fetch_assoc($result);?>
					<h5>Edit a post</h5>
					<form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
						
						<img src="<?=$row['image']?>" style="width:100%;height:200px;object-fit: cover;"><br>
						image: <input type="file" name="image"><br>
						<textarea name="post" rows="8"><?=$row['post']?></textarea><br>
						<input type="hidden" name="action" value="post_edit">
						<a href="profile.php">
                            <button>Save</button>
							<button type="button">Cancel</button>
						</a>
					</form>
				<?php endif;?>

			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'edit'):?>

				<h2 style="text-align: center;">Edit profile</h2>

<form method="post" enctype="multipart/form-data" style="margin: auto; padding: 10px;">
  <img src="<?php echo $_SESSION['info']['image'] ?>" style="width: 100px; height: 100px; object-fit: cover; margin: auto; display: block;">
  <label style="margin-top: 10px;
      display: inline-block;
      background-color:blue;
      color: #fff;
      padding: 8px 20px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
">
    <input type="file" name="image" style="display: none;">
    <span style="padding: 10px; border: 0px solid #ccc; cursor: pointer;" onclick="document.querySelector('input[name=image]').click();">Add Image</span>
  </label><br>
  <div>
  <input value="<?php echo $_SESSION['info']['username'] ?>" type="text" name="username" placeholder="Username" required style="margin-top: 10px;"><br>
  <input value="<?php echo $_SESSION['info']['email'] ?>" type="email" name="email" placeholder="Email" required style="margin-top: 10px;"><br>
  <input value="<?php echo $_SESSION['info']['password'] ?>" type="text" name="password" placeholder="Password" required style="margin-top: 10px;"><br>
  </div>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color:bisque;
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background-color:gray;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }

  img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin: auto;
    display: block;
    border-radius: 50%;
    margin-bottom: 10px;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 1%;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049;
  }

  a {
    text-decoration: none;
  }

  button[type="button"] {
    background-color: #f44336;
    margin-left: 10px;
  }

  button[type="button"]:hover {
    background-color: #e53935;
  }
</style>
  
  <a href="profile.php">
  <button >Save</button>
    <button type="button">Cancel</button>
  </a>
</form>


			<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'):?>

				<h2 style="text-align: center;">Are you sure you want to delete your profile??</h2>

				<div style="margin: auto;max-width: 600px;text-align: center;">
					<form method="post" style="margin: auto;padding:10px;">
						
						<img src="<?php echo $_SESSION['info']['image']?>" style="width: 100%;height: auto;object-fit: cover;margin: auto;display: block;">
						<div><?php echo $_SESSION['info']['username']?></div>
						<div><?php echo $_SESSION['info']['email']?></div>
						<input type="hidden" name="action" value="delete">
						<button class="custom-file-input">Delete</button>
						<div>
						<a href="profile.php">
							<button type="button"style="{
      display: inline-block;
      background-color:green;
      color: #fff;
      padding: 8px 20px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
    }">Cancel</button>
						</a>
						</div>
					</form>
				</div>

			<?php else:?>

				<h2 style="text-align: center;">User Profile</h2>
				<br>
				<div style="margin: auto;max-width: 600px;text-align: center; ">
					<div>
						<td><img src="<?php echo $_SESSION['info']['image']?>" style="width: 150px; border-radius:50%; height: 150px;object-fit: cover;"></td>
					</div>
					<div>
						<td><?php echo $_SESSION['info']['username']?></td>
					</div>
					
					<div>
						<td><?php echo $_SESSION['info']['email']?></td>
					</div>

					<a href="profile.php?action=edit">
						<button  class="custom-file-input">Edit profile</button>
					</a>

					<a href="profile.php?action=delete">
						<button  class="custom-file-input">Delete profile</button>
					</a>

				</div>
				<br>
				<div style="text-align:center">
				<hr>
				<h5 style="font-size:larger">new post</h5>
				<form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
  <style>
    /* Your existing CSS styles here */
    /* Hide the default file input appearance */
    input[type="file"] {
      display: none;
    }

    /* Style the custom file input button */
    .custom-file-input {
      display: inline-block;
      background-color:darkcyan;
      color: #fff;
      padding: 8px 20px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
    }
	textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
	  background-color: silver;
	}
  </style>
</head>
<body>
  <div class="wrapper">
    <label for="imageInput" class="custom-file-input">Add post</label>
    <input type="file" id="imageInput" name="image" onchange="handleImageSelection()" accept="image/*">
    <textarea name="post" rows="1" columns="14" placeholder="Description here"></textarea><br>
  </div>

  <script>
    function handleImageSelection() {
      var fileInput = document.getElementById('imageInput');
      var file = fileInput.files[0];
      // Handle the selected file here, if needed
      // ...
    }
  </script>
</body>
</html>


					<button>Post</button>
				</form>

				<hr>
				</div>
				
				<posts>
					<?php 
						$id = $_SESSION['info']['id'];
						$query = "select * from posts where user_id = '$id' order by id desc limit 10";

						$result = mysqli_query($con,$query);
					?>

					<?php if(mysqli_num_rows($result) > 0):?>

						<?php while ($row = mysqli_fetch_assoc($result)):?>

							<?php 
								$user_id = $row['user_id'];
								$query = "select username,image from users where id = '$user_id' limit 1";
								$result2 = mysqli_query($con,$query);

								$user_row = mysqli_fetch_assoc($result2);
							?>
							<div style="background-color:gray; display: flex; border-style: double; border-radius: 10px;margin-bottom: 10px;margin-top: 10px; width:100%; height:auto">
								<div style="flex:1;text-align: center; border-style:double">
									<img src="<?=$user_row['image']?>" style="border-radius:50%;margin:10px;width:100px;height:auto;object-fit: cover;">
									<br>
									<?=$user_row['username']?>
								</div>
								<div style="flex:8">
									<?php if(file_exists($row['image'])):?>
										<div style="">
											<img src="<?=$row['image']?>" style="width:100%;height:auto;object-fit: cover;">
										</div>
									<?php endif;?>
									<div>
										<div style="color:white"><?=date("Y-m-d H:i:s",strtotime($row['date']))?></div>
										<?php echo nl2br(htmlspecialchars($row['post']))?>
										<br><br>

										<a href="profile.php?action=post_edit&id=<?= $row['id']?>">
											<button>Edit</button>
										</a>

										<a href="profile.php?action=post_delete&id=<?= $row['id']?>">
											<button>Delete</button>
										</a>
										<br><br>
									</div>
								</div>
								
							</div>
						<?php endwhile;?>
					<?php endif;?>
				</posts>
			<?php endif;?>

									</div>
									<?php require "footer.php";?>

</body>
</html>