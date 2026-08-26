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
        <input type="text" id="memberSearchInput" class="table-search-input" placeholder="🔍 Tìm kiếm bệnh viện, địa chỉ..." />
        
      </div>

      <!-- Member Table -->
      <div class="member-table-container">
        <table class="member-data-table" id="memberDataTable">
                    <thead>
            <tr>
              <th class="col-stt">TT</th>
              <th class="col-name">TÊN BỆNH VIỆN</th>
              <th class="col-address">ĐỊA CHỈ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="col-stt">1</td>
              <td class="col-name">Bệnh viện Gia An 115</td>
              <td>Số 5 Đường 17A, Khu Y tế Kỹ thuật cao, Phường An Lạc, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">2</td>
              <td class="col-name">Bệnh viện Quốc tế City (CIH)</td>
              <td>Số 3 Đường 17A, Khu Y tế Kỹ thuật cao, Phường An Lạc, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">3</td>
              <td class="col-name">Bệnh viện FV (Pháp Việt)</td>
              <td>Số 6 Nguyễn Lương Bằng, Khu đô thị Phú Mỹ Hưng, Phường Tân Mỹ, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">4</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Hồng Bàng</td>
              <td>Số 3 Hoàng Việt, Phường Tân Sơn Nhất, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">5</td>
              <td class="col-name">Hệ thống Bệnh viện Sài Gòn - ITO</td>
              <td>Số 305 Lê Văn Sỹ, Phường Tân Sơn Hòa, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">6</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Nam Sài Gòn</td>
              <td>Số 88 Đường Số 8, Khu dân cư Trung Sơn, Xã Bình Hưng, Huyện Bình Chánh, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">7</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế S.I.S Cần Thơ</td>
              <td>Số 397 Nguyễn Văn Cừ Nối Dài, Phường An Bình, TP. Cần Thơ</td>
            </tr>
            <tr>
              <td class="col-stt">8</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Minh Anh</td>
              <td>Số 36 Đường Số 1B, Phường An Lạc, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">9</td>
              <td class="col-name">Bệnh viện Phương Nam</td>
              <td>Số 2 Nguyễn Lương Bằng, Phường Tân Mỹ, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">10</td>
              <td class="col-name">Bệnh viện Đa khoa Quốc tế Vinmec Central Park</td>
              <td>Số 208 Nguyễn Hữu Cảnh, Phường Thạnh Mỹ Tây, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">11</td>
              <td class="col-name">Bệnh viện Triều An</td>
              <td>Số 425 Kinh Dương Vương, Phường An Lạc, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">12</td>
              <td class="col-name">Bệnh viện Tân Hưng</td>
              <td>Số 871 Trần Xuân Soạn, Phường Tân Hưng, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">13</td>
              <td class="col-name">Bệnh viện Đa khoa Medic Bình Dương</td>
              <td>Số 14A Nguyễn An Ninh, Phường Phú Cường, TP. Thủ Dầu Một, Tỉnh Bình Dương</td>
            </tr>
            <tr>
              <td class="col-stt">14</td>
              <td class="col-name">Bệnh viện Quốc tế Columbia Asia Bình Dương</td>
              <td>Đường 22/12, Khu phố Hòa Lân 2, Phường Thuận Giao, TP. Thuận An, Tỉnh Bình Dương</td>
            </tr>
            <tr>
              <td class="col-stt">15</td>
              <td class="col-name">Bệnh viện Đa khoa Việt Mỹ</td>
              <td>Số 1 Hoàng Việt, Phường Tân Sơn Nhất, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">16</td>
              <td class="col-name">Bệnh viện Đa khoa Hoàn Mỹ Sài Gòn</td>
              <td>Số 60-60A Phan Xích Long, Phường Cầu Kiệu, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">17</td>
              <td class="col-name">Phòng khám Đa khoa Thuận Kiều</td>
              <td>Số 623-625 Nguyễn Chí Thanh, Phường Hòa Bình, TP. Hồ Chí Minh</td>
            </tr>
            <tr>
              <td class="col-stt">18</td>
              <td class="col-name">Phòng khám Đa khoa Maimay</td>
              <td>Số 80 Nguyễn Thị Thập, Khu đô thị Him Lam, Phường Tân Hưng, TP. Hồ Chí Minh</td>
            </tr>
            <tr id="memberNoResultRow" style="display:none;">
              <td colspan="3" style="text-align:center;padding:30px;color:#64748b;">
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