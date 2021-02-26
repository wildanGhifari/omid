<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="secondary-bg">
                        <img class="card-img-top" src="<?= $content->image ? base_url("/images/user/$content->image") : base_url("/images/user/default.jpg") ?>" alt="<?= $content->name; ?>">
                    </div>
                    <div class="card-body">
                        <h5><?= $content->name; ?></h5>
                        <p><?= $content->email; ?></p>
                        <hr>
                        <p><?= $content->address ?></p>
                        <p><a class="text-muted" target="_blank" href="<?= $content->social_media ?>"><?= $content->social_media ?></a></p>
                    </div>
                </div>

                <a style="width: 100%;" href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn-light mt-3">Edit Profile</a>
            </div>
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <div class="col-md-9">
                    <div id="dashboardNav">
                        <a href="<?= base_url("/profile") ?>">Overview</a>
                        <a href="<?= base_url("order") ?>">Order</a>
                        <a href="<?= base_url("user") ?>">User</a>
                        <a href="<?= base_url("product") ?>">Product</a>
                        <a href="<?= base_url("category") ?>">Category</a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <div id="orderCard" class="card dashboardCard">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <h6>Order List</h6>
                                        <div>
                                            <a href="<?= base_url('order') ?>" class="btn btn-success">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Invoice Number</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order as $row) : ?>
                                                <tr>
                                                    <td>
                                                        <small><a href="<?= base_url("/order/detail/$row->id") ?>"><?= $row->invoice; ?></a></small>
                                                    </td>
                                                    <td>
                                                        <small><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></small>
                                                    </td>
                                                    <td>
                                                        <small>Rp.<?= number_format($row->total, 0, ',', '.'); ?></small>
                                                    </td>
                                                    <td>
                                                        <small><?php $this->load->view('layouts/_status', ['status' => $row->status]); ?></small>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div id="userCard" class="card dashboardCard">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <h6>User</h6>
                                        <div>
                                            <a href="<?= base_url('user') ?>" class="btn btn-success">Manage</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($users as $user) : $no++; ?>
                                                <tr>
                                                    <td class="text-center"><small><?= $no ?></small></td>
                                                    <td><small><?= $user->name; ?></small></td>
                                                    <td>
                                                        <small>
                                                            <?= form_open(base_url("user/delete/$user->id"), ['method' => 'POST']) ?>
                                                            <?= form_hidden('id', $user->id) ?>
                                                            <a href="<?= base_url("user/edit/$user->id") ?>" class="btn btn-sm">
                                                                <i class="fas fa-edit text-info"></i>
                                                            </a>
                                                            <button class="btn btn-sm" type="submit" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </button>
                                                            <?= form_close() ?>
                                                        </small>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="productCard" class="card dashboardCard">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <h6>Product</h6>
                                        <div>
                                            <form action="<?= base_url("product/search") ?>" method="POST">
                                                <div class="input-group border">
                                                    <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?= $this->session->userdata('keyword') ?>">
                                                    <div class="input-group-append">
                                                        <button class="btn bg-white rounded-0 border-0" type="submit">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                        <a href="<?= base_url("product/reset") ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Harga</th>
                                                <th>Stock</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($products as $row) : $no++; ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <small>
                                                            <?= $no; ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            <small><?= $row->product_title; ?></small>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <small><span class="badge badge-warning"><?= $row->category_title; ?></span></small>
                                                    </td>
                                                    <td>
                                                        <small>Rp.<?= number_format($row->price, 0, ',', '.') ?></small>
                                                    </td>
                                                    <td>
                                                        <small><?= $row->is_available ? 'Available' : 'Empty'; ?></small>
                                                    </td>
                                                    <td>
                                                        <small>
                                                            <?= form_open(base_url("/product/delete/$row->id"), ['method' => 'POST']) ?>
                                                            <?= form_hidden('id', $row->id) ?>
                                                            <a href="<?= base_url("/product/edit/$row->id") ?>" class="btn btn-sm">
                                                                <i class="fas fa-edit text-info"></i>
                                                            </a>
                                                            <button class="btn btn-sm" type="submit" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </button>
                                                            <?= form_close() ?>
                                                        </small>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Page navigation example" class="mt-3">
                                        <?= $pagination; ?>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="container-xl px-0">
                            <div class="row py-0">
                                <div class="col-md-12">
                                    <h6 class="float-left">My Wishlist (<?= getWishlist(); ?>)</h6>
                                    <a href="<?= base_url('wishlist') ?>" class="float-right">
                                        <h6 class="text-success">See All <i class="fas fa-chevron-right"></i></h6>
                                    </a>
                                </div>
                            </div>
                            <?php if (!$wishlist) : ?>
                                <div class="card">
                                    <div class="card-body text-center" style="padding: 5% 0;">
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <h4>You have no wishlist yet, make one or more.</h4>
                                            </div>
                                        </div>
                                        <img class="mb-5"" src=" <?= base_url('assets/img/undraw_Wishlist_re_m7tv.svg') ?>" style="width: 60%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="<?= base_url('shopping') ?>" style="width: 60%;" class="btn btn-lg btn-success rounded-0 text-uppercase">Make a wish list</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                                    <?php foreach ($wishlist as $row) : ?>
                                        <div class="gallery-cell galCelProfile teaserProduct">
                                            <div class="card">
                                                <?php if ($row->weight >= 1000) : ?>
                                                    <?php $row->weight = $row->weight / 1000 ?>
                                                    <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?> Kg</span>
                                                <?php else : ?>
                                                    <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?>gr</span>
                                                <?php endif ?>
                                                <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                                    <img class="card-img-top" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                                </a>
                                                <div class="card-body">
                                                    <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$row->category_slug") ?>"><?= $row->category_title; ?></a></small>
                                                    <p class="card-title"><?= $row->product_title; ?></p>
                                                    <h5>Rp.<?= number_format($row->price, 0, ',', '.') ?></h5>
                                                    <form class="mt-4" action="<?= base_url("/cart/add") ?>" method="POST">
                                                        <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                                        <div class="input-group">
                                                            <input class="form-control" type="hidden" name="" value="1">
                                                            <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="col-md-9 mb-3">
                    <div id="myOrderCard" class="card dashboardCard">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between">
                                <h6>My Order History</h6>
                                <div>
                                    <a href="<?= base_url('/myorder') ?>" class="btn btn-success">Order List</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($myOrders as $row) : ?>
                                        <?php if ($row->status == 'success') : ?>
                                            <tr>
                                                <td>
                                                    <small><a href="<?= base_url("/myorder/detail/$row->invoice") ?>"><?= $row->invoice; ?></a></small>
                                                </td>
                                                <td>
                                                    <small><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></small>
                                                </td>
                                                <td>
                                                    <small>Rp.<?= number_format($row->total, 0, ',', '.'); ?></small>
                                                </td>
                                                <td>
                                                    <small><?php $this->load->view('layouts/_status', ['status' => $row->status]); ?></small>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="container-xl px-0">
                            <div class="row py-0">
                                <div class="col-md-12">
                                    <h6 class="float-left">My Wishlist (<?= getWishlist(); ?>)</h6>
                                    <a href="<?= base_url('wishlist') ?>" class="float-right">
                                        <h6 class="text-success">See All <i class="fas fa-chevron-right"></i></h6>
                                    </a>
                                </div>
                            </div>
                            <?php if (!$wishlist) : ?>
                                <div class="card">
                                    <div class="card-body text-center" style="padding: 5% 0;">
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <h4>You have no wishlist yet, make one or more.</h4>
                                            </div>
                                        </div>
                                        <img class="mb-5"" src=" <?= base_url('assets/img/undraw_Wishlist_re_m7tv.svg') ?>" style="width: 60%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="<?= base_url('shopping') ?>" style="width: 60%;" class="btn btn-lg btn-success rounded-0 text-uppercase">Make a wish list</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                                    <?php foreach ($wishlist as $row) : ?>
                                        <div class="gallery-cell galCelProfile teaserProduct">
                                            <div class="card">
                                                <?php if ($row->weight >= 1000) : ?>
                                                    <?php $row->weight = $row->weight / 1000 ?>
                                                    <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?> Kg</span>
                                                <?php else : ?>
                                                    <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?>gr</span>
                                                <?php endif ?>
                                                <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                                    <img class="card-img-top" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                                </a>
                                                <div class="card-body">
                                                    <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$row->category_slug") ?>"><?= $row->category_title; ?></a></small>
                                                    <p class="card-title"><?= $row->product_title; ?></p>
                                                    <h5>Rp.<?= number_format($row->price, 0, ',', '.') ?></h5>
                                                    <form class="mt-4" action="<?= base_url("/cart/add") ?>" method="POST">
                                                        <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                                        <div class="input-group">
                                                            <input class="form-control" type="hidden" name="" value="1">
                                                            <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</main>