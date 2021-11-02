<?php
get_header();
?>
<?php
// show_array($_SESSION);
/*
 * B1. Lấy thông tin khách hàng
 * B2. Tạo content - tối ưu bằng hàm 
 * B3. Gửi mail xác nhận đơn hàng cho khách - PHP mailer
 * B4. Gửi mail báo cáo thông tin đơn hàng cho mình - PHP mailer
 * B5. Kết thúc phiên làm việc - tối ưu hàm
 */
?>

<div id="main-content-wp" class="thank-page">
    <div class="wp-inner clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="thank-wp">
                <div class="section-head">
                    <h3 class="section-title">Đặt hàng thành công</h3>
                </div>
                <div class="section-detail">
                    <p>Chúc mừng bạn đã đặt hàng thành công. Vui lòng kiểm tra địa chỉ <a href="https://mail.google.com/" title="Email">Email</a> để kiểm tra đơn hàng!</p>
                    <p>Trở về<a href="?"> trang chủ</a> !</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

