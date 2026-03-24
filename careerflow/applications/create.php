<?php
include '../auth/check.php';
include '../config/db.php';

$resume_path = "";

if (!empty($_FILES['resume']['name'])) {
    $file_name = time() . "_" . $_FILES['resume']['name'];
    $target = "../uploads/resumes/" . $file_name;

    move_uploaded_file($_FILES['resume']['tmp_name'], $target);

    $resume_path = $file_name;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $company = $_POST['company_name'];
    $job = $_POST['job_title'];
    $status = $_POST['status'];
    $date = $_POST['date_applied'];
    $notes = $_POST['notes'];


    $sql = "INSERT INTO applications 
    (user_id, company_name, job_title, status, date_applied, notes, resume_path) 
    VALUES 
    ('$user_id', '$company', '$job', '$status', '$date', '$notes', '$resume_path')";

    if ($conn->query($sql)) {
        header("Location: list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">Add Job Application</h2>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

        <input type="text" name="company_name" class="form-control mb-3" placeholder="Company Name" required>

        <input type="text" name="job_title" class="form-control mb-3" placeholder="Job Title" required>

        <select name="status" class="form-select mb-3">
            <option value="applied">Applied</option>
            <option value="interview">Interview</option>
            <option value="rejected">Rejected</option>
            <option value="hired">Hired</option>
        </select>

        <input type="date" name="date_applied" class="form-control mb-3" required>

        <textarea name="notes" class="form-control mb-3" placeholder="Notes"></textarea>

        <input type="file" name="resume" class="form-control mb-3">

        <button type="submit" class="btn btn-success">Save Application</button>
        <a href="list.php" class="btn btn-secondary mt-2">Back</a>

    </form>
</div>

</body>
</html>