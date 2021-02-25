<main role="main">
    <div class="container-xl" style="padding: 5%;">

        <?php foreach ($blog as $row) : ?>
            <div class="row">
                <div id="blog-detail" class="col-md-12">
                    <h3><?= $row->blog_title ?></h3>
                    <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <span><?= $row->description ?></span>
                    <hr>
                    <p><?= $row->content ?></p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h4>Related Products</h4>
                    <div class="teaserProduct">
                        <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                            <?php foreach ($products as $product) : ?>
                                <?php if ($product->category_title !== 'B2B') : ?>
                                    <div class="gallery-cell">
                                        <div class="card">
                                            <?php if ($product->weight >= 1000) : ?>
                                                <?php $product->weight = $product->weight / 1000 ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $product->weight; ?> Kg</span>
                                            <?php else : ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $product->weight; ?>gr</span>
                                            <?php endif ?>
                                            <a href="<?= base_url("shopping/detail/$product->slug") ?>">
                                                <img class="card-img-top" src="<?= $product->image ? base_url("/images/product/$product->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                            </a>
                                            <div class="card-body">
                                                <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$product->category_slug") ?>"><?= $product->category_title; ?></a></small>
                                                <p class="card-title"><?= $product->product_title; ?></p>
                                                <h5>Rp.<?= number_format($product->price, 0, ',', '.') ?></h5>
                                                <div id="addToCartAndWishlist">
                                                    <div id="addToCart">
                                                        <form action="<?= base_url("/cart/add") ?>" method="POST">
                                                            <input type="hidden" name="id_product" value="<?= $product->id ?>">
                                                            <div class="input-group">
                                                                <input class="form-control" type="hidden" name="" value="1">
                                                                <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
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
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h4>Other Products</h4>
                    <div class="teaserProduct">
                        <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": false }'>
                            <?php foreach ($otherProdutcs as $product) : ?>
                                <?php if ($product->category_title !== 'B2B') : ?>
                                    <div class="gallery-cell">
                                        <div class="card">
                                            <?php if ($product->weight >= 1000) : ?>
                                                <?php $product->weight = $product->weight / 1000 ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $product->weight; ?> Kg</span>
                                            <?php else : ?>
                                                <span class="badge badge-warning badge-pill mr-2"><?= $product->weight; ?>gr</span>
                                            <?php endif ?>
                                            <a href="<?= base_url("shopping/detail/$product->slug") ?>">
                                                <img class="card-img-top" src="<?= $product->image ? base_url("/images/product/$product->image") : base_url("/images/product/default.jpg") ?>" alt="">
                                            </a>
                                            <div class="card-body">
                                                <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$product->category_slug") ?>"><?= $product->category_title; ?></a></small>
                                                <p class="card-title"><?= $product->product_title; ?></p>
                                                <h5>Rp.<?= number_format($product->price, 0, ',', '.') ?></h5>
                                                <div id="addToCartAndWishlist">
                                                    <div id="addToCart">
                                                        <form action="<?= base_url("/cart/add") ?>" method="POST">
                                                            <input type="hidden" name="id_product" value="<?= $product->id ?>">
                                                            <div class="input-group">
                                                                <input class="form-control" type="hidden" name="" value="1">
                                                                <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
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
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>


</main>