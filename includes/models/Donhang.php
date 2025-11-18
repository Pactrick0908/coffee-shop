<?php
// Model quản lý đơn hàng (CRUD operations)
class Donhang {
    // Lưu trữ đối tượng PDO để thực hiện truy vấn
    private $db;
    // Constructor: nhận đối tượng PDO và lưu vào thuộc tính $db
    public function __construct(PDO $pdo) { $this->db = $pdo; }

    // Lấy tất cả đơn hàng, sắp xếp theo ngày đặt giảm dần (mới nhất trước)
    public function all() {
        return $this->db->query("
            SELECT * FROM donhang ORDER BY ngaydat DESC
        ")->fetchAll();
    }

    // Tìm một đơn hàng theo ID
    public function find($id) {
        // Chuẩn bị câu lệnh SQL với tham số để tránh SQL injection
        $stm = $this->db->prepare("SELECT * FROM donhang WHERE id_donhang=:id");
        // Thực thi với tham số id
        $stm->execute([':id'=>$id]);
        // Trả về kết quả đầu tiên (hoặc false nếu không tìm thấy)
        return $stm->fetch();
    }

    // Tạo đơn hàng mới với thông tin khách hàng
    public function create($hoten, $sdt, $diachi) {
        // Chuẩn bị câu lệnh INSERT với các tham số
        $stm = $this->db->prepare("
            INSERT INTO donhang(hoten_kh,sdt,diachi)
            VALUES(:ho,:sdt,:dc)
        ");
        // Thực thi với các giá trị được truyền vào
        $stm->execute([':ho'=>$hoten,':sdt'=>$sdt,':dc'=>$diachi]);
        // Trả về ID của đơn hàng vừa được tạo
        return $this->db->lastInsertId();
    }

    // Cập nhật thông tin đơn hàng bởi admin (chỉ cập nhật thông tin khách hàng)
    public function adminUpdate($id,$ho,$sdt,$dc) {
        // Chuẩn bị câu lệnh UPDATE
        $stm = $this->db->prepare("
            UPDATE donhang SET hoten_kh=:ho,sdt=:sdt,diachi=:dc WHERE id_donhang=:id
        ");
        // Thực thi và trả về kết quả
        return $stm->execute([':ho'=>$ho,':sdt'=>$sdt,':dc'=>$dc,':id'=>$id]);
    }

    // Cập nhật tổng tiền của đơn hàng (sau khi thêm chi tiết đơn hàng)
    public function updateTongTien($id,$tong) {
        // Chuẩn bị câu lệnh UPDATE tổng tiền
        $stm = $this->db->prepare("
            UPDATE donhang SET tongtien=:t WHERE id_donhang=:id
        ");
        // Thực thi với tổng tiền và ID đơn hàng
        return $stm->execute([':t'=>$tong,':id'=>$id]);
    }

    // Xóa đơn hàng theo ID
    public function delete($id) {
        // Chuẩn bị câu lệnh DELETE
        $stm = $this->db->prepare("DELETE FROM donhang WHERE id_donhang=:id");
        // Thực thi và trả về kết quả
        return $stm->execute([':id'=>$id]);
    }
}
