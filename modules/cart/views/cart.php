<?php
get_header();
?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <h3 class="title">Giỏ hàng</h3>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php
                if (!empty($list_buy)) {
                    ?>
                    <form action="?mod=cart&act=update" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                    ?>
                                    <tr title="<?php echo $item['product_id'] ?>">
                                        <td><?php echo $item['product_code']; ?></td>
                                        <td>
                                            <a href="<?php echo $item['product_url'] ?>" title="" class="thumb">
                                                <img src="<?php echo $item['product_thumbnail']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['product_url']; ?>" title="" class="name-product"><?php echo $item['product_title']; ?></a>
                                        </td>
                                        <td class="price"><?php echo currency_format($item['product_price']); ?></td>
                                        <td>
                                            <input type="number" name="quantity_of_product[<?php echo $item['product_id'] ?>]" min="1" value="<?php echo $item['product_quantity']; ?>" class="num-order">
                                        </td>
                                        <td class="total"><?php echo currency_format($item['sub_total']); ?></td>
                                        <td>
                                            <a href="<?php echo $item['url_delete_cart'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($total_cart); ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <!-- <input type="submit" name="btn_update_cart" id="update-cart" value="Cập nhật giỏ hàng"> -->
                                                <a href="?mod=cart&controller=index&action=checkout" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <?php
                } else {
                    ?>
                    <p style="font-weight : bold;">Không có sản phẩm trong giỏ hàng. Click vào <a href="?">Trang chủ</a> để tiếp tục mua hàng</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <!-- <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p> -->
                <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&controller=index&action=delete" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>