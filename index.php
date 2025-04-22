<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            margin: 0;
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Adjust if your navbar has different height */
            padding: 2rem;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        h1 {
            color: #d63384;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .welcome-text {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .button-group a {
            display: inline-block;
            background: #f783ac;
            color: white;
            text-decoration: none;
            padding: 0.6em 1.2em;
            margin: 0.5em;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .button-group a:hover {
            background: #e64980;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <h1>&#x1F353; Welcome to the Virtual Kitchen</h1>

            <?php if (isset($_SESSION['username'])): ?>
                <p class="welcome-text">Hello, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</p>
                <div class="button-group">
                    <a href="dashboard.php">&#x1F4BB; Go to Dashboard</a>
                    <a href="logout.php">&#x1F6AA; Logout</a>
                </div>
            <?php else: ?>
                <p class="welcome-text">Discover and share recipes made with love &#x1F497;</p>
                <div class="button-group">
                    <a href="login.php">&#x1F511; Login</a>
                    <a href="register.php">&#x1F465; Register</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
