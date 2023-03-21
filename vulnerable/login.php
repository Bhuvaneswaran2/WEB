<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location:home.php");
  die();
}
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if($db)
{
  if(isset($_POST['login_btn']))
  {
      $username=$_POST['username'];
      $password=$_POST['password'];
      
      $sql="SELECT * FROM users WHERE  username='$username' AND password='$password'";
      $result=mysqli_query($db,$sql);
      
      if($result)
      {
     
        if( mysqli_num_rows($result)>=1)
        {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['username']=$username;
            $_SESSION['email']=$email;
            $_SESSION['password']=$password;
            header("location:home.php");
        }
       else
       {
              $_SESSION['message']="Username and Password combiation incorrect";
       }
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
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
<form method="POST" action="login.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" ></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" ></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" ></td>
     </tr>
 
</table>
</form>
</div>

</main>
</div>

</body>
</html>
