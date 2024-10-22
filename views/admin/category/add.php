<?php include "../views/admin/layout/header.php"; ?>
<div class="wrapper">

    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <!-- <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="assets_admin/images/product/p-1.png" alt="" class="avatar-xxl">
                        </div>
                        <div class="mt-3">
                            <h4>Fashion Men , Women & Kid's</h4>
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Created By :</p>
                                    <h5 class="mb-0">Seller</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Stock :</p>
                                    <h5 class="mb-0">46233</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">ID :</p>
                                    <h5 class="mb-0">FS16276</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="row g-2">
                            <div class="col-lg-6">
                                <a href="#!" class="btn btn-outline-secondary w-100">Create Category</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="#!" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                <form action="index.php?act=add_category" method="post" enctype="multipart/form-data">
                    <div class="col-xl-9 col-lg-8 ">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Thumbnail Photo</h4>
                            </div>
                            <div class="card-body">
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">General Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="meta-tag" class="form-label">Meta Tag Keyword</label>
                                            <input type="text" id="meta-tag" class="form-control" name="name" placeholder="Enter word">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="description" id="description" rows="4" placeholder="Type description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <button type="submit" name="add_category" class="btn btn-outline-secondary w-100">Save Change</button>
                                </div>
                                <div class="col-lg-2">

                                    <a href="index.php?act=category" class="btn btn-primary w-100">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- End Container Fluid -->

    <!-- ========== Footer Start ========== -->

    <!-- ========== Footer End ========== -->

</div>

<?php include "../views/admin/layout/footer.php"; ?>