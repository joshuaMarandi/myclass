<!DOCTYPE html>
<html>
<head>
<title>Myclass</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
 

  <!-- Your CSS and other head elements here -->
  <style>
    /* Header styles */
    header {
      background-color:black;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position:auto;
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
      padding: 10px 20px;
      font-size: 16px;
      color: #ffffff;
      text-decoration: none;
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
    <img src="./img/myclass.png" alt="Logo" class="logo">

    <div class="header-tabs">
    <h1 style="color:white">MyClass</h1>
<a href="profile.php" class="header-tab">New post</a>
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

