<?php
// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/auth.php'; // Xác thực admin
require_once __DIR__ . '/../includes/models/Douong.php'; // Model đồ uống
// Kiểm tra quyền admin
requireAdmin();
// Lấy kết nối PDO
$db = Database::getInstance()->pdo();
// Khởi tạo model Douong
$D = new Douong($db);
// Biến thông báo (chưa sử dụng trong code hiện tại)
$msg = '';
// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy và làm sạch dữ liệu từ form
    $ten = trim($_POST['ten'] ?? ''); // Tên đồ uống
    $gia = $_POST['gia'] ?? 0; // Giá (mặc định 0)
    $loai = trim($_POST['loai'] ?? ''); // Loại đồ uống
    $hinh = null; // Mặc định không có hình
    // Kiểm tra nếu có file hình được upload
    if (!empty($_FILES['hinh']['name'])) {
        // Đường dẫn thư mục upload
        $dest = __DIR__ . '/../uploads/';
        // Tạo thư mục nếu chưa tồn tại (quyền 0755)
        if (!is_dir($dest)) mkdir($dest,0755,true);
        // Tạo tên file mới: timestamp + tên file gốc (để tránh trùng tên)
        $fn = time().'_'.basename($_FILES['hinh']['name']);
        // Di chuyển file từ thư mục tạm sang thư mục upload
        move_uploaded_file($_FILES['hinh']['tmp_name'],$dest.$fn);
        // Lưu đường dẫn tương đối
        $hinh = 'uploads/'.$fn;
    }
    // Tạo đồ uống mới trong database
    $D->create($ten,$gia,$loai,$hinh);
    // Chuyển hướng về trang danh sách
    header('Location: douong_list.php'); exit;
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.1);
        }
        .btn-dark {
            background: #0f172a;
            border: none;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Thêm đồ uống mới</h2>
            <small class="text-muted">Điền thông tin và tải ảnh để bổ sung vào menu</small>
        </div>
        <a href="douong_list.php" class="btn btn-outline-secondary">← Danh sách đồ uống</a>
    </div>

    <div class="card p-4">
        <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Tên đồ uống</label>
                <input name="ten" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Giá (VND)</label>
                <input name="gia" type="number" min="0" step="1000" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Loại</label>
                <input name="loai" class="form-control" placeholder="Cà phê, Trà..." required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Hình ảnh</label>
                <input type="file" name="hinh" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <button class="btn btn-dark btn-lg px-4">Lưu đồ uống</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
