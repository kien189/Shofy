<?php include "../views/client/layout/header.php"; ?>
<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">Checkout</h3>
                        <div class="breadcrumb__list">
                            <span><a href="#">Home</a></span>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- checkout area start -->
    <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
        <div class="container">
            <form action="index.php?act=order" method="post">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="tp-checkout-verify">
                            <div class="tp-checkout-verify-item">
                                <p class="tp-checkout-verify-reveal">Returning customer? <button type="button" class="tp-checkout-login-form-reveal-btn">Click here to login</button></p>

                                <div id="tpReturnCustomerLoginForm" class="tp-return-customer">


                                    <div class="tp-return-customer-input">
                                        <label>Email</label>
                                        <input type="text" placeholder="Your Email">
                                    </div>
                                    <div class="tp-return-customer-input">
                                        <label>Password</label>
                                        <input type="password" placeholder="Password">
                                    </div>

                                    <div class="tp-return-customer-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                        <div class="tp-return-customer-remeber">
                                            <input id="remeber" type="checkbox">
                                            <label for="remeber">Remember me</label>
                                        </div>
                                        <div class="tp-return-customer-forgot">
                                            <a href="forgot.html">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Login</button>

                                </div>
                            </div>
                            <div class="tp-checkout-verify-item">
                                <p class="tp-checkout-verify-reveal">Have a coupon? <button type="button" class="tp-checkout-coupon-form-reveal-btn">Click here to enter your code</button></p>

                                <div id="tpCheckoutCouponForm" class="tp-return-customer">

                                    <div class="tp-return-customer-input">
                                        <label>Coupon Code :</label>
                                        <input type="text" placeholder="Coupon">
                                    </div>
                                    <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Apply</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Billing Details</h3>

                            <div class="tp-checkout-bill-form">

                                <div class="tp-checkout-bill-inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>First Name <span>*</span></label>
                                                <input type="text" placeholder="First Name" name="name" value="<?= $_SESSION['user']['name'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Address <span>*</span></label>
                                                <input type="text" placeholder="" name="address" value="<?= $_SESSION['user']['address'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Phone <span>*</span></label>
                                                <input type="text" placeholder="" name="phone" value="<?= $_SESSION['user']['phone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Email address <span>*</span></label>
                                                <input type="email" placeholder="" name="email" value="<?= $_SESSION['user']['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-option-wrapper">
                                                <div class="tp-checkout-option">
                                                    <input id="create_free_account" type="checkbox">
                                                    <label for="create_free_account">Create an account?</label>
                                                </div>
                                                <div class="tp-checkout-option">
                                                    <input id="ship_to_diff_address" type="checkbox">
                                                    <label for="ship_to_diff_address">Ship to a different address?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Order notes (optional)</label>
                                                <textarea placeholder="Notes about your order, e.g. special notes for delivery." name="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place white-bg">
                            <h3 class="tp-checkout-place-title">Your Order</h3>

                            <div class="tp-order-info-list">
                                <ul>

                                    <!-- header -->
                                    <li class="tp-order-info-list-header">
                                        <h4>Product</h4>
                                        <h4>Total</h4>
                                    </li>
                                    <?php foreach ($getCheckout as $key => $detailCheckout) : ?>
                                        <input type="hidden" name="product_id" value="<?= $detailCheckout['product_id'] ?>" id="">
                                        <input type="hidden" name="variant_id" value="<?= $detailCheckout['variant_id'] ?>" id="">
                                        <input type="hidden" name="cart_id" value="<?= $detailCheckout['cart_id'] ?>" id="">
                                        <input type="hidden" name="quantity" value="<?= $detailCheckout['cart_quantity'] ?>" id="">
                                        <input type="hidden" name="coupon_id" value="<?=$_SESSION['coupon']['id'] ?? null ?>">
                                        <!-- item list -->
                                        <li class="tp-order-info-list-desc">
                                            <p><?= substr($detailCheckout['product_name'], 0, 35) ?>. <span> x 2</span></p>
                                            <span>$<?= $detailCheckout['variant_price'] * $detailCheckout['cart_quantity'] ?>.00</span>
                                        </li>
                                    <?php endforeach ?>

                                    <!-- subtotal -->
                                    <li class="tp-order-info-list-subtotal">
                                        <span>Subtotal</span>
                                        <span>$<?= $total ?>.00</span>
                                    </li>
                                    <li class="tp-order-info-list-subtotal">
                                        <p>Coupon: <?= $_SESSION['coupon']['name'] ?? '' ?></p>
                                        <p> - $<?= $_SESSION['totalCart'] ?? '' ?>.00</p>
                                    </li>

                                    <!-- shipping -->
                                    <li class="tp-order-info-list-shipping">
                                        <span>Shipping</span>
                                        <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                                            <?php foreach ($shipping as $key =>  $ship) : ?>
                                                <span>
                                                    <input id="flat_rate<?=$key?>" type="radio" name="shipping_id" value="<?=$ship['id']?>" <?= $key === 0 ? 'checked' : '' ?>>
                                                    <label for="flat_rate<?=$key?>"><?=$ship['shipping_name']?>: <span>$.<?=$ship['shipping_price']?>.00</span></label>
                                                </span>
                                            <?php endforeach; ?>
                                            <span>
                                                <input id="free_shipping" type="radio" name="shipping">
                                                <label for="free_shipping">Free shipping</label>
                                            </span>
                                        </div>
                                    </li>

                                    <!-- total -->
                                    <li class="tp-order-info-list-total">
                                        <span>Total</span>
                                        <input type="hidden" name="amount" value="<?= $total ?>">
                                        <span>$<?= $total - ($_SESSION['totalCart'] ?? 0) ?>.00</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="tp-checkout-payment">
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="momoPayment" name="payment">
                                    <label for="momoPayment" data-bs-toggle="direct-bank-transfer">Momo</label>
                                    <div class="tp-checkout-payment-desc direct-bank-transfer">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="vnpayPayment" name="payment">
                                    <label for="vnpayPayment">VnPay</label>
                                    <div class="tp-checkout-payment-desc cheque-payment">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cod" name="payment" checked>
                                    <label for="cod">Cash on Delivery</label>
                                    <div class="tp-checkout-payment-desc cash-on-delivery">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                                <!-- <div class="tp-checkout-payment-item paypal-payment">
                                    <input type="radio" id="paypal" name="payment">
                                    <label for="paypal">PayPal <img src="assets/img/icon/payment-option.png" alt=""> <a href="#">What is PayPal?</a></label>
                                </div> -->
                            </div>
                            <!-- <div class="tp-checkout-agree">
                                <div class="tp-checkout-option">
                                    <input id="read_all" type="checkbox">
                                    <label for="read_all">I have read and agree to the website.</label>
                                </div>
                            </div> -->
                            <div class="tp-checkout-btn-wrapper">
                                <button type="submit" id="checkout-button" class="tp-checkout-btn w-100" name="checkout">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- checkout area end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutButton = document.getElementById('checkout-button');
            const paymentMethods = [{
                    element: document.getElementById('momoPayment'),
                    name: 'momo'
                },
                {
                    element: document.getElementById('vnpayPayment'),
                    name: 'vnpay'
                },
                {
                    element: document.getElementById('cod'),
                    name: 'checkout'
                },
            ];
            paymentMethods.forEach(method => {
                method.element.addEventListener('change', function() {
                    if (this.checked) {
                        checkoutButton.setAttribute('name', method.name);
                        console.log(` button name is now:`, method.name);
                    }
                })
            })
        })
    </script>
</main>
<?php include "../views/client/layout/footer.php"; ?>