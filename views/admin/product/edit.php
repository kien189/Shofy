<?php include "../views/admin/layout/header.php"; ?>
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">

            <form action="index.php?act=update_product&product_id=<?= $getProductID['product_info']['product_id'] ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="product_id" value="<?= $getProductID['product_info']['product_id'] ?>">

                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            <img src="./images/product/<?= $getProductID['product_info']['product_image'] ?>"
                                alt="" class="avatar-md">
                            <input type="hidden" name="oldImage" value="<?= $getProductID['product_info']['product_image'] ?>">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            <?php foreach ($getProductID['product_gallery'] as $image): ?>

                                <img src="./images/productGalery/<?= $image['image'] ?>"
                                    alt="" class="avatar-md">
                                <input type="hidden" name="oldImages[]" value="<?= $image['image'] ?>">
                            <?php endforeach; ?>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Product Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Product Name</label>
                                        <input type="text" id="product-name" name="name" value="<?= $getProductID['product_info']['product_name'] ?>" class="form-control" placeholder="Items Name">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <label for="product-categories" class="form-label">Product Categories</label>
                                    <select class="form-control" name="category_id" id="product-categories" data-choices data-choices-groups data-placeholder="Select Categories">
                                        <?php foreach ($listCategory as $category): ?>
                                            <option value="<?= $category['id'] ?>" <?= $getProductID['product_info']['category_id'] == $category['id'] ? 'selected' : 'Loi' ?>><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-brand" class="form-label">Price</label>
                                        <input type="text" id="product-brand" class="form-control" value="<?= $getProductID['product_info']['product_price'] ?>" name="priceProduct" placeholder="Brand Name">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <?php foreach ($getProductID['product_variants'] as $index => $variant): // Sử dụng $index để làm chỉ số duy nhất 
                    ?>
                        <div class="card variants">
                            <div class="card-header">
                                <div>
                                    <!-- Input hidden chứa product_variant_id -->
                                    <input type="hidden" name="product_variant_id[]" value="<?= $variant['product_variant_id'] ?>">

                                    <div class="variant-item mb-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-dark fw-medium">Variant</h5>
                                            <a onclick="return confirm('Are you sure?')" href="index.php?act=delete_variant&product_variant_id=<?= $variant['product_variant_id'] ?>" class="text-dark fw-medium" value="<?= $variant['product_variant_id'] ?>"><i class='bx bx-x'></i></a>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-lg-4">
                                                <div class="mt-3">
                                                    <h5 class="text-dark fw-medium">Size :</h5>
                                                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                        <?php foreach ($size as $s): ?>
                                                            <!-- Thêm $index vào id để tạo id duy nhất -->
                                                            <input type="checkbox" class="btn-check" name="size[]" id="size-<?= $s['id'] ?>-<?= $index ?>" value="<?= $s['id'] ?>" <?= ($s['id'] == $variant['variant_size_id']) ? 'checked' : '' ?>>
                                                            <label class="btn btn-light btn-lg avatar-sm rounded d-flex justify-content-center align-items-center" for="size-<?= $s['id'] ?>-<?= $index ?>">
                                                                <?= $s['size'] ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-5">
                                                <div class="mt-3">
                                                    <h5 class="text-dark fw-medium">Colors :</h5>
                                                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                        <?php foreach ($color as $c): ?>
                                                            <!-- Thêm $index vào id để tạo id duy nhất -->
                                                            <input type="checkbox" class="btn-check" name="color[]" id="color-<?= $c['id'] ?>-<?= $index ?>" value="<?= $c['id'] ?>" <?= ($c['id'] == $variant['variant_color_id']) ? 'checked' : '' ?> autocomplete="off">
                                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-<?= $c['id'] ?>-<?= $index ?>">
                                                                <i class="bx bxs-circle fs-18" style="color: <?= $c['color_code'] ?>;"></i>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="mt-3">
                                                    <label for="product-stock-<?= $index ?>" class="form-label">Quantity</label>
                                                    <input type="number" id="product-stock-<?= $index ?>" name="quantity[]" value="<?= $variant['variant_quantity'] ?>" class="form-control" placeholder="Quantity">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-lg-6">
                                                <div class="mt-3">
                                                    <h5 class="text-dark fw-medium">Price :</h5>
                                                    <input type="text" name="price[]" class="form-control" placeholder="Price" value="<?= $variant['variant_price'] ?> ">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mt-3">
                                                    <h5 class="text-dark fw-medium">Sale Price :</h5>
                                                    <input type="text" name="salePrice[]" class="form-control" placeholder="Sale Price" value="<?= $variant['variant_sale_price'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="card variants">
                        <div class="card-header">
                            <div id="variant-container">
                                <!-- Biến thể sẽ được thêm vào đây -->
                            </div>
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <button type="button" id="add-variant" class="btn btn-outline-secondary w-100">Add Variant</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control bg-light-subtle editor1" id="description" name="description" rows="7" placeholder="Short description about the product"><?= $getProductID['product_info']['product_description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                   
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" name="update_product" class="btn btn-outline-secondary w-100">Creat Product</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="#!" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
    <!-- End Container Fluid -->
    <!-- Nhúng dữ liệu từ PHP vào JavaScript -->
    <script>
        var sizes = <?= json_encode($size); ?>; // Lấy dữ liệu size từ PHP
        var colors = <?= json_encode($color); ?>; // Lấy dữ liệu color từ PHP
    </script>




