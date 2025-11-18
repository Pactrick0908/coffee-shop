<?php
// Model quản lý chi tiết đơn hàng (các món trong đơn hàng)
class Chitietdonhang {
    // Lưu trữ đối tượng PDO để thực hiện truy vấn
    private $db;
    // Constructor: nhận đối tượng PDO và lưu vào thuộc tính $db
    public function __construct(PDO $pdo) { $this->db = $pdo; }

    // Lấy tất cả chi tiết đơn hàng theo ID đơn hàng, kèm thông tin đồ uống
    public function getByDonhang($id) {
        // Chuẩn bị câu lệnh JOIN để lấy thông tin đồ uống kèm theo
        $stm = $this->db->prepare("
            SELECT c.*, d.ten, d.gia
            FROM chitietdonhang c
            JOIN douong d ON c.id_douong = d.id_douong
            WHERE c.id_donhang = :id
        ");
        // Thực thi với ID đơn hàng
        $stm->execute([':id'=>$id]);
        // Trả về tất cả các dòng kết quả
        return $stm->fetchAll();
    }

    // Thêm một món vào chi tiết đơn hàng
    public function addItem($id_dh,$id_du,$sl,$gia) {
        // Tính thành tiền = số lượng * giá
        $tt = $sl*$gia;
        // Chuẩn bị câu lệnh INSERT
        $stm = $this->db->prepare("
            INSERT INTO chitietdonhang(id_donhang,id_douong,soluong,thanhtien)
            VALUES(:dh,:du,:sl,:tt)
        ");
        // Thực thi với các tham số
        $stm->execute([
            ':dh'=>$id_dh,  // ID đơn hàng
            ':du'=>$id_du,  // ID đồ uống
            ':sl'=>$sl,     // Số lượng
            ':tt'=>$tt      // Thành tiền
        ]);
        // Trả về thành tiền để tính tổng
        return $tt;
    }
}
