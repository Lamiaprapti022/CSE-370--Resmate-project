<?php
include('authentication.php');
include('dbcon.php');

// Check if admin
if (!isset($_SESSION['auth_user']) || $_SESSION['auth_user']['is_admin'] != 1) {
    header("Location: index.php");
    exit();
}

// Handle admin actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaint_id = $_POST['complaint_id'];
    $action = $_POST['action'];

    if ($action === 'ban') {
        $stmt = $con->prepare("UPDATE users SET is_banned = 1 WHERE user_id = (SELECT accused_id FROM complaints WHERE complaint_id = ?)");
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $stmt->close();
    }

    $stmt = $con->prepare("UPDATE complaints SET status = ? WHERE complaint_id = ?");
    $status = ($action === 'ban') ? 'resolved' : 'dismissed';
    $stmt->bind_param("si", $status, $complaint_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch complaints
$query = "SELECT complaints.*, 
        complainer.name AS complainer_name, 
        accused.name AS accused_name 
        FROM complaints 
        JOIN users AS complainer ON complaints.complainer_id = complainer.user_id 
        JOIN users AS accused ON complaints.accused_id = accused.user_id";

$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Complaints</title>
    <link rel="icon" type="image/png" href="images/resmate_logo.png">
    <style>
        .container-complain {
            padding: 2rem;
            max-width: 1000px;
            margin: 20px auto 50px auto;
            background: white;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .complaint-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .complaint-card p {
            margin: 0.3rem 0;
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            gap: 10px;
        }

        .actions form {
            display: inline;
        }

        .actions button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .ban-btn {
            background-color: #ef4444;
            color: white;
            font-family: "National Park","Montserrat","Poppins", sans-serif;
        }

        .dismiss-btn {
            background-color: #9ca3af;
            color: white;
            font-family: "National Park","Montserrat","Poppins", sans-serif;
        }

        .status {
            font-weight: bold;
            color: #10b981;
        }
    </style>
</head>

<body>
    <div class="home">
        <?php
        include('includes/header.php');
        include('components/sidebar_admin.php');
        ?>
        <div class="container-layouts">
            <main>
                <?php include('components/nav-header.php'); ?>

                <div class="container-complain">
                    <h1>Complaint Management Panel</h1>

                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="complaint-card">
                                <p><strong>From:</strong> <?= htmlspecialchars($row['complainer_name']) ?></p>
                                <p><strong>Against:</strong> <?= htmlspecialchars($row['accused_name']) ?></p>
                                <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($row['message'])) ?></p>
                                <p><strong>Date:</strong> <?= $row['created_at'] ?></p>
                                <p><strong>Status:</strong> <span class="status"><?= ucfirst($row['status']) ?></span></p>

                                <?php if ($row['status'] === 'pending'): ?>
                                    <div class="actions">
                                        <form method="POST">
                                            <input type="hidden" name="complaint_id" value="<?= $row['complaint_id'] ?>">
                                            <input type="hidden" name="action" value="ban">
                                            <button type="submit" class="ban-btn">Ban User</button>
                                        </form>
                                        <form method="POST">
                                            <input type="hidden" name="complaint_id" value="<?= $row['complaint_id'] ?>">
                                            <input type="hidden" name="action" value="dismiss">
                                            <button type="submit" class="dismiss-btn">Dismiss</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No complaints found.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>