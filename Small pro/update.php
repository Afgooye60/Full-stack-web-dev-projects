<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id']; // Add this line to retrieve the ID from the URL
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "UPDATE users SET fullname='$fullname', username='$username', email='$email', password='$password' WHERE id=$id";
    mysqli_query($conn, $query);

    // Move the header function above the echo statement
    header("Location: users info.php");
    echo "<script> alert('User updated successfully'); </script>";
    exit();
} else {
    // If the form is not submitted, fetch user data from the database based on the provided ID
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
</head>
<body>
    <center>
        <h2>User Update Form</h2>
        <form action="update.php?id=<?php echo $id; ?>" method="post">

            <table>
                <tr>
                    <td><label for="fullname">Full Name:</label>
                        <input type="text" name="fullname" placeholder="Edite your Full Name" required autocomplete="on" value="<?php echo $row['fullname']; ?>">
                        <br></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Edite your Username" required autocomplete="on" value="<?php echo $row['username']; ?>">
                        <br></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label>
                        <input type="email" name="email" placeholder="Edite your Email" required autocomplete="on" value="<?php echo $row['email']; ?>">
                        <br></td>
                </tr>
                <tr>
                    <td> <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="dite your Password" required autocomplete="on" value="<?php echo $row['password']; ?>">
                        <br></td>
                </tr>
            
                <tr>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
        
    </center>
</body>
</html>
