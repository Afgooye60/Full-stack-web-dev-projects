<?php
include_once 'config.php';

if (isset($_POST["add"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];

    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert ('Username or email has already been taken'); </script>";
    } else {
        if ($password == $confirmpass) {
            // Use VALUES instead of values and specify column names
            $query = "INSERT INTO users (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$password')";
            $resul= mysqli_query($conn, $query);
            if($resul){
                header("location:users info.php");
            }
         
            echo "<script> alert ('Added Successful'); </script>";
            header("index.php");
            exit();
        } else {
            echo "<script> alert ('Password does not match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User Form</title>
</head>
<body>
    <center>
        <h2>ADD USER</h>
        <form action="add.php?id=" . $row['id'] " method="post">
            <table>
                <tr>
                    <td><label for="fullname">Full Name:</label>
                        <input type="text" name="fullname" placeholder="Enter your Full Name" required>
                        <br></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Enter your Username" required>
                        <br></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label>
                        <input type="email" name="email" placeholder="Enter your Email" required>
                        <br></td>
                </tr>
                <tr>
                    <td> <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Enter your Password" required>
                        <br></td>
                </tr>
                <tr>
                    <td> <label for="confirmpass">Confirm Password:</label>
                        <input type="password" name="confirmpass" placeholder="Confirm your Password" required>
                        <br></td>
                </tr>
                <tr>
                    <td><input type="submit" name="add" value="Add User"></td>
                </tr>
            </table>
        </form>
       
    </center>
</body>
</html>
