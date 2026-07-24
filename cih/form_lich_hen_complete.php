<?php
// Shortcode function
function form_lich_hen_complete() {
    ob_start();  // Bắt đầu buffer để lưu HTML của form

    // Tạo ID ngẫu nhiên cho form
    $form_id = 'form_lich_hen_' . uniqid();
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/css/datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/locales/vi.js"></script>
    <style>
        .form-lich-hen input[type=text],
        .form-lich-hen input[type=email],
        .form-lich-hen input[type=password],
        .form-lich-hen input[type=date],
        .form-lich-hen input[type=datetime],
        .form-lich-hen input[type=datetime-local],
        .form-lich-hen input[type=number],
        .form-lich-hen input[type=search],
        .form-lich-hen input[type=tel],
        .form-lich-hen input[type=time],
        .form-lich-hen input[type=url],
        .form-lich-hen input[type=week],
        .form-lich-hen textarea,
        .form-lich-hen select,
        .form-lich-hen .select2-container .select2-selection--single .select2-selection__rendered {
            border-bottom: 2px solid #007da5;
            border-radius: 0;
            background-color: transparent;
            color: #007da5;
            padding: 0 !important;
        }

        .form-lich-hen input[type=text]:focus,
        .form-lich-hen input[type=email]:focus,
        .form-lich-hen input[type=password]:focus,
        .form-lich-hen input[type=date]:focus,
        .form-lich-hen input[type=datetime]:focus,
        .form-lich-hen input[type=datetime-local]:focus,
        .form-lich-hen input[type=number]:focus,
        .form-lich-hen input[type=search]:focus,
        .form-lich-hen input[type=tel]:focus,
        .form-lich-hen input[type=time]:focus,
        .form-lich-hen input[type=url]:focus,
        .form-lich-hen input[type=week]:focus,
        .form-lich-hen textarea:focus,
        .form-lich-hen select:focus {
            border-bottom: 2px solid #004d66;
            outline: none;
            box-shadow: none;
        }

        .form-lich-hen input[type=text]::placeholder,
        .form-lich-hen input[type=email]::placeholder,
        .form-lich-hen input[type=password]::placeholder,
        .form-lich-hen input[type=date]::placeholder,
        .form-lich-hen input[type=datetime]::placeholder,
        .form-lich-hen input[type=datetime-local]::placeholder,
        .form-lich-hen input[type=number]::placeholder,
        .form-lich-hen input[type=search]::placeholder,
        .form-lich-hen input[type=tel]::placeholder,
        .form-lich-hen input[type=time]::placeholder,
        .form-lich-hen input[type=url]::placeholder,
        .form-lich-hen input[type=week]::placeholder,
        .form-lich-hen textarea::placeholder {
            color: #007da5;
            opacity: 1;
        }

        .form-lich-hen h3 {
            font-weight: 300;
        }
    </style>
    <form id="<?php echo esc_attr($form_id); ?>" class="form-lich-hen" action="" method="post">

        <div class="row">
            <div class="col medium-6">
                <!-- Thông tin bệnh nhân -->
                <h3>Thông tin khách hàng</h3>
                <!-- Họ và tên -->
                <div>
                    <input type="text" name="name" placeholder="Họ và tên" required>
                </div>

                <!-- Email -->
                <input type="email" name="email" placeholder="Email">

                <!-- Số điện thoại -->
                <input 
                  type="text" 
                  name="phone" 
                  placeholder="Số điện thoại" 
                  pattern="^[0-9+]{8,22}$"
                  title="Vui lòng nhập số điện thoại hợp lệ (chỉ chứa số và dấu +, không khoảng trắng, không gạch ngang, không gạch chéo, độ dài từ 8 - 22 ký tự)"
                  oninput="this.value = this.value.replace(/[^0-9+]/g, '')"
                  required
                >


                <!-- Ngày sinh -->
                <input type="text" name="birthdate" placeholder="Ngày sinh" autocomplete="off" required>

            </div>
            <div class="col medium-6">
                <h3>Chọn chuyên khoa</h3>

                <!-- Chọn chuyên khoa -->
                <div>
                    <select name="chuyen_khoa" required>
                        <option value="">Chọn chuyên khoa</option>
                        <?php
                        // 1. Lấy tất cả ID chuyên khoa đã được gán cho các bác sĩ đang hoạt động
                        $active_doctors = get_posts(array(
                            'post_type' => 'bac-si',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ));

                        $assigned_dept_ids = array();
                        if ($active_doctors) {
                            foreach ($active_doctors as $doc) {
                                $chuyen_khoa_val = get_field('chuyen_khoa', $doc->ID);
                                $ck_id = null;
                                if (is_object($chuyen_khoa_val)) {
                                    $ck_id = $chuyen_khoa_val->ID;
                                } elseif (is_numeric($chuyen_khoa_val)) {
                                    $ck_id = $chuyen_khoa_val;
                                }
                                if ($ck_id) {
                                    $assigned_dept_ids[] = intval($ck_id);
                                }
                            }
                        }
                        $assigned_dept_ids = array_unique($assigned_dept_ids);

                        // 2. Lấy danh sách chuyên khoa sắp xếp từ A-Z
                        $chuyen_khoa_posts = get_posts(array(
                            'post_type' => 'chuyen-khoa',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));

                        if ($chuyen_khoa_posts) {
                            foreach ($chuyen_khoa_posts as $post) {
                                // Chỉ hiển thị chuyên khoa nếu chuyên khoa đó có ít nhất một bác sĩ
                                if (in_array(intval($post->ID), $assigned_dept_ids)) {
                                    echo '<option value="' . $post->ID . '">' . esc_html($post->post_title) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Chọn bác sĩ -->
                <div>
                    <select name="bac_si" required>
                        <option value="">Chọn bác sĩ</option>
                        <?php
                        // Lấy danh sách các bài viết từ CPT bac-si
                        $bac_si_posts = get_posts(array(
                            'post_type' => 'bac-si',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ));

                        if ($bac_si_posts) {
                            foreach ($bac_si_posts as $post) {
                                // Lấy ID chuyên khoa của bác sĩ thông qua trường ACF chuyen_khoa
                                $chuyen_khoa_val = get_field('chuyen_khoa', $post->ID);
                                $ck_id = '';
                                if (is_object($chuyen_khoa_val)) {
                                    $ck_id = $chuyen_khoa_val->ID;
                                } elseif (is_numeric($chuyen_khoa_val)) {
                                    $ck_id = $chuyen_khoa_val;
                                }
                                echo '<option value="' . $post->ID . '" data-chuyen-khoa="' . esc_attr($ck_id) . '">' . esc_html($post->post_title) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Triệu chứng -->
                <div>
                    <input type="text" name="trieu_chung" placeholder="Triệu chứng">
                </div>

                <!-- Ngày và Giờ thích hợp -->
                <h3 style="margin-top: 20px;">Ngày giờ ưu tiên</h3>
                <!-- Ngày hẹn -->
                <div>
                    <input type="text" name="appointment_date" placeholder="Chọn ngày" autocomplete="off" required>
                </div>

                <!-- Buổi -->
                <div>
                    <label class="radio">
                        <input type="radio" name="time" value="Sáng" required checked>
                        <span class="radio-label">Sáng</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="time" value="Chiều" required>
                        <span class="radio-label">Chiều</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- UTM Tracking (ẩn) -->
        <input type="hidden" name="landing_page" value="">
        <input type="hidden" name="utm_source" value="">
        <input type="hidden" name="utm_medium" value="">
        <input type="hidden" name="utm_campaign" value="">

        <!-- Nút Submit -->
        <div class="row" style="margin-top: 20px;">
            <div class="col medium-12 text-right">
                <input id="submit_<?php echo esc_js($form_id); ?>" type="submit" value="Đăng ký" style="border-radius:99px; font-weight: 300; font-size: 95%; background-color: var(--fs-color-success);">
            </div>
        </div>

        <!-- Thông báo -->
        <div id="form-result-<?php echo esc_attr($form_id); ?>"></div>
        <?php wp_nonce_field('ajax_form_nonce', 'security'); ?>
    </form>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#<?php echo esc_js($form_id); ?>').on('submit', function(e) {
                e.preventDefault(); // Ngăn form submit trực tiếp

                var formData = new FormData(this); // Lấy dữ liệu từ form và sử dụng FormData để có thể thêm dữ liệu mới

                // Thêm giá trị ngày đã format vào formData
                formData.set('birthdate', datepicker_birthdate_<?php echo esc_js($form_id); ?>.getDate('yyyy-mm-dd'));
                formData.set('appointment_date', datepicker_appointment_date_<?php echo esc_js($form_id); ?>.getDate('yyyy-mm-dd'));
				
				// Thêm action vào FormData
				formData.append('action', 'submit_lich_hen');
				
                $('#submit_<?php echo esc_js($form_id); ?>').prop('disabled', true).val('Đang gửi thông tin...');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>', // URL xử lý AJAX của WordPress
                    data: formData,
                    processData: false, // Không xử lý dữ liệu, vì đã sử dụng FormData
                    contentType: false, // Để mặc định content type
                    success: function(response) {
                        if (response.success) {
                            $('#<?php echo esc_js($form_id); ?>')[0].reset(); // Reset form
							 $.loadMagnificPopup().then(() => {
								$.magnificPopup.open({
								  items: {
									src: `<div id="statusSuccessModal" class="lightbox-by-id lightbox-content lightbox-white" style="max-width:300px ;padding:20px">
											<div class="modal-body text-center">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
											<circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"></circle>
											<polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "></polyline>
											</svg>
											<h4 class="text-success mt-3">Thành công!</h4>
											<div>Bạn đã đăng ký thành công. Chúng tôi sẽ gọi lại để xác nhận lịch hẹn. Xin cảm ơn!</div>
											</div>
										</div>`, // can be a HTML string, jQuery object, or CSS selector
									type: 'inline',
									  closeBtnInside:true
								  }
								});
							  });
							$('#submit_<?php echo esc_js($form_id); ?>').prop('disabled', false).val('Đăng ký');
                        } else {
                            $('#form-result-<?php echo esc_js($form_id); ?>').html('<p>' + response.data + '</p>'); // Hiển thị thông báo lỗi
							$('#submit_<?php echo esc_js($form_id); ?>').prop('disabled', false).val('Đăng ký');
                        }
                    },
                    error: function() {
                        $('#submit_<?php echo esc_js($form_id); ?>').prop('disabled', false).val('Đăng ký');
                    }
                });
            });

            // Logic lọc bác sĩ theo chuyên khoa (Safari-friendly)
            var $bac_si_select = $('#<?php echo esc_js($form_id); ?> select[name="bac_si"]');
            var $bac_si_options_backup = $bac_si_select.find('option').clone();

            $('#<?php echo esc_js($form_id); ?> select[name="chuyen_khoa"]').on('change', function() {
                var chuyen_khoa_id = $(this).val();
                
                // Xóa toàn bộ option cũ
                $bac_si_select.empty();
                
                // Lọc và chèn lại các option tương thích
                $bac_si_options_backup.each(function() {
                    var $opt = $(this);
                    var opt_ck = $opt.attr('data-chuyen-khoa');
                    
                    if ($opt.val() === "") {
                        // Luôn giữ lại tùy chọn mặc định
                        $bac_si_select.append($opt.clone());
                    } else if (chuyen_khoa_id !== "" && opt_ck == chuyen_khoa_id) {
                        $bac_si_select.append($opt.clone());
                    }
                });
                
                // Reset giá trị bác sĩ được chọn về rỗng
                $bac_si_select.val('');
            });

            // Kích hoạt ẩn toàn bộ bác sĩ ban đầu khi chưa chọn chuyên khoa
            $('#<?php echo esc_js($form_id); ?> select[name="chuyen_khoa"]').trigger('change');

            // Tự động gán UTM params từ URL vào hidden fields
            var utmParams = new URLSearchParams(window.location.search);
            $('#<?php echo esc_js($form_id); ?> input[name="landing_page"]').val(window.location.pathname);
            $('#<?php echo esc_js($form_id); ?> input[name="utm_source"]').val(utmParams.get('utm_source') || '');
            $('#<?php echo esc_js($form_id); ?> input[name="utm_medium"]').val(utmParams.get('utm_medium') || '');
            $('#<?php echo esc_js($form_id); ?> input[name="utm_campaign"]').val(utmParams.get('utm_campaign') || '');

            const datepicker_birthdate_<?php echo esc_js($form_id); ?> = new Datepicker(document.querySelector('#<?php echo esc_js($form_id); ?> input[name="birthdate"]'), {
                language: 'vi',
				autohide: true
            });
            
            // Lấy ngày hôm nay bằng JS Date chuẩn và đưa về 0 giờ sáng
            const today_<?php echo esc_js($form_id); ?> = new Date();
            today_<?php echo esc_js($form_id); ?>.setHours(0,0,0,0);
            
            const datepicker_appointment_date_<?php echo esc_js($form_id); ?> = new Datepicker(document.querySelector('#<?php echo esc_js($form_id); ?> input[name="appointment_date"]'), {
                language: 'vi',
				autohide: true,
                minDate: today_<?php echo esc_js($form_id); ?>
            });
        });
    </script>
<?php
    return ob_get_clean();
}

add_shortcode('form_lich_hen_complete', 'form_lich_hen_complete');

// Đăng ký shortcode cho UX Builder
function register_lich_hen_form_shortcode() {
    if (function_exists('add_ux_builder_shortcode')) {
        add_ux_builder_shortcode('form_lich_hen_complete', array(
            'name' => __('Form Lịch Hẹn', 'your-textdomain'),
            'category' => __('Content', 'your-textdomain'),
            'info' => __('Form đặt lịch hẹn kiểm tra.', 'your-textdomain'),
            'options' => array()
        ));
    }
}
add_action('ux_builder_setup', 'register_lich_hen_form_shortcode');
