<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <?= form_open(base_url('order/search'), ['method' => 'POST']) ?>
                        <div class="input-group border">
                            <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?php $this->session->userdata('keyword') ?>">
                            <div class="input-group-append">
                                <button class="btn bg-white rounded-0 border-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url('order/reset') ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>Order List</strong>
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
                                            <a href="<?= base_url("/order/detail/$row->id") ?>"><strong>#<?= $row->invoice; ?></strong></a>
                                        </td>
                                        <td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
                                        <td>Rp.<?= number_format($row->total, 0, ',', '.'); ?></td>
                                        <td>
                                            <?php $this->load->view('layouts/_status', ['status' => $row->status]); ?>
                                        </td>
                                        <td>
                                            <?php if ($row->status == 'success') : ?>
                                                <a class="badge badge-danger" href="<?= base_url("myorder/pdf/$row->invoice") ?>">Export to PDF</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <?= $pagination; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>