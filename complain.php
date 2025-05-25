<?php
include('authentication.php');
?>

<head>
    <title>Complaints - User</title>
    <link rel="icon" type="image/png" href="images/resmate_logo.png">
    <style>
        .hero-section {
            display: flex;
            justify-content: flex-start;
            padding: 2rem;
        }

        .card-1 {
            background-color: white;
            padding: 2rem;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .card-1 h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="email"],
        textarea {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            width: 100%;
            background-color: #f9f9f9;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            padding: 0.75rem;
            background-color: #4287f5;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #306edb;
        }
    </style>
</head>

<div class="home">
    <?php
    include("includes/header.php");
    include('components/sidebar_user.php');
    ?>
    <div class="container-layouts">
        <main>
            <?php include 'components/nav-header.php'; ?>

            <div class="hero-section">
                <div class="card-1">
                    <h2>File a Complaint</h2>
                    <form action="submit_complaint.php" method="POST">
                        <label for="reported_email">Reported User Email:</label>
                        <input type="email" name="reported_email" id="reported_email" required placeholder="example@gmail.com" />

                        <label for="complaint_text">Complaint Details:</label>
                        <textarea name="complaint_text" id="complaint_text" rows="5" required placeholder="Describe the issue..."></textarea>

                        <button type="submit">Submit Complaint</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
