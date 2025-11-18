<?php
// Class Database sử dụng Singleton pattern để đảm bảo chỉ có 1 kết nối database
class Database {
    // Biến static lưu trữ instance duy nhất của Database
    private static $instance = null;
    // Đối tượng PDO để thực hiện các truy vấn SQL
    private $pdo;

    // Constructor private để ngăn việc tạo object từ bên ngoài
    private function __construct($host, $db, $user, $pass, $options) {
        // Tạo chuỗi DSN (Data Source Name) để kết nối MySQL
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        // Khởi tạo đối tượng PDO với thông tin kết nối
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    // Phương thức static để lấy instance duy nhất (Singleton pattern)
    public static function getInstance() {
        // Lấy các biến cấu hình từ file db_config.php
        global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_OPTIONS;
        // Nếu chưa có instance thì tạo mới
        if (self::$instance === null) {
            self::$instance = new Database($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $DB_OPTIONS);
        }
        // Trả về instance đã tồn tại hoặc vừa tạo
        return self::$instance;
    }

    // Phương thức trả về đối tượng PDO để sử dụng trong các model
    public function pdo() {
        return $this->pdo;
    }
}
