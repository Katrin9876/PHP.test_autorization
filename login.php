<?php
$login=0;
$invalid_data=0;

if($_SERVER['REQUEST_METHOD']=='POST')
{
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

    try{
        
        $sql="SELECT * FROM `registration` 
            WHERE username = '$username' and password='$password'";
        $result = $conn->query($sql);
        if($result->fetch()!=0)
        {
            //echo "Login successful";
            $login=1;
            session_start();
            $_SESSION['username']= $username;
            header('location:home.php');
        }
        else
        {
            //echo "Invalid data";
            $invalid_data=1;
        }      
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
        
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php
        if($login)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Great job. You are logged in
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <?php
        if($invalid_data)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry, invalid username or password.</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>

    <div class="container mt-5">
    <form action="login.php" method="post">    
    <h1> Login to our website</h1>
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username:</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username" >
        </div>
        <div class="mb-3" >
            <label for="exampleInputPassword1" class="form-label">Password:</label>
            <input type="password" class="form-control"  placeholder="Enter your password" name="password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mb-3" >
            <a href="signup.php"> If you dont have user account please sign up using this link</a>
        </div>
    </div>
  </body>
</html>