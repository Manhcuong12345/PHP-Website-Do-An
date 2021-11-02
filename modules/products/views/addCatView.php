<?php
get_header();
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <form action="?mod=products&controller=cat&action=addCat" method="POST">
                <label for="cat_title">Nhập tên danh mục sản phẩm</label><br>
                <input type="text" name="cat_title" id="cat_title" value=""><br><br>

                <input type="submit" name="btn_reg_cat" value="Đăng ký danh mục">
            </form>
            <br>
            <h1>Danh mục sản phẩm</h1>

            <?php
            if (!empty($list_cat)) {
                ?>
                <table class="table_data">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Cat_id</td>
                            <td>Cat_title</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $temp = 0;
                        foreach ($list_cat as $item) {
                            $temp++;
                            ?>
                            <tr>
                                <td><?php echo $temp ?></td>
                                <td><?php echo $item['cat_id']; ?></td>
                                <td><?php echo $item['cat_title']; ?></td>
                                <td><a href="<?php echo $item['url_delete'] ?>">Xóa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <p class="num_row">Có <?php echo "{$num_rows}" ?> danh mục sản phẩm trong hệ thống</p>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>