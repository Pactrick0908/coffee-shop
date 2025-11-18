# 🔧 Hướng dẫn sửa Commit Message trên GitHub

## Cách 1: Sửa trực tiếp trên GitHub Web (Dễ nhất)

### Bước 1: Truy cập commit cần sửa
1. Vào repository: https://github.com/Pactrick0908/coffee-shop
2. Click vào tab **"Commits"** (hoặc vào link: https://github.com/Pactrick0908/coffee-shop/commits)
3. Tìm commit `f42e7e4` - "Initial commit: Coffee Shop website..."
4. Click vào commit đó để xem chi tiết

### Bước 2: Sửa commit message
1. Ở trang chi tiết commit, click vào biểu tượng **bút chì (✏️)** hoặc **"Edit"** bên cạnh commit message
2. Sửa message thành:
   ```
   Initial commit: Coffee Shop website - Quản lý quán cà phê với đầy đủ chức năng
   ```
3. Click **"Save"** hoặc **"Update commit"**

**Lưu ý:** GitHub chỉ cho phép sửa commit message nếu:
- Bạn là chủ sở hữu repository
- Commit chưa được merge vào branch chính của người khác
- Repository không bị khóa

---

## Cách 2: Sửa bằng Git Command Line (Nâng cao)

Nếu không thể sửa trên GitHub, có thể dùng interactive rebase:

### Bước 1: Mở interactive rebase
```bash
git rebase -i f42e7e4^
```

### Bước 2: Trong editor, thay `pick` thành `reword` (hoặc `r`)
```
reword f42e7e4 Initial commit: Coffee Shop website...
```

### Bước 3: Sửa commit message
Sửa thành:
```
Initial commit: Coffee Shop website - Quản lý quán cà phê với đầy đủ chức năng
```

### Bước 4: Force push (CẨN THẬN!)
```bash
git push --force origin main
```

**⚠️ CẢNH BÁO:** Force push sẽ ghi đè lịch sử trên GitHub. Chỉ làm nếu bạn chắc chắn!

---

## Cách 3: Tạo commit mới với message đúng (An toàn nhất)

Nếu không muốn sửa commit cũ, có thể tạo commit mới:

```bash
# Tạo file trống để commit
git commit --allow-empty -m "Fix: Sửa lại commit message - Quản lý quán cà phê với đầy đủ chức năng"
git push
```

---

## Khuyến nghị

**Nên dùng Cách 1** (sửa trên GitHub web) vì:
- ✅ Dễ nhất, không cần command line
- ✅ An toàn, không ảnh hưởng đến lịch sử
- ✅ GitHub tự động xử lý encoding

**Tránh Cách 2** (force push) trừ khi:
- Bạn chắc chắn không ai khác đang làm việc với repository
- Bạn hiểu rõ rủi ro của force push

