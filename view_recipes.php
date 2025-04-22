<?php
session_start();
require_once 'includes/db.php';

// Fetch all recipes
$stmt = $pdo->query("SELECT recipes.*, users.username FROM recipes 
                     JOIN users ON recipes.uid = users.uid 
                     ORDER BY rid DESC");
$recipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Recipes – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #d63384;
            margin-bottom: 2rem;
        }

        .recipe-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin: 1rem auto;
            max-width: 700px;
            position: relative;
        }

        .recipe-card h2 {
            color: #c22568;
        }

        .meta {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 0.8rem;
        }

        .actions {
            margin-top: 1rem;
        }

        .actions a {
            display: inline-block;
            margin-right: 1rem;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            background: #f783ac;
            color: #fff;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .actions a:hover {
            background: #d63384;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <h1>&#x1F374; All Recipes</h1>

    <?php if (count($recipes) === 0): ?>
        <p style="text-align: center;">No recipes found.</p>
    <?php endif; ?>

    <?php foreach ($recipes as $recipe): ?>
        <div class="recipe-card">
            <h2><?= htmlspecialchars($recipe['name']) ?></h2>
            <p class="meta">
                &#x1F372; <?= htmlspecialchars($recipe['type']) ?> |
                &#x23F1; <?= (int)$recipe['Cookingtime'] ?> mins |
                &#x1F464; <?= htmlspecialchars($recipe['username']) ?>
            </p>
            <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

            <div class="actions">
                <!-- Optional view button -->
                <!-- <a href="recipe.php?rid=<?= $recipe['rid'] ?>">&#x1F441; View</a> -->

                <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] == $recipe['uid']): ?>
                    <a href="delete_recipe.php?rid=<?= $recipe['rid'] ?>" onclick="return confirm('Delete this recipe?');">&#x1F5D1;&#xFE0F; Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
