# Hướng Dẫn Triển Khai WordPress CMS Chi Hội Bệnh Viện Tư Nhân

Gói theme và CMS hoàn chỉnh cho website **Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam** chuẩn thiết kế **FV Hospital & AIH**.

---

## 1. Cài Đặt Giao Diện (Theme) Trên WordPress

### Cách 1: Cài đặt trực tiếp qua file Zip (Khuyên Dùng)
1. Tải tệp tin `chihoi-theme.zip` (hoặc nén toàn bộ thư mục `wordpress-theme-chihoi/` thành file zip).
2. Đăng nhập trang quản trị WordPress: `https://your-domain.com/wp-admin`.
3. Truy cập **Giao diện > Giao diện (Appearance > Themes)**.
4. Nhấn **Thêm mới (Add New)** > **Tải giao diện lên (Upload Theme)**.
5. Chọn file `chihoi-theme.zip` và nhấn **Cài đặt ngay (Install Now)**.
6. Nhấn **Kích hoạt (Activate)**.

### Cách 2: Tải lên qua FTP / cPanel File Manager
1. Mở FTP hoặc cPanel File Manager.
2. Tải toàn bộ thư mục `wordpress-theme-chihoi` lên đường dẫn:
   `wp-content/themes/chihoi/`
3. Vào trang quản trị WordPress > **Giao diện** > Kích hoạt theme **Chi Hội Bệnh Viện Tư Nhân Phía Nam**.

---

## 2. Tạo Các Trang Nội Dung (Pages & Templates)

Vào mục **Trang > Thêm trang mới (Pages > Add New)** và tạo các trang với Page Template tương ứng:

1. **Trang Chủ**: Giao diện tự động nhận diện `front-page.php`.
2. **Giới Thiệu**: Đặt đường dẫn `/gioi-thieu`, chọn Template: `Template Về Chi Hội`.
3. **Sơ Đồ Cơ Cấu Tổ Chức**: Đặt đường dẫn `/so-do-to-chuc`, chọn Template: `Template Sơ Đồ Tổ Chức`.
4. **Danh Sách Hội Viên**: Đặt đường dẫn `/hoi-vien`, chọn Template: `Template Danh Sách Hội Viên`.
5. **Chương Trình Đào Tạo**: Đặt đường dẫn `/dao-tao`, chọn Template: `Template Đào Tạo CME`.
6. **Tin Tức - Sự Kiện**: Đặt đường dẫn `/tin-tuc`, chọn Template: `Template Tin Tức Sự Kiện`.
7. **Liên Hệ**: Đặt đường dẫn `/lien-he`, chọn Template: `Template Liên Hệ`.

---

## 3. Quản Trị Dữ Liệu CMS

- **Bệnh Viện Hội Viên**: Vào menu **Bệnh Viện Hội Viên** trên Admin để thêm/sửa bệnh viện, địa chỉ, hotline.
- **Khóa Đào Tạo CME**: Vào menu **Đào Tạo CME** để đăng tải lịch khai giảng, chứng chỉ, giảng viên.
- **Văn Bản Quyết Định**: Vào menu **Văn Bản & Quyết Định** để đăng tải Quyết định 160, 170,...
- **Cấu hình chung**: Vào **Cấu Hình Chi Hội** để thay đổi hotline, địa chỉ, slogan.
