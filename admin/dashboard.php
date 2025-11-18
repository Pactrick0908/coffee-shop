<?php
// Load file xác thực
require_once __DIR__ . '/../includes/auth.php';
// Kiểm tra quyền admin
requireAdmin();
// Lấy thông tin admin từ session
$admin = $_SESSION['admin'];
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: #111827;
            color: #fff;
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }
        .sidebar a {
            color: #e5e7eb;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .card-dashboard {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.1);
        }
        .stat-card {
            border-radius: 16px;
            padding: 1.5rem;
            background: #fff;
            box-shadow: 0 5px 15px rgba(15, 23, 42, 0.08);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111827;
            color: #fff;
            font-size: 1.3rem;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 sidebar">
            <h3 class="text-white">Coffee Shop</h3>
            <p class="text-muted mb-4">Xin chào, <strong><?php echo htmlspecialchars($admin['username']); ?></strong></p>
            <a href="dashboard.php">📊 Tổng quan</a>
            <a href="douong_list.php">☕ Quản lý đồ uống</a>
            <a href="donhang_list.php">📝 Quản lý đơn hàng</a>
            <hr class="text-secondary">
            <a href="logout.php">⏻ Đăng xuất</a>
        </nav>

        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h2 class="fw-bold">Tổng quan hệ thống</h2>
                <p class="text-muted">Xem nhanh tình trạng quán và truy cập các chức năng quản lý.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Đồ uống</p>
                                <h3 class="mb-0">Quản lý menu</h3>
                            </div>
                            <div class="stat-icon">☕</div>
                        </div>
                        <p class="mt-3 mb-0">Thêm, sửa, xoá đồ uống.</p>
                        <a href="douong_list.php" class="btn btn-dark mt-3 w-100">Đi tới</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Đơn hàng</p>
                                <h3 class="mb-0">Quản lý đơn</h3>
                            </div>
                            <div class="stat-icon">🧾</div>
                        </div>
                        <p class="mt-3 mb-0">Xem và cập nhật trạng thái.</p>
                        <a href="donhang_list.php" class="btn btn-dark mt-3 w-100">Đi tới</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Tài khoản</p>
                                <h3 class="mb-0">Đăng xuất</h3>
                            </div>
                            <div class="stat-icon">🔐</div>
                        </div>
                        <p class="mt-3 mb-0">Kết thúc phiên quản trị.</p>
                        <a href="logout.php" class="btn btn-outline-dark mt-3 w-100">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
