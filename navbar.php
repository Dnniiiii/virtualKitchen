<?php


$loggedIn = isset($_SESSION['uid']);
?>

<style>
    .navbar {
        background-color: #fff0f6;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f3c4d1;
    }

    .navbar .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #d63384;
        text-decoration: none;
    }

    .navbar-links a {
        margin-left: 1rem;
        text-decoration: none;
        color: #d63384;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background-color 0.2s;
    }

    .navbar-links a:hover {
        background-color: #fcd5e3;
    }

    .navbar-links {
        display: flex;
        align-items: center;
    }
</style>

<div class="navbar">
    <a href="<?= $loggedIn ? 'dashboard.php' : 'index.php' ?>" class="logo">Virtual Kitchen</a>
    <div class="navbar-links">
        <a href="index.php">Home</a>
        <?php if ($loggedIn): ?>
            <a href="add_recipe.php">Add Recipe</a>
            <a href="view_recipes.php">View Recipes</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php">Log Out</a>
        <?php else: ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <a href="contact.php">Contact</a>
        <?php endif; ?>
    </div>
</div>
