<?php
// Model quản lý đồ uống (CRUD operations)
class Douong {
    // Lưu trữ đối tượng PDO để thực hiện truy vấn
    private $db;
    // Constructor: nhận đối tượng PDO và lưu vào thuộc tính $db
    public function __construct(PDO $pdo) { $this->db = $pdo; }

    // Lấy tất cả đồ uống, sắp xếp theo ID giảm dần (mới nhất trước)
    public function all() {
        return $this->db->query("SELECT * FROM douong ORDER BY id_douong DESC")->fetchAll();
    }

    // Tìm một đồ uống theo ID
    public function find($id) {
        // Chuẩn bị câu lệnh SQL với tham số để tránh SQL injection
        $stm = $this->db->prepare("SELECT * FROM douong WHERE id_douong=:id");
        // Thực thi với tham số id
        $stm->execute([':id'=>$id]);
        // Trả về kết quả đầu tiên (hoặc false nếu không tìm thấy)
        return $stm->fetch();
    }

    // Tạo đồ uống mới
    public function create($ten, $gia, $loai, $hinh) {
        // Chuẩn bị câu lệnh INSERT với các tham số
        $stm = $this->db->prepare("
            INSERT INTO douong(ten,gia,loai,hinh_anh)
            VALUES(:ten,:gia,:loai,:hinh)
        ");
        // Thực thi với các giá trị được truyền vào
        $stm->execute([
            ':ten'=>$ten,   // Tên đồ uống
            ':gia'=>$gia,   // Giá
            ':loai'=>$loai, // Loại
            ':hinh'=>$hinh  // Đường dẫn hình ảnh
        ]);
        // Trả về ID của bản ghi vừa được tạo
        return $this->db->lastInsertId();
    }

    // Cập nhật thông tin đồ uống
    public function update($id, $ten, $gia, $loai, $hinh=null) {
        // Nếu không có hình mới, chỉ cập nhật thông tin (giữ nguyên hình cũ)
        if ($hinh===null) {
            $stm = $this->db->prepare("
                UPDATE douong SET ten=:ten, gia=:gia, loai=:loai WHERE id_douong=:id
            ");
            // Thực thi và trả về kết quả (true/false)
            return $stm->execute([':ten'=>$ten,':gia'=>$gia,':loai'=>$loai,':id'=>$id]);
        }
        // Nếu có hình mới, cập nhật cả hình ảnh
        $stm = $this->db->prepare("
            UPDATE douong SET ten=:ten, gia=:gia, loai=:loai, hinh_anh=:hinh WHERE id_douong=:id
        ");
        // Thực thi với tất cả các tham số bao gồm hình ảnh
        return $stm->execute([':ten'=>$ten,':gia'=>$gia,':loai'=>$loai,':hinh'=>$hinh,':id'=>$id]);
    }

    // Xóa đồ uống theo ID
    public function delete($id) {
        // Chuẩn bị câu lệnh DELETE
        $stm = $this->db->prepare("DELETE FROM douong WHERE id_douong=:id");
        // Thực thi và trả về kết quả
        return $stm->execute([':id'=>$id]);
    }
}
