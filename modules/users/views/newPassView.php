<?php
get_header('login');
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div id="wp-form-reg">
            <h1 class="page_title">Thiết lập mật khẩu mới</h1>
            <form id="form_reg" action="" method="post">
                <input type="password" name="password" id="password" placeholder="New Password">
                <p class="error"><?php echo form_error('password'); ?></p>
                <input type="submit" name="btn_reg" id="" value="Lưu mật khẩu">
            </form>
            <a href="?">Trở về trang chủ</a>
        </div>

    </div>
</div>
<?php
get_footer();
?>