<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Form</title>
</head>
<body>

    <h1>PHP Form</h1>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $age = $_POST["age"];
        $color = $_POST["color"];
        // Display the submitted data
        echo "<p>your Name is: $name</p>";
        echo "<p>your Age is: $age</p>";
        echo "<p>your Color is: $color</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        <br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required>
        <br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>
