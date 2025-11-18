# ⚠️ Hướng dẫn sửa Root Commit (Commit đầu tiên)

## Cảnh báo quan trọng:
- ⚠️ Sẽ phải **force push** - ghi đè lịch sử trên GitHub
- ⚠️ Nếu có người khác đang làm việc với repository, họ sẽ gặp vấn đề
- ⚠️ Chỉ làm nếu bạn chắc chắn và là người duy nhất làm việc với repo

## Các bước:

### Bước 1: Backup (QUAN TRỌNG!)
```bash
# Tạo branch backup
git branch backup-before-rebase
```

### Bước 2: Rebase root commit
```bash
git rebase -i --root
```

### Bước 3: Trong editor, sửa `pick` thành `reword` (hoặc `r`)
```
reword f42e7e4 Initial commit: Coffee Shop website...
```

### Bước 4: Sửa commit message
Sửa thành:
```
Initial commit: Coffee Shop website - Quản lý quán cà phê với đầy đủ chức năng
```

### Bước 5: Lưu và đóng editor

### Bước 6: Force push (CẨN THẬN!)
```bash
git push --force origin main
```

## Nếu gặp lỗi:
```bash
# Hủy rebase
git rebase --abort

# Khôi phục từ backup
git checkout backup-before-rebase
```

