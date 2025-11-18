<?php
// File mẫu cấu hình database
// HƯỚNG DẪN: Copy file này thành db_config.php và điền thông tin database của bạn
// Lệnh: copy db_config.example.php db_config.php (Windows) hoặc cp db_config.example.php db_config.php (Linux/Mac)

// File cấu hình kết nối database
// Địa chỉ host của MySQL (localhost hoặc hostname từ hosting)
$DB_HOST = "127.0.0.1";
// Tên database
$DB_NAME = "ql_quanan";
// Tên người dùng database
$DB_USER = "root";
// Mật khẩu database (để trống nếu không có mật khẩu)
$DB_PASS = "";
// Các tùy chọn cho PDO
$DB_OPTIONS = [
    // Bật chế độ báo lỗi exception khi có lỗi SQL
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // Mặc định fetch dữ liệu dưới dạng associative array (mảng kết hợp)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

