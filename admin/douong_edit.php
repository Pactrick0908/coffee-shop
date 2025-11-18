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
// Lấy ID từ URL và chuyển sang integer
$id = intval($_GET['id'] ?? 0);
// Tìm đồ uống theo ID
$data = $D->find($id);
// Nếu không tìm thấy, hiển thị thông báo và dừng
if (!$data) { echo 'Not found'; exit; }
// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy và làm sạch dữ liệu từ form
    $ten = trim($_POST['ten'] ?? ''); // Tên đồ uống
    $gia = $_POST['gia'] ?? 0; // Giá
    $loai = trim($_POST['loai'] ?? ''); // Loại
    // Mặc định giữ nguyên hình cũ
    $hinh = $data['hinh_anh'];
    // Nếu có upload hình mới
    if (!empty($_FILES['hinh']['name'])) {
        // Đường dẫn thư mục upload
        $dest = __DIR__ . '/../uploads/';
        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($dest)) mkdir($dest,0755,true);
        // Tạo tên file mới với timestamp
        $fn = time().'_'.basename($_FILES['hinh']['name']);
        // Di chuyển file từ thư mục tạm
        move_uploaded_file($_FILES['hinh']['tmp_name'],$dest.$fn);
        // Cập nhật đường dẫn hình mới
        $hinh = 'uploads/'.$fn;
    }
    // Cập nhật thông tin đồ uống
    $D->update($id,$ten,$gia,$loai,$hinh);
    // Chuyển hướng về trang danh sách
    header('Location: douong_list.php'); exit;
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa đồ uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eff2f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
        }
        .preview-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 16px;
            border: 2px dashed #cbd5f5;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Chỉnh sửa đồ uống</h2>
            <small class="text-muted">Cập nhật thông tin đồ uống hiện có</small>
        </div>
        <a href="douong_list.php" class="btn btn-outline-secondary">← Danh sách</a>
    </div>

    <div class="card p-4">
        <form method="post" enctype="multipart/form-data" class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Tên đồ uống</label>
                <input name="ten" class="form-control" value="<?=htmlspecialchars($data['ten'])?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Giá (VND)</label>
                <input name="gia" type="number" min="0" step="1000" class="form-control" value="<?=htmlspecialchars($data['gia'])?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Loại</label>
                <input name="loai" class="form-control" value="<?=htmlspecialchars($data['loai'])?>" required>
            </div>
            <div class="col-md-4 text-center">
                <label class="form-label d-block">Hình hiện tại</label>
                <?php if($data['hinh_anh']): ?>
                    <img src="../<?=ltrim(htmlspecialchars($data['hinh_anh']),'/')?>" class="preview-img" alt="">
                <?php else: ?>
                    <div class="preview-img d-flex align-items-center justify-content-center text-muted">Không có ảnh</div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <label class="form-label">Thay hình</label>
                <input type="file" name="hinh" class="form-control" accept="image/*">
                <small class="text-muted">Bỏ trống nếu giữ nguyên hình cũ.</small>
            </div>
            <div class="col-12">
                <button class="btn btn-dark btn-lg px-4">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
