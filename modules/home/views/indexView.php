<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">

            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    foreach ($list_media_slider as $item) {
                        ?>
                        <div class="item">
                            <img src="<?php echo $item['thumbnail']; ?>" alt="">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_featured_product)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_featured_product as $item) {
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
                                        <a href="<?php echo $item['url_add_cart'] ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $item['url_checkout'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
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

            <!-- List-product -->
            <div class="section" id="list-product-wp">

                <div data-type="1">
                    <div class="section-head">
                        <h3 class="section-title">Điện thoại</h3>
                    </div>
                    <div class="section-detail">
                        <?php
                        if (!empty($list_mobile)) {
                            ?>
                            <ul data-type="1" class="list-item clearfix">
                                <?php
                                foreach ($list_mobile as $item) {
                                    ?>
                                    <li>
                                        <a href="<?php echo "product/" . $item['slug']; ?>" title="" class="thumb">
                                            <img src="<?php echo $item['thumbnail']; ?>">
                                        </a>
                                        <a href="<?php echo "product/" . $item['slug']; ?>" title="" class="product-name"><?php echo $item['title']; ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($item['price']); ?></span>
                                            <span class="old"><?php echo currency_format($item['old_price']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="<?php echo $item['url_add_cart']; ?>" title="Add Cart" class="add-cart fl-left">Add Cart</a>
                                            <a href="<?php echo $item['url_checkout']; ?>" title="Buy Now" class="buy-now fl-right">Buy Now</a>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <div class="pagging clearfix">
                                <?php echo get_pagging_custom($num_page_mobile, $page, "home.html"); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div data-type="2">
                    <div class="section-head">
                        <h3 class="section-title">Tablet</h3>
                    </div>
                    <div class="section-detail">
                        <?php
                        if (!empty($list_tablet)) {
                            ?>
                            <ul data-type="2" class="list-item clearfix">
                                <?php
                                foreach ($list_tablet as $item) {
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
                                            <a href="<?php echo $item['url_add_cart'] ?>" title="Add Cart" class="add-cart fl-left">Add Cart</a>
                                            <a href="<?php echo $item['url_checkout'] ?>" title="Buy Now" class="buy-now fl-right">Buy Now</a>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <div class="pagging clearfix">
                                <?php echo get_pagging_custom($num_page_tablet, $page, "home.html"); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div data-type="3">
                    <div class="section-head">
                        <h3 class="section-title">Tablet</h3>
                    </div>
                    <div class="section-detail">
                        <?php
                        if (!empty($list_laptop)) {
                            ?>
                            <ul data-type="3" class="list-item clearfix">
                                <?php
                                foreach ($list_laptop as $item) {
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
                                            <a href="<?php echo $item['url_add_cart']; ?>" title="Add Cart" class="add-cart fl-left">Add Cart</a>
                                            <a href="<?php echo $item['url_checkout']; ?>" title="Buy Now" class="buy-now fl-right">Buy Now</a>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <div class="pagging clearfix">
                                <?php echo get_pagging_custom($num_page_laptop, $page, "home.html"); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar('home'); ?>
    </div>
</div>
<?php
get_footer();
?>
