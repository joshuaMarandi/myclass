

<?php 

	require "functions.php";

	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>my website</title>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<head>
  <title>Mustika</title>
  <!-- Your CSS and other head elements here -->
  <style>
    /* Header styles */
    header {
      background-color: coral;
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
    <img src="./img/must.png" alt="Logo" class="logo">
    <div class="header-tabs">
	<a href="add_project.php" class="header-tab">New Projects</a>
      <a href="projects.php" class="header-tab">Projects</a>
    </div>
    <div class="header-menu-icon" onclick="toggleDropdownMenu()">&#9776;</div>
    <div class="dropdown-menu" id="dropdownMenu">
      <a href="profile.php">Posts</a>
      <a href="admin.php">Admin</a>
      <a href="projects.php">Projects</a>
      <a href="logout.php">Logout</a>
      <a href="contacts.php">Contacts</a>
    </div>
  </header>
</head>
<body style="background-color:bisque" >

				<div style="max-width:800px; margin: auto;">

					<h3 style="text-align: center;">Lets share our experiences</h3>
					<?php 
						
						$query = "select * from projects order by id desc limit 130";

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
							<div style="background-color:coral; display: flex;border:solid thin #aaa;border-radius: 10px;margin-bottom: 10px;margin-top: 10px;">
								<div style="flex:1;">
									<img src="<?=$user_row['image']?>" style="border-radius:50%;margin:10px;width:100px;height:100px;object-fit: cover; " >
									<br>
									<div style="flex:1;text-align: center; border-style:hidden">
									<?=$user_row['username']?>
									</div>
								</div>
								<div style="flex:8">
								<div style="text-align:center; font-size:larger; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
								<?php echo nl2br(htmlspecialchars($row['post']))?>
								</div>
				<div>
								<?php if(file_exists($row['image'])): ?>
    <div style="border-radius:auto">
        <img src="<?=$row['image']?>" style="width:100%;height:auto;object-fit: cover; ">
        <!-- Like and comment buttons -->
        <div class="post">
            <form action="#" method="post">
                <button type="submit" name="like"><i class="fas fa-heart"></i> Like</button>
            </form>
            <form action="#" method="post">
                <textarea name="comment" placeholder="Write a comment..."></textarea>
                <button type="submit" name="post_comment">Post</button>
            </form>
        </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    </div>
<?php endif; ?>
<?php
if (isset($_POST['post_comment'])) {
    $comment = $_POST['comment'];
	$user_id = $_SESSION['info']['id'];
	$post_id= $user_row['image'];
	$date = date('Y-m-d H:i:s');
    
    // Connect to your database here
    
    $insert_query = "INSERT INTO comments (comment,user_id,post_id,created_on) VALUES ('$comment','$user_id','$post_id','$date')";
    // Execute the query here
	if (isset($_POST['post_comment'])) {
		//echo "Comment form submitted.";
		// Rest of the code for inserting the comment
	}
	
}

?>
<!-- Existing HTML code -->

<style>
	/* CSS to style the like and comment buttons */
.post form {
    display: flex;
    align-items: center;
    margin-top: 10px;
}
.post-container {
        background-color: coral;
        display: flex;
        border: solid thin #aaa;
        border-radius: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
    }
.post form textarea {
    resize: none;
    width: 100%;
    max-width: 300px;
    padding: 5px;
    border: 1px solid #000;
}

.post form button {
    margin-left: 10px;
    padding: 5px 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
}

.post form button:hover {
    background-color: #2980b9;
}

</style>
</div>
								
									<div style="text-align:center;">
										<div style="color:black; "><?=date("Y-m-d H:i:s",strtotime($row['date']))?></div>
						
									</div>
								</div>
								
							</div>
						<?php endwhile;?>
					<?php endif;?>
				</div>

	<?php require "footer.php";?>
</body>
</html>