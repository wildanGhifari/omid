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
                                <textarea name="address" id="" cols="30" rows="3" class="form-control rounded-0"><?= $input->address; ?></textarea>
                                <?= form_error('address') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Province</label>
                                        <select class="form-control" name="nama-provinsi" id="">
                                            <option value="">Select Province</option>
                                            <?php foreach ($provinsi as $province) : ?>
                                                <option value="<?= $province['province_id']; ?>"><?= $province["province"]; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">District</label>
                                        <select class="form-control" name="nama-distrik" id="">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Courier</label>
                                        <?= form_dropdown('id_courier', getDropdownList('courier', ['id', 'name']), $input->id_courier, ['class' => 'form-control']) ?>
                                        <?= form_error('id_courier') ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Total Weight</label>
                                        <input type="number" class="form-control" name="total-berat" id="" value="<?= $totalWeight; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Shipping package</label>
                                        <select class="form-control" name="nama-paket" id="">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="row mb-3">
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
                                <div class="row px-0">
                                    <div class="col-md-12">
                                        <p class="float-left font-weight-bold">Shipping</p>
                                        <p class="float-right font-weight-bold">Rp. 20.000</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row px-0">
                                    <div class="col-md-12">
                                        <h6 class="float-left"><strong>Total</strong></h6>
                                        <h6 class="float-right"><strong>Rp. <?= number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.') ?></strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <button style="width: 100%; letter-spacing: 0.1em;" class="btn btn-lg btn-success rounded-0 text-uppercase" type="submit">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>