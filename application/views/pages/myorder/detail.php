<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card detailOrder">
                    <div class="card-header bg-white">
                        <h6>Detail Order <?= $order->invoice ?></h6>
                        <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="float-left">Paket Pengiriman</p>
                                    <p class="float-right"><?= $order->courier ?>, <?= $order->package ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>
                                        <p class="float-left">Total</p>
                                        <p class="float-right">Rp. <?= number_format($order->total, 0, ',', '.') ?></p>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($order->status == 'waiting') : ?>
                        <div class="card-footer bg-white">
                            <a style="width: 100%;" href="<?= base_url("/myorder/confirm/$order->invoice") ?>" class="btn btn-lg btn-success">Confirm Payment</a>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <?php if (isset($order_confirm)) : ?>
                <div class="col-md-4">
                    <div class="card confirmOrder">
                        <div class="card-header bg-white">
                            <h6>Bukti Transfer</h6>
                        </div>
                        <div class="card-body">
                            <p>No. Rekening: <?= $order_confirm->account_number; ?></p>
                            <p>Atas Nama: <?= $order_confirm->account_name; ?></p>
                            <p>Nominal: Rp.<?= number_format($order_confirm->nominal, 0, ',', '.') ?></p>
                            <p>Catatan: <?= $order_confirm->note; ?></p>
                        </div>
                        <div class="card-footer bg-white px-0 py-0">
                            <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" style="width: 100%;">
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</main>