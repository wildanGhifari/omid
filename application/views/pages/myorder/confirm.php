<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="lead font-weight-bold">Order Confirmation <?= $order->invoice; ?></strong>
                        <div class="">
                            <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                        </div>
                    </div>
                    <?= form_open_multipart($form_action, ['method' => 'POST']) ?>
                    <?= form_hidden('id_orders', $order->id); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Transaction</label>
                            <input type="text" class="form-control" value="<?= $order->invoice ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pemilik Rekening</label>
                            <input type="text" name="account_name" value="<?= $input->account_name ?>" class="form-control">
                            <?= form_error('account_name') ?>
                        </div>
                        <div class="form-group">
                            <label for="">No. Rekening</label>
                            <input type="text" name="account_number" value="<?= $input->account_number ?>" class="form-control">
                            <?= form_error('account_number') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Transfer</label>
                            <input type="number" name="nominal" value="<?= $input->nominal; ?>" class="form-control">
                            <?= form_error('nominal') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Catatan</label>
                            <textarea name="note" id="" cols="30" rows="5" class="form-control">-</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Transfer</label> <br>
                            <input type="file" name="image" id="">
                            <?php if ($this->session->flashdata('image_error')) : ?>
                                <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button style="width: 100%;" type="submit" class="btn btn-lg btn-success rounded-0">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>