<main role="main">
    <div class="container-fluid px-0 bg-white detailProductCon">
        <?php foreach ($product as $row) : ?>
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-5 px-0 mb-4">
                        <img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" style="width: 100%;" alt="">
                    </div>

                    <div class="col-md-6 detailProduct">
                        <h5><?= $row->product_title ?></h5>
                        <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-3"><?= $row->category_title; ?></a>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <p class="text-muted"><strong>PRICE</strong></p>
                                <h5 class="text-success"><strong>Rp.<?= number_format($row->price, 0, ',', '.') ?></strong></h5>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p class="text-muted"><strong>SIZE</strong></p>
                                <h6>500g</h6>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-sm-12 mb-3 proDesc">
                                <p class="text-muted"><strong>DESCRIPTION</strong></p>
                                <p><?= $row->description; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <form action="<?= base_url("/cart/add") ?>" method="POST">
                                <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                <div class="input-group">
                                    <div class="col-sm-6 mb-3">
                                        <input style="width:100%;" type="number" class="form-control rounded-pill" name="qty" value="1" min="1">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="input-group">
                                            <button style="width:100%;" class="btn btn-success rounded-pill">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <section>
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
    </section>

    </div>
</main>