<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'sdfreshcart');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$faqQuery = "SELECT * FROM faq";
$faqResult = mysqli_query($conn, $faqQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        .faq-section {
            position: relative;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            top: 30px;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow:0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
        }

        .faq-section h2 {
            font-size: 25px;
            font-weight: bold;
            text-decoration: underline;
            text-align: center;
            color: black;
        }

        .faq-item {
            margin: 20px 0;
            border-bottom: 1px solid gray;
            padding-bottom: 10px;
        }

        .question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .question h3 {
            font-size: 18px;
            color: black;
        }

        .toggle {
            font-size: 20px;
            color: #00a000;
        }

        .answer {
            display: none;
            padding: 10px 0;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

<div class="faq-section">
    <h2>Online order & delivery related</h2>

    <?php
    if (mysqli_num_rows($faqResult) > 0) {
        while ($row = mysqli_fetch_assoc($faqResult)) {
            echo '<div class="faq-item">';
            echo '<div class="question">';
            echo '<h3>' . htmlspecialchars($row['question']) . '</h3>';
            echo '<span class="toggle">+</span>';
            echo '</div>';
            echo '<div class="answer">';
            echo '<p>' . htmlspecialchars($row['answer']) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No FAQs available.</p>";
    }
    ?>
</div>

<script>
    document.querySelectorAll('.faq-item').forEach(item => {
        item.querySelector('.question').addEventListener('click', () => {
            const answer = item.querySelector('.answer');
            const toggle = item.querySelector('.toggle');

            if (answer.style.display === 'block') {
                answer.style.display = 'none';
                toggle.textContent = '+';
            } else {
                answer.style.display = 'block';
                toggle.textContent = '-';
            }
        });
    });
</script>

<?php include 'Footer.php'; ?>

</body>
</html>

<?php

mysqli_close($conn);
?>
