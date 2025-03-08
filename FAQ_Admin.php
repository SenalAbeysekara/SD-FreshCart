<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'sdfreshcart');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_faq'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $sql = "INSERT INTO faq (question, answer) VALUES ('$question', '$answer')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('FAQ added successfully');</script>";
        header("Location: FAQ_Admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM faq WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('FAQ deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$faqData = mysqli_query($conn, "SELECT * FROM faq");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD FreshCart Dashboard</title>
    <link rel="icon" href="Logo Pics/Logo11.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 63%;
            background-color: #013220;
            padding: 20px;
            height: 100vh;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            min-width: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            margin-bottom: 15px;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #00a000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #007700;
        }

        .delete-button {
            color: #fff;
            background-color: #e63946;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
        }

        .delete-button:hover {
            background-color: #a62836;
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

        <div class="content">
            <h1>FAQ Management</h1>

            <div class="form-container">
                <h3>Add New FAQ</h3>
                <form method="POST" action="FAQ_Admin.php">
                    <label for="question">Question:</label>
                    <input type="text" id="question" name="question" required>

                    <label for="answer">Answer:</label>
                    <textarea id="answer" name="answer" rows="4" required></textarea>

                    <button type="submit" name="add_faq">Add FAQ</button>
                </form>
            </div>

            <h3>Manage FAQs</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($faqData)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['question']; ?></td>
                            <td><?php echo $row['answer']; ?></td>
                            <td>
                                <a href="?delete=<?php echo $row['id']; ?>" class="delete-button">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
