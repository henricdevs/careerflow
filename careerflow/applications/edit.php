<?php
include '../auth/check.php';
include '../config/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM applications WHERE id='$id' AND user_id='$user_id'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = $_POST['company_name'];
    $job = $_POST['job_title'];
    $status = $_POST['status'];
    $date = $_POST['date_applied'];
    $notes = $_POST['notes'];

    if (!empty($_FILES['resume']['name'])) {
    $file_name = time() . "_" . $_FILES['resume']['name'];
    $target = "../uploads/resumes/" . $file_name;

    move_uploaded_file($_FILES['resume']['tmp_name'], $target);

    $resume_path = $file_name;

    $update = "UPDATE applications SET 
        company_name='$company',
        job_title='$job',
        status='$status',
        date_applied='$date',
        notes='$notes',
        resume_path='$resume_path'
        WHERE id='$id' AND user_id='$user_id'";
} else {
    $update = "UPDATE applications SET 
        company_name='$company',
        job_title='$job',
        status='$status',
        date_applied='$date',
        notes='$notes'
        WHERE id='$id' AND user_id='$user_id'";
        }

    if ($conn->query($update)) {
        header("Location: list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">Edit Application</h2>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

        <input type="text" name="company_name" class="form-control mb-3" value="<?php echo $data['company_name']; ?>" required>

        <input type="text" name="job_title" class="form-control mb-3" value="<?php echo $data['job_title']; ?>" required>

        <select name="status" class="form-select mb-3">
            <option value="applied" <?php if($data['status']=='applied') echo 'selected'; ?>>Applied</option>
            <option value="interview" <?php if($data['status']=='interview') echo 'selected'; ?>>Interview</option>
            <option value="rejected" <?php if($data['status']=='rejected') echo 'selected'; ?>>Rejected</option>
            <option value="hired" <?php if($data['status']=='hired') echo 'selected'; ?>>Hired</option>
        </select>

        <input type="date" name="date_applied" class="form-control mb-3" value="<?php echo $data['date_applied']; ?>" required>

        <textarea name="notes" class="form-control mb-3"><?php echo $data['notes']; ?></textarea>

        <input type="file" name="resume" class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary mt-2">Back</a>

    </form>
</div>

</body>
</html>