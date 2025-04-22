<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];
$username = htmlspecialchars($_SESSION['username']);

// Fetch the user's own recipes
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE uid = ? ORDER BY rid DESC");
$stmt->execute([$uid]);
$myRecipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
            margin: 0;
        }

        .dashboard-box {
            background: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        h1 {
            color: #d63384;
            margin-bottom: 1rem;
        }

        .nav-buttons a {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.75rem 1.2rem;
            border-radius: 10px;
            background-color: #d63384;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .nav-buttons a:hover {
            background-color: #c22568;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 1.5rem;
        }

        .recipes {
            margin-top: 3rem;
            text-align: left;
        }

        .recipe-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .recipe-card h3 {
            margin: 0 0 0.5rem;
            color: #d63384;
        }

        .recipe-actions a {
            margin-right: 1rem;
            text-decoration: none;
            color: #fff;
            background: #f783ac;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
        }

        .recipe-actions a:hover {
            background: #c22568;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="dashboard-box">
        <h1>Welcome, <?= $username ?>! &#x1F44B;</h1>
        <p>What would you like to do today?</p>

        <div class="nav-buttons">
            <a href="add_recipe.php">&#x2795; Add a Recipe</a>
            <a href="view_recipes.php">&#x1F4D6; View All Recipes</a>
            <a href="logout.php">&#x1F6AA; Log Out</a>
        </div>

        <?php if (isset($_GET['added'])): ?>
            <p class="success">&#x2705; Recipe added successfully!</p>
        <?php endif; ?>
        <?php if (isset($_GET['updated'])): ?>
            <p class="success">&#x1F58A; Recipe updated successfully!</p>
        <?php endif; ?>
        <?php if (isset($_GET['deleted'])): ?>
            <p class="success">&#x1F5D1;&#xFE0F; Recipe deleted successfully!</p>
        <?php endif; ?>

        <div class="recipes">
            <h2>Your Recipes</h2>

            <?php if (count($myRecipes) === 0): ?>
                <p>You haven't added any recipes yet.</p>
            <?php else: ?>
                <?php foreach ($myRecipes as $recipe): ?>
                    <div class="recipe-card">
                        <h3><?= htmlspecialchars($recipe['name']) ?></h3>
                        <p>
                            <strong>Type:</strong> <?= htmlspecialchars($recipe['type']) ?> |
                            <strong>Time:</strong> <?= (int)$recipe['Cookingtime'] ?> mins
                        </p>
                        <div class="recipe-actions">
                            <a href="edit_recipe.php?rid=<?= $recipe['rid'] ?>">&#x270F;&#xFE0F; Edit</a>
                            <a href="delete_recipe.php?rid=<?= $recipe['rid'] ?>" onclick="return confirm('Are you sure you want to delete this recipe?');">&#x1F5D1;&#xFE0F; Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
