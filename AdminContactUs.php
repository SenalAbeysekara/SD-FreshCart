<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete_contact']) && isset($_POST['contact_id'])) {
    $contact_id = intval($_POST['contact_id']);  

    $sql = "DELETE FROM contact WHERE contact_id = $contact_id";

    if (mysqli_query($conn, $sql)) {
        header('Location: AdminContactUs.php');
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD FreshCart Dashboard</title>
    <link rel="icon" href="Logo Pics/Logo11.png">
    <link rel="stylesheet" href="AdminProduct.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        .container {
            display: flex;
            height: 100vh;
        }

        .main-content {
            margin-left: 270px; 
            padding: 20px;
            flex-grow: 1;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .del {
            background-color: #f44336;
            color: white; 
            padding: 8px 16px; 
            text-decoration: none; 
            border-radius: 5px;
        }

        .del:hover {
            background-color: #d32f2f; 
            cursor: pointer; 
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <a href="#"><img src="Logo Pics/Logo10.png" alt="SD Freshcart" width="60%"></a>
            <a href="AdminProducts.php">Products</a>
            <a href="orders.php">Orders</a>
            <a href="FAQ_Admin.php">FAQ Management</a>
            <a href="AdminContactUs.php">Reviews Manager</a>
            <a href="logout.php">Log out</a>
        </div>

        <div class="main-content">
            <h2>Contact Us - User Queries</h2>
            <?php
            if (mysqli_num_rows($result) > 0) {

                echo "<table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['subject']) . "</td>
                            <td>" . htmlspecialchars($row['message']) . "</td>
                            <td>
                                <form action='AdminContactUs.php' method='POST' style='display: inline;'>
                                    <input type='hidden' name='contact_id' value='" . $row['contact_id'] . "'>
                                    <button type='submit' class='del' name='delete_contact'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "No contact messages found.";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
