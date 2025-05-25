<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['auth_user']['id'];

if (isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'yes') {
    // Delete the user profile
    $query = "DELETE FROM users WHERE user_id = '$userId'";
    if (mysqli_query($con, $query)) {
        // Optionally delete user's profile image from the server if not the default
        $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT image FROM users WHERE user_id = '$userId'"));
        $imagePath = "uploads/" . $user['image'];
        if (file_exists($imagePath) && $user['image'] != 'default-avatar.png') {
            unlink($imagePath);
        }

        // Log out and redirect to login page
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['status'] = "Failed to delete the profile. Please try again.";
        header("Location: user-profile.php");
        exit;
    }
} else {
    // Redirect to user profile page if not confirmed
    header("Location: profile.php");
    exit;
}
?>

