<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Branch Directory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .header-section {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .card-create { border-top: 4px solid #28a745; }
        .card-read { border-top: 4px solid #17a2b8; }
        .card-update { border-top: 4px solid #ffc107; }
        .card-delete { border-top: 4px solid #dc3545; }
        .btn-feature { 
            border-radius: 25px; 
            padding: 10px 25px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="header-section">
                <h1 class="display-4">🎓 Student Branch Directory</h1>
                <p class="lead">Manage student records with ease</p>
            </div>
            
            <div class="container py-5">
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="card feature-card card-create h-100">
                            <div class="card-body">
                                <div class="feature-icon mb-3">
                                    <h1>➕</h1>
                                </div>
                                <h5 class="card-title">Add Student</h5>
                                <p class="card-text">Create new student records in the system</p>
                                <a href="create.php" class="btn btn-success btn-feature">Add New</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card feature-card card-read h-100">
                            <div class="card-body">
                                <div class="feature-icon mb-3">
                                    <h1>📋</h1>
                                </div>
                                <h5 class="card-title">View Students</h5>
                                <p class="card-text">Browse and search all student records</p>
                                <a href="read.php" class="btn btn-info btn-feature text-white">View All</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card feature-card card-update h-100">
                            <div class="card-body">
                                <div class="feature-icon mb-3">
                                    <h1>✏️</h1>
                                </div>
                                <h5 class="card-title">Edit Students</h5>
                                <p class="card-text">Update existing student information</p>
                                <a href="read.php" class="btn btn-warning btn-feature">Edit Records</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card feature-card card-delete h-100">
                            <div class="card-body">
                                <div class="feature-icon mb-3">
                                    <h1>🗑️</h1>
                                </div>
                                <h5 class="card-title">Delete Students</h5>
                                <p class="card-text">Remove student records from system</p>
                                <a href="read.php" class="btn btn-danger btn-feature">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <div class="system-info p-4 bg-light rounded">
                        <h4>System Information</h4>
                        <p class="mb-1"><strong>Database:</strong> ralphgit</p>
                        <p class="mb-1"><strong>Table:</strong> students</p>
                        <p class="mb-0"><strong>Features:</strong> Complete CRUD Operations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>