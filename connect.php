<?php
session_start();
include('dbcon.php');

// Ensure the user is logged in
if (!isset($_SESSION['auth_user']['id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['auth_user']['id'];

// Validate the target user ID
if (!isset($_GET['to_user']) || !is_numeric($_GET['to_user'])) {
    echo "Invalid request.";
    exit();
}

$to_user_id = (int) $_GET['to_user'];

// Prevent sending a request to oneself
if ($to_user_id === $current_user_id) {
    echo "You can't send a connection request to yourself.";
    exit();
}

// Check if a request already exists
$check_query = "SELECT * FROM connection_requests WHERE sender_id = ? AND receiver_id = ?";
$check_stmt = $con->prepare($check_query);
$check_stmt->bind_param("ii", $current_user_id, $to_user_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    $existing_request = $result->fetch_assoc();

    if ($existing_request['status'] === 'rejected') {
        // Update the rejected request to pending
        $update_query = "UPDATE connection_requests SET status = 'pending', created_at = NOW() WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("i", $existing_request['id']);
        $update_stmt->execute();
        header("Location: home_user.php");
        exit();
    } else {
        echo "You have already sent a connection request to this user.";
        exit();
    }
}

// Insert new connection request
$insert_query = "INSERT INTO connection_requests (sender_id, receiver_id, status) VALUES (?, ?, 'pending')";
$insert_stmt = $con->prepare($insert_query);
$insert_stmt->bind_param("ii", $current_user_id, $to_user_id);

if ($insert_stmt->execute()) {
    header("Location: home_user.php");
    exit();
} else {
    echo "Failed to send connection request.";
}
?>
