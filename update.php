<?php
include 'config/db.php';

$database = new Database();
$db = $database->getConnection();

$message = '';
$student = [];

// Get student data for editing
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

// Handle form submission
if ($_POST) {
    try {
        $query = "UPDATE students SET student_no=:student_no, fullname=:fullname, branch=:branch, email=:email, contact=:contact WHERE id=:id";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":student_no", $_POST['student_no']);
        $stmt->bindParam(":fullname", $_POST['fullname']);
        $stmt->bindParam(":branch", $_POST['branch']);
        $stmt->bindParam(":email", $_POST['email']);
        $stmt->bindParam(":contact", $_POST['contact']);
        $stmt->bindParam(":id", $_POST['id']);
        
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Student updated successfully!</div>";
            // Refresh student data
            $student = $_POST;
        }
    } catch(PDOException $exception) {
        $message = "<div class='alert alert-danger'>Error updating student: " . $exception->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Student System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin-top: 50px; }
        .header { background: #ffc107; color: black; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h1>Edit Student</h1>
        </div>
        
        <?php echo $message; ?>
        
        <?php if ($student): ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            
            <div class="mb-3">
                <label for="student_no" class="form-label">Student Number *</label>
                <input type="text" class="form-control" id="student_no" name="student_no" 
                       value="<?php echo htmlspecialchars($student['student_no']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="fullname" name="fullname" 
                       value="<?php echo htmlspecialchars($student['fullname']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="branch" class="form-label">Branch *</label>
                <select class="form-control" id="branch" name="branch" required>
                    <option value="">Select Branch</option>
                    <option value="Computer Science" <?php echo ($student['branch'] == 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="Information Technology" <?php echo ($student['branch'] == 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                    <option value="Electrical Engineering" <?php echo ($student['branch'] == 'Electrical Engineering') ? 'selected' : ''; ?>>Electrical Engineering</option>
                    <option value="Mechanical Engineering" <?php echo ($student['branch'] == 'Mechanical Engineering') ? 'selected' : ''; ?>>Mechanical Engineering</option>
                    <option value="Civil Engineering" <?php echo ($student['branch'] == 'Civil Engineering') ? 'selected' : ''; ?>>Civil Engineering</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?php echo htmlspecialchars($student['email']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" 
                       value="<?php echo htmlspecialchars($student['contact']); ?>">
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning">Update Student</button>
                <a href="read.php" class="btn btn-secondary">Back to Student List</a>
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