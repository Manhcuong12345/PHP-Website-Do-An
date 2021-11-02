<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Kết quả tìm kiếm cho: "<?php echo $s; ?>"</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_search_item)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_search_item as $item) {
                                ?>  
                                <li>
                                    <a href="<?php echo $item['url_detail']; ?>" title="" class="thumb">
                                        <img src="<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url_detail']; ?>" title="" class="product-name"><?php echo $item['title']; ?></a>
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
                    <?php echo get_pagging($num_page, $page, "search?s={$s}"); ?> 
                </div>
            </div>
        </div>
        <?php get_sidebar('home'); ?>
    </div>
</div>
<?php
get_footer();
?>
