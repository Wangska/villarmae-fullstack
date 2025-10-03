<?php
// Setup script to initialize the database
require_once 'config/init_db.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Setup - NFT App</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .setup-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card setup-card border-0'>
                    <div class='card-body p-5 text-center'>
                        <i class='fas fa-cube fa-3x text-primary mb-3'></i>
                        <h3 class='fw-bold mb-3'>NFT App Setup</h3>
                        <div class='alert alert-success' role='alert'>
                            <i class='fas fa-check-circle me-2'></i>Database tables created successfully!
                        </div>
                        <p class='text-muted mb-4'>Your NFT application is ready to use. You can now:</p>
                        <div class='d-grid gap-2'>
                            <a href='index.php' class='btn btn-primary'>
                                <i class='fas fa-home me-2'></i>Go to Homepage
                            </a>
                            <a href='auth/register.php' class='btn btn-outline-primary'>
                                <i class='fas fa-user-plus me-2'></i>Create Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'></script>
</body>
</html>";
?>
