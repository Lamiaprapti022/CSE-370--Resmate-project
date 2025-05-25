<?php
include('authentication.php');

?>


<head>
    <title>Welcome Admin</title>
    <link rel="icon" type="image/png" href="images/resmate_logo.png">
</head>
<div class="home">
    <?php
    include('includes/header.php');
    include('components/sidebar_admin.php');

    ?>
    <div class="container-layouts">
        <main>
            <?php include('components/nav-header.php'); ?>
            <div class="welcome-container">
                <h1 class="f-s-30">Welcome back, Admin!</h1>
                <p class="f-w-300">
                    Manage the website.
                </p>
            </div>

            <div class="">
                <div class="">
                    <?php
                    include('admin_post.php');
                    ?>
                </div>

            </div>
        </main>
    </div>
</div>