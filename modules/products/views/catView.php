<?php
get_header();
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <h1>Danh mục sản phẩm</h1>
            <div>
                <a href="?mod=products&controller=cat&action=addCat">Đăng ký danh mục</a> || <a href="?mod=products&controller=cat&action=addProduct">Đăng ký sản phẩm</a>
            </div>   
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
                <p class="num_row">Có <?php echo "{$num_rows_cat}" ?> danh mục sản phẩm trong hệ thống</p>
                <?php
            }
            ?>

            <?php
            if (!empty($list_product)) {
                ?>
                <table class="table_data">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Product id</td>
                            <td>Product title</td>
                            <td>Product price</td>
                            <td>Product code</td>
                            <td>Product cat id</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $temp = 0;
                        foreach ($list_product as $item) {
                            $temp++;
                            ?>
                            <tr>
                                <td><?php echo $temp ?></td>
                                <td><?php echo $item['product_id']; ?></td>
                                <td><?php echo $item['product_title']; ?></td>
                                <td><?php echo $item['product_price']; ?></td>
                                <td><?php echo $item['product_code']; ?></td>
                                <td><?php echo $item['product_cat_id']; ?></td>

                                <td><a href="<?php echo $item['url_delete'] ?>">Xóa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <p class="num_row">Có <?php echo "{$num_rows_product}" ?> sản phẩm trong hệ thống</p>
                <?php
            }
            ?>

        </div>
    </div>
</div>
<?php
get_footer();
?>