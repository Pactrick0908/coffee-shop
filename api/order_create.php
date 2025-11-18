<?php
// API endpoint tạo đơn hàng mới
// Thiết lập header để trả về JSON với encoding UTF-8
header('Content-Type: application/json; charset=utf-8');

// Kiểm tra phương thức request phải là POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Trả về HTTP status 405 (Method Not Allowed)
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không được hỗ trợ'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Đọc dữ liệu JSON từ request body
$input = json_decode(file_get_contents('php://input'), true);
// Kiểm tra nếu không parse được JSON
if (!$input) {
    // Trả về HTTP status 400 (Bad Request)
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Dữ liệu gửi lên không hợp lệ'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Lấy thông tin khách hàng và giỏ hàng từ input
$customer = $input['customer'] ?? [];
$cart = $input['cart'] ?? [];

// Lấy và làm sạch thông tin khách hàng
$name = trim($customer['name'] ?? ''); // Họ tên
$phone = trim($customer['phone'] ?? ''); // Số điện thoại
$address = trim($customer['address'] ?? ''); // Địa chỉ

// Kiểm tra thông tin khách hàng có đầy đủ không
if ($name === '' || $phone === '' || $address === '') {
    // Trả về HTTP status 422 (Unprocessable Entity)
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Vui lòng nhập đầy đủ thông tin khách hàng'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Kiểm tra giỏ hàng có rỗng không
if (empty($cart) || !is_array($cart)) {
    // Trả về HTTP status 422 (Unprocessable Entity)
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Giỏ hàng đang trống'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Load các file cần thiết
require_once __DIR__ . '/../includes/db_config.php'; // Cấu hình database
require_once __DIR__ . '/../includes/Database.php'; // Class Database
require_once __DIR__ . '/../includes/models/Douong.php'; // Model đồ uống
require_once __DIR__ . '/../includes/models/Donhang.php'; // Model đơn hàng
require_once __DIR__ . '/../includes/models/Chitietdonhang.php'; // Model chi tiết đơn hàng

try {
    // Lấy kết nối PDO
    $pdo = Database::getInstance()->pdo();
    // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    $pdo->beginTransaction();

    // Khởi tạo các model
    $drinkModel = new Douong($pdo); // Model đồ uống
    $orderModel = new Donhang($pdo); // Model đơn hàng
    $orderDetailsModel = new Chitietdonhang($pdo); // Model chi tiết đơn hàng

    // Tạo đơn hàng mới với thông tin khách hàng
    $orderId = $orderModel->create($name, $phone, $address);
    // Khởi tạo tổng tiền = 0
    $total = 0;

    // Duyệt qua từng món trong giỏ hàng
    foreach ($cart as $item) {
        // Lấy ID đồ uống và số lượng, ép kiểu integer
        $drinkId = isset($item['id']) ? (int) $item['id'] : 0;
        $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;

        // Kiểm tra tính hợp lệ của dữ liệu
        if ($drinkId <= 0 || $quantity <= 0) {
            throw new RuntimeException('Sản phẩm trong giỏ hàng không hợp lệ');
        }

        // Tìm đồ uống trong database
        $drink = $drinkModel->find($drinkId);
        // Kiểm tra đồ uống có tồn tại không
        if (!$drink) {
            throw new RuntimeException('Sản phẩm không tồn tại hoặc đã bị xóa');
        }

        // Thêm món vào chi tiết đơn hàng và cộng vào tổng tiền
        $total += $orderDetailsModel->addItem($orderId, $drinkId, $quantity, (float) $drink['gia']);
    }

    // Cập nhật tổng tiền của đơn hàng
    $orderModel->updateTongTien($orderId, $total);
    // Commit transaction (lưu tất cả thay đổi)
    $pdo->commit();

    // Trả về JSON thành công với ID đơn hàng và tổng tiền
    echo json_encode([
        'success' => true,
        'order_id' => (int) $orderId,
        'total' => $total
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    // Nếu có lỗi và đang trong transaction, rollback (hoàn tác tất cả thay đổi)
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    // Trả về HTTP status 500 (Internal Server Error)
    http_response_code(500);
    // Trả về JSON thông báo lỗi
    echo json_encode([
        'success' => false,
        // Nếu là RuntimeException thì hiển thị message của nó, ngược lại hiển thị message mặc định
        'message' => $e instanceof RuntimeException
            ? $e->getMessage()
            : 'Không thể tạo đơn hàng. Vui lòng thử lại sau.'
    ], JSON_UNESCAPED_UNICODE);
}

