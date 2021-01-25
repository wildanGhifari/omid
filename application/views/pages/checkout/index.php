<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="row justify-content-center">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Province</label>
                                        <select class="form-control" name="nama-provinsi" id="province" onChange="load_city()">
                                            <?php
                                            foreach ($provinces->rajaongkir->results as $province) {
                                                echo "<option value='" . $province->province_id . '-' . $province->province . "'>" . $province->province . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">District</label>
                                        <span class="district"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Sub District</label>
                                        <span class="sub-district"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Courier</label>
                                        <select class="form-control" name="nama-ekspedisi" id="courier" onChange='count_cost()'>
                                            <?php
                                            foreach ($couriers as $courier) {
                                                echo "<option value=" . $courier['id'] . ">" . $courier['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Total Weight</label>
                                        <input type="number" class="form-control" name="total-berat" id="weight" value="<?= $totalWeight; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Shipping package</label>
                                        <span class="cost"></span>
                                        <input type="hidden" name="total" id="total">
                                        <input type="hidden" name="ongkir" id="ongkir">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div style="box-shadow: none !important;" class="card border border-mute">
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
                                                    <p class="float-left">Shipping Cost</p>
                                                    <p class="float-right">Rp. <span class="ongkir"></span></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class="float-left"><strong>Total</strong></h6>
                                                    <h6 class="float-right"><strong>Rp. <span class="total"></span></strong></h6>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button style="width: 100%; letter-spacing: 0.1em;" class="btn btn-lg btn-success rounded-0 text-uppercase" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>