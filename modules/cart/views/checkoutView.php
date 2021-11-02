<?php
get_header();
?>
<div id="main-content-wp" class="checkout-page">

    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname">
                            <?php echo form_error('fullname'); ?>
                        </div>

                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                            <?php echo form_error('address'); ?>
                        </div>

                        <div class="form-col fl-right">
                            <label for="tel">Số điện thoại</label>
                            <input type="tel" name="tel" id="phone">
                            <?php echo form_error('tel'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"></textarea>
                        </div>
                    </div>

                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="payment-bank">
                                <label for="direct-payment">Thanh toán qua ngân hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <?php echo form_error('payment-method'); ?>
                        </ul>
                    </div>

                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="checkout" value="Đặt hàng">
                    </div>
                </form>
            </div>
        </div>

        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <?php
                if (!empty($list_buy)) {
                    ?>
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_buy as $item) {
                                ?>
                                <tr class="cart-item">
                                    <td class="product-name"><?php echo $item['title']; ?><strong class="product-quantity">x <?php echo $item['quantity']; ?></strong></td>
                                    <td class="product-total"><?php echo currency_format($item['sub_total']); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format($total); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php
                }
                ?>


            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>