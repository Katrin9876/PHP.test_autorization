<?php
$success=0;
$user=0;
$nodata=0;
$pass_inconsist=0;

if($_SERVER['REQUEST_METHOD']=='POST')
{
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    try{
        
        $sql="SELECT * FROM `registration` 
            WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->fetch()!=0)
            //echo "Username already exist";
            $user=1;
        else
        {
            $sql="INSERT INTO `registration` (username, password)
                VALUES(:username, :password)";
            $stmt = $conn->prepare($sql);

            if($username == NULL or $password== NULL)
            {
                //echo "Sorry you forget to enter username or password";
                $nodata=1;
            }
            else
            {
                if($password===$cpassword)
                {
                    $stmt->bindValue(":username", $username);
                    $stmt->bindValue(":password", $password);
                    $stmt->execute();
                    
                    //echo "Signup successfully"; 
                    //$success=1; 
                    header('location:login.php');
                }
                else
                {
                    $pass_inconsist=1;
                }
            }      
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
    <title>Signup page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php
        if($user)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry, please insert another username.</strong> This username already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <?php
        if($nodata)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry, you forgot to enter username or password.</strong> Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <?php
        if($pass_inconsist)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry, inserted passwords are not the same.</strong> Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <!-- <?php
        if($success)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Great job. You are signed up
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?> -->
    <div class="container mt-5">
    <form action="signup.php" method="post">    
    <h1> Signup page </h1>
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username:</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username" >
        </div>
        <div class="mb-3" >
            <label for="exampleInputPassword1" class="form-label">Password:</label>
            <input type="password" class="form-control"  placeholder="Enter your password" name="password">
        </div>
        <div class="mb-3" >
            <label for="exampleInputPassword1" class="form-label">Confirm password:</label>
            <input type="password" class="form-control"  placeholder="Enter your password again" name="cpassword">
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
  </body>
</html>