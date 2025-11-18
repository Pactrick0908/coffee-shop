<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- Khai báo mã hóa ký tự UTF-8 -->
    <meta charset="UTF-8">
    <!-- Thiết lập viewport để responsive trên mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tiêu đề trang -->
    <title>Coffee Shop</title>
    <!-- Link đến Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link đến Font Awesome để sử dụng icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Style cho logo/navbar brand: in đậm */
        .navbar-brand {
            font-weight: bold;
        }
        /* Style cho phần hero (banner đầu trang): background gradient với hình ảnh */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1350&q=80');
            background-size: cover; /* Phủ kín toàn bộ */
            background-position: center; /* Căn giữa */
            color: white; /* Màu chữ trắng */
            padding: 100px 0; /* Padding trên dưới */
            text-align: center; /* Căn giữa text */
        }
        /* Style chung cho các trang: padding và chiều cao tối thiểu */
        .page {
            padding: 60px 0;
            min-height: calc(100vh - 220px); /* Chiều cao tối thiểu = viewport height - 220px */
        }
        /* Trang chủ không có padding và chiều cao tự động */
        #home-page {
            padding: 0;
            min-height: auto;
        }
        /* Card có hiệu ứng transition khi hover */
        .card {
            transition: transform 0.3s; /* Hiệu ứng chuyển đổi trong 0.3s */
            margin-bottom: 20px; /* Khoảng cách dưới */
        }
        /* Khi hover vào card, di chuyển lên 5px */
        .card:hover {
            transform: translateY(-5px);
        }
        /* Hình ảnh đồ uống: chiều cao cố định, object-fit để giữ tỷ lệ */
        .drink-img {
            height: 200px;
            object-fit: cover; /* Cắt ảnh để vừa khung */
        }
        /* Style cho mỗi item trong giỏ hàng */
        .cart-item {
            border-bottom: 1px solid #eee; /* Đường viền dưới */
            padding: 10px 0; /* Padding trên dưới */
        }
        /* Style cho tổng tiền giỏ hàng */
        .cart-total {
            font-weight: bold; /* In đậm */
            font-size: 1.2rem; /* Cỡ chữ lớn hơn */
        }
        /* Style cho footer */
        footer {
            background-color: #333; /* Nền xám đen */
            color: white; /* Chữ trắng */
            padding: 30px 0; /* Padding trên dưới */
            margin-top: 50px; /* Khoảng cách trên */
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#" data-page="home">Coffee Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="home">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="cart">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                            <span class="badge bg-primary" id="cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Page -->
    <div id="home-page" class="page">
        <div class="hero-section">
            <div class="container">
                <h1 class="display-4">Chào mừng đến với Coffee Shop</h1>
                <p class="lead">Thưởng thức những ly cà phê tuyệt vời nhất</p>
                <a href="#" data-page="menu" class="btn btn-primary btn-lg">Xem Menu</a>
            </div>
        </div>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 text-center">
                    <i class="fas fa-coffee fa-3x text-primary mb-3"></i>
                    <h3>Cà phê chất lượng</h3>
                    <p>Chúng tôi sử dụng những hạt cà phê tốt nhất để phục vụ bạn.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h3>Phục vụ nhanh chóng</h3>
                    <p>Đặt hàng và nhận đồ uống của bạn trong thời gian ngắn nhất.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                    <h3>Giao hàng tận nơi</h3>
                    <p>Chúng tôi giao hàng đến tận nhà của bạn.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Page -->
    <div id="menu-page" class="page d-none">
        <div class="container mt-4">
            <h2 class="text-center mb-4">Menu Đồ Uống</h2>
            
            <div class="row" id="drink-list">
                <!-- Drink items will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Cart Page -->
    <div id="cart-page" class="page d-none">
        <div class="container mt-4">
            <h2 class="text-center mb-4">Giỏ Hàng</h2>
            
            <div id="cart-items">
                <!-- Cart items will be displayed here -->
            </div>
            
            <div class="row mt-4">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between">
                        <span>Tổng cộng:</span>
                        <span id="cart-total">0 VNĐ</span>
                    </div>
                    <button class="btn btn-success w-100 mt-3" id="checkout-btn">Thanh Toán</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Page -->
    <div id="checkout-page" class="page d-none">
        <div class="container mt-4">
            <h2 class="text-center mb-4">Thanh Toán</h2>
            
            <form id="checkout-form">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Thông tin khách hàng</h4>
                        <div class="mb-3">
                            <label for="customer-name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="customer-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer-phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="customer-phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer-address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="customer-address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Đơn hàng của bạn</h4>
                        <div id="order-summary">
                            <!-- Order summary will be displayed here -->
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <strong>Tổng cộng:</strong>
                            <strong id="order-total">0 VNĐ</strong>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4" id="checkout-submit">Đặt Hàng</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; <?php echo date('Y'); ?> Coffee Shop. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Link đến Bootstrap JavaScript từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Định dạng tiền tệ theo chuẩn Việt Nam (VND)
        const currencyFormatter = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
        // Hình ảnh placeholder khi không có ảnh
        const placeholderImage = 'https://via.placeholder.com/400x300?text=Coffee+Shop';
        // Lấy base URL của trang hiện tại
        const baseUrl = new URL('.', window.location.href).href;

        // Mảng lưu danh sách đồ uống
        let drinks = [];
        // Biến cờ để tránh load đồ uống nhiều lần
        let isLoadingDrinks = false;
        // Mảng lưu giỏ hàng
        let cart = [];

        // Hàm xử lý đường dẫn hình ảnh: chuyển đổi relative path thành absolute URL
        function resolveImageUrl(path) {
            // Nếu không có path, trả về placeholder
            if (!path) return placeholderImage;
            // Nếu đã là URL đầy đủ (http/https), trả về nguyên
            if (/^https?:\/\//i.test(path)) return path;
            try {
                // Tạo URL tuyệt đối từ relative path
                return new URL(path, baseUrl).href;
            } catch (e) {
                // Nếu lỗi, trả về placeholder
                return placeholderImage;
            }
        }

        // Khôi phục giỏ hàng từ localStorage khi trang được load
        try {
            // Lấy dữ liệu giỏ hàng từ localStorage
            const storedCart = JSON.parse(localStorage.getItem('cart'));
            // Nếu là mảng hợp lệ
            if (Array.isArray(storedCart)) {
                // Map qua từng item và resolve lại đường dẫn hình ảnh
                cart = storedCart.map(item => ({
                    ...item,
                    image: resolveImageUrl(item.image)
                }));
            }
        } catch (error) {
            // Nếu có lỗi, khởi tạo giỏ hàng rỗng
            cart = [];
        }

        // Hàm hiển thị trang: ẩn tất cả các trang, sau đó hiển thị trang được chọn
        function showPage(pageId) {
            // Ẩn tất cả các trang bằng cách thêm class d-none
            document.querySelectorAll('.page').forEach(page => {
                page.classList.add('d-none');
            });
            // Hiển thị trang được chọn bằng cách xóa class d-none
            document.getElementById(pageId).classList.remove('d-none');
        }

        // Hàm format số tiền theo định dạng VND
        function formatCurrency(value) {
            return currencyFormatter.format(value || 0);
        }

        // Hàm async để lấy danh sách đồ uống từ API
        async function fetchDrinks(force = false) {
            // Nếu đang load hoặc đã có dữ liệu và không force, chỉ hiển thị lại
            if (isLoadingDrinks || (drinks.length && !force)) {
                loadDrinks();
                return;
            }

            // Đánh dấu đang load
            isLoadingDrinks = true;
            const drinkList = document.getElementById('drink-list');
            // Hiển thị thông báo đang tải
            drinkList.innerHTML = '<p class="text-center">Đang tải dữ liệu...</p>';

            try {
                // Gọi API để lấy danh sách đồ uống
                const response = await fetch('api/drinks.php');
                // Parse JSON response
                const data = await response.json();

                // Kiểm tra nếu API trả về lỗi
                if (!data.success) {
                    throw new Error(data.message || 'Không thể tải menu');
                }

                // Map qua dữ liệu và resolve đường dẫn hình ảnh
                drinks = data.data.map(drink => ({
                    ...drink,
                    image: resolveImageUrl(drink.image)
                }));
                // Hiển thị danh sách đồ uống
                loadDrinks();
            } catch (error) {
                // Log lỗi ra console
                console.error(error);
                // Hiển thị thông báo lỗi
                drinkList.innerHTML = `<p class="text-center text-danger">${error.message}</p>`;
            } finally {
                // Đánh dấu đã load xong
                isLoadingDrinks = false;
            }
        }

        // Hàm hiển thị danh sách đồ uống lên trang
        function loadDrinks() {
            const drinkList = document.getElementById('drink-list');
            // Xóa nội dung cũ
            drinkList.innerHTML = '';

            // Nếu không có đồ uống, hiển thị thông báo
            if (drinks.length === 0) {
                drinkList.innerHTML = '<p class="text-center text-muted">Hiện chưa có đồ uống nào.</p>';
                return;
            }

            // Duyệt qua từng đồ uống và tạo card
            drinks.forEach(drink => {
                // Tạo HTML cho card đồ uống
                const drinkCard = `
                    <div class="col-md-4">
                        <div class="card">
                            <img src="${resolveImageUrl(drink.image)}" class="card-img-top drink-img" alt="${drink.name}">
                            <div class="card-body">
                                <h5 class="card-title">${drink.name}</h5>
                                <p class="card-text">${drink.category || 'Đồ uống'}</p>
                                <p class="card-text"><strong>${formatCurrency(drink.price)}</strong></p>
                                <button class="btn btn-primary" data-drink-id="${drink.id}">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                `;
                // Thêm card vào danh sách
                drinkList.insertAdjacentHTML('beforeend', drinkCard);
            });

            // Gắn event listener cho các nút "Thêm vào giỏ"
            drinkList.querySelectorAll('button[data-drink-id]').forEach(button => {
                button.addEventListener('click', () => {
                    // Lấy ID đồ uống từ attribute
                    const drinkId = Number(button.getAttribute('data-drink-id'));
                    // Thêm vào giỏ hàng
                    addToCart(drinkId);
                });
            });
        }

        // Hàm thêm đồ uống vào giỏ hàng
        function addToCart(drinkId) {
            // Tìm đồ uống trong danh sách
            const drink = drinks.find(d => d.id === drinkId);
            // Nếu không tìm thấy, hiển thị cảnh báo
            if (!drink) {
                alert('Đồ uống không tồn tại. Vui lòng tải lại trang.');
                return;
            }

            // Tìm xem đồ uống đã có trong giỏ hàng chưa
            const existingItem = cart.find(item => item.id === drinkId);
            
            // Nếu đã có, tăng số lượng lên 1
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                // Nếu chưa có, thêm mới vào giỏ hàng
                cart.push({
                    id: drink.id,
                    name: drink.name,
                    price: drink.price,
                    image: resolveImageUrl(drink.image),
                    quantity: 1
                });
            }
            
            // Cập nhật hiển thị giỏ hàng
            updateCart();
            // Hiển thị thông báo thành công
            alert('Đã thêm vào giỏ hàng!');
        }

        // Hàm cập nhật giỏ hàng: cập nhật số lượng và lưu vào localStorage
        function updateCart() {
            const cartCount = document.getElementById('cart-count');
            // Tính tổng số lượng items trong giỏ hàng
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            // Cập nhật số lượng hiển thị trên badge
            cartCount.textContent = totalItems;
            
            // Lưu giỏ hàng vào localStorage để giữ lại khi reload trang
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Nếu đang ở trang giỏ hàng, render lại
            if (!document.getElementById('cart-page').classList.contains('d-none')) {
                renderCart();
            }
        }

        // Hàm render giỏ hàng: hiển thị các items và tổng tiền
        function renderCart() {
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            
            // Nếu giỏ hàng rỗng, hiển thị thông báo
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-center">Giỏ hàng của bạn đang trống</p>';
                cartTotal.textContent = formatCurrency(0);
                return;
            }
            
            let html = '';
            let total = 0;
            
            // Duyệt qua từng item trong giỏ hàng
            cart.forEach(item => {
                // Tính thành tiền cho mỗi item
                const itemTotal = item.price * item.quantity;
                // Cộng vào tổng
                total += itemTotal;
                
                // Tạo HTML cho mỗi item
                html += `
                    <div class="cart-item row align-items-center">
                        <div class="col-md-2">
                            <img src="${item.image || placeholderImage}" alt="${item.name}" class="img-fluid" style="height: 60px; object-fit: cover;">
                        </div>
                        <div class="col-md-4">
                            <h6>${item.name}</h6>
                        </div>
                        <div class="col-md-2">
                            <p>${formatCurrency(item.price)}</p>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" onclick="updateQuantity(${item.id}, -1)">-</button>
                                <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                                <button class="btn btn-outline-secondary" onclick="updateQuantity(${item.id}, 1)">+</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger" onclick="removeFromCart(${item.id})">Xóa</button>
                        </div>
                    </div>
                `;
            });
            
            // Cập nhật HTML và tổng tiền
            cartItems.innerHTML = html;
            cartTotal.textContent = formatCurrency(total);
        }

        // Hàm cập nhật số lượng đồ uống trong giỏ hàng
        function updateQuantity(drinkId, change) {
            // Tìm item trong giỏ hàng
            const item = cart.find(item => item.id === drinkId);
            if (item) {
                // Thay đổi số lượng
                item.quantity += change;
                
                // Nếu số lượng <= 0, xóa khỏi giỏ hàng
                if (item.quantity <= 0) {
                    removeFromCart(drinkId);
                } else {
                    // Ngược lại, cập nhật giỏ hàng
                    updateCart();
                }
            }
        }

        // Hàm xóa đồ uống khỏi giỏ hàng
        function removeFromCart(drinkId) {
            // Lọc bỏ item có ID trùng
            cart = cart.filter(item => item.id !== drinkId);
            // Cập nhật hiển thị
            updateCart();
        }

        // Hàm render tóm tắt đơn hàng (trong trang checkout)
        function renderOrderSummary() {
            const orderSummary = document.getElementById('order-summary');
            const orderTotal = document.getElementById('order-total');
            
            // Nếu giỏ hàng rỗng, hiển thị thông báo
            if (cart.length === 0) {
                orderSummary.innerHTML = '<p class="text-center">Giỏ hàng đang trống</p>';
                orderTotal.textContent = formatCurrency(0);
                return;
            }

            let html = '';
            let total = 0;
            
            // Duyệt qua từng item và tính tổng
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                // Tạo HTML cho mỗi item
                html += `
                    <div class="d-flex justify-content-between">
                        <span>${item.name} x ${item.quantity}</span>
                        <span>${formatCurrency(itemTotal)}</span>
                    </div>
                `;
            });
            
            // Cập nhật HTML và tổng tiền
            orderSummary.innerHTML = html;
            orderTotal.textContent = formatCurrency(total);
        }

        // Hàm async để submit đơn hàng
        async function submitOrder(event) {
            // Ngăn form submit mặc định
            event.preventDefault();

            // Kiểm tra giỏ hàng có rỗng không
            if (cart.length === 0) {
                alert('Giỏ hàng của bạn đang trống!');
                return;
            }

            // Lấy thông tin khách hàng từ form
            const name = document.getElementById('customer-name').value.trim();
            const phone = document.getElementById('customer-phone').value.trim();
            const address = document.getElementById('customer-address').value.trim();
            const submitBtn = document.getElementById('checkout-submit');

            // Disable nút submit và hiển thị trạng thái đang xử lý
            submitBtn.disabled = true;
            submitBtn.textContent = 'Đang xử lý...';

            try {
                // Gọi API để tạo đơn hàng
                const response = await fetch('api/order_create.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        customer: { name, phone, address },
                        cart: cart.map(item => ({ id: item.id, quantity: item.quantity }))
                    })
                });

                // Parse JSON response
                const data = await response.json();
                // Kiểm tra nếu có lỗi
                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Không thể đặt hàng');
                }

                // Hiển thị thông báo thành công với mã đơn
                alert(`Đặt hàng thành công! Mã đơn của bạn: #${data.order_id}`);
                // Xóa giỏ hàng
                cart = [];
                updateCart();
                // Xóa giỏ hàng khỏi localStorage
                localStorage.removeItem('cart');
                // Reset form
                event.target.reset();
                // Chuyển về trang chủ
                showPage('home-page');
            } catch (error) {
                // Hiển thị thông báo lỗi
                alert(error.message);
            } finally {
                // Bật lại nút submit và khôi phục text
                submitBtn.disabled = false;
                submitBtn.textContent = 'Đặt Hàng';
            }
        }

        // Khi DOM đã load xong, khởi tạo các event listener
        document.addEventListener('DOMContentLoaded', function() {
            // Gắn event listener cho tất cả các link có attribute data-page
            document.querySelectorAll('[data-page]').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Ngăn hành vi mặc định của link
                    e.preventDefault();
                    // Lấy giá trị page từ attribute
                    const page = this.getAttribute('data-page');
                    
                    // Xử lý navigation theo từng trang
                    if (page === 'home') {
                        showPage('home-page');
                    } else if (page === 'menu') {
                        showPage('menu-page');
                        fetchDrinks(); // Load danh sách đồ uống
                    } else if (page === 'cart') {
                        showPage('cart-page');
                        renderCart(); // Render giỏ hàng
                    }
                });
            });

            // Gắn event listener cho nút "Thanh Toán"
            document.getElementById('checkout-btn').addEventListener('click', function() {
                // Kiểm tra giỏ hàng có rỗng không
                if (cart.length === 0) {
                    alert('Giỏ hàng của bạn đang trống!');
                    return;
                }
                
                // Render tóm tắt đơn hàng và chuyển đến trang checkout
                renderOrderSummary();
                showPage('checkout-page');
            });

            // Gắn event listener cho form checkout
            document.getElementById('checkout-form').addEventListener('submit', submitOrder);

            // Khởi tạo: cập nhật giỏ hàng, load đồ uống, hiển thị trang chủ
            updateCart();
            fetchDrinks();
            showPage('home-page');
        });
    </script>
</body>
</html>

