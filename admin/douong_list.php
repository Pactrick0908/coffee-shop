<?php
// Khai báo các file cần thiết để kết nối database và xác thực
require_once __DIR__ . '/../includes/db_config.php'; // File cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class quản lý kết nối database
require_once __DIR__ . '/../includes/auth.php'; // File xác thực quyền admin
require_once __DIR__ . '/../includes/models/Douong.php'; // Model quản lý đồ uống

// Kiểm tra quyền admin, nếu chưa đăng nhập sẽ chuyển về trang login
requireAdmin();
// Lấy kết nối PDO từ singleton Database
$db = Database::getInstance()->pdo();
// Khởi tạo đối tượng Douong để thao tác với bảng đồ uống
$D = new Douong($db);
// Lấy tất cả danh sách đồ uống từ database
$list = $D->all();
?>
<!doctype html>
<html lang="vi">
<head>
    <!-- Khai báo mã hóa ký tự UTF-8 -->
    <meta charset="utf-8">
    <!-- Thiết lập viewport để responsive trên mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tiêu đề trang -->
    <title>Quản lý đồ uống</title>
    <!-- Link đến thư viện Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Thiết lập màu nền và font chữ cho body */
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Style cho header của bảng: nền đen, chữ trắng */
        .table thead th {
            background: #111827;
            color: #fff;
        }
        /* Khoảng cách giữa các nút thao tác */
        .action-btns a {
            margin-right: 8px;
        }
        /* Layout header: flexbox để căn chỉnh tiêu đề và nút */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
<!-- Container chính với padding top và bottom -->
<div class="container py-4">
    <!-- Header của trang: tiêu đề và các nút điều hướng -->
    <div class="page-header">
        <div>
            <!-- Tiêu đề trang -->
            <h2 class="fw-bold mb-0">Danh sách đồ uống</h2>
            <!-- Mô tả nhỏ -->
            <small class="text-muted">Quản lý menu đồ uống của quán</small>
        </div>
        <div>
            <!-- Nút quay về trang dashboard -->
            <a href="dashboard.php" class="btn btn-outline-secondary me-2">← Trang chính</a>
            <!-- Nút thêm đồ uống mới -->
            <a href="douong_add.php" class="btn btn-dark">+ Thêm đồ uống</a>
        </div>
    </div>

    <!-- Card chứa bảng danh sách -->
    <div class="card shadow-sm">
        <!-- Table responsive để cuộn ngang trên màn hình nhỏ -->
        <div class="table-responsive">
            <!-- Bảng hiển thị danh sách đồ uống -->
            <table class="table table-hover mb-0">
                <thead>
                <!-- Header của bảng -->
                <tr>
                    <th>#</th> <!-- Cột ID -->
                    <th>Tên đồ uống</th> <!-- Cột tên -->
                    <th>Giá</th> <!-- Cột giá -->
                    <th>Loại</th> <!-- Cột loại đồ uống -->
                    <th>Hình</th> <!-- Cột hình ảnh -->
                    <th class="text-end">Thao tác</th> <!-- Cột các nút thao tác -->
                </tr>
                </thead>
                <tbody>
                <!-- Kiểm tra nếu danh sách rỗng -->
                <?php if (empty($list)): ?>
                    <tr>
                        <!-- Hiển thị thông báo khi không có dữ liệu -->
                        <td colspan="6" class="text-center text-muted py-4">Chưa có đồ uống nào.</td>
                    </tr>
                <?php else: ?>
                    <!-- Duyệt qua từng đồ uống trong danh sách -->
                    <?php foreach ($list as $r): ?>
                        <tr>
                            <!-- Hiển thị ID đồ uống, dùng htmlspecialchars để chống XSS -->
                            <td><?php echo htmlspecialchars($r['id_douong']); ?></td>
                            <!-- Hiển thị tên đồ uống -->
                            <td><?php echo htmlspecialchars($r['ten']); ?></td>
                            <!-- Hiển thị giá đã format với dấu phẩy ngăn cách hàng nghìn -->
                            <td><?php echo number_format($r['gia']); ?> đ</td>
                            <!-- Hiển thị loại đồ uống, nếu không có thì hiển thị chuỗi rỗng -->
                            <td><?php echo htmlspecialchars($r['loai'] ?? ''); ?></td>
                            <td>
                                <!-- Kiểm tra nếu có hình ảnh -->
                                <?php if ($r['hinh_anh']): ?>
                                    <!-- Hiển thị hình ảnh, ltrim để loại bỏ dấu / đầu tiên nếu có -->
                                    <img src="<?php echo '../' . ltrim(htmlspecialchars($r['hinh_anh']), '/'); ?>" width="70" height="70" style="object-fit: cover;" alt="">
                                <?php else: ?>
                                    <!-- Hiển thị text nếu không có hình -->
                                    <span class="text-muted">Không có</span>
                                <?php endif; ?>
                            </td>
                            <!-- Cột thao tác: các nút Sửa và Xóa -->
                            <td class="text-end action-btns">
                                <!-- Nút sửa: chuyển đến trang edit với id đồ uống -->
                                <a href="douong_edit.php?id=<?php echo $r['id_douong']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <!-- Nút xóa: có confirm dialog trước khi xóa -->
                                <a href="douong_delete.php?id=<?php echo $r['id_douong']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa đồ uống này?');">Xóa</a>
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
