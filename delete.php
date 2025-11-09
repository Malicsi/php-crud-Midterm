<?php
include 'config/db.php';

$database = new Database();
$db = $database->getConnection();

$message = '';
$student = [];

// Get student data
if (isset($_GET['id'])) {
    $query = "SELECT * FROM students WHERE id = ? LIMIT 0,1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        $message = "<div class='alert alert-danger'>Student not found.</div>";
    }
}

// Handle deletion
if ($_POST && isset($_POST['confirm_delete'])) {
    try {
        $query = "DELETE FROM students WHERE id = ?";
        $stmt = $db->prepare($query);
        
        if ($stmt->execute([$_POST['id']])) {
            header("Location: read.php?message=deleted");
            exit();
        }
    } catch(PDOException $exception) {
        $message = "<div class='alert alert-danger'>Error deleting student: " . $exception->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student - Student System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin-top: 50px; }
        .header { background: #dc3545; color: white; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
        .warning-box { background: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h1>Delete Student</h1>
        </div>
        
        <?php echo $message; ?>
        
        <?php if ($student): ?>
        <div class="warning-box">
            <h4 class="text-danger">⚠️ Warning: This action cannot be undone!</h4>
            <p>You are about to delete the following student:</p>
            
            <div class="student-info p-3 bg-light rounded">
                <p><strong>Student Number:</strong> <?php echo htmlspecialchars($student['student_no']); ?></p>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($student['fullname']); ?></p>
                <p><strong>Branch:</strong> <?php echo htmlspecialchars($student['branch']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            </div>
        </div>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            
            <div class="d-grid gap-2">
                <button type="submit" name="confirm_delete" class="btn btn-danger btn-lg">Confirm Delete</button>
                <a href="read.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Student not found.</div>
            <a href="read.php" class="btn btn-secondary">Back to Student List</a>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>