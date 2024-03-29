<main role="main">
    <div class="container-fluid px-0 bg-white detailProductCon">
        <?php foreach ($products as $product) : ?>
            <div class="container-xl">
                <div class="row justify-content-between mb-3">
                    <div class="col-md-7 px-3 rounded secondary-bg text-center">
                        <img class="detailProduct-img mx-auto" src="<?= $product->image ? base_url("/images/product/$product->image") : base_url("/images/product/default.jpg") ?>" alt="">
                    </div>

                    <div class="col-md-5 px-3">
                        <div id="detailProduct" class="card">
                            <div class="card-body">
                                <h4 id="namaProduk" class="mb-2"><span lang="id"><?= $product->product_title ?></span> <span lang="in"><?= $product->judul ?></span></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?= base_url("/shop/category/$product->category_slug") ?>" class="badge badge-warning mb-3 text-uppercase mr-2 py-2"><?= $product->category_title; ?></a>
                                        <button class="badge badge-secondary border-0 font-weight-normal py-2 px-2" id="switch-lang"><i class="fas fa-language fa-lg"></i> <span lang="id">Ganti Bahasa</span> <span lang="in">Switch Language</span></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted"><strong>PRICE</strong></small>
                                    <h5 class="text-success"><strong>Rp.<?= number_format($product->price, 0, ',', '.') ?></strong></h5>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4">
                                        <small class="text-muted"><strong>SIZE</strong></small>
                                        <h6><?= $product->weight ?>gr</h6>
                                    </div>
                                    <?php if ($product->category_title == 'B2B') : ?>
                                        <?php foreach ($relB2b as $b2b) : ?>
                                            <?php if (substr($b2b->b2b_title, 0, 15) === substr($product->product_title, 0, 15) && $b2b->weight !== $product->weight) : ?>
                                                <div class="col-md-4">
                                                    <small class="text-muted"><strong>OTHER SIZE</strong></small>
                                                    <?php if ($b2b->weight > 1000) : ?>
                                                        <?php $b2b->weight = $b2b->weight / 1000 ?>
                                                        <h6><a href="<?= base_url("shopping/detail/$b2b->slug") ?>"><?= $b2b->weight ?> Kg</a></h6>
                                                    <?php else : ?>
                                                        <h6><a href="<?= base_url("shopping/detail/$b2b->slug") ?>"><?= $b2b->weight ?> gr</a></h6>
                                                    <?php endif ?>
                                                    <p>Rp. <?= number_format($b2b->price, 0, ',', '.') ?></p>
                                                </div>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                <div id="addToCartAndWishlist">
                                    <div id="addToCart">
                                        <form action="<?= base_url("/cart/add") ?>" method="POST">
                                            <input type="hidden" name="id_product" value="<?= $product->id ?>">
                                            <div class="input-group">
                                                <input type="number" name="qty" class="form-control text-center" value="1" min="1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success px-5" type="submit">Add To Cart</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="addToWishlist">
                                        <form action="<?= base_url("/wishlist/add") ?>" method="POST">
                                            <input type="hidden" name="id_product" value="<?= $product->id ?>">
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
                </div>

                <?php if ($product->category_title == 'B2B') : ?>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <span class="btn btn-warning mb-3">All Product is Negotiable</span>
                            <span class="btn btn-warning mb-3">Custom Packaging Available</span>
                            <a href="https://wa.link/cy8heu"><span class="btn btn-success mb-3"><i class="fab fa-whatsapp"></i> Click here to contact us</span></a>
                        </div>
                    </div>

                    <h4>Other B2b Products</h4>
                    <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                        <?php foreach ($relB2b as $b2b) : ?>
                            <?php if ($b2b->b2b_title !== $product->product_title) : ?>
                                <div class="gallery-cell galCelCol teaserProduct">
                                    <a href="<?= base_url("shopping/detail/$b2b->slug") ?>">
                                        <div class="card">
                                            <?php if ($b2b->weight >= 1000) : ?>
                                                <?php $b2b->weight = $b2b->weight / 1000 ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $b2b->weight; ?> Kg</span>
                                            <?php else : ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $b2b->weight; ?>gr</span>
                                            <?php endif ?>
                                            <img class="card-img-top" src="<?= $b2b->image ? base_url("/images/product/$b2b->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                            <div class="card-body px-3">
                                                <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$b2b->category_slug") ?>"><?= $b2b->category_title; ?></a></small>
                                                <p class="card-title"><?= $b2b->b2b_title; ?></p>
                                                <h5>Rp.<?= number_format($b2b->price, 0, ',', '.') ?></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                <?php else : ?>
                    <h4>Other Products</h4>
                    <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                        <?php foreach ($relProducts as $row) : ?>
                            <div class="gallery-cell galCelCol teaserProduct">
                                <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                    <div class="card">
                                        <?php if ($row->weight >= 1000) : ?>
                                            <?php $row->weight = $row->weight / 1000 ?>
                                            <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?> Kg</span>
                                        <?php else : ?>
                                            <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?>gr</span>
                                        <?php endif ?>
                                        <img class="card-img-top" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                        <div class="card-body px-3">
                                            <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$row->category_slug") ?>"><?= $row->category_title; ?></a></small>
                                            <p class="card-title"><?= $row->product_title; ?></p>
                                            <h5>Rp.<?= number_format($row->price, 0, ',', '.') ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- <?php if ($row->product_title !== $product->product_title) : ?>
                            <?php endif ?> -->
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <div class="row">
                    <div class="col-md-7 mb-3 proDesc">
                        <small class="text-muted"><strong>DESCRIPTION</strong></small>
                        <p><?= $product->description; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    </div>
</main>