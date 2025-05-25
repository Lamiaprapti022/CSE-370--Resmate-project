<?php
include('dbcon.php');

// Get current user ID
$current_user_id = $_SESSION['auth_user']['id'];

// Handle filter
$user_filter = $_GET['user_filter'] ?? 'all';

// Build query
if ($user_filter === 'all') {
    $sql = "SELECT posts.*, users.name, users.email 
            FROM posts 
            JOIN users ON posts.user_id = users.user_id 
            WHERE is_approved = 1 
              AND posts.user_id != ? 
            ORDER BY posts.id DESC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $current_user_id);
} else {
    $sql = "SELECT posts.*, users.name, users.email 
            FROM posts 
            JOIN users ON posts.user_id = users.user_id 
            WHERE is_approved = 1 
              AND posts.user_id != ? 
              AND posts.category = ? 
            ORDER BY posts.id DESC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $current_user_id, $user_filter);  // Use user_filter instead of filter
}

$stmt->execute();
$approved = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>All Posts</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
    <style>
        .approved-container {
            max-width: 700px;
            margin: auto auto;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .filter {
            margin-bottom: 1rem;
            text-align: center;
        }

        .filter select {
            padding: 0.7rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .post {
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
        }

        .head-post-text {
            color: #333;
            text-align: center;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-top: 0.5rem;
            color: white;
            background: #4287f5;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn.red {
            background: #d9534f;
        }
    </style>
</head>

<body>

    <div class="approved-container">
        <h2 class="head-post-text">All Posts</h2>

        <!-- Filter Form -->
        <div class="filter">
            <form method="GET">
                <label for="user_filter">Filter by Category:</label>
                <select name="user_filter" id="user_filter" onchange="this.form.submit()"> <!-- Renamed to user_filter -->
                    <option value="all" <?= $user_filter === 'all' ? 'selected' : '' ?>>All</option>
                    <option value="Machine Learning (ML)" <?= $user_filter === 'Machine Learning (ML)' ? 'selected' : '' ?>>Machine Learning (ML)</option>
                    <option value="Artificial Intelligence (AI)" <?= $user_filter === 'Artificial Intelligence (AI)' ? 'selected' : '' ?>>Artificial Intelligence (AI)</option>
                    <option value="CyberSecurity" <?= $user_filter === 'CyberSecurity' ? 'selected' : '' ?>>CyberSecurity</option>
                </select>
            </form>
        </div>

        <!-- Posts List -->
        <?php if ($approved->num_rows > 0): ?>
            <?php while ($post = $approved->fetch_assoc()): ?>
                <div class="post">
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><strong>Category:</strong> <?= htmlspecialchars($post['category']) ?></p>
                    <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($post['description'])) ?></p>
                    <p><strong>Requirements:</strong><br><?= nl2br(htmlspecialchars($post['requirements'])) ?></p>
                    <p><strong>Posted by:</strong> <?= htmlspecialchars($post['name']) ?> </p>   
                    <a class="btn" href="connect.php?to_user=<?= $post['user_id'] ?>">Connect</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center;">No approved posts from other users.</p>
        <?php endif; ?>
    </div>
    <!-- <?= htmlspecialchars($post['email']) ?> -->
</body>

</html>