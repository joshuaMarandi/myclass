<?php
include  'connection.php';
if (isset($_POST['submit']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $message=$_POST['message'] ;
 $sql="insert into feedback (username,email,phone,message)
  values ('$name','$email','$phone','$message')";
 $result=mysqli_query($con,$sql);
if($result)
{
    echo "Data inserted succesful";
}
else{
    die (mysqli_error($con));
}
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>myclass</title>
    <link rel="stylesheet" href="style.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
           Contact me and share anything you want
          </p>

          <div class="info">
            <div class="information">
             
              <p>Joh5002, MUST</p>
            </div>
            <div class="information">
              
              <p>Tarime,Mara</p>
            </div>
            <div class="information">
              
              <p>0748415599</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with me :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div><br>
            <div class="credit">Made with <span style="color:tomato">❤</span> by <a href="Johmarandi5002.com">Joshua Marandi</a></div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form method="post" autocomplete="off">
            <h3 class="title">Contact me</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" />
              <label for="">Username</label>
              <span>Username</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <button type="submit" class="btn" name="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
