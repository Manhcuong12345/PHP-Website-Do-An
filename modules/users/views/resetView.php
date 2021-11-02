<?php
get_header('login');
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div id="wp-form-reg">
            <h1 class="page_title">Khôi phục mật khẩu</h1>
            <form id="form_reset" action="" method="post">
                <input type="text" name="email" id="email" placeholder="Nhập email">
                <p class="error"><?php echo form_error('email'); ?></p>
                <input type="submit" name="btn_reset" id="btn_reset" value="Gửi yêu cầu">
            </form>
            <a href="?">Trở về trang chủ</a>
        </div>

    </div>
</div>
<?php
get_footer();
?>