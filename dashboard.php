<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle NFT creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_nft') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']);
    $price = floatval($_POST['price']);
    $token_id = trim($_POST['token_id']);
    $contract_address = trim($_POST['contract_address']);
    
    if (!empty($name)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO nfts (user_id, name, description, image_url, price, token_id, contract_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $name, $description, $image_url, $price, $token_id, $contract_address]);
            $success = "NFT added successfully!";
        } catch(PDOException $e) {
            $error = "Failed to add NFT: " . $e->getMessage();
        }
    } else {
        $error = "NFT name is required";
    }
}

// Get user's NFTs
try {
    $stmt = $pdo->prepare("SELECT * FROM nfts WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $nfts = $stmt->fetchAll();
} catch(PDOException $e) {
    $error = "Failed to load NFTs: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NFT Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
        }
        .nft-card {
            transition: transform 0.3s ease;
        }
        .nft-card:hover {
            transform: translateY(-5px);
        }
        .nft-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-cube me-2"></i>NFT Collection
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!
                </span>
                <a class="btn btn-outline-danger" href="auth/logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Success/Error Messages -->
        <?php if (isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Add NFT Form -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Add New NFT
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="action" value="add_nft">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">NFT Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price (ETH)</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image_url" class="form-label">Image URL</label>
                                    <input type="url" class="form-control" id="image_url" name="image_url">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="token_id" class="form-label">Token ID</label>
                                    <input type="text" class="form-control" id="token_id" name="token_id">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="contract_address" class="form-label">Contract Address</label>
                                <input type="text" class="form-control" id="contract_address" name="contract_address">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add NFT
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- NFTs Grid -->
        <div class="row">
            <div class="col-12">
                <h4 class="text-white mb-4">
                    <i class="fas fa-images me-2"></i>Your NFT Collection (<?= count($nfts) ?>)
                </h4>
            </div>
        </div>

        <div class="row">
            <?php if (empty($nfts)): ?>
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-cube fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No NFTs yet</h5>
                            <p class="text-muted">Add your first NFT using the form above!</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($nfts as $nft): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card nft-card h-100">
                            <?php if (!empty($nft['image_url'])): ?>
                                <img src="<?= htmlspecialchars($nft['image_url']) ?>" class="nft-image" alt="<?= htmlspecialchars($nft['name']) ?>">
                            <?php else: ?>
                                <div class="nft-image bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($nft['name']) ?></h5>
                                <?php if (!empty($nft['description'])): ?>
                                    <p class="card-text text-muted"><?= htmlspecialchars($nft['description']) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($nft['price'])): ?>
                                    <p class="card-text">
                                        <strong class="text-primary"><?= number_format($nft['price'], 2) ?> ETH</strong>
                                    </p>
                                <?php endif; ?>
                                <div class="small text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?= date('M j, Y', strtotime($nft['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
