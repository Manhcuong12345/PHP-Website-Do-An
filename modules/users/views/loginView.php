<?php
get_header('login')
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div id="wp-form-reg">
            <h1 class="page-title">ĐĂNG NHẬP</h1>
            <form id="form-login" action="" method="post">
                <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username"> <br>
                <p class="error"><?php echo form_error('username'); ?></p>
                <input type="password" name="password" id="password" placeholder="Password">
                <p class="error"><?php echo form_error('password'); ?></p>
                <input type="checkbox" name="remember_me" id="">Ghi nhớ đăng nhập <br>
                <input type="submit" name="btn_login" id="btn_login" value="Đăng nhập">
                <p class="error"><?php echo form_error('account'); ?></p>
            </form>
            <a href="reset.html" id="lost_pass">Quên mật khẩu ?</a><br>
            <span>Chưa có tài khoản ?</span>
            <a href="registry.html">Đăng ký ngay</a><br>
            <a href="home.html">Trở về trang chủ</a>
        </div>

    </div>
</div>

<?php
get_footer();
?>

