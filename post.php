<?php
session_start();
include('dbcon.php');

// Redirect if not authenticated
if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['auth_user']['id'];

// Handle create post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
    $stmt = $con->prepare("INSERT INTO posts (user_id, title, description, category, requirements) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $_POST['title'], $_POST['description'], $_POST['category'], $_POST['requirements']);
    $stmt->execute();
    $stmt->close();
    header("Location: post.php");
    exit();
}

// Handle delete post
if (isset($_GET['delete'])) {
    $stmt = $con->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $_GET['delete'], $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: post.php");
    exit();
}

// Handle edit fetch
$edit_post = null;
if (isset($_GET['edit'])) {
    $stmt = $con->prepare("SELECT * FROM posts WHERE user_id = ? AND is_approved = 1"); 
    $stmt->bind_param("ii", $_GET['edit'], $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_post = $result->fetch_assoc();
    $stmt->close();
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
    $stmt = $con->prepare("UPDATE posts SET title=?, description=?, category=?, requirements=? WHERE id=? AND user_id=?");
    $stmt->bind_param("ssssii", $_POST['title'], $_POST['description'], $_POST['category'], $_POST['requirements'], $_POST['post_id'], $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: post.php");
    exit();
}

// Filter system
$filter = $_GET['filter'] ?? 'all';
if ($filter === 'all') {
    $stmt = $con->prepare("SELECT * FROM posts WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
} else {
    $stmt = $con->prepare("SELECT * FROM posts WHERE (user_id = ? OR is_approved = 1) AND (category = ? OR ? = 'all') ORDER BY id DESC");
$stmt->bind_param("iss", $user_id, $filter, $filter);
}
$stmt->execute();
$result = $stmt->get_result();
$filtered_posts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<head>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
</head>

<style>
    .form-container,
    .post-list {
        max-width: 800px;
        margin: auto;
        background: #fff;
        padding: 2rem;
        margin-top: 2rem;
        border-radius: 10px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.16);
    }

    .in-text,
    select {
        width: 100%;
        padding: 0.7rem;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn {
        padding: 0.3rem 0.8rem;
        border: none;
        background: #4287f5;
        color: white;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
        font-family: "National Park","Montserrat","Poppins", sans-serif;
    }

    .post {
        border-bottom: 1px solid #ccc;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .filter {
        margin-bottom: 1rem;
    }

    .actions {
        margin-top: 1rem;
    }

    .actions a {
        margin-right: 10px;
    }

    .post-list {
        margin-bottom: 100px;
    }
</style>

<div class="home">
    <?php include('includes/header.php');
    include('components/sidebar_user.php'); ?>
    <div class="container-layouts">
        <main>
            <?php include('components/nav-header.php'); ?>

            <div class="form-container">
                <h2><?= $edit_post ? 'Edit Post' : 'Create New Post' ?></h2>
                <form method="POST">
                    <input type="hidden" name="action" value="<?= $edit_post ? 'update' : 'create' ?>">
                    <?php if ($edit_post): ?>
                        <input type="hidden" name="post_id" value="<?= $edit_post['id'] ?>">
                    <?php endif; ?>

                    <label>Title:</label>
                    <input class="in-text" type="text" name="title" value="<?= $edit_post['title'] ?? '' ?>" required>

                    <label>Description:</label>
                    <textarea class="in-text" name="description" required><?= $edit_post['description'] ?? '' ?></textarea>

                    <label>Category:</label>
                    <select name="category">
                        <option value="Machine Learning (ML)" <?= (isset($edit_post) && $edit_post['category'] === 'Machine Learning (ML)') ? 'selected' : '' ?>>Machine Learning (ML)</option>
                        <option value="Artificial Intelligence (AI)" <?= (isset($edit_post) && $edit_post['category'] === 'Artificial Intelligence (AI)') ? 'selected' : '' ?>>Artificial Intelligence (AI)</option>
                        <option value="CyberSecurity" <?= (isset($edit_post) && $edit_post['category'] === 'CyberSecurity') ? 'selected' : '' ?>>CyberSecurity</option>
                    </select>

                    <label>Requirements:</label>
                    <textarea class="in-text" name="requirements" required><?= $edit_post['requirements'] ?? '' ?></textarea>

                    <button class="btn" type="submit"><?= $edit_post ? 'Update Post' : 'Create Post' ?></button>
                </form>
            </div>

            <!-- Filter Posts -->
            <div class="post-list">
                <h2>Your Posts</h2>
                <form method="GET" class="filter">
                    <label for="filter">Filter by Category:</label>
                    <select name="filter" onchange="this.form.submit()">
                        <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All</option>
                        <option value="Machine Learning (ML)" <?= $filter === 'Machine Learning (ML)' ? 'selected' : '' ?>>Machine Learning (ML)</option>
                        <option value="Artificial Intelligence (AI)" <?= $filter === 'Artificial Intelligence (AI)' ? 'selected' : '' ?>>Artificial Intelligence (AI)</option>
                        <option value="CyberSecurity" <?= $filter === 'CyberSecurity' ? 'selected' : '' ?>>CyberSecurity</option>
                    </select>
                </form>

                <?php foreach ($filtered_posts as $post): ?>
                    <div class="post">
                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                        <p><strong>Category:</strong> <?= $post['category'] ?></p>
                        <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($post['description'])) ?></p>
                        <p><strong>Requirements:</strong><br><?= nl2br(htmlspecialchars($post['requirements'])) ?></p>
                        <div class="actions">
                            <a class="btn" href="?edit=<?= $post['id'] ?>">Edit</a>
                            <a class="btn" href="?delete=<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($filtered_posts)): ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>

        </main>
    </div>
</div>