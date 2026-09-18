<?php
/**
 * Template Name: Template Ban Thư Ký
 */
get_header(); ?>

<!-- ========== MAIN CONTENT: BAN THƯ KÝ ========== -->
  <main class="site-section">
    <div class="container">
      
      <div class="section-header-row">
        <h1 class="section-main-title">BAN THƯ KÝ</h1>
      </div>

      <!-- Sub-navigation Tabs -->
      <div class="filter-tabs-wrapper" style="margin-bottom: 25px;">
        <a href="<?php echo esc_url(home_url('/ban-chap-hanh/')); ?>" class="tab-btn" style="display:inline-block;text-decoration:none;">Danh sách Ban Chấp hành</a>
        <a href="<?php echo esc_url(home_url('/ban-thu-ky/')); ?>" class="tab-btn active" style="display:inline-block;text-decoration:none;">Danh sách Ban Thư ký</a>
      </div>

      <!-- Danh Sách Ban Thư Ký -->
      <div class="white-box-card" style="margin-top:20px;">
        <div style="margin-bottom:20px;border-bottom:2px solid #e2e8f0;padding-bottom:12px;">
          <h2 style="color:#2C3691;font-size:1.25rem;font-weight:900;text-transform:uppercase;margin:0;">
            DANH SÁCH BAN THƯ KÝ CHI HỘI
          </h2>
        </div>

        <div class="table-responsive-rounded">
          <table class="org-data-table thuky-table">
            <thead>
              <tr>
                <th class="col-stt">STT</th>
                <th class="col-name">Họ tên</th>
                <th class="col-pos">Chức vụ</th>
                <th class="col-org">Đơn vị công tác</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="col-stt">1</td>
                <td class="col-name">Ông Nguyễn Thanh Tuyền</td>
                <td class="col-pos">Phó Tổng Giám đốc</td>
                <td class="col-org">Công ty CP Đầu tư Phát triển Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">2</td>
                <td class="col-name">Bà Lê Thị Nhi Kỳ</td>
                <td class="col-pos">Trợ lý Chủ tịch</td>
                <td class="col-org">Tập đoàn Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">3</td>
                <td class="col-name">Bà Đặng Thị Ngọc Bích</td>
                <td class="col-pos">Thư ký Chủ tịch</td>
                <td class="col-org">Tập đoàn Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">4</td>
                <td class="col-name">Bà Bùi Thị Tường Vy</td>
                <td class="col-pos">Thư ký Chủ tịch</td>
                <td class="col-org">Tập đoàn Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">5</td>
                <td class="col-name">Bà Nguyễn Thị Kim Phượng</td>
                <td class="col-pos">Thư ký Chủ tịch</td>
                <td class="col-org">Tập đoàn Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">6</td>
                <td class="col-name">Ông Nguyễn Thể Hưng</td>
                <td class="col-pos">Thư ký Chủ tịch</td>
                <td class="col-org">Tập đoàn Hoa Lâm</td>
              </tr>
              <tr>
                <td class="col-stt">7</td>
                <td class="col-name">Bà Nguyễn Thị Huế</td>
                <td class="col-pos">Giám đốc Nhân sự</td>
                <td class="col-org">Bệnh viện Gia An 115 & Bệnh viện Quốc tế City</td>
              </tr>
              <tr>
                <td class="col-stt">8</td>
                <td class="col-name">Bà Nguyễn Thị Kim Thúy</td>
                <td class="col-pos">Trưởng phòng Thương hiệu &<br />Truyền thông cấp cao</td>
                <td class="col-org">Bệnh viện Gia An 115 & Bệnh viện Quốc tế City</td>
              </tr>
              <tr>
                <td class="col-stt">9</td>
                <td class="col-name">Bà Nguyễn Thị Lan Hương</td>
                <td class="col-pos">Trưởng phòng Trải nghiệm Khách hàng</td>
                <td class="col-org">Bệnh viện Gia An 115</td>
              </tr>
              <tr>
                <td class="col-stt">10</td>
                <td class="col-name">Bà Trần Thị Thu</td>
                <td class="col-pos">Trưởng phòng Trải nghiệm Khách hàng</td>
                <td class="col-org">Bệnh viện Quốc tế City</td>
              </tr>
              <tr>
                <td class="col-stt">11</td>
                <td class="col-name">Ông Hồ Trọng Nhân</td>
                <td class="col-pos">Trưởng phòng Thiết bị Y tế cấp cao<br />kiêm Quản lý Công nghệ thông tin</td>
                <td class="col-org">Bệnh viện Quốc tế City</td>
              </tr>
              <tr>
                <td class="col-stt">12</td>
                <td class="col-name">Bà Lê Nguyễn Hồng Anh</td>
                <td class="col-pos">Trưởng phòng Mua hàng cấp cao</td>
                <td class="col-org">Bệnh viện Quốc tế City</td>
              </tr>
              <tr>
                <td class="col-stt">13</td>
                <td class="col-name">Bà Vũ Thị Thu</td>
                <td class="col-pos">Phó phòng Mua hàng</td>
                <td class="col-org">Bệnh viện Gia An 115</td>
              </tr>
              <tr>
                <td class="col-stt">14</td>
                <td class="col-name">Bà Lê Thị Vy</td>
                <td class="col-pos">Chủ tịch Công đoàn</td>
                <td class="col-org">Bệnh viện Gia An 115</td>
              </tr>
              <tr>
                <td class="col-stt">15</td>
                <td class="col-name">Bà Phạm Thị Như Quỳnh</td>
                <td class="col-pos">Trợ lý Giám đốc Điều hành</td>
                <td class="col-org">Bệnh viện Quốc tế City</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

<?php get_footer(); ?>
