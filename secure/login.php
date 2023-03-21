<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location:home.php");
  die();
}
//connect to database
$db=new PDO('mysql:host=localhost;dbname=mysite;charset=utf8', 'root', '');
if($db)
{
  if(isset($_POST['login_btn']))
  {
      $username=$_POST['username'];
      $password=$_POST['password'];
      $hashed_password=md5($password); //Remember we hashed password before storing last time
      $stmt=$db->prepare("SELECT * FROM users WHERE  username=:username AND password=:password");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $hashed_password);
      $stmt->execute();
      $result=$stmt->fetch(PDO::FETCH_ASSOC);
      
      if($result)
      {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['username']=$username;
        header("location:home.php");
      }
      else
      {
        $_SESSION['message']="Username and Password combination incorrect";
      }
  }
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
<form method="post" action="login.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
     </tr>
 
</table>
</form>
</div>

</main>
</div>

</body>
</html>
