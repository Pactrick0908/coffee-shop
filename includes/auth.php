<?php
// Bắt đầu session để lưu trữ thông tin đăng nhập
session_start();
// Load các file cần thiết
require_once __DIR__ . '/db_config.php'; // Cấu hình database
require_once __DIR__ . '/Database.php'; // Class Database

// Hằng số định nghĩa tài khoản admin mặc định
const DEFAULT_ADMIN_USERNAME = 'admin';
const DEFAULT_ADMIN_PASSWORD = '123456';

// Hàm xác thực đăng nhập admin
function adminLogin($username, $password) {
    // Lấy kết nối PDO
    $pdo = Database::getInstance()->pdo();
    // Chuẩn bị câu lệnh SQL để tìm admin theo username
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :u");
    // Thực thi với tham số username
    $stmt->execute([':u'=>$username]);
    // Lấy kết quả đầu tiên
    $ad = $stmt->fetch();

    // Kiểm tra nếu tìm thấy admin và mật khẩu khớp (đã hash)
    if ($ad && password_verify($password, $ad['password'])) {
        // Lưu thông tin admin vào session
        $_SESSION['admin'] = ['id'=>$ad['id_admin'],'username'=>$ad['username']];
        return true;
    }

    // Kiểm tra với tài khoản mặc định (fallback nếu chưa có admin trong DB)
    if ($username === DEFAULT_ADMIN_USERNAME && $password === DEFAULT_ADMIN_PASSWORD) {
        // Lưu thông tin admin mặc định vào session
        $_SESSION['admin'] = ['id'=>0,'username'=>DEFAULT_ADMIN_USERNAME];
        return true;
    }

    // Đăng nhập thất bại
    return false;
}

// Hàm kiểm tra yêu cầu quyền admin, nếu chưa đăng nhập thì chuyển về trang login
function requireAdmin() {
    // Kiểm tra xem session admin có tồn tại không
    if (!isset($_SESSION['admin'])) {
        // Chuyển hướng về trang login
        header("Location: login.php");
        // Dừng thực thi script
        exit;
    }
}
