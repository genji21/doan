# Hướng dẫn Cài đặt và Chạy Dự án Travela

Tài liệu này hướng dẫn chi tiết cách cài đặt môi trường và khởi chạy source code PHP (Laravel) và Python (Recommendation Service).

## 1. Yêu cầu hệ thống (Prerequisites)

Hãy đảm bảo máy của bạn đã cài đặt các công cụ sau:

- **PHP**: Phiên bản 8.0 trở lên.
- **Composer**: Trình quản lý thư viện cho PHP.
- **Node.js & npm**: Để build assets frontend.
- **Python**: Phiên bản 3.8 trở lên.
- **MySQL**: Cơ sở dữ liệu.

---

## 2. Cài đặt và Chạy Backend PHP (Laravel)

Source code Laravel nằm ở thư mục gốc của dự án.

### Bước 1: Cài đặt thư viện PHP
Mở terminal tại thư mục gốc của dự án và chạy:
```bash
composer install
```

### Bước 2: Cài đặt thư viện Frontend
Chạy các lệnh sau để cài đặt và build assets:
```bash
npm install
npm run build
# Hoặc dùng 'npm run dev' nếu muốn hot-reload trong quá trình code
```

### Bước 3: Cấu hình môi trường (.env)
Sao chép file cấu hình mẫu:
```bash
cp .env.example .env
```
Mở file `.env` và cập nhật thông tin kết nối database tương ứng với máy của bạn:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travela
DB_USERNAME=root
DB_PASSWORD=your_password
```
*Lưu ý: Hãy tạo database trống tên là `travela` (hoặc tên bạn cấu hình) trong MySQL trước khi tiếp tục.*

### Bước 4: Tạo key và khởi tạo Database
```bash
php artisan key:generate
php artisan migrate --seed
```
*Lưu ý: Lệnh `migrate --seed` sẽ tạo bảng và dữ liệu mẫu.*

### Bước 5: Chạy server Laravel
```bash
php artisan serve
```
Mặc định server sẽ chạy tại `http://127.0.0.1:8000`.

---

## 3. Cài đặt và Chạy Service Python (Recommendation System)

Service này nằm trong thư mục `recommendation-service`.

### Bước 1: Di chuyển vào thư mục service
```bash
cd recommendation-service
```

### Bước 2: Tạo môi trường ảo (Virtual Environment) - Khuyến nghị
```bash
# Mac/Linux
python3 -m venv venv
source venv/bin/activate

# Windows
python -m venv venv
venv\Scripts\activate
```

### Bước 3: Cài đặt thư viện Python
```bash
pip install -r requirements.txt
```

### Bước 4: Cấu hình môi trường (.env)
Tạo file `.env` bên trong thư mục `recommendation-service` và thêm cấu hình database giống như file `.env` của Laravel:
```bash
# Tạo file .env
touch .env
```
Nội dung file `recommendation-service/.env`:
```ini
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travela
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Bước 5: Chạy Service Python
**LƯU Ý QUAN TRỌNG:** Laravel đang được cấu hình để gọi service Python qua cổng **8001**. Vì vậy bạn cần chỉ định cổng 8001 khi chạy.

```bash
uvicorn main:app --reload --port 8001
```

Nếu chạy thành công, bạn sẽ thấy thông báo server đang chạy tại `http://127.0.0.1:8001`.

---

## 4. Kiểm tra hoạt động

1.  Truy cập web Laravel tại: [http://127.0.0.1:8000](http://127.0.0.1:8000)
2.  Xem chi tiết một tour bất kỳ. Nếu phần "Gợi ý tour" hiển thị hoặc không báo lỗi, nghĩa là kết nối giữa Laravel và Python đã thành công.
3.  Bạn cũng có thể kiểm tra API Python trực tiếp tại: [http://127.0.0.1:8001/docs](http://127.0.0.1:8001/docs) (Giao diện Swagger UI).

## 5. Các lưu ý khi phát triển

Bạn nên mở 3 terminal riêng biệt để duy trì server:
1.  Terminal 1: `php artisan serve` (Laravel)
2.  Terminal 2: `npm run dev` (Vite assets - Optional nếu đã run build)
3.  Terminal 3: `uvicorn main:app --reload --port 8001` (Python Service)
