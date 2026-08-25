/* CIH BỆNH VIỆN QUỐC TẾ CITY - MINIMALIST BRAND BOOKING MODAL (#007DA5) */
(function() {
  const modalHTML = `
  <div id="cih-booking-modal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0, 26, 40, 0.65); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto; font-family: 'Lexend', 'Inter', system-ui, -apple-system, sans-serif;">
    <style>
      #cih-booking-modal *, #cih-booking-modal input, #cih-booking-modal select, #cih-booking-modal textarea, #cih-booking-modal button {
        font-family: 'Lexend', 'Inter', system-ui, -apple-system, sans-serif !important;
        box-sizing: border-box;
      }
      #cih-booking-modal input, #cih-booking-modal select, #cih-booking-modal textarea {
        width: 100%;
        padding: 0.7rem 0.9rem;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #0f172a;
        outline: none;
        transition: all 0.2s ease;
      }
      #cih-booking-modal input:focus, #cih-booking-modal select:focus, #cih-booking-modal textarea:focus {
        border-color: #007DA5 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(0, 125, 165, 0.15) !important;
      }
      #cih-booking-modal input::placeholder, #cih-booking-modal textarea::placeholder {
        color: #94a3b8;
        font-size: 0.875rem;
      }
      #cih-booking-modal label {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 0.35rem;
      }
      .cih-form-group {
        margin-bottom: 0.9rem;
      }
      .cih-section-title {
        font-size: 0.875rem;
        font-weight: 800;
        color: #007DA5;
        margin: 1.1rem 0 0.75rem 0;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
      }
      .cih-section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 14px;
        background: #007DA5;
        border-radius: 2px;
      }
      @media (max-width: 580px) {
        .cih-grid-2col {
          grid-template-columns: 1fr !important;
        }
      }
    </style>
    
    <div style="background: #ffffff; width: 100%; max-width: 650px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 59, 92, 0.25); position: relative; max-height: 90vh; overflow-y: auto; border: 1px solid #e2e8f0;">
      
      <!-- Modal Header (Official CIH Cyan #007DA5) -->
      <div style="background: linear-gradient(135deg, #007DA5 0%, #005f80 100%); padding: 1.35rem 1.75rem; border-top-left-radius: 24px; border-top-right-radius: 24px; color: #ffffff; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="font-size: 1.3rem; font-weight: 800; margin: 0; color: #ffffff; letter-spacing: -0.2px;">ĐĂNG KÝ KHÁM BỆNH</h2>
        <button onclick="closeBookingModal()" aria-label="Đóng" style="width: 32px; height: 32px; border-radius: 50%; border: none; background: rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 1.3rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255, 255, 255, 0.35)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'">✕</button>
      </div>

      <!-- Form Content -->
      <div style="padding: 1.5rem 1.75rem;">
        <form onsubmit="handleModalBookingSubmit(event)">
          
          <!-- SECTION 1: LỊCH KHÁM -->
          <div class="cih-section-title" style="margin-top: 0;">Thông tin chuyên khoa &amp; lịch khám</div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Chọn chuyên khoa <span style="color: #e11d48;">*</span></label>
              <select id="modal-bk-specialty" required onchange="updateModalDoctors(this.value)">
                <option value="">-- Chọn Chuyên Khoa --</option>
                <option value="khoa-phu-san">Khoa Phụ Sản</option>
                <option value="khoa-nhi">Khoa Nhi</option>
                <option value="ivf">Trung tâm Hỗ trợ sinh sản (IVF)</option>
                <option value="khoa-than-kinh">Khoa Thần Kinh</option>
                <option value="noi-soi-tieu-hoa">Trung tâm Tiêu hóa - Nội soi</option>
                <option value="khoa-ngoai-tong-quat">Khoa Ngoại Tổng Quát</option>
                <option value="khoa-tim-mach">Khoa Tim Mạch</option>
                <option value="khoa-kham-tong-quat">Khoa Khám Tổng Quát (EHS)</option>
              </select>
            </div>

            <div>
              <label>Chọn bác sĩ <span style="color: #e11d48;">*</span></label>
              <select id="modal-bk-doctor" required>
                <option value="">-- Bác sĩ khám bất kỳ --</option>
                <option value="BS.CKII. Nguyễn Vũ Mỹ Linh">BS.CKII. Nguyễn Vũ Mỹ Linh (Trưởng khoa Sản)</option>
                <option value="BS.CKII. Nguyễn Bạch Huệ">BS.CKII. Nguyễn Bạch Huệ (Trưởng khoa Nhi)</option>
                <option value="BS.CKII. Lê Kim Sang">BS.CKII. Lê Kim Sang (Trưởng khoa Tiêu Hóa)</option>
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
              <div style="display: flex; gap: 6px; background: #f1f5f9; padding: 4px; border-radius: 10px; border: 1.5px solid #e2e8f0;">
                <button type="button" id="modal-slot-sang" onclick="setModalSlot('Sáng (07:30 - 11:30)', this)" style="flex: 1; padding: 0.45rem; border: none; border-radius: 7px; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: #007DA5; color: #fff; transition: all 0.2s;">🌅 Sáng</button>
                <button type="button" id="modal-slot-chieu" onclick="setModalSlot('Chiều (13:00 - 16:30)', this)" style="flex: 1; padding: 0.45rem; border: none; border-radius: 7px; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: transparent; color: #64748b; transition: all 0.2s;">⛅ Chiều</button>
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

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.9rem; margin-bottom: 1.5rem;" class="cih-form-group cih-grid-2col">
            <div>
              <label>Ngày sinh <span style="color: #e11d48;">*</span></label>
              <input type="text" id="modal-bk-dob" required placeholder="dd/mm/yyyy" style="background: #ffffff; cursor: pointer;" />
            </div>
            <div>
              <label>Mã khách hàng <span style="color: #94a3b8; font-weight: 400;">(Không bắt buộc)</span></label>
              <input type="text" id="modal-bk-code" placeholder="" />
            </div>
          </div>

          <button type="submit" style="width: 100%; background: linear-gradient(135deg, #007DA5 0%, #005f80 100%); color: #ffffff; border: none; padding: 0.9rem; border-radius: 50px; font-weight: 800; font-size: 1rem; cursor: pointer; box-shadow: 0 6px 18px rgba(0, 125, 165, 0.25); transition: all 0.25s ease;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 10px 24px rgba(0, 125, 165, 0.35)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 6px 18px rgba(0, 125, 165, 0.25)'">
            ĐĂNG KÝ KHÁM BỆNH NGAY →
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
    loadFlatpickrAssets();

    // Attach click events to all booking buttons on the page
    document.querySelectorAll('a[href*="lien-he.html#dat-lich"], button[id*="booking"], .btn--primary').forEach(btn => {
      btn.addEventListener('click', function(e) {
        if (!window.location.href.includes('lien-he.html')) {
          e.preventDefault();
          openBookingModal();
        }
      });
    });
  });

  window.openBookingModal = function() {
    const modal = document.getElementById('cih-booking-modal');
    if (modal) {
      modal.style.display = 'flex';
      initVietnameseDatePickers();
    }
  };

  window.closeBookingModal = function() {
    const modal = document.getElementById('cih-booking-modal');
    if (modal) modal.style.display = 'none';
  };

  window.setModalSlot = function(slotStr, btn) {
    document.getElementById('modal-slot-sang').style.background = 'transparent';
    document.getElementById('modal-slot-sang').style.color = '#64748b';
    document.getElementById('modal-slot-chieu').style.background = 'transparent';
    document.getElementById('modal-slot-chieu').style.color = '#64748b';

    btn.style.background = '#007DA5';
    btn.style.color = '#ffffff';
    document.getElementById('modal-bk-timeslot').value = slotStr;
  };

  window.updateModalDoctors = function(specSlug) {
    const docSelect = document.getElementById('modal-bk-doctor');
    if (!docSelect) return;
    docSelect.innerHTML = '<option value="">-- Bác sĩ khám bất kỳ --</option>';
    
    const docs = {
      'khoa-phu-san': ['BS.CKII. Nguyễn Vũ Mỹ Linh', 'TS.BS.CKII. Trần Việt Thế Phương'],
      'khoa-nhi': ['BS.CKII. Nguyễn Bạch Huệ', 'BS.CKI. Nguyễn Thị Hạnh'],
      'ivf': ['ThS.BS. Lê Thị Bích Châu', 'BS.CKII. Nguyễn Vũ Mỹ Linh'],
      'noi-soi-tieu-hoa': ['BS.CKII. Lê Kim Sang']
    }[specSlug] || ['Bác sĩ Trưởng khoa CIH'];

    docs.forEach(d => {
      const opt = document.createElement('option');
      opt.value = d;
      opt.innerText = d;
      docSelect.appendChild(opt);
    });
  };

  window.handleModalBookingSubmit = function(e) {
    e.preventDefault();
    const name = document.getElementById('modal-bk-fullname').value;
    const phone = document.getElementById('modal-bk-phone').value;
    const date = document.getElementById('modal-bk-date').value;
    const slot = document.getElementById('modal-bk-timeslot').value;

    alert('🎉 ĐĂNG KÝ KHÁM BỆNH THÀNH CÔNG!\n\n' +
          'Bệnh nhân: ' + name + '\n' +
          'Số điện thoại: ' + phone + '\n' +
          'Ngày khám: ' + date + ' (' + slot + ')\n\n' +
          'Bộ phận CSKH Bệnh viện Quốc tế City sẽ gọi điện xác nhận lịch hẹn với bạn trong 15 phút.');
    closeBookingModal();
  };
})();
