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

    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>