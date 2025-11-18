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
// Xóa đơn hàng theo ID
$DH->delete($id);
// Chuyển hướng về trang danh sách
header('Location: donhang_list.php'); exit;
