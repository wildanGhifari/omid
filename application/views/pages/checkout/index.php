<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>Checkout Billing</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("checkout/create") ?>" method="POST">
                            <div class="form-group">
                                <label for="">Fullname</label>
                                <input type="text" class="form-control rounded-0" name="name" placeholder="Please input your fullname" value="<?= $input->name; ?>">
                                <?= form_error('name') ?>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control rounded-0" name="phone" placeholder="Please input your phone number" value="<?= $input->phone; ?>">
                                <?= form_error('phone') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control rounded-0"><?= $input->address; ?></textarea>
                                <?= form_error('address') ?>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4 mt-4">
                                    <button style="width: 100%;" class="btn btn-success rounded-0" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header lead font-weight-bold">
                                <strong>My Cart Summary (<?= getCart(); ?>)</strong>
                            </div>
                            <div class="card-body">
                                <?php foreach ($cart as $row) : ?>
                                    <div class="row px-0">
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
                                        <h6 class="float-right"><strong>Rp. <?= number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.') ?></strong></h6>
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