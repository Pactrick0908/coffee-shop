# ☕ Coffee Shop - Website Quản Lý Quán Cà Phê

Website quản lý quán cà phê với đầy đủ chức năng cho khách hàng và quản trị viên.

## ✨ Tính năng

### Cho khách hàng:
- 🏠 Trang chủ giới thiệu
- 📋 Xem menu đồ uống
- 🛒 Thêm vào giỏ hàng
- 📝 Đặt hàng online
- 💰 Thanh toán

### Cho quản trị viên:
- 🔐 Đăng nhập/đăng xuất
- 📊 Dashboard tổng quan
- ☕ Quản lý đồ uống (thêm, sửa, xóa)
- 📦 Quản lý đơn hàng (xem, sửa, xóa)
- 📸 Upload hình ảnh sản phẩm

## 🛠️ Yêu cầu hệ thống

- **PHP**: 7.4 trở lên
- **MySQL**: 5.7 trở lên (hoặc MariaDB 10.2+)
- **Web Server**: Apache hoặc Nginx
- **Extensions PHP**: PDO, PDO_MySQL

## 📦 Cài đặt

### 1. Clone repository

```bash
git clone https://github.com/username/coffee-shop.git
cd coffee-shop
```

### 2. Cấu hình database

#### Tạo database:
```sql
CREATE DATABASE ql_quanan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Import database:
- Mở phpMyAdmin hoặc MySQL command line
- Import file `sql/ql_quanan.sql`

#### Cấu hình kết nối:
```bash
# Copy file mẫu cấu hình
copy includes\db_config.example.php includes\db_config.php
# (Linux/Mac: cp includes/db_config.example.php includes/db_config.php)
```

Sửa file `includes/db_config.php` với thông tin database của bạn:
```php
$DB_HOST = "127.0.0.1";  // hoặc hostname từ hosting
$DB_NAME = "ql_quanan";
$DB_USER = "root";        // username database
$DB_PASS = "";            // password database
```

### 3. Cấu hình thư mục uploads

Đảm bảo thư mục `uploads/` có quyền ghi:

**Windows (XAMPP):**
- Thư mục `uploads` tự động có quyền ghi

**Linux/Mac:**
```bash
chmod 755 uploads
```

### 4. Khởi động web server

**XAMPP:**
- Start Apache và MySQL
- Truy cập: `http://localhost/doan`

**PHP Built-in server:**
```bash
php -S localhost:8000
# Truy cập: http://localhost:8000
```

## 🚀 Sử dụng

### Trang chủ khách hàng:
- URL: `http://localhost/doan`
- Chức năng: Xem menu, thêm vào giỏ, đặt hàng

### Trang quản trị:
- URL: `http://localhost/doan/admin/login.php`
- **Tài khoản mặc định:**
  - Username: `admin`
  - Password: `123456`

## 📁 Cấu trúc thư mục

```
doan/
├── admin/              # Trang quản trị
│   ├── dashboard.php   # Trang tổng quan
│   ├── login.php      # Đăng nhập
│   ├── logout.php     # Đăng xuất
│   ├── douong_*.php   # Quản lý đồ uống
│   └── donhang_*.php  # Quản lý đơn hàng
├── api/                # API endpoints
│   ├── drinks.php      # API lấy danh sách đồ uống
│   └── order_create.php # API tạo đơn hàng
├── includes/           # File chung
│   ├── db_config.php  # Cấu hình database (không commit)
│   ├── Database.php   # Class quản lý kết nối
│   ├── auth.php       # Xác thực admin
│   └── models/        # Models (Douong, Donhang, Chitietdonhang)
├── uploads/            # Thư mục lưu hình ảnh
├── sql/               # File SQL database
│   └── ql_quanan.sql  # File import database
├── index.php          # Trang chủ
├── .gitignore         # Git ignore file
└── README.md          # File này
```

## 🔧 Công nghệ sử dụng

- **Backend**: PHP (PDO)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla JS)
- **Framework CSS**: Bootstrap 5.3
- **Icons**: Font Awesome 6.4
- **Database**: MySQL
- **Pattern**: MVC (Model-View-Controller)

## 📝 Ghi chú

- Tất cả code đã được comment bằng tiếng Việt
- Sử dụng Prepared Statements để tránh SQL Injection
- Session-based authentication cho admin
- LocalStorage để lưu giỏ hàng
- Responsive design (mobile-friendly)

## 🐛 Xử lý lỗi thường gặp

### Lỗi kết nối database:
- Kiểm tra thông tin trong `db_config.php`
- Đảm bảo MySQL đang chạy
- Kiểm tra username/password

### Lỗi upload hình ảnh:
- Kiểm tra quyền thư mục `uploads/`
- Kiểm tra `upload_max_filesize` trong php.ini

### Lỗi 404:
- Kiểm tra cấu hình Apache/Nginx
- Kiểm tra đường dẫn file

## 📄 License

MIT License - Tự do sử dụng cho mục đích học tập và thương mại.

## 👤 Tác giả

[Tên của bạn]

## 🙏 Cảm ơn

Cảm ơn bạn đã sử dụng project này!

---

**Lưu ý**: Nhớ thay đổi mật khẩu admin mặc định trong môi trường production!

