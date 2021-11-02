<?php
get_header('login');
?>

<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <div id="wp-form-reg">
            <?php
            if (!empty($user_info)) {
                ?>
                <form id="form-reg" action="" method="POST">
                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="fullname" >Họ và tên: </label>
                        </div>

                        <div class="fill-info">
                            <input type="text" name="fullname" id="fullname" value="<?php echo $user_info['fullname']; ?>" placeholder="Fullname">
                            <p class="error" style="display: inline;"><?php echo form_error('fullname'); ?></p>
                        </div>
                    </div>

                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="username" class="fl-left">Tên đăng nhập: </label>
                        </div>

                        <div class="fill-info">
                            <input type="text" name="username" id="username" value="<?php echo $user_info['username']; ?>" readonly="readonly">
                            <p class="error"><?php echo form_error('username'); ?></p>
                        </div>
                    </div>

                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="email" class="fl-left">Email: </label>
                        </div>

                        <div class="fill-info">
                            <input type="email" name="email" placeholder="Email" value="<?php echo $user_info['email']; ?>" readonly="readonly">
                            <p class="error"><?php echo form_error('email'); ?></p>
                        </div>
                    </div>

                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="tel" class="fl-left">Số điện thoại: </label>
                        </div>

                        <div class="fill-info">
                            <input type="text" name="tel" id="tel" placeholder="Tel" value="<?php echo $user_info['tel']; ?>">
                            <p class="error"><?php echo form_error('tel'); ?></p>
                        </div>
                    </div>

                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="address" class="fl-left">Địa chỉ: </label>
                        </div>

                        <div class="fill-info">
                            <textarea name="address" id="address" placeholder="Address"><?php echo $user_info['address']; ?></textarea>
                            <p class="error"></p>
                        </div>
                    </div>

                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="gender" class="fl-left">Giới tính: </label>
                        </div>

                        <div class="fill-info">
                            <select name="gender" id="gender">
                                <option value=""><?php echo $gender; ?></option>
                                <option value="">--------------------</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                            </select>
                            <p class="error"><?php echo form_error('gender'); ?></p>
                        </div>

                    </div>

                    <input type="submit" name="btn_update_info" id="btn_reg" value="Thay đổi thông tin">
                    <p class="error"><?php echo form_error('account'); ?></p>

                </form>
                <?php
            }
            ?>

            <div><p>------------------------------------------------------------------------------------------</p></div><br>

            <?php
            if (!empty($user_info)) {
                ?>
                <form id="form-reg" action="" method="POST">
                    <div class="widget clearfix">
                        <div class="fill-label fl-left">
                            <label for="password" class="fl-left">Mật khẩu mới: </label>
                        </div>

                        <div class="fill-info">
                            <input type="password" name="password" id="password" placeholder="Password">
                            <p class="error"><?php echo form_error('password'); ?></p>
                        </div>
                    </div>

                    <input type="submit" name="btn_update_pass" id="btn_reg" value="Thay đổi mật khẩu">
                    <p class="error"><?php echo form_error('account'); ?></p>
                </form>
                <?php
            }
            ?>






        </div>

    </div>
</div>

<?php
get_footer();
?>