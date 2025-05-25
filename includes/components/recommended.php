<?php
// include("authentication.php");
include("dbcon.php");

$currentUserId = $_SESSION['auth_user']['id'];

// Handle the filter system
$filter = $_GET['filter'] ?? 'all';
$filterQuery = '';

if ($filter !== 'all') {
    $filterQuery = " AND (INTERESTS LIKE '%$filter%')";
}

$query = "SELECT * FROM users WHERE user_id != '$currentUserId' $filterQuery";
$result = mysqli_query($con, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $interestsArray = array_map('trim', explode(',', $row['interests']));
    $users[] = [
        'name' => $row['name'],
        'avatar' => !empty($row['image']) ? 'uploads/' . $row['image'] : 'default-avatar.png',
        'department' => $row['department'] ?? 'Not specified',
        'year' => $row['year'] ?? '',
        'interests' => $interestsArray,
        'bio' => $row['bio']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recommended Partners</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .card {
            height: auto;
            width: auto;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 700px;
            margin: auto auto;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
        }

        .card-header p {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .card-body .partner {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            transition: background 0.2s;
        }

        .card-body .partner:hover {
            background: #f9fafb;
        }

        .partner-info {
            display: flex;
            align-items: flex-start;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            object-fit: cover;
        }

        .partner-details {
            margin-left: 1rem;
            flex: 1;
        }

        .partner-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .partner-header h3 {
            font-size: 1rem;
            font-weight: 500;
            color: #111827;
        }

        .match {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .match span {
            color: #4287f5;
            font-weight: 500;
        }

        .dept {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .interests {
            margin-top: 0.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .interest {
            padding: 0.25rem 0.5rem;
            background: #e0e7ff;
            color: #4287f5;
            font-size: 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn.connect {
            background-color: #4287f5;
            color: white;
        }

        .btn.connect:hover {
            background-color: #4287f5;
        }

        .btn.message {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn.message:hover {
            background-color: #f3f4f6;
        }

        .btn i {
            margin-right: 0.375rem;
            width: 1rem;
            height: 1rem;
        }

        .filter {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter select {
            padding: 0.3rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btttn {
            height: 15px;
            width: 15px;
        }

    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h2>Recommended Research Partners</h2>
        <p>Based on your research interests and preferences</p>
    </div>

    <!-- Filter Section -->
    <div class="filter">
        <form method="GET">
            <label for="filter">Filter by Interest:</label>
            <select name="filter" onchange="this.form.submit()">
                <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All Interests</option>
                <option value="Machine Learning" <?= $filter === 'Machine Learning' ? 'selected' : '' ?>>Machine Learning</option>
                <option value="Artificial Intelligence" <?= $filter === 'Artificial Intelligence' ? 'selected' : '' ?>>Artificial Intelligence</option>
                <option value="CyberSecurity" <?= $filter === 'CyberSecurity' ? 'selected' : '' ?>>CyberSecurity</option>
            </select>
        </form>
    </div>

    <div class="card-body">
        <?php foreach ($users as $user): ?>
            <div class="partner">
                <div class="partner-info">
                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>" class="avatar">
                    <div class="partner-details">
                        <div class="partner-header">
                            <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                        </div>
                        <p class="dept"><?php echo htmlspecialchars($user['department']); ?><?php if ($user['year']) echo ' • ' . htmlspecialchars($user['year']) . ' Year'; ?></p>
                        <div class="interests">
                            <?php foreach ($user['interests'] as $interest): ?>
                                <span class="interest"><?php echo htmlspecialchars($interest); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty($user['bio'])): ?>
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #4b5563;"><?php echo htmlspecialchars($user['bio']); ?></p>
                        <?php endif; ?>
                        <div class="actions">
                            <button class="btn connect" href="connect.php?to_user=<?= $post['id'] ?>"></i>Connect</button>
                            <button class="btn message"></i>Message</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
