<?php
// Include PHPMailer classes and autoload file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'exception.php';
require 'phpmailer.php';
require 'SMTP.php';

// Function to send welcome email
function sendWelcomeEmail($email, $fullname) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    try {
        // Server settings
        $mail->isSMTP(true);
        $mail->Host       = 'smtp.gmail.com';  // Specify your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yusufafgooye99@gmail.com'; // SMTP username
        $mail->Password   = 'yigs bgbz rpzu aljd';             // SMTP password
        $mail->SMTPSecure = 'TLS';
        $mail->Port       = 587;                        // Port for TLS encryption

        // Recipients
        $mail->setFrom('bossyuu709@gmail.com', 'Diinaari Travel and Logistics');
        $mail->addAddress($email, $fullname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'SOO DHAWOW MACAAMIIL!';
        $mail->Body    = "Dear <strong>$fullname,</strong>

        Welcome to [Diinaari Travel and Logistics]! We're thrilled to have you join our community. 
        
        Thank you for registering with us. You now have access to all our features and content.
        
        If you have any questions or need assistance, feel free to reach out to our support team at [Your Support Email].
        
        Best regards,
        The [Sayid] Team
        ";

        // Send the email
        $mail->send();
        echo "<script> alert('Welcome email sent successfully!'); </script>";
    } catch (Exception $e) {
        echo "<script> alert('Failed to send welcome email.'); </script>";
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}

// Process registration form submission
if (isset($_POST["Register"])) {
    // Include your database connection file
    include_once 'config.php';

    // Get user input from registration form
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"]; // Correct variable name
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];
    $profile_picture = $_FILES['profile_picture']['name'];

    // Validate and handle file upload
    $target_dir = "images/";  
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        echo "<script> alert ('File is not an image.'); </script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        echo "<script> alert ('Sorry, your file is too large.'); </script>";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script> alert ('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); </script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script> alert ('Sorry, your file was not uploaded.'); </script>";
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "<script> alert ('The file ".htmlspecialchars(basename($_FILES["profile_picture"]["name"]))." has been uploaded.'); </script>";
        } else {
            echo "<script> alert ('Sorry, there was an error uploading your file.'); </script>";
        }
    }

    // Check for duplicate username or email
    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert ('Username or email has already been taken'); </script>";
    } else {
        // Insert user data into database
        if ($password == $confirmpass) {
            $query = "INSERT INTO users (fullname, username, email, password, profile_picture) VALUES ('$fullname', '$username', '$email', '$password','$target_file')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Send welcome email after successful registration
                sendWelcomeEmail($email, $fullname);
                
                echo "<script> alert ('Registration Successful'); window.location.href = 'login.php'; </script>";
                exit();
            } else {
                echo "<script> alert ('Error in registration'); </script>";
            }
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
    <title>Registration Form</title>
</head>
<body>
    <center>
        <h2>Registration Form</h2>
        <form action="registration.php" method="post" enctype="multipart/form-data">
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
                    <td><label for="profile_picture">Profile Picture:</label>
                        <input type="file" name="profile_picture" accept="image/*" required>
                        <br></td>
                </tr>
                <tr>
                    <td><input type="submit" name="Register" value="Register"></td>
                </tr>
            </table>
        </form>
        If you have an account, please <a href="login.php">login here</a>.
    </center>
</body>
</html>
