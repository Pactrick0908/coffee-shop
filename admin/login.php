<?php
// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/auth.php'; // Hàm xác thực

// Biến lưu thông báo lỗi
$error = '';
// Kiểm tra nếu form được submit bằng phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy và làm sạch username (loại bỏ khoảng trắng đầu cuối)
    $u = trim($_POST['username'] ?? '');
    // Lấy password (không trim để giữ nguyên)
    $p = $_POST['password'] ?? '';
    // Gọi hàm đăng nhập, nếu thành công
    if (adminLogin($u, $p)) {
        // Chuyển hướng đến trang dashboard
        header('Location: dashboard.php'); exit;
    } else {
        // Nếu đăng nhập thất bại, gán thông báo lỗi
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 18px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .login-card .card-header {
            background: #111;
            color: #fff;
            border-bottom: none;
            text-align: center;
        }
        .login-card .card-body {
            padding: 2rem;
        }
        .hint {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="card-header">
            <h3 class="mb-0">Coffee Shop Admin</h3>
            <small>Đăng nhập hệ thống quản trị</small>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="admin" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="123456" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">Đăng nhập</button>
                </div>
            </form>
            <p class="hint mt-3 text-center">
                Tài khoản mặc định: <strong>admin</strong> / <strong>123456</strong>
            </p>
            <div class="text-center mt-2">
                <a class="text-decoration-none" href="../index.php">&larr; Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
