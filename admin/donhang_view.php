<?php
// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/auth.php'; // Xác thực admin
require_once __DIR__ . '/../includes/models/Donhang.php'; // Model đơn hàng
require_once __DIR__ . '/../includes/models/Chitietdonhang.php'; // Model chi tiết đơn hàng
// Kiểm tra quyền admin
requireAdmin();
// Lấy kết nối PDO
$db = Database::getInstance()->pdo();
// Khởi tạo model Donhang
$DH = new Donhang($db);
// Khởi tạo model Chitietdonhang
$CT = new Chitietdonhang($db);
// Lấy ID đơn hàng từ URL
$id = intval($_GET['id'] ?? 0);
// Tìm đơn hàng theo ID
$don = $DH->find($id);
// Lấy chi tiết đơn hàng (các món trong đơn)
$ct = $CT->getByDonhang($id);
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.12);
        }
        .pill {
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-1">Đơn hàng #<?php echo htmlspecialchars($id); ?></p>
            <h2 class="fw-bold mb-0">Chi tiết đơn hàng</h2>
        </div>
        <a href="donhang_list.php" class="btn btn-outline-secondary">← Trở lại danh sách</a>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card p-4 h-100">
                <h5 class="fw-bold mb-3">Thông tin khách</h5>
                <div class="mb-3">
                    <small class="text-muted d-block">Họ tên</small>
                    <p class="mb-0 fs-5"><?php echo htmlspecialchars($don['hoten_kh']); ?></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Số điện thoại</small>
                    <p class="mb-0"><?php echo htmlspecialchars($don['sdt']); ?></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Địa chỉ giao</small>
                    <p class="mb-0"><?php echo htmlspecialchars($don['diachi']); ?></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Ngày đặt</small>
                    <span class="pill"><?php echo htmlspecialchars($don['ngaydat']); ?></span>
                </div>
                <div>
                    <small class="text-muted d-block">Tổng tiền</small>
                    <h3 class="text-success"><?php echo number_format($don['tongtien']); ?> đ</h3>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">Danh sách món</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>Món</th>
                            <th>Giá</th>
                            <th class="text-center">SL</th>
                            <th class="text-end">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($ct)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Đơn hàng chưa có món nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($ct as $r): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($r['ten']); ?></td>
                                    <td><?php echo number_format($r['gia']); ?> đ</td>
                                    <td class="text-center"><?php echo htmlspecialchars($r['soluong']); ?></td>
                                    <td class="text-end fw-semibold"><?php echo number_format($r['thanhtien']); ?> đ</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
