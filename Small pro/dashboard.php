<?php
include_once 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFGOOYE TECHNOLOGY CENTER</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('bac3.avif');
        }
        header {
            background-color: red;
            color: #fff;
            padding: 10px;
            text-align: center;
            
        }
        nav {
            background-color: white;
            color: #fff;
            padding: 25px;
            text-align: center;
        }
        .content {
            margin: 20px;
        }
        .logout-btn {
            background-color: #f00;
            color: #fff;
            padding: 5px;
            text-decoration: none;
            border: 5px;
            cursor: pointer;
            border-radius: 5px;
            
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
       
        }
    </style>
</head>
<body>

    <header>
        <h1>AFGOOYE TECHNOLOGY CENTER</h1>
          <h4>AFGOOYE-LOWERSHABELLE-SOMALIA</h>
    </header>

    <nav>
        <a href="#">Home</a> |
        <a href="add.php">Add New User</a> |
        <a href="users info.php">Users Info</a> |
        <a href="#">Contacts</a> |
        <a href="about us.php">About Us</a> |
        <a href="logout.php" class="logout-btn">Logout</a>
        
    </nav>

    <div class="content">
        <div class="dashboard-container">
           Welcome to our first web page.
           I am Engineer Yusuf Mohamed 
        </div>
    </div>

</body>
</html>
