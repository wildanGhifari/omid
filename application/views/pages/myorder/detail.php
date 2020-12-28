<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-6 mx-auto">
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
                        <div>
                            <?php foreach ($order_detail as $row) : ?>
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
                                    <h6 class="float-left">Total</h6>
                                    <h6 class="float-right">Rp. <?= number_format(array_sum(array_column($order_detail, 'subtotal')), 0, ',', '.') ?></h6>
                                </div>
                            </div>
                        </div>
                        <!-- <div style="overflow: auto;">
                            <table class=" table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_detail as $row) : ?>
                                        <tr>
                                            <td>
                                                <p><img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url('/images/product/default.jpg') ?>" alt="" height="50"><strong><?= $row->title; ?></strong>
                                                </p>
                                            </td>
                                            <td class="text-center">Rp.<?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                            <td class="text-center"><?= $row->qty; ?></td>
                                            <td class="text-center">Rp.<?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="3"><strong>Total :</strong></td>
                                        <td class="text-center"><strong>Rp.<?= number_format(array_sum(array_column($order_detail, 'subtotal')), 0, ',', '.') ?>,-</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <?php if ($order->status == 'waiting') : ?>
                        <div class="card-footer">
                            <a style="width: 100%;" href="<?= base_url("/myorder/confirm/$order->invoice") ?>" class="btn btn-lg btn-success rounded-0">Confirm Payment</a>
                        </div>
                    <?php endif ?>
                </div>

                <?php if (isset($order_confirm)) : ?>
                    <div class="row mb-3">
                        <div class="col-md-8">
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
                        <div class="col-md-4">
                            <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" style="width: 100%;">
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</main>