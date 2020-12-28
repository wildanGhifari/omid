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
            <div class="container-xl">
                <div class="flexRow mt-4">
                    <?php foreach ($content as $row) : ?>
                        <div class="flexCol">
                            <div class="card mb-4">
                                <a href="<?= base_url("shopping/detail/$row->id") ?>">
                                    <img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-3"><?= $row->category_title; ?></a>
                                        <p class="card-title"><?= $row->product_title; ?></p>
                                        <h6 class="card-text"><strong>Rp.<?= number_format($row->price, 0, ',', '.') ?></strong></h6>
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
</main>