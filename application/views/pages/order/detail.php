<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="lead font-weight-bold">Detail Order <?= $order->invoice; ?></strong>
                                <div class="">
                                    <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Tanggal : <?= str_replace('-', '/', date("d-m-Y", strtotime($order->date))) ?></p>
                                <p>Nama : <?= $order->name; ?></p>
                                <p>Phone : <?= $order->phone; ?></p>
                                <p>Alamat : <?= $order->address; ?></p>
                                <hr>
                                <?php foreach ($order_detail as $row) : ?>
                                    <div class="row px-0">
                                        <div class="col-md-12">
                                            <p class="float-left"><?= $row->qty; ?>x <?= $row->title; ?></p>
                                            <p class="float-right">Rp.<?= number_format($row->subtotal, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="float-left">Total</h6>
                                        <h6 class="float-right">Rp. <?= number_format($order->total, 0, ',', '.') ?></h6>
                                        <!-- <h6 class="float-right">Rp. <?= number_format(array_sum(array_column($order_detail, 'subtotal')), 0, ',', '.') ?></h6> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form action="<?= base_url("order/update/$order->id") ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $order->id ?>">
                                    <div class="input-group">
                                        <select name="status" id="" class="form-control">
                                            <option value="waiting" <?= $order->status == 'waiting' ? 'selected' : '' ?>>Waiting for payment</option>
                                            <option value="paid" <?= $order->status == 'paid' ? 'selected' : '' ?>>Paid</option>
                                            <option value="delivered" <?= $order->status == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                            <option value="success" <?= $order->status == 'success' ? 'selected' : '' ?>>Success</option>
                                            <option value="cancel" <?= $order->status == 'cancel' ? 'selected' : '' ?>>Cancel</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($order_confirm)) : ?>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Bukti Transfer
                                        </div>
                                        <div class="card-body">
                                            <p>No. Rekening: <?= $order_confirm->account_number; ?></p>
                                            <p>Atas Nama: <?= $order_confirm->account_name; ?></p>
                                            <p>Nominal: Rp.<?= number_format($order_confirm->nominal, 0, ',', '.') ?>,-</p>
                                            <p>Catatan: <?= $order_confirm->note; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</main>