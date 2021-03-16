<main role="main" class="container">
    <div class="containerl-xl" style="padding: 5% 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>My Order List</strong>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($content as $row) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url("/myorder/detail/$row->invoice") ?>"><strong><?= $row->invoice; ?></strong></a>
                                        </td>
                                        <td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
                                        <td>Rp.<?= number_format($row->total, 0, ',', '.'); ?>,-</td>
                                        <td>
                                            <?php $this->load->view('layouts/_status', ['status' => $row->status]); ?>
                                        </td>
                                        <td>
                                            <?php if ($row->status =='paid' || 'delivered' || 'success') :?>
                                                <a class="badge badge-danger" href="<?= base_url("myorder/pdf/$row->invoice") ?>">Export to PDF</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>