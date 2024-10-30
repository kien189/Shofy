<?php include "../views/admin/layout/header.php"; ?>
<div class="wrapper">

<div class="page-content">

     <!-- Start Container -->
     <div class="container-xxl">

          <div class="row">
               <div class="col-xl-9 col-lg-8">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                             <div>
                                                  <h4 class="fw-medium text-dark d-flex align-items-center gap-2">#0758267/90 <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span><span class="border border-warning text-warning fs-13 px-2 py-1 rounded">In Progress</span></h4>
                                                  <p class="mb-0">Order / Order Details / #0758267/90 - April 23 , 2024 at 6:23 pm</p>
                                             </div>
                                             <form action="index.php?act=update_order" method="post">

                                                  <div>
                                                       <input type="hidden" name="id" value="<?= $getOrderById['order_detail_id'] ?>">
                                                       <div class="d-flex flex-wrap align-items-center gap-2 mb-3 mt-3">
                                                            <a href="#!" class="btn btn-outline-secondary">Refund</a>
                                                            <a href="#!" class="btn btn-outline-secondary">Return</a>
                                                            <select id="orderStatus" name="status" class="form-select">
                                                                 <option value="" disabled selected>Select status</option>
                                                                 <option value="Pending" <?= $getOrderById['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                                 <option value="Confirmed" <?= $getOrderById['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                                 <option value="Shipped" <?= $getOrderById['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                                                 <option value="Delivered" <?= $getOrderById['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                                                 <option value="Canceled" <?= $getOrderById['status'] == 'Canceled' ? 'selected' : '' ?>>Canceled</option>
                                                            </select>
                                                            <button type="submit" name="updateOrder" class="btn btn-primary ">Edit Order</button>
                                                       </div>

                                                  </div>
                                             </form>

                                        </div>

                                        <div class="mt-4">
                                             <h4 class="fw-medium text-dark">Progress</h4>
                                        </div>
                                        <div class="row row-cols-xxl-5 row-cols-md-2 row-cols-1">
                                             <?php
                                             // Các trạng thái và tên hiển thị tương ứng
                                             $statuses = [
                                                  'Pending' => 'Pending',
                                                  'Confirmed' => 'Order Confirming',
                                                  'Shipped' => 'Processing',
                                                  'Delivered' => 'Shipping',
                                                  'Canceled' => 'Canceled'
                                             ];

                                             // Vòng lặp qua từng trạng thái
                                             foreach ($statuses as $status => $label) {
                                                  // Xác định màu sắc cho thanh tiến độ
                                                  if ($status === $getOrderById['status']) {
                                                       // Nếu trạng thái hiện tại
                                                       if ($status === 'Canceled') {
                                                            $barClass = 'bg-danger'; // Màu đỏ cho trạng thái Canceled
                                                            $barWidth = '100%'; // Hoàn thành
                                                       } else {
                                                            $barClass = 'bg-success'; // Màu xanh cho trạng thái hoàn thành
                                                            $barWidth = '100%'; // Hoàn thành
                                                       }
                                                  } elseif (array_search($status, array_keys($statuses)) < array_search($getOrderById['status'], array_keys($statuses))) {
                                                       // Nếu trạng thái đã hoàn thành
                                                       $barClass = 'bg-success'; // Màu xanh cho trạng thái đã hoàn thành
                                                       $barWidth = '100%'; // Hoàn thành
                                                  } else {
                                                       // Nếu trạng thái chưa hoàn thành
                                                       $barClass = 'bg-secondary'; // Màu xám cho trạng thái chưa hoàn thành
                                                       $barWidth = '0%'; // Chưa hoàn thành
                                                  }
                                             ?>
                                                  <div class="col">
                                                       <div class="progress mt-3" style="height: 10px;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated <?= $barClass ?>"
                                                                 role="progressbar"
                                                                 style="width: <?= $barWidth ?>"
                                                                 aria-valuenow="70"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                            </div>
                                                       </div>
                                                       <p class="mb-0 mt-2"><?= $label ?></p>
                                                  </div>
                                             <?php
                                             }
                                             ?>
                                        </div>

                                   </div>
                                   <div class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                        <p class="border rounded mb-0 px-2 py-1 bg-body"><i class='bx bx-arrow-from-left align-middle fs-16'></i> Estimated shipping date : <span class="text-dark fw-medium"><?= date('M d, Y' . $getOrderById['created_at']) ?></span></p>
                                        <div>
                                             <a href="#!" class="btn btn-primary">Make As Ready To Ship</a>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Product</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle border-bottom">
                                                       <tr>
                                                            <th>Product Name & Size</th>
                                                            <th>Status</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <!-- <th>Text</th> -->
                                                            <th>Amount</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach ($product as $value) : ?>
                                                            <tr>
                                                                 <td>
                                                                      <div class="d-flex align-items-center gap-2">
                                                                           <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                                <img src="./images/product/<?= $value['order_product_image'] ?>" alt="" class="avatar-md">
                                                                           </div>
                                                                           <div>
                                                                                <a href="#!" class="text-dark fw-medium fs-15">Men Black Slim Fit T-shirt</a>
                                                                                <span class="d-flex gap-2">
                                                                                     <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span><?= $value['order_variant_size_name'] ?></p>
                                                                                     <p class="text-muted mb-0 mt-1 fs-13"><span>Color : </span><?= $value['order_variant_color_name'] ?></p>
                                                                                </span>
                                                                           </div>
                                                                      </div>

                                                                 </td>

                                                                 <td>
                                                                      <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                                                 </td>
                                                                 <td> <?= $value['quantity'] ?></td>
                                                                 <td>$<?= $value['order_product_price'] ?>.00</td>
                                                                 <!-- <td> $3.00</td> -->
                                                                 <td>
                                                                      $<?= $value['quantity'] * $value['order_product_price'] ?>.00
                                                                 </td>
                                                            </tr>
                                                       <?php endforeach; ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Order Timeline</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="position-relative ms-2">
                                             <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                                             <div class="position-relative ps-4">
                                                  <div class="mb-4">
                                                       <span class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle">
                                                            <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                                 <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                       </span>
                                                       <div class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                            <div>
                                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The packing has been started</h5>
                                                                 <p class="mb-0">Confirmed by Gaston Lapierre</p>
                                                            </div>
                                                            <p class="mb-0">April 23, 2024, 09:40 am</p>

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="position-relative ps-4">
                                                  <div class="mb-4">
                                                       <span class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                            <i class='bx bx-check-circle'></i>
                                                       </span>
                                                       <div class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                            <div>
                                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been sent to the customer</h5>
                                                                 <p class="mb-2">Invoice email was sent to <a href="#!" class="link-primary">hello@dundermuffilin.com</a></p>
                                                                 <a href="#!" class="btn btn-light">Resend Invoice</a>
                                                            </div>
                                                            <p class="mb-0">April 23, 2024, 09:40 am</p>

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="position-relative ps-4">
                                                  <div class="mb-4">
                                                       <span class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                            <i class='bx bx-check-circle'></i>
                                                       </span>
                                                       <div class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                            <div>
                                                                 <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been created</h5>
                                                                 <p class="mb-2">Invoice created by Gaston Lapierre</p>
                                                                 <a href="#!" class="btn btn-primary">Download Invoice</a>
                                                            </div>
                                                            <p class="mb-0">April 23, 2024, 09:40 am</p>

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="position-relative ps-4">
                                                  <div class="mb-4">
                                                       <span class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                            <i class='bx bx-check-circle'></i>
                                                       </span>
                                                       <div class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                            <div>
                                                                 <h5 class="mb-1 text-dark fw-medium fs-15">Order Payment</h5>
                                                                 <p class="mb-2">Using Master Card</p>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <p class="mb-1 text-dark fw-medium">Status :</p>
                                                                      <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span>
                                                                 </div>
                                                            </div>
                                                            <p class="mb-0">April 23, 2024, 09:40 am</p>

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="position-relative ps-4">
                                                  <div class="mb-2">
                                                       <span class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                            <i class='bx bx-check-circle'></i>
                                                       </span>
                                                       <div class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                            <div>
                                                                 <h5 class="mb-2 text-dark fw-medium fs-15">4 Order conform by Gaston Lapierre</h5>
                                                                 <a href="#!" class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order 1</a>
                                                                 <a href="#!" class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order 2</a>
                                                                 <a href="#!" class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order 3</a>
                                                                 <a href="#!" class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order 4</a>
                                                            </div>
                                                            <p class="mb-0">April 23, 2024, 09:40 am</p>

                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card bg-light-subtle">
                                   <div class="card-body">
                                        <div class="row g-3 g-lg-0">
                                             <div class="col-lg-3 border-end">
                                                  <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Vender</p>
                                                            <p class="mb-0">Catpiller</p>
                                                       </div>
                                                       <div class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:shop-2-bold-duotone" class="fs-35 text-primary"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-3 border-end">
                                                  <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Date</p>
                                                            <p class="mb-0">April 23 , 2024</p>
                                                       </div>
                                                       <div class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:calendar-date-bold-duotone" class="fs-35 text-primary"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-3 border-end">
                                                  <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Paid By</p>
                                                            <p class="mb-0">Gaston Lapierre</p>
                                                       </div>
                                                       <div class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:user-circle-bold-duotone" class="fs-35 text-primary"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-3">
                                                  <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Reference #IMEMO</p>
                                                            <p class="mb-0">#0758267/90</p>
                                                       </div>
                                                       <div class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:clipboard-text-bold-duotone" class="fs-35 text-primary"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-xl-3 col-lg-4">
                    <div class="card">
                         <div class="card-header">
                              <h4 class="card-title">Order Summary</h4>
                         </div>
                         <div class="card-body">
                              <div class="table-responsive">
                                   <table class="table mb-0">
                                        <tbody>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:clipboard-text-broken"></iconify-icon> Sub Total : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">$<?= ($getOrderById['amount']-$coupon)+$getOrderById['shipping_price'] ?>.00</td>
                                             </tr>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:ticket-broken" class="align-middle"></iconify-icon> Discount : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">-$<?=$coupon?>.00</td>
                                             </tr>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon> Delivery Charge : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">$<?=$getOrderById['shipping_price']?>.00</td>
                                             </tr>
                                             <!-- <tr>
                                             <td class="px-0">
                                                  <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:calculator-minimalistic-broken" class="align-middle"></iconify-icon> Estimated Tax (15.5%) : </p>
                                             </td>
                                             <td class="text-end text-dark fw-medium px-0">$20.00</td>
                                        </tr> -->

                                        </tbody>
                                   </table>
                              </div>
                         </div>
                         <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                              <div>
                                   <p class="fw-medium text-dark mb-0">Total Amount</p>
                              </div>
                              <div>
                                   <p class="fw-medium text-dark mb-0">$<?= $getOrderById['amount'] ?>.00</p>
                              </div>

                         </div>
                    </div>
                    <div class="card">
                         <div class="card-header">
                              <h4 class="card-title">Payment Information</h4>
                         </div>
                         <div class="card-body">
                              <div class="d-flex align-items-center gap-3 mb-3">
                                   <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                                        <img src="assets_admin/images/card/mastercard.svg" alt="" class="avatar-sm">
                                   </div>
                                   <div>
                                        <p class="mb-1 text-dark fw-medium">Master Card</p>
                                        <p class="mb-0 text-dark">xxxx xxxx xxxx 7812</p>
                                   </div>
                                   <div class="ms-auto">
                                        <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                                   </div>
                              </div>
                              <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13"> #IDN768139059</span></p>
                              <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13"> Gaston Lapierre</span></p>

                         </div>
                    </div>
                    <div class="card">
                         <div class="card-header">
                              <h4 class="card-title">Customer Details</h4>
                         </div>
                         <div class="card-body">
                              <div class="d-flex align-items-center gap-2">
                                   <img src="assets_admin/images/users/avatar-1.jpg" alt="" class="avatar rounded-3 border border-light border-3">
                                   <div>
                                        <p class="mb-1"><?= $getOrderById['name'] ?></p>
                                        <a href="#!" class="link-primary fw-medium"><?= $getOrderById['email'] ?></a>
                                   </div>
                              </div>
                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Contact Number</h5>
                                   <div>
                                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                                   </div>
                              </div>
                              <p class="mb-1"><?= $getOrderById['phone'] ?></p>

                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Shipping Address</h5>
                                   <div>
                                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                                   </div>
                              </div>

                              <div>
                                   <p class="mb-1"><?= nl2br(str_replace(',', ',<br>', $getOrderById['address'])) ?></p>
                              </div>

                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Billing Address</h5>
                                   <div>
                                        <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                                   </div>
                              </div>

                              <p class="mb-1">Same as shipping address</p>
                         </div>
                    </div>
                    <div class="card">
                         <div class="card-body">
                              <div class="mapouter">
                                   <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%" style="height: 418px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University%20of%20Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

</div>
</div>
<?php include "../views/admin/layout/footer.php"; ?>