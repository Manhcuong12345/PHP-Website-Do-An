<?php
get_header();
?> 
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="home.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo $category['url_cat'] ?>" title=""><?php echo $category['cat_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Laptop</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo $num_show; ?> trên <?php echo $total_num_rows; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá thấp dần</option>
                                    <option value="4">Giá tăng dần</option>
                                </select>
                                <button type="submit" name="btn-submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_product)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                ?>  
                                <li>
                                    <a href="<?php echo "product/" . $item['slug'] ?>" title="" class="thumb">
                                        <img src="<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="<?php echo "product/" . $item['slug'] ?>" title="" class="product-name"><?php echo $item['title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['old_price']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $item['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $item['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, "", "category-{$category['cat_id']}"); ?> 
                </div>
            </div>
        </div>


        <?php get_sidebar('product'); ?>
    </div>
</div>
<?php
get_footer();
?> 