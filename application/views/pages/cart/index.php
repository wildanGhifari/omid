<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>

        <div class="row">
            <div class="col-md-8 mb-3">
                <h4 class="mb-3">My Cart (<?= getCart(); ?>) items</h4>
                <?php if (!$content) : ?>
                    <div class="card">
                        <div class="card-body text-center" style="padding: 5% 0;">
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <h4>Your Cart is empt. <br> Let's go shopping!</h4>
                                </div>
                            </div>
                            <img class="mb-5"" src=" <?= base_url('assets/img/undraw_add_to_cart.svg') ?>" style="width: 60%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?= base_url('shopping') ?>" style="width: 60%;" class="btn btn-lg btn-success rounded-0 text-uppercase">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($content as $row) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-4 mb-3">
                                        <img style="width: 100%;" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url('/images/product/default.jpg') ?>" alt="<?= $row->title; ?>">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6 class="float-left"><?= $row->title; ?></h6>
                                                <h6 class="cart-subtotal text-success"><strong>Rp.<?= number_format($row->subtotal, 0, ',', '.') ?></strong></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="text-muted"><strong>PRICE</strong></small>
                                                <p>Rp.<?= number_format($row->price, 0, ',', '.') ?></p>
                                                <small class="text-muted"><strong>WEIGHT</strong></small>
                                                <p><?= $row->weight ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 qty">
                                                <form class="float-left" action="<?= base_url("cart/update/$row->id") ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                                    <div class="input-group">
                                                        <input type="number" name="qty" class="form-control text-center" value="<?= $row->qty ?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success px-4" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-md-6 rmv">
                                                <form action="<?= base_url("cart/delete/$row->id") ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                                    <button style="width: 100%;" class="btn btn btn-link text-danger" type="submit" onclick="return confirm('Are you sure?')">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>

            <div class="col-md-4 mb-3">
                <h4>Summary</h4>
            </div>
        </div>

        <div class="row">

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