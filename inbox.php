<?php
include('authentication.php');
include('dbcon.php');

if (!isset($_SESSION['auth_user']['id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['auth_user']['id'];

// Handle accept/reject/delete actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'accepted' || $action === 'rejected') {
        $request_id = $_POST['request_id'];
        $update = $con->prepare("UPDATE connection_requests SET status = ? WHERE id = ? AND receiver_id = ?");
        $update->bind_param("sii", $action, $request_id, $current_user_id);
        $update->execute();
        $_SESSION['message'] = $action === 'accepted' ? "Connection accepted." : "Connection rejected.";
    } elseif ($action === 'delete') {
        $other_user_id = $_POST['other_user_id'];
        $delete_stmt = $con->prepare("DELETE FROM connection_requests WHERE status = 'accepted' AND (
            (sender_id = ? AND receiver_id = ?) OR 
            (sender_id = ? AND receiver_id = ?)
        )");
        $delete_stmt->bind_param("iiii", $current_user_id, $other_user_id, $other_user_id, $current_user_id);
        $delete_stmt->execute();
        $_SESSION['message'] = "Connection deleted successfully.";
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch pending connection requests
$pending_stmt = $con->prepare("SELECT cr.id, cr.sender_id, u.name, u.email 
    FROM connection_requests cr 
    JOIN users u ON cr.sender_id = u.user_id 
    WHERE cr.receiver_id = ? AND cr.status = 'pending' 
    ORDER BY cr.created_at DESC");
$pending_stmt->bind_param("i", $current_user_id);
$pending_stmt->execute();
$pending_requests = $pending_stmt->get_result();

// Fetch accepted connections
$accepted_stmt = $con->prepare("SELECT cr.sender_id, cr.receiver_id, u.user_id, u.name, u.email
    FROM connection_requests cr
    JOIN users u ON (u.user_id = cr.sender_id OR u.user_id = cr.receiver_id)
    WHERE (cr.receiver_id = ? OR cr.sender_id = ?) 
    AND cr.status = 'accepted' 
    AND u.user_id != ?");
$accepted_stmt->bind_param("iii", $current_user_id, $current_user_id, $current_user_id);
$accepted_stmt->execute();
$accepted_connections = $accepted_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inbox - Connections</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
    <style>
        .connection-container {
            max-width: 700px;
            margin: 30px auto;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.16);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1rem;
        }

        .request {
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0.5rem 0.5rem 0 0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .accept { background-color: #28a745; }
        .reject { background-color: #dc3545; }
        .delete { background-color: #6c757d; }

        .accepted-user {
            background-color: rgba(230, 230, 230, 0.62);
            border-radius: 5px;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        .accepted-user:last-child { border-bottom: none; }

        .no-requests, .no-accepted {
            text-align: center;
            color: #666;
        }

        /* Notification */
        .flash-message {
            max-width: 700px;
            margin: 20px auto;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        .flash-message button {
            background: none;
            border: none;
            font-size: 16px;
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            color: #155724;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>

<body>
    <div class="home">
        <?php
        include("includes/header.php");
        include('components/sidebar_user.php');
        ?>

        <div class="container-layouts">
            <main>
                <?php include('components/nav-header.php'); ?>

                <?php if (isset($_SESSION['message'])): ?>
                    <div class="flash-message" id="flashMessage">
                        <?= htmlspecialchars($_SESSION['message']) ?>
                        <button onclick="document.getElementById('flashMessage').style.display='none'">&times;</button>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <div class="profile-container">
                    <!-- Pending Requests -->
                    <div class="connection-container">
                        <h2>Incoming Connection Requests</h2>
                        <?php if ($pending_requests->num_rows > 0): ?>
                            <?php while ($row = $pending_requests->fetch_assoc()): ?>
                                <div class="request">
                                    <p><strong><?= htmlspecialchars($row['name']) ?></strong> (<?= htmlspecialchars($row['email']) ?>) wants to connect with you.</p>
                                    <form method="POST">
                                        <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                                        <button class="btn accept" name="action" value="accepted">Accept</button>
                                        <button class="btn reject" name="action" value="rejected">Reject</button>
                                    </form>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="no-requests">No pending connection requests.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Accepted Connections -->
                    <div class="connection-container">
                        <h2>Accepted Connections</h2>
                        <?php $c = 1 ?>
                        <?php if ($accepted_connections->num_rows > 0): ?>
                            <?php while ($conn = $accepted_connections->fetch_assoc()): ?>
                                <div class="accepted-user">
                                    <p>
                                        <strong><?= $c ?>. <?= htmlspecialchars($conn['name']) ?></strong> —
                                        mail at <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($conn['email']) ?>" target="_blank">
                                            <?= htmlspecialchars($conn['email']) ?>
                                        </a> to chat.
                                    </p>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="other_user_id" value="<?= $conn['user_id'] ?>">
                                        <button class="btn delete" onclick="return confirm('Are you sure you want to delete this connection?')">Delete</button>
                                    </form>
                                </div>
                                <?php $c += 1; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="no-accepted">No accepted connections yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
