<?php
include('authentication.php');

?>

<head>
    <title>Welcome <?= $_SESSION['auth_user']['username'] ?></title>
    <link rel="icon" type="image/png" href="images/resmate_logo.png">
</head>

<style>
    .hero-section {
        display: grid;
        grid-template-columns: 500px 1fr;
    }

    .card-1 {
        margin-left: 50px;
    }
</style>

<div class="home">
    <?php
    include("includes/header.php");
    include('components/sidebar_user.php');

    ?>
    <div class="container-layouts">
        <main>
            <?php include 'components/nav-header.php'; ?>
            <div class="welcome-container">
                <h1 class="f-s-30">Welcome back, <?= $_SESSION['auth_user']['username'] ?>!</h1>
                <p class="f-w-300">
                    Find your perfect research partner and collaborate on exciting projects.
                </p>
            </div>

            <div class="hero-section">
                <div class="card-1">
                    <?php
                    include 'components/recommended.php';
                    ?>
                </div>

                <div class="space-y-6">
                    <?php
                    include('user_all_post.php');
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>