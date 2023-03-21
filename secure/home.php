<?php
session_start();

//connect to database
$db = new mysqli("localhost", "root", "", "mysite");

if ($db->connect_errno) {
    die("Failed to connect to MySQL: " . $db->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>localhost</title>
  
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: green;">Login, Registration, Logout</h1><br>
  </hgroup>

<br>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav center">
        <li><a href="login.php">LogIN</a></li>
        <li><a href="register.php">SignUp</a></li>
        <li><a href="logout.php">LogOut</a></li>
      </ul>

    </div>
  </div>
</nav>


<main class="main-content">
 <div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<h1>Home</h1>
<div>
    <h4>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h4>
</div>
<a href="logout.php">Log Out</a>
</div>
</main>
</div>

</body>
</html>
