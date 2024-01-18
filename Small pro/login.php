<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameemail = $_POST["username"];
    $password = $_POST["password"];
    $remember_me = isset ($_POST['remember_me']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$usernameemail' OR email='$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    

    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["Login"] = true;
            $_SESSION["id"] = $row["id"];
            if(isset($_REQUEST['remember_me'])){
                setcookie('emailid', $_REQUEST['email'], time()+20);
                setcookie('usernameid', $_REQUEST['username'], time()+60);
                setcookie('password', $_REQUEST['password'], time()+60);
            }
            
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script> alert('Wrong Password'); </script>";
        }
    } else {
        echo "<script> alert('This user is not registered'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <center>
        <h2>Login Form</h2>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td><label for="username">User Name:</label>
                    <input type="text" name="username" placeholder="Enter your User Name" required>
                    <br></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter your Password" required>
                    <br></td>
                </tr>
                <tr>
                    <td><label for="remember me">Remember Me:</label>
                    <input type="checkbox" name="remember_me" value="1">
                    <br></td>
                </tr>
                <tr>
                    <td> 
                    <input type="Submit" value="Login">
                    <br></td>
                </tr>
            </table>
        </form>
        if you don't have an account please <a href="Registration.php">Register here.</a>
    </center>
    
</body>
</html>
