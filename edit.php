<?php
include("authentication.php");
include("dbcon.php");

$userId = $_SESSION['auth_user']['id'];
$query = "SELECT * FROM users WHERE user_id = '$userId'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<head>
    <title>Edit Profile</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
</head>

<style>
    .edit-form {
        width: 600px;
        margin: 3rem auto auto auto;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .edit-form h2 {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: .5rem;
        font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: .7rem;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .form-group input[type="file"] {
        border: none;
    }

    .form-group textarea {
        resize: vertical;
        height: 100px;
    }

    .submit-btn {
        display: block;
        width: 100%;
        background-color: rgb(66, 116, 224);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 1rem;
    }

    .submit-btn:hover {
        background-color: rgb(64, 136, 220);
    }
</style>

<div class="home">
    <?php
    include("includes/header.php");
    include('components/sidebar_user.php');
    ?>
    <div class="container-layouts">
        <main>
            <?php include('components/nav-header.php'); ?>

            <form class="edit-form" method="POST" action="update.php" enctype="multipart/form-data">
                <h2>Edit Profile</h2>

                <div class="form-group">
                    <label for="profile-image">Profile Image</label>
                    <input type="file" id="profile-image" name="profile_image">
                    <?php if (!empty($user['image'])): ?>
                        <p>Current: <?= htmlspecialchars($user['image']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>">
                </div>

                <div class="form-group">
                    <label for="name">Department Name</label>
                    <input type="text" id="name" name="department" value="<?= htmlspecialchars($user['department']) ?>">
                </div>


                <div class="form-group">
                    <label for="interests">Interests</label>
                    <input type="text" id="interests" name="interests" value="<?= htmlspecialchars($user['interests']) ?>">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio"><?= htmlspecialchars($user['bio']) ?></textarea>
                </div>

                <button type="submit" class="submit-btn">Save Changes</button>
            </form>
        </main>
    </div>
</div>
