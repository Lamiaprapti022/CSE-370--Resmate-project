<?php
include('dbcon.php'); 
include('authentication.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complainer_email = $_SESSION['auth_user']['email'];
    $accused_email = trim($_POST['reported_email']);
    $message = trim($_POST['complaint_text']);

    if (!empty($accused_email) && !empty($message)) {
        // Get complainer ID
        $stmt = $con->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $complainer_email);
        $stmt->execute();
        $stmt->bind_result($complainer_id);
        $stmt->fetch();
        $stmt->close();

        // Get accused ID
        $stmt = $con->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $accused_email);
        $stmt->execute();
        $stmt->bind_result($accused_id);
        $stmt->fetch();
        $stmt->close();

        if ($complainer_id && $accused_id) {
            $stmt = $con->prepare("INSERT INTO complaints (complainer_id, accused_id, message, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iis", $complainer_id, $accused_id, $message);
            $stmt->execute();
            $stmt->close();

            $_SESSION['status'] = "Complaint submitted successfully.";
        } else {
            $_SESSION['status'] = "Invalid email address provided.";
        }
    } else {
        $_SESSION['status'] = "Please fill all required fields.";
    }

    header("Location: complain.php");
    exit();
}
?>
