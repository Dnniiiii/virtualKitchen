<?php
session_start();
require_once 'includes/db.php';

$rid = intval($_GET['rid'] ?? 0);

$stmt = $pdo->prepare("SELECT recipes.*, users.username FROM recipes JOIN users ON recipes.uid = users.uid WHERE rid = ?");
$stmt->execute([$rid]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipe Details – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 2rem;
        }

        .recipe-details {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #d63384;
        }

        p {
            margin-bottom: 1rem;
        }

        img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .back-link {
            margin-top: 2rem;
            text-align: center;
        }

        .back-link a {
            background: #f783ac;
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            text-decoration: none;
        }

        .back-link a:hover {
            background: #c22568;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="recipe-details">
        <h2>&#x1F372; <?= htmlspecialchars($recipe['name']) ?></h2>

        <p><strong>&#x1F464; By:</strong> <?= htmlspecialchars($recipe['username']) ?></p>
        <p><strong>&#x1F372; Type:</strong> <?= htmlspecialchars($recipe['type']) ?></p>
        <p><strong>&#x23F1; Cooking Time:</strong> <?= (int)$recipe['Cookingtime'] ?> mins</p>
        <p><strong>&#x1F371; Ingredients:</strong><br><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
        <p><strong>&#x1F9C0; Instructions:</strong><br><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>

        <?php if ($recipe['image']): ?>
            <img src="images/<?= htmlspecialchars($recipe['image']) ?>" alt="Recipe Image">
        <?php endif; ?>

        <div class="back-link">
            <a href="view_recipes.php">&#x2B05;&#xFE0F; Back to Recipes</a>
        </div>
    </div>
</body>
</html>
