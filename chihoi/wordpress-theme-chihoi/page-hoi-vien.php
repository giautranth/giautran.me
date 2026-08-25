<?php
/**
 * Template Name: Template Danh Sách Hội Viên
 */
get_header(); ?>


  <!-- ========== MAIN CONTENT: DANH SÁCH HỘI VIÊN (Image 4 Wireframe) ========== -->
  <main class="site-section">
    <div class="container">
      
      <div class="page-title-banner">
        <h1 class="page-main-heading">DANH SÁCH HỘI VIÊN</h1>
      </div>

      <!-- Search & Filter Controls -->
      <div class="table-filter-bar">
        <input type="text" id="memberSearchInput" class="table-search-input" placeholder="🔍 Tìm kiếm bệnh viện, địa chỉ, SĐT..." />
        <div style="font-size:0.88rem;color:#64748b;">
          Hiển thị danh sách các bệnh viện và cơ sở y tế hội viên chính thức
        </div>
      </div>

      <!-- Member Table -->
      <div class="member-table-container">
        <table class="member-data-table" id="memberDataTable">
          <thead>
            <tr>
              <th class="col-stt">TT</th>
              <th class="col-name">TÊN BỆNH VIỆN</th>
              <th>ĐỊA CHỈ</th>
              <th class="col-phone">SĐT</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="col-stt">1</td>
              <td class="col-name">Bệnh viện Gia An 115</td>
              <td>Số 5 Đường 17A, Khu Y tế Kỹ thuật cao, P. An Lạc, Q. Bình Tân, TP. HCM</td>
              <td class="col-phone">1800 9045</td>
            </tr>
            <tr>
              <td class="col-stt">2</td>
              <td class="col-name">Bệnh viện Quốc tế City (CIH)</td>
              <td>Số 3 Đường 17A, Khu Y tế Kỹ thuật cao, P. An Lạc, Q. Bình Tân, TP. HCM</td>
              <td class="col-phone">1900 8146</td>
            </tr>
            <tr>
              <td class="col-stt">3</td>
              <td class="col-name">Bệnh viện FV (Pháp Việt)</td>
              <td>Số 6 Nguyễn Lương Bằng, Phường Tân Phú, Quận 7, TP. HCM</td>
              <td class="col-phone">028 5411 3333</td>
            </tr>
            <tr>
              <td class="col-stt">4</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Hồng Bàng</td>
              <td>Số 3 Hoàng Việt, Phường 4, Quận Tân Bình, TP. HCM</td>
              <td class="col-phone">028 7300 9999</td>
            </tr>
            <tr>
              <td class="col-stt">5</td>
              <td class="col-name">Hệ thống Bệnh viện Sài Gòn - ITO</td>
              <td>305 Lê Văn Sỹ, Phường 1, Quận Tân Bình, TP. HCM</td>
              <td class="col-phone">028 3844 2989</td>
            </tr>
            <tr>
              <td class="col-stt">6</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Nam Sài Gòn</td>
              <td>Số 88, Đường Số 8, Khu Dân Cư Trung Sơn, Bình Chánh, TP. HCM</td>
              <td class="col-phone">1800 6767</td>
            </tr>
            <tr>
              <td class="col-stt">7</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế S.I.S Cần Thơ</td>
              <td>397 Nguyễn Văn Cừ Nối Dài, P. An Bình, Q. Ninh Kiều, TP. Cần Thơ</td>
              <td class="col-phone">1800 1115</td>
            </tr>
            <tr>
              <td class="col-stt">8</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Minh Anh</td>
              <td>36 Đường Số 1B, Bình Trị Đông B, Quận Bình Tân, TP. HCM</td>
              <td class="col-phone">028 6260 0818</td>
            </tr>
            <tr>
              <td class="col-stt">9</td>
              <td class="col-name">Bệnh viện Phương Nam</td>
              <td>Số 2 Nguyễn Lương Bằng, Phường Tân Mỹ, Quận 7, TP. HCM</td>
              <td class="col-phone">1900 1800</td>
            </tr>
            <tr>
              <td class="col-stt">10</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Vinmec Central Park</td>
              <td>208 Nguyễn Hữu Cảnh, Phường 22, Quận Bình Thạnh, TP. HCM</td>
              <td class="col-phone">028 3622 1166</td>
            </tr>
            <tr>
              <td class="col-stt">11</td>
              <td class="col-name">Bệnh viện Triều An</td>
              <td>425 Kinh Dương Vương, Phường An Lạc, Quận Bình Tân, TP. HCM</td>
              <td class="col-phone">028 3750 9999</td>
            </tr>
            <tr>
              <td class="col-stt">12</td>
              <td class="col-name">Bệnh viện Tân Hưng</td>
              <td>871 Trần Xuân Soạn, Phường Tân Hưng, Quận 7, TP. HCM</td>
              <td class="col-phone">028 3776 0648</td>
            </tr>
            <tr>
              <td class="col-stt">13</td>
              <td class="col-name">Bệnh viện Đa khoa Medic Bình Dương</td>
              <td>14A Nguyễn An Ninh, P. Phú Cường, TP. Thủ Dầu Một, Bình Dương</td>
              <td class="col-phone">0274 3855 997</td>
            </tr>
            <tr>
              <td class="col-stt">14</td>
              <td class="col-name">Bệnh viện Quốc tế Columbia Asia Bình Dương</td>
              <td>Đường 22/12, Khu phố Hòa Lân 2, Thuận An, Bình Dương</td>
              <td class="col-phone">0274 381 9933</td>
            </tr>
            <tr>
              <td class="col-stt">15</td>
              <td class="col-name">Bệnh viện Đa khoa Việt Mỹ</td>
              <td>01 Hoàng Việt, Phường 4, Quận Tân Bình, TP. HCM</td>
              <td class="col-phone">028 3811 1188</td>
            </tr>
            <tr>
              <td class="col-stt">16</td>
              <td class="col-name">Bệnh viện Đa khoa Hoàn Mỹ Sài Gòn</td>
              <td>60-60A Phan Xích Long, Phường 1, Phú Nhuận, TP. HCM</td>
              <td class="col-phone">028 3990 2468</td>
            </tr>
            <tr>
              <td class="col-stt">17</td>
              <td class="col-name">Bệnh viện Quốc tế Mỹ (AIH)</td>
              <td>199 Nguyễn Hoàng, Phường An Phú, TP. Thủ Đức, TP. HCM</td>
              <td class="col-phone">028 3910 9999</td>
            </tr>
            <tr>
              <td class="col-stt">18</td>
              <td class="col-name">Bệnh viện Đa khoa Xuyên Á</td>
              <td>Số 42, Quốc lộ 22, Xã Tân Phú Trung, Huyện Củ Chi, TP. HCM</td>
              <td class="col-phone">1800 9075</td>
            </tr>
            <tr>
              <td class="col-stt">19</td>
              <td class="col-name">Phòng khám Đa khoa Thuận Kiều</td>
              <td>623-625 Nguyễn Chí Thanh, Phường 16, Quận 11, TP. HCM</td>
              <td class="col-phone">028 3855 2400</td>
            </tr>
            <tr>
              <td class="col-stt">20</td>
              <td class="col-name">Phòng khám Đa khoa Maimay</td>
              <td>Số 80 Nguyễn Thị Thập, Khu đô thị Him Lam, Quận 7, TP. HCM</td>
              <td class="col-phone">028 6298 9898</td>
            </tr>
            <tr id="memberNoResultRow" style="display:none;">
              <td colspan="4" style="text-align:center;padding:30px;color:#64748b;">
                Không tìm thấy bệnh viện hội viên phù hợp với từ khóa. Vui lòng thử lại!
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Member Benefits & Joining Info -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:40px;">
        <div class="white-box-card">
          <h3 style="color:#2C3691;font-size:1.15rem;font-weight:800;margin-bottom:14px;text-transform:uppercase;display:flex;align-items:center;gap:6px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            Quyền Lợi Hội Viên
          </h3>
          <ul style="padding-left:20px;color:#475569;font-size:0.92rem;line-height:1.8;">
            <li>Được bảo vệ quyền và lợi ích hợp pháp trong hoạt động khám chữa bệnh.</li>
            <li>Ưu đãi giảm 15% - 30% kinh phí cho các khóa đào tạo Y khoa liên tục (CME).</li>
            <li>Tham gia các hội nghị khoa học kỹ thuật, hội thảo quản lý bệnh viện hàng năm.</li>
            <li>Được hỗ trợ tư vấn pháp lý, quản trị rủi ro y khoa và ứng dụng chuyển đổi số y tế.</li>
            <li>Quảng bá thương hiệu bệnh viện trên cổng thông tin chính thức của Chi hội.</li>
          </ul>
        </div>

        <div class="white-box-card" style="background:#e6f6fc;border-color:#bde5f7;">
          <h3 style="color:#2C3691;font-size:1.15rem;font-weight:800;margin-bottom:14px;text-transform:uppercase;display:flex;align-items:center;gap:6px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Đăng Ký Gia Nhập Chi Hội
          </h3>
          <p style="color:#475569;font-size:0.92rem;line-height:1.7;margin-bottom:16px;">
            Các bệnh viện, viện nghiên cứu y khoa, phòng khám đa khoa - chuyên khoa tư nhân có giấy phép hoạt động hợp pháp đều có thể nộp hồ sơ gia nhập Chi hội.
          </p>
          <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="lien-he" class="btn-primary-pill">Nộp Hồ Sơ Trực Tuyến</a>
            <a href="#" onclick="alert('Đã tải mẫu đơn đăng ký hội viên (.docx)!'); return false;" class="btn-primary-pill" style="background:#ffffff;color:#2C3691!important;border:1px solid #2C3691;">Tải Mẫu Đơn Đăng Ký</a>
          </div>
      </div>

      <!-- ========== LOGO SHOWCASE: HỘI VIÊN CHI HỘI (Infinite Loop) ========== -->
      <div style="margin-top:40px;overflow:hidden;">
        <div class="section-header-row" style="margin-bottom:16px;">
          <div>
            <div class="section-main-title" style="font-size:1.15rem;">HỘI VIÊN CHI HỘI</div>
            
          </div>
        </div>

        <div class="infinite-marquee-container">
          <div class="infinite-marquee-wrapper">
            <div class="infinite-marquee-track">            <!-- Original Set: Hospital Members -->
            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/doitac/logo_benhvienquoctecity.png" alt="Bệnh viện Quốc tế City" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện FV (Pháp Việt)">
              <img src="photo/logo/fv.png" alt="Bệnh viện FV" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Phương Nam">
              <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Nam Sài Gòn">
              <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Vinmec Central Park">
              <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Columbia Asia">
              <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ">
              <img src="photo/logo/sis.png" alt="Bệnh viện S.I.S Cần Thơ" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Minh Anh">
              <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
            </a>

            <!-- Duplicated Set for Seamless Infinite Loop -->
            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/doitac/logo_benhvienquoctecity.png" alt="Bệnh viện Quốc tế City" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện FV (Pháp Việt)" aria-hidden="true">
              <img src="photo/logo/fv.png" alt="Bệnh viện FV" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Phương Nam" aria-hidden="true">
              <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Nam Sài Gòn" aria-hidden="true">
              <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Vinmec Central Park" aria-hidden="true">
              <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Columbia Asia" aria-hidden="true">
              <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ" aria-hidden="true">
              <img src="photo/logo/sis.png" alt="Bệnh viện S.I.S Cần Thơ" />
            </a>

            <a href="hoi-vien" class="member-partner-card" title="Bệnh viện Minh Anh" aria-hidden="true">
              <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
            </a></div>
              <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
                <img src="photo/doitac/logo_benhvienquoctecity.png" alt="Bệnh viện Quốc tế City" />
              </div>
              <div class="member-partner-card" title="Bệnh viện FV">
                <img src="photo/logo/fv.png" alt="Bệnh viện FV" />
              </div>
              <div class="member-partner-card" title="Tập đoàn Hoa Lâm">
                <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Phương Nam">
                <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
              </div>
              <div class="member-partner-card" title="Bệnh viện ĐK Quốc tế Nam Sài Gòn">
                <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
              </div>
              <div class="member-partner-card" title="Ngân hàng VietBank">
                <img src="photo/doitac/logo_vietbank.jpg" alt="VietBank" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Vinmec Central Park">
                <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec" />
              </div>
              <div class="member-partner-card" title="Vietlott">
                <img src="photo/doitac/logo_vietlot.jpg" alt="Vietlott" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Columbia Asia">
                <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
              </div>
              <div class="member-partner-card" title="Bệnh viện S.I.S Cần Thơ">
                <img src="photo/logo/sis.png" alt="Bệnh viện S.I.S Cần Thơ" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Minh Anh">
                <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
              </div>

              <!-- Duplicate for Seamless Infinite Loop -->
              <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
                <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
                <img src="photo/doitac/logo_benhvienquoctecity.png" alt="Bệnh viện Quốc tế City" />
              </div>
              <div class="member-partner-card" title="Bệnh viện FV" aria-hidden="true">
                <img src="photo/logo/fv.png" alt="Bệnh viện FV" />
              </div>
              <div class="member-partner-card" title="Tập đoàn Hoa Lâm" aria-hidden="true">
                <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Phương Nam" aria-hidden="true">
                <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
              </div>
              <div class="member-partner-card" title="Bệnh viện ĐK Quốc tế Nam Sài Gòn" aria-hidden="true">
                <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
              </div>
              <div class="member-partner-card" title="Ngân hàng VietBank" aria-hidden="true">
                <img src="photo/doitac/logo_vietbank.jpg" alt="VietBank" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Vinmec Central Park" aria-hidden="true">
                <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec" />
              </div>
              <div class="member-partner-card" title="Vietlott" aria-hidden="true">
                <img src="photo/doitac/logo_vietlot.jpg" alt="Vietlott" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Columbia Asia" aria-hidden="true">
                <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
              </div>
              <div class="member-partner-card" title="Bệnh viện S.I.S Cần Thơ" aria-hidden="true">
                <img src="photo/logo/sis.png" alt="Bệnh viện S.I.S Cần Thơ" />
              </div>
              <div class="member-partner-card" title="Bệnh viện Minh Anh" aria-hidden="true">
                <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>