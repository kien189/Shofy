<?php include "../views/admin/layout/header.php"; ?>
<div class="wrapper">

    <div class="page-content">

        <!-- Start Container Fluid -->
        <form action="index.php?act=coupon_update&id=<?=$coupon['id']?>" method="post">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Coupon Status</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?=$coupon['id']?>">
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" <?= $coupon['status'] == 'Active' ? 'checked' : '' ?> value="Active" name="status" type="radio" id="flexRadioDefault9" checked="">
                                                <label class="form-check-label" for="flexRadioDefault9">
                                                    Active
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" <?= $coupon['status'] == 'In Active' ? 'checked' : '' ?> value="In Active" type="radio" name="status" id="flexRadioDefault10">
                                            <label class="form-check-label" for="flexRadioDefault10">
                                                In Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" <?= $coupon['status'] == 'Future Plan' ? 'checked' : '' ?> value="Future Plan" type="radio" name="status" id="flexRadioDefault11">
                                            <label class="form-check-label" for="flexRadioDefault11">
                                                Future Plan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Date Schedule</h4>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="start-date" class="form-label text-dark">Start Date</label>
                                    <input type="text" value="<?= $coupon['start_date'] ?>" id="start-date" name="start_date" class="form-control flatpickr-input active" placeholder="dd-mm-yyyy" readonly="readonly">
                                </div>


                                <div class="mb-3">
                                    <label for="end-date" class="form-label text-dark">End Date</label>
                                    <input type="text" id="end-date" value="<?= $coupon['end_date'] ?>" name="end_date" class="form-control flatpickr-input active" placeholder="dd-mm-yyyy" readonly="readonly">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Coupon Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="coupons-code" class="form-label">Coupons Name</label>
                                            <input type="text" id="coupons-code" name="name" value="<?= $coupon['name'] ?>" class="form-control" placeholder="Code enter">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="coupons-code" class="form-label">Coupons Code</label>
                                            <input type="text" id="coupons-code" value="<?= $coupon['coupon_code'] ?>" name="coupon_code" class="form-control" placeholder="Code enter">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="coupons-limits" class="form-label">Coupons Limits</label>
                                            <input type="number" id="coupons-limits" name="quantity" value="<?= $coupon['quantity'] ?>" class="form-control" placeholder="limits ">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mb-3 mt-2">Coupons Types</h4>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" <?= $coupon['type'] == 'Free Shipping' ? 'checked' : '' ?> value="Free Shipping" name="type" id="flexRadioDefault12" checked="">
                                                <label class="form-check-label" for="flexRadioDefault12">
                                                    Free Shipping
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" <?= $coupon['type'] == 'Percentage' ? 'checked' : '' ?> value="Percentage" name="type" id="flexRadioDefault13">
                                            <label class="form-check-label" for="flexRadioDefault13">
                                                Percentage
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" <?= $coupon['type'] == 'Fixed Amount' ? 'checked' : '' ?> value="Fixed Amount" type="radio" name="type" id="flexRadioDefault14">
                                            <label class="form-check-label" for="flexRadioDefault14">
                                                Fixed Amount
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <label for="discount-value" class="form-label">Discount Value</label>
                                            <input type="text" id="discount-value" value="<?= $coupon['coupon_value'] ?>" name="coupon_value" class="form-control" placeholder="value enter">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top">
                                <button type="submit" name="updateCoupon" class="btn btn-primary">Update Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        <!-- <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a
                        href="#" class="fw-bold footer-text" target="_blank">Techzaa</a>
                </div>
            </div>
        </div>
    </footer> -->
        <!-- ========== Footer End ========== -->

    </div>
</div>
<?php include "../views/admin/layout/footer.php"; ?>