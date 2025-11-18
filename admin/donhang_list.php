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
// Lấy tất cả đơn hàng từ database
$list = $DH->all();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .table thead th {
            background: #0f172a;
            color: #fff;
        }
        .badge-status {
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Danh sách đơn hàng</h2>
            <small class="text-muted">Theo dõi và xử lý đơn hàng của khách</small>
        </div>
        <a href="dashboard.php" class="btn btn-outline-secondary">← Trang chính</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th class="text-end">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($list)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa có đơn hàng nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($list as $d): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($d['id_donhang']); ?></td>
                            <td><?=htmlspecialchars($d['hoten_kh']); ?></td>
                            <td><?php echo htmlspecialchars($d['sdt']); ?></td>
                            <td><?php echo htmlspecialchars($d['diachi']); ?></td>
                            <td><?php echo htmlspecialchars($d['ngaydat']); ?></td>
                            <td><?php echo number_format($d['tongtien']); ?> đ</td>
                            <td class="text-end">
                                <a href="donhang_view.php?id=<?php echo $d['id_donhang']; ?>" class="btn btn-sm btn-info text-white">Xem</a>
                                <a href="donhang_edit.php?id=<?php echo $d['id_donhang']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="donhang_delete.php?id=<?php echo $d['id_donhang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa đơn hàng này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
