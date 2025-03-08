<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect("localhost", "root", "", "sdfreshcart");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $category = $_POST['productCategory'];
    $name = $_POST['productName'];
    $weight = $_POST['productWeight'];
    $price = $_POST['productPrice'];
    $ori_price = $_POST['productOriPrice'];
    $description = $_POST['productDescription'];

    $imageName = $_FILES['productImage']['name'];
    $imageTmpName = $_FILES['productImage']['tmp_name'];
    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imagePath = $uploadDir . basename($imageName);

    if ($_FILES['productImage']['error'] == UPLOAD_ERR_OK) {
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $query = "INSERT INTO products (category, name, weight, price, ori_price, description, image_path) 
                      VALUES ('$category', '$name', '$weight', '$price', '$ori_price', '$description', '$imagePath')";

            if (mysqli_query($conn, $query)) {
                $productId = mysqli_insert_id($conn);
                $productPageUrl = "productDescription.php?id=$productId";

                header("Location: AdminProducts.php?status=success&url=$productPageUrl");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Error uploading image: " . $_FILES['productImage']['error'];
    }

    mysqli_close($conn);
}
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

        .container-add {
            flex-grow: 1;
            margin-left: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            height: 100vh;
            box-sizing: border-box;
        }

        .add-form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            width: 60%;
        }

        .header2 {
            background-color: black;
            border-radius: 10px;
        }

        .header2 h2 {
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        #productCategory {
        width: 100%; 
        max-width: 300px;
        padding: 10px; 
        font-size: 16px; 
        color: #333;
        background-color: #f9f9f9; 
        border: 3px solid #ccc; 
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); 
        appearance: none; 
        transition: all 0.3s ease; 
        }

        #productCategory:hover {
        border-color: #007bff;
        background-color: #f1f1f1; 
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.5);
        }

        .form-group button:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .container-add {
                margin-left: 115px;
                padding: 10px;
            }

            .add-form-container {
                width: 85%;
                padding: 20px;
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

        <div class="container-add">
            <div class="add-form-container">
                <div class="header2"><h2>Add Products</h2></div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productCategory">Category:</label>
                        <select id="productCategory" name="productCategory" required>
                            <option value="Vegetables">Vegetables</option>
                            <option value="Snack">Snack</option>
                            <option value="Fruits">Fruits</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Beverags">Beverags</option>
                            <option value="Deals">Deals</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productWeight">Weight:</label>
                        <textarea id="productWeight" name="productWeight" rows="1" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price:</label>
                        <input type="text" id="productPrice" name="productPrice" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="productOriPrice">Original Price:</label>
                        <input type="text" id="productOriPrice" name="productOriPrice">
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Description:</label>
                        <textarea id="productDescription" name="productDescription" rows="1" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image:</label>
                        <input type="file" id="productImage" name="productImage" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
