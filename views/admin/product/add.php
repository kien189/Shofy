<?php include "../views/admin/layout/header.php"; ?>
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">

            <form action="index.php?act=add_product" method="post" enctype="multipart/form-data">
                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Product Name</label>
                                        <input type="text" id="product-name" name="name" onkeyup="ChangeToSlug()" class="form-control" placeholder="Items Name">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <label for="product-categories" class="form-label">Product Categories</label>
                                    <select class="form-control" name="category_id" id="product-categories" data-choices data-choices-groups data-placeholder="Select Categories">
                                        <?php foreach ($listCategory as $category): ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-brand" class="form-label">Price</label>
                                        <input type="text" id="product-brand" class="form-control" name="priceProduct" placeholder="Brand Name">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-brand" class="form-label">Sale Price</label>
                                        <input type="text" id="product-brand" class="form-control" name="salePriceProduct" placeholder="Brand Name">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" class="form-control" name="slug"  placeholder="Brand Name">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card variants">
                        <div class="card-header">
                            <div id="variant-container">
                                <!-- Biến thể mặc định đầu tiên -->
                                <div class="variant-item mb-4">
                                    <div class="row mb-4">
                                        <div class="col-lg-4">
                                            <div class="mt-3">
                                                <h5 class="text-dark fw-medium">Size :</h5>
                                                <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                    <?php foreach ($size as $s): ?>
                                                        <!-- Sửa thành mảng name="size[]" -->
                                                        <input type="checkbox" class="btn-check" name="size[]" id="size-<?= $s['id'] ?>" value="<?= $s['id'] ?>">
                                                        <label class="btn btn-light btn-lg avatar-sm rounded d-flex justify-content-center align-items-center" for="size-<?= $s['id'] ?>">
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
                                                        <!-- Sửa thành mảng name="color[]" -->
                                                        <input type="checkbox" name="color[]" class="btn-check" id="color-<?= $c['id'] ?>" value="<?= $c['id'] ?>" autocomplete="off">
                                                        <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-<?= $c['id'] ?>">
                                                            <i class="bx bxs-circle fs-18" style="color: <?= $c['color_code'] ?>;"></i>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mt-3">
                                                <label for="product-stock" class="form-label">Quantity</label>
                                                <input type="number" id="product-stock" name="quantity[]" class="form-control" placeholder="Quantity">
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
                                </div>
                            </div>
                            <!-- Nút để thêm biến thể mới -->
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
                                <textarea class="form-control bg-light-subtle editor1" id="description" name="description" rows="7" placeholder="Short description about the product"></textarea>
                            </div>
                        </div>
                    </div>
                   
                    <!-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pricing Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">

                                    <label for="product-price" class="form-label">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                        <input type="number" id="product-price" class="form-control" placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-discount" class="form-label">Discount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                        <input type="number" id="product-discount" class="form-control" placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-tex" class="form-label">Tex</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bxs-file-txt'></i></span>
                                        <input type="number" id="product-tex" class="form-control" placeholder="000">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" name="add_product" class="btn btn-outline-secondary w-100">Creat Product</button>
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
    <script>
        document.getElementById('add-variant').addEventListener('click', function() {
            // Lấy khu vực chứa các biến thể sản phẩm bằng id
            var container = document.getElementById('variant-container');

            // Tạo một div mới để chứa biến thể
            var newVariant = document.createElement('div');
            // Thêm các lớp CSS để định dạng cho div mới
            newVariant.classList.add('variant-item', 'mb-4');

            //container.appendChild(newVariant);:
            // Thêm phần tử div mới chứa biến thể vào trong container, hiển thị nó trên giao diện người dùng.
            // Nội dung của biến thể mới
            newVariant.innerHTML = `
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Size :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        <?php foreach ($size as $s): ?>
                            <input type="checkbox" class="btn-check" id="size-<?= $s['id'] ?>-${container.children.length}" name="size[]" value="<?= $s['id'] ?>">
                            <label class="btn btn-light btn-lg avatar-sm rounded d-flex justify-content-center align-items-center" for="size-<?= $s['id'] ?>-${container.children.length}"><?= $s['size'] ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mt-3">
                    <h5 class="text-dark fw-medium">Colors :</h5>
                    <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                        <?php foreach ($color as $c): ?>
                            <input type="checkbox" class="btn-check" id="color-<?= $c['id'] ?>-${container.children.length}" name="color[]" value="<?= $c['id'] ?>" autocomplete="off">
                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-<?= $c['id'] ?>-${container.children.length}">
                                <i class="bx bxs-circle fs-18" style="color: <?= $c['color_code'] ?>;"></i>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-3">
                    <label for="product-stock-${container.children.length}" class="form-label">Quantity</label>
                    <input type="number" name="quantity[]" id="product-stock-${container.children.length}" class="form-control" placeholder="Quantity">
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
        });
    </script>

</div>
<?php include "../views/admin/layout/footer.php"; ?>