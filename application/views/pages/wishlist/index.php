<main role="main">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-3">My Wishlist (<?= getWishlist(); ?>)</h4>
                    <?php if (!$content) : ?>
                        <div class="card">
                            <div class="card-body text-center" style="padding: 5% 0;">
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <h4>You have no wishlist, make one or more.</h4>
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
                        <div class="row">
                            <?php foreach ($content as $row) : ?>
                                <div class="col-md-3 mb-4 teaserProduct">
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
                                            <form action="<?= base_url("/cart/add") ?>" method="POST" class="mt-4">
                                                <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                                <div class="input-group">
                                                    <input class="form-control" type="hidden" name="qty" value="1" min="1">
                                                    <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                                </div>
                                            </form>
                                            <form action="<?= base_url("wishlist/delete/$row->id") ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                                <button style="width: 100%;" class="btn btn btn-link text-danger" type="submit" onclick="return confirm('Are you sure?')">Remove</button>
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
    </div>
</main>