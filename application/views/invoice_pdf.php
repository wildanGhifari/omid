<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('/assets/img/OmidLogo.png') ?>" type="image/gif">
    <title><?= $title; ?></title>
    <style>
        html {
            font-size: 87.5%;
        }

        body {
            margin: 1cm;
            background: #ffffff;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            color: #000000;
        }

        h1 {
            margin-top: 0;
            font-size: 4.209rem;
        }

        h2 {
            font-size: 3.157rem;
        }

        h3 {
            font-size: 2.369rem;
        }

        h4 {
            font-size: 1.777rem;
        }

        h5 {
            font-size: 1.333rem;
        }

        small,
        .text_small {
            font-size: 0.75rem;
        }

        .card img {
            width: 92px;
        }

        /** 
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
        **/
        @page {
            margin: 0cm 0cm;
        }
        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 1.2cm;
        }
    </style>
</head><body>
    <main>
        <div class="card">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 65%; text-align:left;">
                        <img src="<?= base_url('/assets/img/OmidLogo.png') ?>">
                    </td>
                    <td style="width: 35%; text-align:right;">
                        <address style="color: #666666;">
                            Jl. Kemang Raya No.69c, RW.2, Bangka, Kec. Mampang Prpt., Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12730
                        </address>
                    </td>
                </tr>
            </table>
            <div style="margin-top:24px; border-bottom: 5px double #666;"></div>
            <div class="card-header bg-white">
                <h3>Invoice <?= $order->invoice ?></h3>
            </div>
            <div class="card-body">
                <table style="width: 100%;">
                    <tr>
                        <td style="width:80px;">Tanggal</td>
                        <td style="width:10px">:</td>
                        <td style="width: 100%;"><?= str_replace('-', '/', date("d-m-Y", strtotime($order->date))) ?></td>
                    </tr>
                    <tr>
                        <td style="width:80px;">Nama</td>
                        <td style="width:10px">:</td>
                        <td style="width: 100%;"><?= $order->name; ?></td>
                    </tr>
                    <tr>
                        <td style="width:80px;">No. Telp</td>
                        <td style="width:10px">:</td>
                        <td style="width: 100%;"><?= $order->phone; ?></td>
                    </tr>
                    <tr>
                        <td style="width:80px;">Alamat</td>
                        <td style="width:10px;">:</td>
                        <td style="width: 100%;"><?= $order->address; ?>, <?= $order->district ?></td>
                    </tr>
                </table>
                <hr>
                <div>
                    <div style="background-color: #ebebeb">
                        <?php foreach ($order_detail as $row) : ?>
                        <table style="width: 100%;">
                            <tr>
                                <td style="text-align:left;"><p style="padding: 0; margin:0;"><?= $row->qty; ?>x <?= $row->title; ?></p></td>
                                <td style="text-align:right;"><p style="padding: 0; margin:0;">Rp. <?= number_format($row->subtotal, 0, ',', '.') ?></p></td>
                            </tr>
                        </table>
                        <?php endforeach ?>
                        <div>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="text-align:left;"><p style="padding: 0; margin:0;">Paket Pengiriman</p></td>
                                    <td style="text-align:right;"><p style="padding: 0; margin:0;"><?= $order->courier ?>, <?= $order->package ?></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <table style="width: 100%;">
                            <tr>
                                <td style="text-align:left;"><strong><p style="padding: 0; margin:0;">Total</p></strong></td>
                                <td style="text-align:right;"><strong><p style="padding: 0; margin:0;">Rp. <?= number_format($order->total, 0, ',', '.') ?></p></strong></td>
                            </tr>
                        </table>
                    </div>
                    <?php if (isset($order_confirm)) : ?>
                    <div class="col-md-4">
                        <div class="card confirmOrder">
                            <div class="card-header bg-white">
                                <h4>Bukti Transfer</h4>
                            </div>
                            <div class="card-body">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 100px;">No. Rekening</td>
                                        <td style="width: 10px;">:</td>
                                        <td style="width: 100%;"><?= $order_confirm->account_number; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Atas Nama</td>
                                        <td style="width: 10px;">:</td>
                                        <td style="width: 100%;"><?= $order_confirm->account_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Nominal</td>
                                        <td style="width: 10px;">:</td>
                                        <td style="width: 100%;">Rp.<?= number_format($order_confirm->nominal, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Catatan</td>
                                        <td style="width: 10px;">:</td>
                                        <td style="width: 100%;"><?= $order_confirm->note; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer" style="margin-top: 24px;">
                                <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" width="200" style="height: 100%;">
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </main>
</body></html>