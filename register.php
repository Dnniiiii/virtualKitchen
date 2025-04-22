<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 2rem;
        }

        .form-box {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #d63384;
            margin-bottom: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #d63384;
            color: white;
            padding: 0.8rem;
            border: none;
            width: 100%;
            border-radius: 8px;
            margin-top: 1rem;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c22568;
        }

        a {
            display: block;
            margin-top: 1rem;
            color: #f783ac;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="form-box">
        <h2>&#x1F353; Create Your Account</h2>
        <form action="register_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="&#x1F465; Register">
        </form>
        <a href="login.php">&#x1F511; Already have an account? Log in</a>
    </div>
</body>
</html>
