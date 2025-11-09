<?php
include 'config/db.php';

$database = new Database();
$db = $database->getConnection();

$message = '';

if ($_POST) {
    try {
        $query = "INSERT INTO students SET student_no=:student_no, fullname=:fullname, branch=:branch, email=:email, contact=:contact";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":student_no", $_POST['student_no']);
        $stmt->bindParam(":fullname", $_POST['fullname']);
        $stmt->bindParam(":branch", $_POST['branch']);
        $stmt->bindParam(":email", $_POST['email']);
        $stmt->bindParam(":contact", $_POST['contact']);
        
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Student was added successfully!</div>";
        }
    } catch(PDOException $exception) {
        $message = "<div class='alert alert-danger'>Error adding student: " . $exception->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Student System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 600px; margin-top: 50px; }
        .header { background: #007bff; color: white; padding: 20px; border-radius: 5px; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h1>Add New Student</h1>
        </div>
        
        <?php echo $message; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <label for="student_no" class="form-label">Student Number *</label>
                <input type="text" class="form-control" id="student_no" name="student_no" required>
            </div>
            
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            
            <div class="mb-3">
                <label for="branch" class="form-label">Branch *</label>
                <select class="form-control" id="branch" name="branch" required>
                    <option value="">Select Branch</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Electrical Engineering">Electrical Engineering</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact">
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Add Student</button>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>