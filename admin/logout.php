<?php
// Load file auth để có session_start
require_once __DIR__ . '/../includes/auth.php';
// Hủy toàn bộ session (xóa tất cả dữ liệu session)
session_destroy();
// Chuyển hướng về trang đăng nhập
header('Location: login.php');
// Dừng thực thi script
exit;
