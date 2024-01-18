<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Table</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            text-align:center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        input {
            width: 100%;
            padding: 8px;
        }
    </style>
</head>
<body>

    <h2>Users Table Info</h2>
   

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
        include_once 'config.php';
        $sql= "SELECT * FROM users";
        $result= mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['fullname']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>
            <a href='update.php?id=" . $row['id'] . "'>Update</a> |
            <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
          </td>";
    echo "</tr>";

        
        }
        ?>
        </tbody>
    </table>

</body>
</html>
