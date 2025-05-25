<?php
// session_start();
include('authentication.php');
include('dbcon.php');

// Ensure the user is an admin
if ($_SESSION['auth_user']['is_admin'] != TRUE) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user's image from the server
    $query = "SELECT image FROM users WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    $imagePath = "uploads/" . $user['image'];

    if (file_exists($imagePath) && $user['image'] != 'default-avatar.png') {
        unlink($imagePath);
    }

    // Delete the user from the database
    $deleteQuery = "DELETE FROM users WHERE user_id = '$userId'";
    if (mysqli_query($con, $deleteQuery)) {
        $_SESSION['status'] = "User deleted successfully.";
        header('Location: admin_all_user.php');
        exit;
    } else {
        $_SESSION['status'] = "Failed to delete user.";
    }
}
?>
