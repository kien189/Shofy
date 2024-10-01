<?php include "../views/admin/layout/header.php"; ?>
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">All Product List</h4>

                            <a href="index.php?act=add_product" class="btn btn-sm btn-primary">
                                Add Product
                            </a>

                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    This Month
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Export</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Import</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Product Name & Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Rating</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($listProduct as $product) : ?>
                                        <tr>
                                            <td>
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="images/product/<?php echo $product['product_image'] ?>"
                                                             alt="" class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!"
                                                           class="text-dark fw-medium fs-15"><?php echo $product['product_name'] ?></a>
                                                        <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>
                                                            <?php $sizes = array_column($product['variants'], 'variant_size');
                                                            echo implode(', ', array_unique($sizes)); // Hiển thị các kích thước không trùng lặp
                                                            ?>
                                                        </p>
                                                        <p class="text-muted mb-0 mt-1 fs-13">
                                                            <span>Color: </span>
                                                            <!-- Hiển thị màu sắc -->
                                                            <?php
                                                            $colors = array_column($product['variants'], 'variant_color');
                                                            echo implode(', ', array_unique($colors)); // Hiển thị các màu sắc không trùng lặp
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td><?= number_format($product['product_price']) ?> đ
                                                to <?= number_format($product['variants'][0]['variant_price']) ?> đ
                                            </td>
                                            <td>
                                                <p class="mb-1 text-muted"><span
                                                            class="text-dark fw-medium">486 Item</span> Left</p>
                                                <p class="mb-0 text-muted">155 Sold</p>
                                            </td>
                                            <td> <?= $product['category_name'] ?></td>
                                            <td><span class="badge p-1 bg-light text-dark fs-12 me-1"><i
                                                            class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> 4.5</span>
                                                55 Review
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" class="btn btn-light btn-sm">
                                                        <iconify-icon icon="solar:eye-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <a href="index.php?act=edit_product<?= "&product_id=" . $product['product_id'] ?>"
                                                       class="btn btn-soft-primary btn-sm">
                                                        <iconify-icon icon="solar:pen-2-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <a onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không ?')" href="index.php?act=delete_product<?= "&product_id=" . $product['product_id'] ?>" class="btn btn-soft-danger btn-sm">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                        <div class="card-footer border-top">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->


    </div>
<?php include "../views/admin/layout/footer.php"; ?>