<?php
session_start();

$submitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
            min-height: 90vh;
        }

        .form-box {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #d63384;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 0.3rem;
        }

        input[type="submit"] {
            background-color: #d63384;
            color: white;
            border: none;
            margin-top: 1.5rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c22568;
        }

        .message {
            margin-top: 1rem;
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="page-wrapper">
        <div class="form-box">
            <h2>&#x1F4AC; Contact Us</h2>

            <?php if ($submitted): ?>
                <p class="message">&#x2705; Thanks for your message! We'll get back to you soon.</p>
            <?php else: ?>
                <form method="post">
                    <label for="name">Name</label>
                    <input type="text" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" required>

                    <label for="message">Message</label>
                    <textarea name="message" rows="4" required></textarea>

                    <input type="submit" value="&#x1F4E8; Send">
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
