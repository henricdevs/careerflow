<?php
include '../auth/check.php';
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM applications WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Your Job Applications</h2>

<a href="create.php" class="btn btn-success mb-3">+ Add New</a>

<table class="table table-bordered">
    <tr>
        <th>Company</th>
        <th>Job</th>
        <th>Status</th>
        <th>Date</th>
        <th>Notes</th>
        <th>Actions</th>
        <th>Resumes</th>

    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['company_name']; ?></td>
        <td><?php echo $row['job_title']; ?></td>
        <td>
        <?php
        $status = $row['status'];
        if ($status == 'applied') {
            echo "<span class='badge bg-warning'>Applied</span>";
        } elseif ($status == 'interview') {
            echo "<span class='badge bg-info'>Interview</span>";
        } elseif ($status == 'rejected') {
            echo "<span class='badge bg-danger'>Rejected</span>";
        } else {
            echo "<span class='badge bg-success'>Hired</span>";
        }
        ?>
        </td>
        <td><?php echo $row['date_applied']; ?></td>
        <td><?php echo $row['notes']; ?></td>
        <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this?')">Delete</a>
        </td>
    <td>
    <?php if($row['resume_path']) { ?>
        <a href="../uploads/resumes/<?php echo $row['resume_path']; ?>" target="_blank" class="btn btn-sm btn-secondary">View</a>
    <?php } else { ?>
        <span class="text-muted">No file</span>
    <?php } ?>
    </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>