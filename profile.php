<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
</head>

<style>
    .profile-container {
        margin: 2rem;
        padding: 3rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.06);
    }

    .img-edit-container {
        display: grid;
        gap: 12px;
        margin-bottom: 22px;
    }

    .edit-btn {
        height: 28px;
        width: 90px;
        padding: 2px 5px;
        background-color: #4287f5;
        color: #f4f4f9;
        border-radius: 3px;
        border: 0;
        text-decoration: none;
    }

    .del-btn {
        height: 28px;
        width: 90px;
        padding: 2px 5px;
        background: #d9534f;
        color: #f4f4f9;
        border-radius: 3px;
        border: 0;
        text-decoration: none;
    }

    .edit-btn:hover {
        background-color: #4287f5;
        color: #f4f4f9;
        transition: 0.3s ease-in-out;
    }

    .del-btn:hover {
        background-color: rgb(229, 104, 100);
        color: #f4f4f9;
        transition: 0.3s ease-in-out;
    }

    .common-cls {
        margin-bottom: 15px;
    }

    .name-text {
        font-size: 28px;
    }

    .interest-text {
        font-weight: 500;
    }

    .bio-text {
        width: 800px;
        font-weight: 400;
    }
</style>

<div class="home">
    <?php
    include('authentication.php');
    include("includes/header.php");
    include('components/sidebar_user.php');
    include('dbcon.php');  // make sure db connection is available

    $userId = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM users WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    ?>

    <div class="container-layouts">
        <main>
            <?php include('components/nav-header.php'); ?>

            <div class="profile-container">
                <div class="img-edit-container">
                    <img height="170px" width="150px" src="uploads/<?= htmlspecialchars($user['image'] ?? 'default-avatar.png') ?>" alt="user">
                    <div class="bttns">
                        <a class="edit-btn" href="edit.php">Edit Profile</a>
                        <a class="del-btn" href="javascript:void(0);" onclick="confirmDelete()">Delete Profile</a>
                    </div>
                </div>
                <h2 class="name-text common-cls"><?= htmlspecialchars($user['name']) ?>,<?= htmlspecialchars($user['department']) ?> </h2>
                <h5 class="interest-text common-cls"><?= htmlspecialchars($user['interests']) ?></h5>
                <h4 class="bio-text common-cls"><?= htmlspecialchars($user['bio']) ?></h4>
            </div>
        </main>
    </div>
</div>

<script>
    function confirmDelete() {
        // Show confirmation dialog
        const confirmation = confirm("Are you sure you want to delete your profile? This action cannot be undone.");
        if (confirmation) {
            // If confirmed, redirect to delete-profile.php with a confirmation parameter
            window.location.href = "delete-profile.php?confirm_delete=yes";
        }
    }
</script>

</html>