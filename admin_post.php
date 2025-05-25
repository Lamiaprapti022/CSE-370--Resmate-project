<?php
// session_start();
include('dbcon.php');

// Ensure only admin can access (you can enhance this by checking an admin role)
if (!isset($_SESSION['authenticated']) || $_SESSION['auth_user']['is_admin'] !== TRUE) {
    header("Location: login.php");
    exit();
}

// Approve a post
if (isset($_GET['approve'])) {
    $post_id = $_GET['approve'];
    $stmt = $con->prepare("UPDATE posts SET is_approved = 1 WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    header("Location: home_admin.php");
    exit();
}

// Delete a post
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $stmt = $con->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    header("Location: admin_post.php");
    exit();
}

// Get all unapproved posts
$pending = $con->query("SELECT posts.*, users.name, users.email FROM posts JOIN users ON posts.user_id = users.user_id WHERE is_approved = 0");

// Get all approved posts
$approved = $con->query("SELECT posts.*, users.name, users.email FROM posts JOIN users ON posts.user_id = users.user_id WHERE is_approved = 1 ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Manage Posts</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
    <style>
        .container {
            max-width: 700px;
            height: auto;
            display: flex;
            flex-direction: column;
            /* justify-content: center;
            align-items: center; */
            margin: 30px auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.16);
            /* overflow: scroll; */
        }

        .post {
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
        }

        h2 {
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 5px 5px 0 0;
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

<div class="container">
    <h2>Approved Posts</h2>
    <?php if ($approved->num_rows > 0): ?>
        <?php while ($post = $approved->fetch_assoc()): ?>
            <div class="post">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><strong>Category:</strong> <?= htmlspecialchars($post['category']) ?></p>
                <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($post['description'])) ?></p>
                <p><strong>Requirements:</strong><br><?= nl2br(htmlspecialchars($post['requirements'])) ?></p>
                <p><strong>Posted by:</strong> <?= htmlspecialchars($post['name']) ?> (<?= htmlspecialchars($post['email']) ?>)</p>
                <a class="btn red" href="?delete=<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No approved posts yet.</p>
    <?php endif; ?>
</div>

</html>