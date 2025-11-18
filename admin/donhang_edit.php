<?php
// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/auth.php'; // Xác thực admin
require_once __DIR__ . '/../includes/models/Donhang.php'; // Model đơn hàng
// Kiểm tra quyền admin
requireAdmin();
// Lấy kết nối PDO
$db = Database::getInstance()->pdo();
// Khởi tạo model Donhang
$DH = new Donhang($db);
// Lấy ID đơn hàng từ URL
$id = intval($_GET['id'] ?? 0);
// Tìm đơn hàng theo ID
$data = $DH->find($id);
// Nếu không tìm thấy, hiển thị thông báo và dừng
if (!$data) { echo 'Not found'; exit; }
// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy và làm sạch dữ liệu từ form
    $ho = trim($_POST['ho'] ?? ''); // Họ tên khách hàng
    $sdt = trim($_POST['sdt'] ?? ''); // Số điện thoại
    $dc = trim($_POST['dc'] ?? ''); // Địa chỉ
    // Cập nhật thông tin đơn hàng
    $DH->adminUpdate($id,$ho,$sdt,$dc);
    // Chuyển hướng về trang danh sách
    header('Location: donhang_list.php'); exit;
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-1">Đơn hàng #<?php echo htmlspecialchars($id); ?></p>
            <h2 class="fw-bold mb-0">Chỉnh sửa thông tin</h2>
        </div>
        <a href="donhang_list.php" class="btn btn-outline-secondary">← Danh sách</a>
    </div>

    <div class="card p-4">
        <form method="post" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Tên khách hàng</label>
                <input name="ho" value="<?=htmlspecialchars($data['hoten_kh'])?>" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Số điện thoại</label>
                <input name="sdt" value="<?=htmlspecialchars($data['sdt'])?>" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Địa chỉ giao</label>
                <input name="dc" value="<?=htmlspecialchars($data['diachi'])?>" class="form-control" required>
            </div>
            <div class="col-12">
                <button class="btn btn-dark btn-lg px-4">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
