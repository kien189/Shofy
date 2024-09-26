<?php include "../views/admin/layout/header.php"; ?>

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">

            <form action="index.php?act=update_category&id=<?= $getCategory['id'] ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$getCategory['id']?>">
                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Thumbnail Photo</h4>
                        </div>
                        <div class="card-body text-center">
                            <img src="./images/category/<?= $getCategory['image'] ?>" alt="">
                            <input type="file" name="image" id="image" class="form-control">
                            <input type="hidden" name="oldImage" value="<?= $getCategory['image']; ?>" >
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Meta Options</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="meta-tag" class="form-label">Meta Tag Keyword</label>
                                        <input type="text" id="meta-tag" name="name" class="form-control" value="<?= $getCategory['name'] ?>" placeholder="Enter word">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-0">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" id="description" name="description" rows="4" placeholder="Type description"><?= $getCategory['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" name="update_category" class="btn btn-outline-secondary w-100">Save Change</button>
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

<?php include "../views/admin/layout/footer.php"; ?>