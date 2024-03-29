<main role="main">
    <?php $this->load->view('layouts/_alert') ?>

    <div class="container-xl marginTop">
        <div class="row justify-content-between">
            <div class="col-md-12 mb-3">
                <h5 class="float-left"><?= isset($category) ? $category : 'All Category' ?></h5>
                <div class="dropdown float-right">
                    <a class="btn btn-secondary dropdown-toggle rounded-0" id="dropdown-1" data-bs-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort Price By:
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdown-1">
                        <a href="<?= base_url("/shop/sortby/asc") ?>" class="dropdown-item">Lowest</a>
                        <a href="<?= base_url("/shop/sortby/desc") ?>" class="dropdown-item">Highest</a>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div id="shoppingProduct">
                <div id="myRow">
                    <?php foreach ($content as $row) : ?>
                        <div id="myCol">
                            <div class="card mx-2 mb-4">
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
                                    <div id="addToCartAndWishlist" class="container-sm mt-4 px-0">
                                        <div id="addToCart">
                                            <form action="<?= base_url("/cart/add") ?>" method="POST">
                                                <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                                <div class="input-group">
                                                    <input class="form-control" type="hidden" name="qty" value="1" min="1">
                                                    <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="addToWishlist">
                                            <form action="<?= base_url("/wishlist/add") ?>" method="POST">
                                                <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                                <div class="input-group">
                                                    <input class="form-control" type="hidden" name="qty" value="1" min="1">
                                                    <button type="submit" class="btn btn-outline-danger" style="width: 100%;" data-toggle="tooltip" data-placement="top" title="Add To Wishlist">
                                                        <i class="far fa-heart fa-lg"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <nav class="mt-4" aria-label="Page navigation example">
                    <?= $pagination; ?>
                </nav>
            </div>
        </section>
</main>