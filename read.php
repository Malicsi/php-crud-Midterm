<?php
include 'config/db.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM students ORDER BY date_added DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - Student System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 50px; }
        .header { background: #28a745; color: white; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
        .table-responsive { margin-top: 20px; }
        .btn-sm { margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h1>Student Records</h1>
            <p class="lead">View all student information</p>
        </div>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="create.php" class="btn btn-success">Add New Student</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student No</th>
                        <th>Full Name</th>
                        <th>Branch</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($students) > 0): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['id']); ?></td>
                                <td><?php echo htmlspecialchars($student['student_no']); ?></td>
                                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($student['branch']); ?></td>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                                <td><?php echo htmlspecialchars($student['contact']); ?></td>
                                <td><?php echo htmlspecialchars($student['date_added']); ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No students found. <a href="create.php">Add the first student!</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>