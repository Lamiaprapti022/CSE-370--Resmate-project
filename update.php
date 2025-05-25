<?php
include("authentication.php");
include("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['auth_user']['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $interests = mysqli_real_escape_string($con, $_POST['interests']);
    $bio = mysqli_real_escape_string($con, $_POST['bio']);

    // Image Upload
    $imageName = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['profile_image']['tmp_name'];
        $imageName = time() . '_' . basename($_FILES['profile_image']['name']);
        $uploadPath = "uploads/" . $imageName;

        if (!move_uploaded_file($imageTmpName, $uploadPath)) {
            $_SESSION['message'] = "Failed to upload image.";
            header("Location: edit.php");
            exit();
        }
    }

    // Prepare SQL based on whether an image was uploaded
    if ($imageName !== '') {
        $updateQuery = "UPDATE users SET name='$name',department='$department' ,interests='$interests', bio='$bio', image='$imageName' WHERE user_id='$userId'";
    } else {
        $updateQuery = "UPDATE users SET name='$name',department='$department',interests='$interests', bio='$bio' WHERE user_id='$userId'";
    }

    $updateRun = mysqli_query($con, $updateQuery);

    if ($updateRun) {
        $_SESSION['auth_user']['username'] = $name;
        $_SESSION['message'] = "Profile updated successfully.";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Profile update failed.";
        header("Location: edit.php");
        exit();
    }
} else {
    header("Location: profile.php");
    exit();
}
