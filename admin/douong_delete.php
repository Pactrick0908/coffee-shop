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
// Xóa đồ uống theo ID
$D->delete($id);
// Chuyển hướng về trang danh sách
header('Location: douong_list.php');
// Dừng thực thi script
exit;
