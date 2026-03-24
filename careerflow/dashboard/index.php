<?php
include '../auth/check.php';
include '../config/db.php';

$user_id = $_SESSION['user_id'];


$applied = $conn->query("SELECT COUNT(*) as total FROM applications WHERE user_id='$user_id' AND status='applied'")->fetch_assoc()['total'];

$interview = $conn->query("SELECT COUNT(*) as total FROM applications WHERE user_id='$user_id' AND status='interview'")->fetch_assoc()['total'];

$rejected = $conn->query("SELECT COUNT(*) as total FROM applications WHERE user_id='$user_id' AND status='rejected'")->fetch_assoc()['total'];

$hired = $conn->query("SELECT COUNT(*) as total FROM applications WHERE user_id='$user_id' AND status='hired'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Welcome, <?php echo $_SESSION['name']; ?> 🔥</h2>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h5>Applied</h5>
                <h2><?php echo $applied; ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-info mb-3">
            <div class="card-body">
                <h5>Interview</h5>
                <h2><?php echo $interview; ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-danger mb-3">
            <div class="card-body">
                <h5>Rejected</h5>
                <h2><?php echo $rejected; ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5>Hired</h5>
                <h2><?php echo $hired; ?></h2>
            </div>
        </div>
    </div>
</div>

<a href="../applications/list.php" class="btn btn-primary">View Applications</a>
<a href="../auth/logout.php" class="btn btn-danger">Logout</a>

</body>
</html>