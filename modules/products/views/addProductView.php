<?php
get_header();
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="clearfix">
                <form action="?mod=products&controller=cat&action=addProduct" method="POST">
                    <label for="product_title">Nhập tên sản phẩm</label>
                    <input type="text" name="product_title" id="product_title" value="">
                    <label for="product_content">Nhập nội dung sản phẩm</label>
                    <input type="text" name="product_content" id="product_content" value="">
                    <label for="product_description">Nhập mô tả sản phẩm</label>
                    <input type="text" name="product_description" id="product_description" value="">
                    <label for="product_price">Nhập giá sản phẩm</label>
                    <input type="number" name="product_price" id="product_price" value="">
                    <label for="product_code">Nhập code sản phẩm</label>
                    <input type="text" name="product_code" id="product_code" value="">
                    <label for="product_thumbnail">Nhập link ảnh sản phẩm</label>
                    <input type="text" name="product_thumbnail" id="product_thumbnail" value="">
                    <label for="product_cat_id">Nhập id danh mục</label>
                    <input type="number" name="product_cat_id" id="product_cat_id" value=""><br><br>

                    <input type="submit" name="btn_reg_product" value="Đăng ký sản phẩm">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>