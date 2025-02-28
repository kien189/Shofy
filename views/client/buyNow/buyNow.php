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
                                    <form action="#">

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
                                    </form>
                                </div>
                            </div>
                            <div class="tp-checkout-verify-item">
                                <p class="tp-checkout-verify-reveal">Have a coupon? <button type="button" class="tp-checkout-coupon-form-reveal-btn">Click here to enter your code</button></p>

                                <div id="tpCheckoutCouponForm" class="tp-return-customer">
                                    <form action="#">
                                        <div class="tp-return-customer-input">
                                            <label>Coupon Code :</label>
                                            <input type="text" placeholder="Coupon">
                                        </div>
                                        <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Apply</button>
                                    </form>
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
                                        <!-- <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Last Name <span>*</span></label>
                                                    <input type="text" placeholder="Last Name">
                                                </div>
                                            </div> -->
                                        <!-- <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Company name (optional)</label>
                                                    <input type="text" placeholder="Example LTD.">
                                                </div>
                                            </div> -->
                                        <!-- <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Country / Region </label>
                                                    <input type="text" placeholder="United States (US)">
                                                </div>
                                            </div> -->
                                        <!-- <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Street address</label>
                                                    <input type="text" placeholder="House number and street name">
                                                </div>

                                                <div class="tp-checkout-input">
                                                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div> -->
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Address <span>*</span></label>
                                                <input type="text" placeholder="" name="address" value="<?= $_SESSION['user']['address'] ?>">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>State / County</label>
                                                    <select>
                                                        <option>New York US</option>
                                                        <option>Berlin Germany</option>
                                                        <option>Paris France</option>
                                                        <option>Tokiyo Japan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Postcode ZIP</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div> -->
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
                                    <input type="hidden" name="product_id" value="<?= $getCheckout[0]['product_id'] ?>">
                                    <input type="hidden" name="variant_id" value="<?= $getCheckout[0]['variant_id'] ?>">
                                    <input type="hidden" name="cart_id" value="<?= $getCheckout[0]['id'] ?>">
                                    <!-- item list -->
                                    <li class="tp-order-info-list-desc">
                                        <p><?= substr($detailCheckout['product_name'], 0, 35) . '...  ' ?> <span class="fw-bold" name="quantity"> x <?= $getCheckout[0]['quantity'] ?></span></p>
                                        <span>$<?= $detailCheckout['variant_sale_price'] ?>.00</span>
                                    </li>
                                    <input type="hidden" name="quantity" value="<?= $getCheckout[0]['quantity'] ?>">
                                    <!-- <li class="tp-order-info-list-desc">
                                        <p>Office Chair Multifun <span> x 1</span></p>
                                        <span><?= $detailCheckout['variant_price'] ?></span>
                                    </li>
                                    <li class="tp-order-info-list-desc">
                                        <p>Apple Watch Series 6 Stainless <span> x 3</span></p>
                                        <span><?= $detailCheckout['variant_sale_price'] ?></span>
                                    </li>
                                    <li class="tp-order-info-list-desc">
                                        <p>Body Works Mens Collection <span> x 1</span></p>
                                        <span>$145:00</span>
                                    </li> -->

                                    <!-- subtotal -->
                                    <li class="tp-order-info-list-subtotal">
                                        <span>Subtotal</span>
                                        <span>$<?= $detailCheckout['variant_sale_price'] * $getCheckout[0]['quantity'] ?>.00</span>
                                    </li>

                                    <!-- shipping -->
                                    <!-- <li class="tp-order-info-list-shipping">
                                        <span>Shipping</span>
                                        <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                                            <span>
                                                <input id="flat_rate" type="radio" name="shipping">
                                                <label for="flat_rate">Flat rate: <span>$20.00</span></label>
                                            </span>
                                            <span>
                                                <input id="local_pickup" type="radio" name="shipping">
                                                <label for="local_pickup">Local pickup: <span>$25.00</span></label>
                                            </span>
                                            <span>
                                                <input id="free_shipping" type="radio" name="shipping">
                                                <label for="free_shipping">Free shipping</label>
                                            </span>
                                        </div>
                                    </li> -->

                                    <!-- total -->
                                    <li class="tp-order-info-list-total">
                                        <span>Total</span>
                                        <span name="amount">$<?= $detailCheckout['variant_sale_price'] * $getCheckout[0]['quantity'] ?>.00</span>
                                        <input type="hidden" name="amount" value="<?= $detailCheckout['variant_sale_price'] * $getCheckout[0]['quantity'] ?>">
                                    </li>
                                </ul>
                            </div>
                            <div class="tp-checkout-payment">
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="back_transfer" name="payment">
                                    <label for="back_transfer" data-bs-toggle="direct-bank-transfer">Direct Bank Transfer</label>
                                    <div class="tp-checkout-payment-desc direct-bank-transfer">
                                        <p>Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn làm tham chiếu thanh toán. Đơn hàng của bạn sẽ không được giao cho đến khi tiền được chuyển vào tài khoản của chúng tôi.</p>
                                    </div>
                                </div>
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cheque_payment" name="payment">
                                    <label for="cheque_payment">Cheque Payment</label>
                                    <div class="tp-checkout-payment-desc cheque-payment">
                                        <p>Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn làm tham chiếu thanh toán. Đơn hàng của bạn sẽ không được giao cho đến khi tiền được chuyển vào tài khoản của chúng tôi.</p>
                                    </div>
                                </div>
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cod" name="payment">
                                    <label for="cod">Cash on Delivery</label>
                                    <div class="tp-checkout-payment-desc cash-on-delivery">
                                        <p>Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn làm tham chiếu thanh toán. Đơn hàng của bạn sẽ không được giao cho đến khi tiền được chuyển vào tài khoản của chúng tôi.</p>
                                    </div>
                                </div>
                                <div class="tp-checkout-payment-item paypal-payment">
                                    <input type="radio" id="paypal" name="payment">
                                    <label for="paypal">PayPal <img src="assets/img/icon/payment-option.png" alt=""> <a href="#">What is PayPal?</a></label>
                                </div>
                            </div>
                            <div class="tp-checkout-agree">
                                <div class="tp-checkout-option">
                                    <input id="read_all" type="checkbox">
                                    <label for="read_all">I have read and agree to the website.</label>
                                </div>
                            </div>
                            <div class="tp-checkout-btn-wrapper">
                                <button type="submit" class="tp-checkout-btn w-100" name="checkout">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- checkout area end -->


</main>

<?php include "../views/client/layout/footer.php"; ?>