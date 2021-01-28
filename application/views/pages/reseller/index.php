<main role="main">
    <?php $this->load->view('layouts/_alert') ?>

    <div class="container-xl marginTop">
        <?php if ($this->session->userdata('role') == 'admin') : ?>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a style="width: 100%;" href="<?= base_url('reseller/create') ?>" class="btn btn-success rounded-0">Add New B2B Product</a>
                </div>
                <div class="col-md-9 mb-3">
                    <form action="<?= base_url("reseller/search") ?>" method="POST">
                        <div class="input-group border">
                            <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?= $this->session->userdata('keyword') ?>">
                            <div class="input-group-append">
                                <button class="btn bg-white rounded-0 border-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("reseller/reset") ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>

    <section>
        <div class="container-xl">
            <div class="flexRow mt-4">
                <?php foreach ($content as $row) : ?>
                    <div class="flexCol">
                        <div class="card mb-4">
                            <a href="<?= base_url("reseller/detail/$row->slug") ?>">
                                <img src="<?= $row->image ? base_url("/images/reseller/$row->image") : base_url("/images/reseller/default.jpg") ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-3"><?= $row->reseller_category_title; ?></a>
                                    <p class="card-title"><?= $row->reseller_title; ?></p>
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