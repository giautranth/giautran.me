# Hướng dẫn triển khai Landing Page Thẻ hội viên trên WordPress (cih.com.vn)

Tài liệu này hướng dẫn bạn cách tải lên và cấu hình trang **Thẻ thành viên** tại địa chỉ `http://cih.com.vn/the-thanh-vien` sử dụng các tệp tin đã được đóng gói mà không cần chạm vào mã nguồn (code).

---

## 1. Các tệp tin được đóng gói trong thư mục `/cih`

Bạn cần tải thư mục `/cih` này lên hosting của bạn tại đường dẫn Flatsome Child Theme:
`wp-content/themes/flatsome-child/cih/`

Thư mục này bao gồm:
*   `membership.css`: Chứa toàn bộ CSS giao diện trang Thẻ hội viên (độc lập, không ảnh hưởng trang khác).
*   `membership.js`: Chứa mã xử lý hiệu ứng cuộn, phóng to thẻ, accordion FAQ.
*   `acf-membership-fields.json`: Tệp cấu hình dùng để Import vào plugin ACF trên quản trị WordPress.
*   Thư mục `/images`: Chứa các ảnh mẫu (bạc, vàng, bạch kim, kim cương, các banner mặc định).

---

## 2. Các bước triển khai chi tiết

### Bước 1: Tải tệp tin lên Hosting của bạn
Dùng FTP (như FileZilla) hoặc trình quản lý tệp trên cPanel để tải các file lên theme Flatsome Child:
1.  Tải file `page-membership.php` vào thư mục:
    `wp-content/themes/flatsome-child/page-membership.php`
2.  Tải toàn bộ thư mục `cih/` (bao gồm `membership.css`, `membership.js`, `acf-membership-fields.json` và thư mục con `images/`) vào thư mục:
    `wp-content/themes/flatsome-child/cih/`

### Bước 2: Import cấu hình quản trị ACF (Advanced Custom Fields)
1.  Cài đặt và kích hoạt plugin **Advanced Custom Fields (ACF)** (hoặc bản ACF Pro) trên website của bạn.
2.  Trong trang quản trị WordPress, truy cập mục **ACF > Tools** (hoặc **Custom Fields > Tools**).
3.  Tại phần **Import Field Groups**, nhấn nút **Chọn tệp** (Choose File) và chọn tệp tin `acf-membership-fields.json` (nằm trong thư mục `wp-content/themes/flatsome-child/cih/` mà bạn đã tải về máy tính).
4.  Nhấn nút **Import File**. Sau khi thành công, bạn sẽ thấy nhóm trường quản trị **CIH Membership Page Fields** xuất hiện.

### Bước 3: Tạo Trang mới trên WordPress
1.  Truy cập mục **Trang > Thêm trang mới** (Pages > Add New).
2.  Đặt tiêu đề cho trang là: **Thẻ thành viên** (đường dẫn tự động tạo sẽ là `/the-thanh-vien`).
3.  Ở khung thuộc tính trang phía bên phải (Page Attributes), phần **Giao diện** (Template), hãy chọn: **CIH Membership Template**.
4.  Nhấn **Đăng** (Publish).

### Bước 4: Nhập liệu nội dung (Không cần chạm vào code)
Sau khi chọn đúng Template ở Bước 3 và lưu trang, kéo xuống phía dưới nội dung trang sửa đổi trên WordPress, bạn sẽ nhìn thấy giao diện nhập liệu trực quan được tự động sinh ra:
*   **Banner Slider**: Nhấn *Thêm Slide* để tải lên các hình ảnh banner mong muốn.
*   **Danh sách các hạng thẻ**: Bạn có thể sửa tên thẻ, tải lên ảnh thẻ riêng, đổi giá tiền, và nhập các quyền lợi (mỗi quyền lợi xuống một dòng) cho 4 hạng thẻ.
*   **Bảng so sánh chi tiết**:
    *   Bạn có thể thay đổi, thêm hoặc bớt các hàng.
    *   *Tiêu đề nhóm* (Group Header) dùng để phân loại (ví dụ: "Khám chuyên khoa").
    *   *Quyền lợi chi tiết* (Feature Row) dùng để điền chi tiết. Bạn nhập `checked` để hiện dấu tích vàng, `unchecked` để hiện dấu X, hoặc nhập chữ bất kỳ (ví dụ: "Giảm 5%", "Tối đa 1 lần/tháng"). Giao diện sẽ tự động chuyển thành icon tương ứng.
*   **Quy tắc tích điểm**: Chỉnh sửa văn bản và bullet points qua ô soạn thảo Word trực quan (WYSIWYG).
*   **Điều khoản chương trình**: Chỉnh sửa danh sách điều khoản trực quan.
*   **Câu hỏi thường gặp (FAQs)**: Thêm câu hỏi và câu trả lời trực tiếp.
*   **Shortcode Form Đăng ký**: Mặc định là `[forminator_form id="45718"]`. Nếu bạn tạo form khác có ID khác, chỉ cần đổi số ID trong ô này.

---

## 3. Một số lưu ý về tài nguyên ảnh
*   Các hình ảnh mặc định của thẻ nằm ở thư mục: `/wp-content/themes/flatsome-child/cih/images/`
    *   Thẻ Bạc: `bac.jpg`
    *   Thẻ Vàng: `vang.jpg`
    *   Thẻ Bạch Kim: `bach_kim.jpg`
    *   Thẻ Kim Cương: `kim_cuong.jpg`
*   Khi bạn cấu hình qua ACF ở Bước 4, bạn có thể tải lên bất kỳ ảnh nào từ thư viện Media của WordPress mà không bắt buộc phải dùng các tên file cứng này.
