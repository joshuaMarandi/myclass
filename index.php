

<?php 

	require "functions.php";

	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Myclass</title>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body style="background-color:white" >
	<?php require_once "header.php";?>

				<div style="max-width:800px; margin: auto;">

					<h3 style="text-align: center;">Lets cheer up our carrier</h3>
					<?php 
						
						$query = "select * from posts order by id desc limit 130";

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
							<div style="background-color:gray; display: flex;border:solid thin #aaa;border-radius: 10px;margin-bottom: 10px;margin-top: 10px;">
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