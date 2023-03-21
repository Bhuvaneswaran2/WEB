<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if(isset($_POST['register_btn']))
{
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $password2=mysqli_real_escape_string($db,$_POST['password2']);  

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($db, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result)
    {

        if(mysqli_num_rows($result) > 0)
        {

            echo '<script language="javascript">';
            echo 'alert("Username already exists")';
            echo '</script>';
        }

        else
        {

            if($password==$password2)
            {           //Create User
                $password=md5($password); //hash password before storing for security purposes

                // Use prepared statement to avoid SQL injection
                $stmt = mysqli_prepare($db, "INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
                mysqli_stmt_execute($stmt);

                $_SESSION['message']="You are now logged in";
                $_SESSION['username']=$username;
                header("location:home.php");  //redirect home page
            }
            else
            {
                $_SESSION['message']="The two password do not match";
            }
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
<form method="post" action="register.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
    </table>

</form>
</div>

</main>
</div>

</body>
</html>
