<main role="main">
    <div class="container-fluid px-0 bg-white detailProductCon">
        <?php foreach ($products as $row) : ?>
            <div class="container-xl">
                <div class="row justify-content-between mb-3">
                    <div class="col-md-7 px-3 rounded secondary-bg text-center">
                        <img class="detailProduct-img mx-auto" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                    </div>

                    <div class="col-md-5 px-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3"><?= $row->product_title ?></h4>
                                <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-4 text-uppercase"><?= $row->category_title; ?></a>
                                <div class="mb-3">
                                    <small class="text-muted"><strong>PRICE</strong></small>
                                    <h5 class="text-success"><strong>Rp.<?= number_format($row->price, 0, ',', '.') ?></strong></h5>
                                </div>
                                <div class="mb-5">
                                    <small class="text-muted"><strong>SIZE</strong></small>
                                    <h6><?= $row->weight ?>gr</h6>
                                </div>
                                <div>
                                    <form action="<?= base_url("/cart/add") ?>" method="POST">
                                        <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                        <div class="input-group">
                                            <input type="number" name="qty" class="form-control text-center" value="1" min="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-success px-5" type="submit">Add To Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($row->category_title == 'B2B') : ?>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <span class="btn btn-warning mb-3">All Product is Negotiable</span>
                            <span class="btn btn-warning mb-3">Cutom Packaging Available</span>
                            <a href="https://wa.link/cy8heu"><span class="btn btn-success mb-3"><i class="fab fa-whatsapp"></i> Click here for contact us</span></a>
                        </div>
                    </div>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-7 mb-3 proDesc">
                        <small class="text-muted"><strong>DESCRIPTION</strong></small>
                        <p><?= $row->description; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- <section>
        <div class="container-xl marginTop">
            <div class="flexRow mt-4">
                <?php foreach ($product as $row) : ?>
                    <div class="flexCol">
                        <div class="card mb-4">
                            <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                <img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-3"><?= $row->category_title; ?></a>
                                    <p class="card-title"><?= $row->product_title; ?></p>
                                    <h6 class="card-text"><strong>Rp.<?= number_format($row->price, 0, ',', '.') ?>,-</strong></h6>
                                    <hr class="my-3">
                                    <form action="<?= base_url("/cart/add") ?>" method="POST">
                                        <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                        <div class="input-group">
                                            <input style="border-radius: 25px 0 0 25px;" type="number" class="form-control" name="qty" value="1" min="1">
                                            <div class="input-group-append">
                                                <button style="border-radius: 0 25px 25px 0;" class="btn btn-success">Add To Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <nav class="mt-4" aria-label="Page navigation example">
                <?= $pagination; ?>
            </nav>
        </div>
    </section> -->

    </div>
</main>