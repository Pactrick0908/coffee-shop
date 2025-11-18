<?php
// API endpoint trả về danh sách đồ uống dưới dạng JSON
// Thiết lập header để trả về JSON với encoding UTF-8
header('Content-Type: application/json; charset=utf-8');

// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/models/Douong.php'; // Model đồ uống
try {
    // Lấy kết nối PDO
    $pdo = Database::getInstance()->pdo();
    // Khởi tạo model Douong
    $douongModel = new Douong($pdo);
    // Lấy tất cả đồ uống
    $items = $douongModel->all();

    // Chuyển đổi dữ liệu từ database sang format JSON
    $data = array_map(function ($row) {
        // Lấy đường dẫn hình ảnh
        $image = $row['hinh_anh'] ?? null;
        // Nếu có hình ảnh và không phải URL đầy đủ (http/https)
        if ($image) {
            if (!preg_match('/^https?:\/\//i', $image)) {
                // Loại bỏ dấu / đầu tiên nếu có
                $image = ltrim($image, '/');
            }
        }

        // Trả về mảng với các key chuẩn hóa
        return [
            'id' => (int) $row['id_douong'], // ID đồ uống (ép kiểu integer)
            'name' => $row['ten'], // Tên đồ uống
            'price' => (float) $row['gia'], // Giá (ép kiểu float)
            'category' => $row['loai'] ?? '', // Loại đồ uống (mặc định chuỗi rỗng)
            'image' => $image // Đường dẫn hình ảnh
        ];
    }, $items);

    // Trả về JSON thành công với dữ liệu
    echo json_encode([
        'success' => true,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE); // JSON_UNESCAPED_UNICODE để hiển thị tiếng Việt đúng
} catch (Throwable $e) {
    // Nếu có lỗi, trả về HTTP status 500 (Internal Server Error)
    http_response_code(500);
    // Trả về JSON thông báo lỗi
    echo json_encode([
        'success' => false,
        'message' => 'Không thể tải danh sách đồ uống. Vui lòng thử lại sau.'
    ], JSON_UNESCAPED_UNICODE);
}

