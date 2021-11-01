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