<script>
    // Khởi tạo biến đếm để theo dõi số lượng biến thể
    var variantIndex = <?= count($getProductID['product_variants']) ?>; // Đếm số biến thể hiện có để tránh trùng lặp

    document.getElementById('add-variant').addEventListener('click', function() {
        // Lấy khu vực chứa các biến thể sản phẩm bằng id
        var container = document.getElementById('variant-container');

        // Tạo một div mới để chứa biến thể
        var newVariant = document.createElement('div');
        newVariant.classList.add('variant-item', 'mb-4');

        // Tạo danh sách size checkbox từ mảng sizes
        var sizeCheckboxes = '';
        sizes.forEach(function(s) {
            sizeCheckboxes += `
            <input type="checkbox" class="btn-check" id="size-${s.id}-${variantIndex}" name="size[]" value="${s.id}">
            <label class="btn btn-light btn-lg avatar-sm rounded d-flex justify-content-center align-items-center" for="size-${s.id}-${variantIndex}">${s.size}</label>
            `;
        });

        // Tạo danh sách color checkbox từ mảng colors
        var colorCheckboxes = '';
        colors.forEach(function(c) {
            colorCheckboxes += `
            <input type="checkbox" class="btn-check" id="color-${c.id}-${variantIndex}" name="color[]" value="${c.id}" autocomplete="off">
            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-${c.id}-${variantIndex}">
                <i class="bx bxs-circle fs-18" style="color: ${c.color_code};"></i>
            </label>
            `;
        });

        // Nội dung của biến thể mới
        newVariant.innerHTML = `
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Size :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        ${sizeCheckboxes}
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Colors :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        ${colorCheckboxes}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-3">
                    <label for="product-stock-${variantIndex}" class="form-label">Quantity</label>
                    <input type="number" name="quantity[]" id="product-stock-${variantIndex}" class="form-control" placeholder="Quantity">
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Price :</h5>
                    <input type="text" name="price[]" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Sale Price :</h5>
                    <input type="text" name="salePrice[]" class="form-control" placeholder="Sale Price">
                </div>
            </div>
        </div>
        `;

        // Thêm biến thể mới vào container
        container.appendChild(newVariant);

        // Tăng biến đếm lên để id tiếp theo là duy nhất
        variantIndex++;
    });
</script>


</div>
<?php include "../views/admin/layout/footer.php"; ?>