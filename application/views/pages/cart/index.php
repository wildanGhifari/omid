<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>My Cart (<?= getCart(); ?>) items</strong>
                    </div>
                    <?php foreach ($content as $row) : ?>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-3">
                                    <img style="width: 100%;" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url('/images/product/default.jpg') ?>" alt="">
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="lead cart-card-title float-left"><strong><?= $row->title; ?></strong></p>
                                            <p class="lead cart-subtotal"><strong>Rp. <?= number_format($row->subtotal, 0, ',', '.') ?></strong></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Price :</strong> @Rp. <?= number_format($row->price, 0, ',', '.') ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Weight :</strong> <?= $row->weight ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Total Weight :</strong> <?= $row->weight * $row->qty ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 qty">
                                            <form class="float-left" action="<?= base_url("cart/update/$row->id") ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                                <div class="input-group">
                                                    <input style="border-radius: 25px 0 0 25px;" type="number" name="qty" class="form-control text-center" value="<?= $row->qty ?>">
                                                    <div class="input-group-append">
                                                        <button style="border-radius: 0 25px 25px 0;" class="btn btn-success" type="submit"><i class="fas fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                            <form class="float-right" action="<?= base_url("cart/delete/$row->id") ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                                <button style="width: 100%;" class="btn btn-outline-danger rounded-pill" type="submit" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                    <?php endforeach ?>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header lead font-weight-bold">
                                <strong>Summary</strong>
                            </div>
                            <div class="card-body">
                                <?php foreach ($content as $row) : ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="float-left"><?= $row->qty; ?>x <?= $row->title; ?></p>
                                            <p class="float-right">Rp. <?= number_format($row->subtotal, 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="float-left"><strong>Total</strong></h6>
                                        <h6 class="float-right"><strong>Rp. <?= number_format(array_sum(array_column($content, 'subtotal')), 0, ',', '.') ?></strong></h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a style="width: 100%; letter-spacing: 0.1em;" href="<?= base_url('/checkout') ?>" class="btn btn-lg btn-success rounded-0 text-uppercase mb-3">Checkout Now</a>
                                        <a style="width: 100%; letter-spacing: 0.1em;" href="<?= base_url('shopping') ?>" class="btn btn-lg btn-light rounded-0 text-uppercase">Continue Shoping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>