<?php
get_header('login');
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div id="wp-form-reg">
            <form id="form-reg" action="" method="POST">
                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="fullname" >Họ và tên: </label>
                    </div>

                    <div class="fill-info">
                        <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>" placeholder="Fullname">
                        <p class="error" style="display: inline;"><?php echo form_error('fullname'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="username" class="fl-left">Tên đăng nhập: </label>
                    </div>

                    <div class="fill-info">
                        <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username">
                        <p class="error"><?php echo form_error('username'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="password" class="fl-left">Mật khẩu: </label>
                    </div>

                    <div class="fill-info">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <p class="error"><?php echo form_error('password'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="email" class="fl-left">Email: </label>
                    </div>

                    <div class="fill-info">
                        <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email') ?>">
                        <p class="error"><?php echo form_error('email'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="tel" class="fl-left">Số điện thoại: </label>
                    </div>

                    <div class="fill-info">
                        <input type="text" name="tel" id="tel" placeholder="Tel" value="<?php echo set_value('tel') ?>">
                        <p class="error"><?php echo form_error('tel'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="address" class="fl-left">Địa chỉ: </label>
                    </div>

                    <div class="fill-info">
                        <textarea name="address" id="address" placeholder="Address"></textarea>
                        <p class="error"><?php echo form_error('address'); ?></p>
                    </div>
                </div>

                <div class="widget clearfix">
                    <div class="fill-label fl-left">
                        <label for="gender" class="fl-left">Giới tính: </label>
                    </div>

                    <div class="fill-info">
                        <select name="gender" id="gender">
                            <option value="">--Chọn giới tính--</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                        </select>
                        <p class="error"><?php echo form_error('gender'); ?></p>
                    </div>

                </div>

                <input type="submit" name="btn_reg" id="btn_reg" value="Đăng ký">
                <p class="error"><?php echo form_error('account'); ?></p>
            </form>
        </div>

    </div>
</div>
<?php
get_footer();
?>