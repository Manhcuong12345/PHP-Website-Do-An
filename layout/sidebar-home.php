<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        
        <div class="section-detail">
            <ul class="list-item">
                <li>
                    <a href="phone-1.html" title="">Điện thoại</a>
                </li>
                <li>
                    <a href="tablet-2.html" title="">Máy tính bảng</a>
                </li>
                <li>
                    <a href="laptop-3.html" title="">laptop</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <?php
            if (!empty($list_best_seller)) {
                ?>
                <ul class="list-item">
                    <?php
                    foreach ($list_best_seller as $item) {
                        ?>
                        <li class="clearfix">
                            <a href="<?php echo "product/" . $item['slug'] ?>" title="" class="thumb fl-left">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo "product/" . $item['slug'] ?>" title="" class="product-name"><?php echo $item['title']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['old_price']); ?></span>
                                </div>
                                <a href="<?php echo $item['url_checkout'] ?>" title="" class="buy-now">Mua ngay</a>
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

    <div class="section" id="banner-wp">
        <?php
        if (!empty($list_media_banner)) {
            ?>
            <div class="section-detail">
                <?php
                foreach ($list_media_banner as $item) {
                    ?>
                    <a href="" title="" class="thumb">
                        <img src="<?php echo $item['thumbnail']; ?>" alt=""><br>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>

    </div>
</div>