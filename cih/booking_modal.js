/* CIH BỆNH VIỆN QUỐC TẾ CITY - LUXURY GRADIENT BOOKING MODAL */
(function() {
  const CIH_BOOKING_CATALOG = [
    {
      slug: 'khoa-phu-san',
      aliases: ['khoa-phu-san', 'phu-san'],
      name: 'Khoa Phụ Sản',
      doctors: [
        { name: 'BS.CKII. Nguyễn Vũ Mỹ Linh', role: 'Phó Trưởng Khoa Phụ Sản' },
        { name: 'BS.CKII. Phạm Minh Khôi Nguyên', role: 'Bác sĩ Khoa Phụ Sản' },
        { name: 'BS.CKII. Trần Thế Lộc', role: 'Bác sĩ Khoa Phụ Sản' },
        { name: 'BS.CKI. Nguyễn Ngân Hà', role: 'Bác sĩ Khoa Phụ Sản' },
        { name: 'ThS.BS. Nguyễn Xuân Công', role: 'Bác sĩ Siêu âm Khoa Phụ Sản' }
      ]
    },
    {
      slug: 'khoa-ho-tro-sinh-san-ivf',
      aliases: ['khoa-ho-tro-sinh-san-ivf', 'ivf'],
      name: 'Trung tâm Hỗ trợ sinh sản (IVF)',
      doctors: [
        { name: 'BS.CKI. Nguyễn Thị Ngọc Sương', role: 'Trưởng Trung tâm Hỗ trợ sinh sản' },
        { name: 'Thạc sĩ Đặng Trường Sơn', role: 'Phó Trưởng Trung tâm Hỗ trợ sinh sản' },
        { name: 'BS.CKII. Cù Thị Kim Loan', role: 'Bác sĩ Trung tâm Hỗ trợ sinh sản' }
      ]
    },
    {
      slug: 'khoa-nhi',
      aliases: ['khoa-nhi', 'khoa-hoi-suc-tich-cuc-so-sinh-nicu', 'nhi'],
      name: 'Khoa Nhi & Hồi sức tích cực sơ sinh (NICU)',
      doctors: [
        { name: 'BS.CKII. Nguyễn Bạch Huệ', role: 'Trưởng khoa Nhi & NICU' },
        { name: 'BS.CKII. Nguyễn Thị Hồng Cẩm', role: 'Bác sĩ Chuyên khoa Tim mạch Nhi' },
        { name: 'BS.CKII. Dương Thị Kim Cúc', role: 'Bác sĩ Ngoại Nhi, Tiết Niệu' },
        { name: 'BS.CKI. Nguyễn Thị Lệ Liễu', role: 'Bác sĩ Chuyên khoa Nhi' },
        { name: 'BS.CKI. Nguyễn Xuân Tài', role: 'Bác sĩ Chuyên khoa Nhi' }
      ]
    },
    {
      slug: 'khoa-kham-tong-quat-ehs',
      aliases: ['khoa-kham-tong-quat-ehs', 'khoa-kham-tong-quat', 'khoa-kham-benh', 'tong-quat'],
      name: 'Khoa Khám Tổng Quát (EHS) & Khám Bệnh',
      doctors: [
        { name: 'BS.CKII. Trần Thanh Bình', role: 'Trưởng Khoa Khám bệnh' },
        { name: 'ThS.BS. Trần Như Hải', role: 'Trưởng Phòng khám Quốc tế - Cố vấn cấp cao' },
        { name: 'BS.CKII. Hà Thị Kim Hồng', role: 'Bác sĩ Khám Tổng Quát & Nội Tiết' },
        { name: 'ThS.BS. Đỗ Đức Tín', role: 'Bác sĩ Chuyên khoa Khám sức khỏe Tổng quát' },
        { name: 'BS.CKII. Dương Anh Phượng', role: 'Trưởng khoa Nội Tổng Quát' },
        { name: 'BS.CKII. Nguyễn Bảo Hòa', role: 'Bác sĩ Da liễu & Nội Cơ Xương Khớp' },
        { name: 'BS.CKI. Lê Thị Ngọc Trân', role: 'Bác sĩ Chuyên khoa Dinh Dưỡng' }
      ]
    },
    {
      slug: 'khoa-noi-tong-hop',
      aliases: ['khoa-noi-tong-hop', 'noi-tong-quat'],
      name: 'Khoa Nội Tổng Quát',
      doctors: [
        { name: 'BS.CKII. Dương Anh Phượng', role: 'Trưởng khoa Nội Tổng Quát' },
        { name: 'ThS.BS.CKII. Hoàng Chân Phương', role: 'Bác sĩ Chuyên khoa Nội Tổng Quát' },
        { name: 'ThS.BS. Trần Như Hải', role: 'Bác sĩ Nội Tổng Quát - Trưởng Phòng khám Quốc tế' },
        { name: 'BS.CKII. Trần Thanh Bình', role: 'Trưởng Khoa Khám bệnh' },
        { name: 'BS.CKII. Hà Thị Kim Hồng', role: 'Bác sĩ Khám Tổng Quát & Nội Tiết' }
      ]
    },
    {
      slug: 'khoa-tim-mach',
      aliases: ['khoa-tim-mach', 'tim-mach'],
      name: 'Khoa Tim Mạch',
      doctors: [
        { name: 'BS.CKII. Nguyễn Ngọc Quỳnh Dung', role: 'Bác sĩ Nội Tim mạch' },
        { name: 'ThS.BS. Bùi Thị Xuân Nga', role: 'Bác sĩ Chuyên khoa Tim Mạch' },
        { name: 'ThS.BS.CKI. Trần Thế Vinh', role: 'Bác sĩ Chuyên khoa Tim Mạch' },
        { name: 'BS.CKI. Lê Văn Tuyến', role: 'Bác sĩ Chuyên khoa Tim Mạch' },
        { name: 'BS.CKII. Nguyễn Thị Hồng Cẩm', role: 'Bác sĩ Chuyên khoa Tim mạch Nhi' }
      ]
    },
    {
      slug: 'khoa-can-thiep-mach-mau',
      aliases: ['khoa-can-thiep-mach-mau', 'khoa-can-thiep-mach-mau-dsa'],
      name: 'Khoa Can Thiệp Mạch Máu (DSA)',
      doctors: [
        { name: 'PGS.TS.BS. Trần Minh Hoàng', role: 'Trưởng Đơn vị Can thiệp mạch máu (DSA)' },
        { name: 'ThS.BS.CKI. Trần Thế Vinh', role: 'Bác sĩ Tim mạch – Tim mạch can thiệp' },
        { name: 'BS.CKI. Lê Văn Tuyến', role: 'Bác sĩ Tim mạch – Tim mạch can thiệp' }
      ]
    },
    {
      slug: 'khoa-noi-tieu-hoa',
      aliases: ['khoa-noi-tieu-hoa', 'khoa-tieu-hoa-noi-soi', 'noi-soi-tieu-hoa', 'tieu-hoa'],
      name: 'Trung tâm Tiêu hóa – Nội soi',
      doctors: [
        { name: 'BS.CKII. Lê Kim Sang', role: 'Trưởng Khoa Tiêu Hóa & Nội Soi Tiêu Hóa' },
        { name: 'BS.CKII. Đinh Đức Minh', role: 'Bác sĩ Chuyên khoa Nội soi Tiêu hóa' }
      ]
    },
    {
      slug: 'khoa-noi-than-kinh',
      aliases: ['khoa-noi-than-kinh', 'khoa-than-kinh'],
      name: 'Khoa Nội Thần Kinh',
      doctors: [
        { name: 'ThS.BS. Trần Thị Mai Thy', role: 'Bác sĩ Chuyên khoa Nội Thần Kinh' },
        { name: 'BS.CKI. Khúc Thừa Minh', role: 'Bác sĩ Chuyên khoa Nội Thần Kinh' },
        { name: 'ThS.BS. Đỗ Đức Tín', role: 'Bác sĩ Nội Thần Kinh & Khám Tổng Quát' }
      ]
    },
    {
      slug: 'khoa-ngoai-than-kinh',
      aliases: ['khoa-ngoai-than-kinh'],
      name: 'Khoa Ngoại Thần Kinh',
      doctors: [
        { name: 'BS.CKI. Nguyễn Mạnh Hùng', role: 'Bác sĩ Ngoại Thần kinh - Cố vấn Cấp cao BGĐ' },
        { name: 'TS.BS. Huỳnh Hồng Châu', role: 'Bác sĩ Khoa Ngoại Thần kinh' },
        { name: 'ThS.BS.CKII. Trần Trọng Tâm', role: 'Bác sĩ Ngoại Thần kinh' },
        { name: 'BS.CKI. Nguyễn Quốc Giang', role: 'Bác sĩ Ngoại Thần kinh' }
      ]
    },
    {
      slug: 'khoa-ngoai-tong-quat',
      aliases: ['khoa-ngoai-tong-quat'],
      name: 'Khoa Ngoại Tổng Quát',
      doctors: [
        { name: 'BS.CKII. Nguyễn Bảo Xuân Thanh', role: 'Trưởng Khoa Ngoại Tổng Quát' },
        { name: 'ThS.BS. Nguyễn Văn Khoa', role: 'Bác sĩ Khoa Ngoại Tổng Quát' },
        { name: 'ThS.BS.CKI. Hà Phú Xuân', role: 'Bác sĩ Khoa Ngoại Tổng Quát' }
      ]
    },
    {
      slug: 'khoa-chan-thuong-chinh-hinh',
      aliases: ['khoa-chan-thuong-chinh-hinh', 'cot-song'],
      name: 'Khoa Chấn Thương Chỉnh Hình & Cơ Xương Khớp',
      doctors: [
        { name: 'TS.BS. Phạm Chí Lăng', role: 'Trưởng khoa Chấn Thương Chỉnh Hình' },
        { name: 'ThS.BS. Trần Văn Bé Bảy', role: 'Bác sĩ Chấn Thương Chỉnh Hình & Cơ Xương Khớp' },
        { name: 'BS.CKI. Nguyễn Văn Tịnh', role: 'Bác sĩ điều trị Chấn thương Chỉnh hình' },
        { name: 'BS.CKII. Nguyễn Bảo Hòa', role: 'Bác sĩ Nội Cơ Xương Khớp & Da liễu' }
      ]
    },
    {
      slug: 'khoa-tiet-nieu',
      aliases: ['khoa-tiet-nieu', 'khoa-than-loc-mau'],
      name: 'Khoa Tiết Niệu & Thận Lọc Máu',
      doctors: [
        { name: 'BS.CKII. Dương Thị Kim Cúc', role: 'Bác sĩ Ngoại Nhi, Tiết Niệu' },
        { name: 'BS.CKI. Nguyễn Thị Thái Hà', role: 'Bác sĩ Chuyên khoa Tiết Niệu' }
      ]
    },
    {
      slug: 'khoa-tai-mui-hong',
      aliases: ['khoa-tai-mui-hong', 'trung-tam-tai-mui-hong-va-phau-thuat-dau-co'],
      name: 'Trung tâm Tai Mũi Họng & Phẫu thuật đầu cổ',
      doctors: [
        { name: 'ThS.BS. Nguyễn Lê Nhân Văn', role: 'Bác sĩ Chuyên khoa Tai Mũi Họng' },
        { name: 'BS.CKI. Lê Ngọc Hiếu', role: 'Bác sĩ Chuyên khoa Tai Mũi Họng' }
      ]
    },
    {
      slug: 'khoa-mat',
      aliases: ['khoa-mat'],
      name: 'Khoa Mắt',
      doctors: [
        { name: 'BS.CKII. Trịnh Bạch Tuyết', role: 'Bác sĩ Trưởng khoa Mắt' },
        { name: 'BS.CKI. Mai Thị Hương Thảo', role: 'Bác sĩ Khoa Mắt' }
      ]
    },
    {
      slug: 'khoa-da-lieu',
      aliases: ['khoa-da-lieu'],
      name: 'Khoa Da Liễu',
      doctors: [
        { name: 'BS. Lê Đức Thọ', role: 'Bác sĩ Chuyên khoa Da liễu' },
        { name: 'BS.CKII. Nguyễn Bảo Hòa', role: 'Bác sĩ Chuyên khoa Da liễu & Nội cơ xương khớp' }
      ]
    },
    {
      slug: 'khoa-dinh-duong',
      aliases: ['khoa-dinh-duong'],
      name: 'Khoa Dinh Dưỡng',
      doctors: [
        { name: 'BS.CKI. Lê Thị Ngọc Trân', role: 'Bác sĩ Chuyên khoa Dinh Dưỡng' },
        { name: 'ThS.BS. Phạm Trần Thiên Nhân', role: 'Bác sĩ Chuyên khoa Dinh Dưỡng' }
      ]
    },
    {
      slug: 'khoa-phau-thuat-tao-hinh-tham-my',
      aliases: ['khoa-phau-thuat-tao-hinh-tham-my', 'khoa-tham-my'],
      name: 'Trung tâm Thẩm mỹ – Y học tái tạo',
      doctors: [
        { name: 'BS.CKI. Hồ Thanh Phong', role: 'Bác sĩ Phẫu thuật tạo hình thẩm mỹ' }
      ]
    },
    {
      slug: 'khoa-phuc-hoi-chuc-nang',
      aliases: ['khoa-phuc-hoi-chuc-nang'],
      name: 'Khoa Phục Hồi Chức Năng',
      doctors: [
        { name: 'BS.CKI. Trần Phương Thảo', role: 'Bác sĩ Chuyên khoa Phục hồi Chức năng' }
      ]
    },
    {
      slug: 'khoa-chan-doan-hinh-anh',
      aliases: ['khoa-chan-doan-hinh-anh'],
      name: 'Khoa Chẩn Đoán Hình Ảnh',
      doctors: [
        { name: 'PGS.TS.BS. Trần Minh Hoàng', role: 'Trưởng Khoa Chẩn đoán hình ảnh & Đơn vị DSA' },
        { name: 'BS.CKI. Ông Kiến Huy', role: 'Bác sĩ Chuyên khoa Chẩn Đoán Hình Ảnh' }
      ]
    },
    {
      slug: 'khoa-gay-me-hoi-suc',
      aliases: ['khoa-gay-me-hoi-suc'],
      name: 'Khoa Gây Mê Hồi Sức',
      doctors: [
        { name: 'BS.CKI. Nguyễn Minh Tuấn B', role: 'Bác sĩ Khoa Gây mê Hồi sức' }
      ]
    },
    {
      slug: 'khoa-cap-cuu',
      aliases: ['khoa-cap-cuu', 'khoa-hoi-suc-tich-cuc-icu'],
      name: 'Khoa Cấp Cứu & Hồi sức tích cực (ICU)',
      doctors: [
        { name: 'ThS.BS.CKII. Nguyễn Văn Nhôm', role: 'Trưởng Khoa Cấp Cứu – Hồi sức Tích cực' },
        { name: 'ThS.BS. Nguyễn Phước Lộc', role: 'Bác sĩ Chuyên khoa Hồi Sức Tích Cực' },
        { name: 'BS.CKI. Lê Quốc Khánh', role: 'Bác sĩ Khoa Cấp cứu' },
        { name: 'BS.CKI. Trương Thanh Phương', role: 'Bác sĩ Khoa Cấp cứu' },
        { name: 'BS. Trần Hiếu', role: 'Bác sĩ Khoa Cấp cứu' }
      ]
    },
    {
      slug: 'khoa-rang-ham-mat',
      aliases: ['khoa-rang-ham-mat'],
      name: 'Khoa Răng Hàm Mặt',
      doctors: [
        { name: 'Bác sĩ Chuyên khoa Răng Hàm Mặt CIH', role: 'Khoa Răng Hàm Mặt' }
      ]
    },
    {
      slug: 'trung-tam-tiem-chung',
      aliases: ['trung-tam-tiem-chung'],
      name: 'Trung Tâm Tiêm Chủng',
      doctors: [
        { name: 'BS.CKII. Nguyễn Bạch Huệ', role: 'Trưởng khoa Nhi & Tư vấn Tiêm chủng' },
        { name: 'BS.CKI. Nguyễn Thị Lệ Liễu', role: 'Bác sĩ Khám sàng lọc Tiêm chủng' },
        { name: 'BS.CKI. Nguyễn Xuân Tài', role: 'Bác sĩ Khám sàng lọc Tiêm chủng' }
      ]
    }
  ];

  window.CIH_BOOKING_CATALOG = CIH_BOOKING_CATALOG;

  function resolveSpecialtyBySlug(rawSlug) {
    if (!rawSlug) return null;
    const clean = rawSlug.trim().toLowerCase();
    return CIH_BOOKING_CATALOG.find(
      s => s.slug === clean || (s.aliases && s.aliases.includes(clean))
    ) || null;
  }

  function normalizeTextKey(str) {
    return (str || '')
      .toLowerCase()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/đ/g, 'd')
      .replace(/[^a-z0-9]/g, '');
  }

  function findDoctorSpecialty(doctorName) {
    if (!doctorName || doctorName === 'Bác sĩ khám bất kỳ') return null;
    const key = normalizeTextKey(doctorName);
    for (const spec of CIH_BOOKING_CATALOG) {
      for (const d of spec.doctors) {
        if (normalizeTextKey(d.name) === key || key.includes(normalizeTextKey(d.name)) || normalizeTextKey(d.name).includes(key)) {
          return { specSlug: spec.slug, doctorName: d.name };
        }
      }
    }
    return null;
  }

  const specialtyOptionsHTML = CIH_BOOKING_CATALOG.map(
    s => `<option value="${s.slug}">${s.name}</option>`
  ).join('\n                ');

  const modalHTML = `
  <div id="cih-booking-modal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(4, 24, 38, 0.68); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto; font-family: 'Be Vietnam Pro', system-ui, -apple-system, sans-serif;">
    <style>
      #cih-booking-modal *, #cih-booking-modal input, #cih-booking-modal select, #cih-booking-modal textarea, #cih-booking-modal button {
        font-family: 'Be Vietnam Pro', system-ui, -apple-system, sans-serif !important;
        box-sizing: border-box;
      }
      #cih-booking-modal .cih-bk-dialog {
        background: linear-gradient(165deg, #F2FAFD 0%, #FFFFFF 46%, #FDF9EE 100%);
        width: 100%;
        max-width: 650px;
        border-radius: 24px;
        box-shadow: 0 28px 60px -12px rgba(0, 48, 73, 0.38);
        position: relative;
        max-height: 92vh;
        overflow-y: auto;
        border: none;
      }
      #cih-booking-modal .cih-bk-header {
        background: linear-gradient(125deg, #003F5C 0%, #007DA5 52%, #34B3CE 100%);
        padding: 1.35rem 1.75rem;
        border-top-left-radius: 24px;
        border-top-right-radius: 24px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        border-bottom: none;
      }
      #cih-booking-modal .cih-bk-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.22) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
      }
      #cih-booking-modal input, #cih-booking-modal select, #cih-booking-modal textarea {
        width: 100%;
        padding: 0.72rem 0.95rem;
        background: #ffffff;
        border: 1.5px solid #dbe7f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: #0f172a;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 125, 165, 0.04);
        transition: all 0.22s ease;
      }
      #cih-booking-modal input:focus, #cih-booking-modal select:focus, #cih-booking-modal textarea:focus {
        border-color: #007DA5 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3.5px rgba(0, 125, 165, 0.16) !important;
      }
      #cih-booking-modal input::placeholder, #cih-booking-modal textarea::placeholder {
        color: #94a3b8;
        font-size: 0.875rem;
      }
      #cih-booking-modal label {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.38rem;
      }
      .cih-form-group {
        margin-bottom: 0.95rem;
      }
      .cih-section-title {
        font-size: 0.86rem;
        font-weight: 800;
        background: linear-gradient(90deg, #005B7F 0%, #007DA5 60%, #1CA3C4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: #007DA5;
        margin: 1.15rem 0 0.8rem 0;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
      }
      .cih-section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 15px;
        background: linear-gradient(180deg, #007DA5 0%, #34B3CE 100%);
        border-radius: 3px;
      }
      .cih-bk-submit-btn {
        width: 100%;
        background: linear-gradient(135deg, #004E6E 0%, #007DA5 48%, #2CB1CE 100%);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.28);
        padding: 0.92rem 1.5rem;
        border-radius: 999px;
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: 0.6px;
        cursor: pointer;
        box-shadow: 0 10px 24px rgba(0, 125, 165, 0.32), inset 0 1px 0 rgba(255, 255, 255, 0.3);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
      }
      .cih-bk-submit-btn:hover {
        background: linear-gradient(135deg, #005E84 0%, #008EBA 48%, #3CC2DF 100%);
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(0, 125, 165, 0.42), inset 0 1px 0 rgba(255, 255, 255, 0.4);
      }
      @media (max-width: 580px) {
        .cih-grid-2col {
          grid-template-columns: 1fr !important;
        }
      }
    </style>
    
    <div class="cih-bk-dialog">
      
      <!-- Modal Header (Luxury Multi-Stop CIH Gradient) -->
      <div class="cih-bk-header">
        <h2 style="font-size: 1.28rem; font-weight: 800; margin: 0; color: #ffffff; letter-spacing: 0.2px; text-shadow: 0 2px 6px rgba(0, 25, 40, 0.25);">ĐĂNG KÝ KHÁM BỆNH</h2>
        <button onclick="closeBookingModal()" aria-label="Đóng" style="width: 34px; height: 34px; border-radius: 50%; border: 1px solid rgba(255, 255, 255, 0.3); background: rgba(255, 255, 255, 0.18); color: #ffffff; font-size: 1.15rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255, 255, 255, 0.32)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.18)'">✕</button>
      </div>

      <!-- Form Content -->
      <div style="padding: 1.5rem 1.75rem 1.65rem;">
        <form onsubmit="handleModalBookingSubmit(event)">
          
          <!-- SECTION 1: LỊCH KHÁM -->
          <div class="cih-section-title" style="margin-top: 0;">Thông tin chuyên khoa &amp; lịch khám</div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Chọn chuyên khoa <span style="color: #e11d48;">*</span></label>
              <select id="modal-bk-specialty" required onchange="updateModalDoctors(this.value)">
                <option value="">-- Chọn Chuyên Khoa --</option>
                ${specialtyOptionsHTML}
              </select>
            </div>

            <div>
              <label>Chọn bác sĩ <span style="color: #e11d48;">*</span></label>
              <select id="modal-bk-doctor" onchange="handleModalDoctorChange(this)">
                <option value="Bác sĩ khám bất kỳ">-- Bác sĩ khám bất kỳ --</option>
              </select>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Chọn ngày khám <span style="color: #e11d48;">*</span></label>
              <input type="text" id="modal-bk-date" required placeholder="dd/mm/yyyy" style="background: #ffffff; cursor: pointer;" />
            </div>

            <div>
              <label>Khung giờ <span style="color: #e11d48;">*</span></label>
              <div style="display: flex; gap: 6px; background: #eef6fa; padding: 4px; border-radius: 12px; border: 1.5px solid #dbe7f0;">
                <button type="button" id="modal-slot-sang" onclick="setModalSlot('Sáng (07:30 - 11:30)', this)" style="flex: 1; padding: 0.46rem; border: none; border-radius: 8px; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: linear-gradient(135deg, #006288 0%, #0088B4 55%, #2CB1CE 100%); color: #fff; box-shadow: 0 3px 10px rgba(0, 125, 165, 0.25); transition: all 0.2s;">🌅 Sáng</button>
                <button type="button" id="modal-slot-chieu" onclick="setModalSlot('Chiều (13:00 - 16:30)', this)" style="flex: 1; padding: 0.46rem; border: none; border-radius: 8px; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: transparent; color: #64748b; transition: all 0.2s;">⛅ Chiều</button>
              </div>
              <input type="hidden" id="modal-bk-timeslot" value="Sáng (07:30 - 11:30)" />
            </div>
          </div>

          <div class="cih-form-group">
            <label>Nhập vấn đề cần khám</label>
            <textarea id="modal-bk-issue" rows="2" placeholder=""></textarea>
          </div>

          <!-- SECTION 2: BỆNH NHÂN -->
          <div class="cih-section-title">Thông tin người đăng ký</div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Họ và tên <span style="color: #e11d48;">*</span></label>
              <input type="text" id="modal-bk-fullname" required placeholder="" />
            </div>
            <div>
              <label>Số điện thoại <span style="color: #e11d48;">*</span></label>
              <input type="tel" id="modal-bk-phone" required placeholder="" />
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; margin-bottom: 1.45rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Ngày sinh <span style="color: #e11d48;">*</span></label>
              <input type="text" id="modal-bk-dob" required placeholder="dd/mm/yyyy" style="background: #ffffff; cursor: pointer;" />
            </div>
            <div>
              <label>Mã khách hàng <span style="color: #94a3b8; font-weight: 400;">(Không bắt buộc)</span></label>
              <input type="text" id="modal-bk-code" placeholder="" />
            </div>
          </div>

          <button type="submit" class="cih-bk-submit-btn">
            GỬI
          </button>
        </form>
      </div>

    </div>
  </div>
  `;

  const flatpickrVN = {
    firstDayOfWeek: 1,
    weekdays: {
      shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
      longhand: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
    },
    months: {
      shorthand: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
      longhand: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
    }
  };

  function initVietnameseDatePickers() {
    if (typeof flatpickr !== 'undefined') {
      flatpickr('#modal-bk-date', {
        locale: flatpickrVN,
        dateFormat: 'd/m/Y',
        minDate: 'today',
        defaultDate: new Date(),
        allowInput: true
      });

      flatpickr('#modal-bk-dob', {
        locale: flatpickrVN,
        dateFormat: 'd/m/Y',
        maxDate: 'today',
        allowInput: true
      });

      if (document.getElementById('doc-book-date')) {
        flatpickr('#doc-book-date', {
          locale: flatpickrVN,
          dateFormat: 'd/m/Y',
          minDate: 'today', defaultDate: new Date(), allowInput: true }); } if (document.getElementById('doc-book-dob')) { flatpickr('#doc-book-dob', { locale: flatpickrVN, dateFormat: 'd/m/Y', maxDate: 'today',
          allowInput: true
        });
      }
    }
  }

  function loadFlatpickrAssets() {
    if (!document.getElementById('flatpickr-css')) {
      const link = document.createElement('link');
      link.id = 'flatpickr-css';
      link.rel = 'stylesheet';
      link.href = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css';
      document.head.appendChild(link);
    }
    if (typeof flatpickr === 'undefined' && !document.getElementById('flatpickr-js')) {
      const script = document.createElement('script');
      script.id = 'flatpickr-js';
      script.src = 'https://cdn.jsdelivr.net/npm/flatpickr';
      script.onload = function() {
        initVietnameseDatePickers();
      };
      document.head.appendChild(script);
    } else {
      initVietnameseDatePickers();
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    updateModalDoctors('');
    loadFlatpickrAssets();

    // Attach click events to all booking buttons on the page
    document.querySelectorAll('a[href*="lien-he"][href*="dat-lich"], button[id*="booking"], #header-booking-btn, .btn--primary').forEach(btn => {
      // Do not hijack submit buttons inside forms (e.g., contact form or modal form)
      if (btn.tagName === 'BUTTON' && btn.type === 'submit') return;
      btn.addEventListener('click', function(e) {
        const href = (btn.getAttribute('href') || '').toLowerCase();
        const isBookingBtn =
          btn.id === 'header-booking-btn' ||
          (btn.id && btn.id.includes('booking')) ||
          href.includes('dat-lich') ||
          (btn.textContent && btn.textContent.toUpperCase().includes('ĐẶT LỊCH'));

        if (isBookingBtn || !window.location.href.includes('lien-he')) {
          e.preventDefault();
          openBookingModal();
        }
      });
    });
  });

  window.openBookingModal = function(preSpecSlug, preDocName) {
    const modal = document.getElementById('cih-booking-modal');
    if (!modal) return;

    const specSelect = document.getElementById('modal-bk-specialty');
    const urlParams = new URLSearchParams(window.location.search);
    const pagePath = window.location.pathname.toLowerCase();

    // Auto-detect specialty or doctor context if on specialty detail or doctor detail page
    if (!preSpecSlug && !preDocName && specSelect && !specSelect.value) {
      if (pagePath.includes('chi-tiet-chuyen-khoa')) {
        const pageSlug = urlParams.get('slug') || 'khoa-phu-san';
        const matchedSpec = resolveSpecialtyBySlug(pageSlug);
        if (matchedSpec) {
          preSpecSlug = matchedSpec.slug;
        }
      } else if (pagePath.includes('chi-tiet-bac-si')) {
        const docHeading = document.getElementById('doc-name');
        const currentDocName = docHeading ? docHeading.textContent.trim() : '';
        const matchedDoc = findDoctorSpecialty(currentDocName);
        if (matchedDoc) {
          preSpecSlug = matchedDoc.specSlug;
          preDocName = matchedDoc.doctorName;
        }
      } else if (pagePath.includes('bac-si')) {
        const filterSpec = document.getElementById('filter-specialty');
        if (filterSpec && filterSpec.value) {
          const matchedSpec = resolveSpecialtyBySlug(filterSpec.value);
          if (matchedSpec) preSpecSlug = matchedSpec.slug;
        }
      }
    }

    if (preSpecSlug && specSelect) {
      const resolved = resolveSpecialtyBySlug(preSpecSlug);
      if (resolved) {
        specSelect.value = resolved.slug;
        updateModalDoctors(resolved.slug, preDocName);
      }
    } else if (preDocName) {
      const matched = findDoctorSpecialty(preDocName);
      if (matched && specSelect) {
        specSelect.value = matched.specSlug;
        updateModalDoctors(matched.specSlug, matched.doctorName);
      }
    }

    modal.style.display = 'flex';
    initVietnameseDatePickers();
  };

  window.closeBookingModal = function() {
    const modal = document.getElementById('cih-booking-modal');
    if (modal) modal.style.display = 'none';
  };

  window.setModalSlot = function(slotStr, btn) {
    const sang = document.getElementById('modal-slot-sang');
    const chieu = document.getElementById('modal-slot-chieu');
    [sang, chieu].forEach(el => {
      if (el) {
        el.style.background = 'transparent';
        el.style.color = '#64748b';
        el.style.boxShadow = 'none';
      }
    });

    btn.style.background = 'linear-gradient(135deg, #006288 0%, #0088B4 55%, #2CB1CE 100%)';
    btn.style.color = '#ffffff';
    btn.style.boxShadow = '0 3px 10px rgba(0, 125, 165, 0.25)';
    document.getElementById('modal-bk-timeslot').value = slotStr;
  };

  window.updateModalDoctors = function(specSlug, preferredDoctorName) {
    const docSelect = document.getElementById('modal-bk-doctor');
    if (!docSelect) return;

    const currentSelectedDoc = preferredDoctorName || docSelect.value;
    docSelect.innerHTML = '';

    const anyOpt = document.createElement('option');
    anyOpt.value = 'Bác sĩ khám bất kỳ';
    anyOpt.textContent = '-- Bác sĩ khám bất kỳ --';
    docSelect.appendChild(anyOpt);

    const resolvedSpec = resolveSpecialtyBySlug(specSlug);

    if (resolvedSpec) {
      let matchedSelection = false;
      resolvedSpec.doctors.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d.name;
        opt.setAttribute('data-spec', resolvedSpec.slug);
        opt.textContent = d.role ? `${d.name} (${d.role})` : d.name;
        if (currentSelectedDoc && normalizeTextKey(currentSelectedDoc) === normalizeTextKey(d.name)) {
          opt.selected = true;
          matchedSelection = true;
        }
        docSelect.appendChild(opt);
      });
      if (!matchedSelection) {
        docSelect.value = 'Bác sĩ khám bất kỳ';
      }
    } else {
      // When no specialty is chosen yet, group all doctors by specialty so the user can also pick a doctor first
      CIH_BOOKING_CATALOG.forEach(spec => {
        const group = document.createElement('optgroup');
        group.label = spec.name;
        spec.doctors.forEach(d => {
          const opt = document.createElement('option');
          opt.value = d.name;
          opt.setAttribute('data-spec', spec.slug);
          opt.textContent = d.role ? `${d.name} (${d.role})` : d.name;
          group.appendChild(opt);
        });
        docSelect.appendChild(group);
      });
    }
  };

  window.handleModalDoctorChange = function(docSelect) {
    if (!docSelect) return;
    const selectedOpt = docSelect.options[docSelect.selectedIndex];
    if (!selectedOpt) return;

    const docName = docSelect.value;
    if (!docName || docName === 'Bác sĩ khám bất kỳ') return;

    const optSpec = selectedOpt.getAttribute('data-spec');
    const specSelect = document.getElementById('modal-bk-specialty');
    if (specSelect && !specSelect.value && optSpec) {
      specSelect.value = optSpec;
      updateModalDoctors(optSpec, docName);
    }
  };

  window.handleModalBookingSubmit = function(e) {
    e.preventDefault();
    const specSelect = document.getElementById('modal-bk-specialty');
    const specText = specSelect && specSelect.options[specSelect.selectedIndex]
      ? specSelect.options[specSelect.selectedIndex].text
      : '';
    const doctor = document.getElementById('modal-bk-doctor').value || 'Bác sĩ khám bất kỳ';
    const name = document.getElementById('modal-bk-fullname').value;
    const phone = document.getElementById('modal-bk-phone').value;
    const date = document.getElementById('modal-bk-date').value;
    const slot = document.getElementById('modal-bk-timeslot').value;

    alert('🎉 ĐĂNG KÝ KHÁM BỆNH THÀNH CÔNG!\n\n' +
          'Bệnh nhân: ' + name + '\n' +
          'Số điện thoại: ' + phone + '\n' +
          'Chuyên khoa: ' + specText + '\n' +
          'Bác sĩ: ' + doctor + '\n' +
          'Ngày khám: ' + date + ' (' + slot + ')\n\n' +
          'Bộ phận CSKH Bệnh viện Quốc tế City sẽ gọi điện xác nhận lịch hẹn với bạn trong 15 phút.');
    closeBookingModal();
  };
})();
