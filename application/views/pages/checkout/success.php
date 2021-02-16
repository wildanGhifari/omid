<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Invoice : <?= $content->invoice; ?></h5>
                        <p>
                            Terima kasih telah berbelanja di <strong>Omid Health Style.</strong><br>
                            Silahkan lakukan pembayaran agar pesanan Anda dapat kami proses, dengan cara :
                        </p>
                        <ol class="ml-4">
                            <li>Lakukan pembayaran ke Nomer Rekening <strong>BCA 1234567890 a/n PT. Omid Health Style.</strong></li>
                            <li>Sertakan keterangan dengan Nomer Invoice : <strong><?= $content->invoice; ?></strong></li>
                            <li>Total pembayaran : <strong>Rp. <?= number_format($content->total, 0, ',', '.'); ?></strong></li>
                            <li>Lakukan konfirmasi melalui halaman konfirmasi atau bisa <a href="<?= base_url("/myorder/detail/$content->invoice") ?>">Klik disini.</a></li>
                        </ol>
                        <hr>
                        <a href="<?= base_url('/') ?>" class="btn btn-outline-success float-left"><i class="fas fa-angle-left"></i> Back to Home</a>
                        <a href="<?= base_url("/myorder/detail/$content->invoice") ?>" class="btn btn-success float-right">Konfirmasi <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>