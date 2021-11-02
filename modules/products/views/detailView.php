<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img src="<?php echo $product['thumbnail']; ?>" data-zoom-image="<?php echo $product['thumbnail']; ?>"/>
                        </a>
                        <div id="list-thumb">
                            <?php
                            if (!empty($slider_thumbnail)) {
                                foreach ($slider_thumbnail as $item) {
                                    ?>
                                    <a href="" data-image="<?php echo $item['thumbnail']; ?>" data-zoom-image="<?php echo $item['thumbnail']; ?>">
                                        <img id="zoom" src="<?php echo $item['thumbnail']; ?>" />
                                    </a>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['title']; ?></h3>
                        <div class="desc">
                            <?php echo $product['description']; ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php echo $product['tracking']; ?></span>
                        </div>
                        <p class="price"><?php echo currency_format($product['price']); ?></p>
                        <form method="GET" action="?">
                            <input type="hidden" name="mod" value="cart">
                            <input type="hidden" name="action" value="addCart">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <input type="submit" value="Thêm giỏ hàng" name="btn-submit" class="add-cart">
                            <!-- <a href="<?php //echo $product['url_add_cart']    ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> -->
                        </form>

                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Giới thiệu sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $product['content']; ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($same_category_product)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($same_category_product as $item) {
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
                                        <a href="<?php echo $item['url_add_cart']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $item['url_checkout']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
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
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
?>