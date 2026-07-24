/* CIH BỆNH VIỆN QUỐC TẾ CITY - INTERACTIVE BOOKING MODAL (TÂM ANH STYLE) */
(function() {
  const modalHTML = `
  <div id="cih-booking-modal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0, 20, 40, 0.75); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div style="background: #ffffff; width: 100%; max-width: 720px; border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.25); position: relative; max-height: 90vh; overflow-y: auto; border: 1px solid #cbd5e1;">
      
      <!-- Close Button -->
      <button onclick="closeBookingModal()" style="position: absolute; top: 1rem; right: 1rem; width: 36px; height: 36px; border-radius: 50%; border: none; background: #f1f5f9; color: #475569; font-size: 1.4rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">×</button>

      <!-- Modal Header -->
      <div style="background: linear-gradient(135deg, #0f3775, #005f80); padding: 1.75rem 2rem; border-top-left-radius: 20px; border-top-right-radius: 20px; color: #ffffff;">
        <span style="background: rgba(255,255,255,0.2); padding: 0.25rem 0.85rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">ĐẶT LỊCH KHÁM TRỰC TUYẾN</span>
        <h2 style="font-size: 1.5rem; font-weight: 900; margin: 0.5rem 0 0; color: #ffffff; text-transform: uppercase;">ĐĂNG KÝ KHÁM BỆNH</h2>
      </div>

      <!-- Form Content -->
      <div style="padding: 1.75rem 2rem;">
        <form onsubmit="handleModalBookingSubmit(event)">
          
          <!-- STEP 1 -->
          <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #e2e8f0; margin-bottom: 1.25rem;">
            <h3 style="font-size: 0.95rem; font-weight: 800; color: #0f3775; margin: 0 0 1rem; display: flex; align-items: center; gap: 6px;">
              <span style="width: 22px; height: 22px; border-radius: 50%; background: #0f3775; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">1</span>
              THÔNG TIN CHUYÊN KHOA & LỊCH KHÁM
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Chọn chuyên khoa <span style="color: #dc2626;">*</span></label>
                <select id="modal-bk-specialty" required style="width: 100%; padding: 0.7rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" onchange="updateModalDoctors(this.value)">
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
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Chọn bác sĩ <span style="color: #dc2626;">*</span></label>
                <select id="modal-bk-doctor" required style="width: 100%; padding: 0.7rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;">
                  <option value="">-- Bác sĩ khám bất kỳ --</option>
                  <option value="BS.CKII. Nguyễn Vũ Mỹ Linh">BS.CKII. Nguyễn Vũ Mỹ Linh (Trưởng khoa Sản)</option>
                  <option value="BS.CKII. Nguyễn Bạch Huệ">BS.CKII. Nguyễn Bạch Huệ (Trưởng khoa Nhi)</option>
                  <option value="BS.CKII. Lê Kim Sang">BS.CKII. Lê Kim Sang (Trưởng khoa Tiêu Hóa)</option>
                </select>
              </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Chọn ngày khám <span style="color: #dc2626;">*</span></label>
                <input type="date" id="modal-bk-date" required min="2026-07-24" value="2026-07-25" style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" />
              </div>

              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Khung giờ <span style="color: #dc2626;">*</span></label>
                <div style="display: flex; gap: 4px; background: #e2e8f0; padding: 3px; border-radius: 8px;">
                  <button type="button" id="modal-slot-sang" onclick="setModalSlot('Sáng (07:30 - 11:30)', this)" style="flex: 1; padding: 0.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.8rem; cursor: pointer; background: #0f3775; color: #fff;">🌅 Sáng</button>
                  <button type="button" id="modal-slot-chieu" onclick="setModalSlot('Chiều (13:00 - 16:30)', this)" style="flex: 1; padding: 0.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.8rem; cursor: pointer; background: transparent; color: #475569;">⛅ Chiều</button>
                </div>
                <input type="hidden" id="modal-bk-timeslot" value="Sáng (07:30 - 11:30)" />
              </div>
            </div>

            <div>
              <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">Nhập vấn đề cần khám</label>
              <textarea id="modal-bk-issue" rows="2" placeholder="Nhập triệu chứng hoặc vấn đề sức khỏe..." style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.85rem; resize: vertical;"></textarea>
            </div>
          </div>

          <!-- STEP 2 -->
          <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #e2e8f0; margin-bottom: 1.25rem;">
            <h3 style="font-size: 0.95rem; font-weight: 800; color: #0f3775; margin: 0 0 1rem; display: flex; align-items: center; gap: 6px;">
              <span style="width: 22px; height: 22px; border-radius: 50%; background: #0f3775; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">2</span>
              THÔNG TIN NGƯỜI ĐĂNG KÝ
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Họ và tên <span style="color: #dc2626;">*</span></label>
                <input type="text" id="modal-bk-fullname" required placeholder="Họ tên bệnh nhân..." style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" />
              </div>
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Số điện thoại <span style="color: #dc2626;">*</span></label>
                <input type="tel" id="modal-bk-phone" required placeholder="Số điện thoại..." style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" />
              </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">* Ngày sinh <span style="color: #dc2626;">*</span></label>
                <input type="date" id="modal-bk-dob" required style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" />
              </div>
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #334155; margin-bottom: 0.3rem;">Mã KH / BHYT <span style="color: #64748b; font-weight: 400;">(Không bắt buộc)</span></label>
                <input type="text" id="modal-bk-code" placeholder="Mã KH / Mã BHYT..." style="width: 100%; padding: 0.65rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;" />
              </div>
            </div>
          </div>

          <button type="submit" style="width: 100%; background: #0f3775; color: #ffffff; border: none; padding: 0.95rem; border-radius: 10px; font-weight: 900; font-size: 1rem; text-transform: uppercase; cursor: pointer; box-shadow: 0 4px 12px rgba(15, 55, 117, 0.3);">
            ĐĂNG KÝ KHÁM BỆNH NGAY →
          </button>
        </form>
      </div>

    </div>
  </div>
  `;

  document.addEventListener('DOMContentLoaded', function() {
    document.body.insertAdjacentHTML('beforeend', modalHTML);

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
    if (modal) modal.style.display = 'flex';
  };

  window.closeBookingModal = function() {
    const modal = document.getElementById('cih-booking-modal');
    if (modal) modal.style.display = 'none';
  };

  window.setModalSlot = function(slotStr, btn) {
    document.getElementById('modal-slot-sang').style.background = 'transparent';
    document.getElementById('modal-slot-sang').style.color = '#475569';
    document.getElementById('modal-slot-chieu').style.background = 'transparent';
    document.getElementById('modal-slot-chieu').style.color = '#475569';

    btn.style.background = '#0f3775';
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

    alert('🎉 ĐĂNG KÝ KHÁM BỆNH THÀNH CÔNG!\\n\\n' +
          'Bệnh nhân: ' + name + '\\n' +
          'Số điện thoại: ' + phone + '\\n' +
          'Ngày khám: ' + date + ' (' + slot + ')\\n\\n' +
          'Bộ phận CSKH Bệnh viện Quốc tế City sẽ gọi điện xác nhận lịch hẹn với bạn trong 15 phút.');
    closeBookingModal();
  };
})();
