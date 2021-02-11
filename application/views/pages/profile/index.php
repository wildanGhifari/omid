<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert'); ?>
        <?php if ($this->session->userdata('role') == 'admin') : ?>
            <div class="row">

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="secondary-bg">
                            <img class="card-img-top" src="<?= $content->image ? base_url("/images/user/$content->image") : base_url("/images/user/default.jpg") ?>" alt="<?= $content->name; ?>">
                        </div>
                        <div class="card-body">
                            <h5><?= $content->name; ?></h5>
                            <p><?= $content->email; ?></p>
                        </div>
                    </div>

                    <a style="width: 100%;" href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn-light mt-3">Edit Profile</a>
                </div>

                <div class="col-md-9">
                    <div id="dashboardNav">
                        <a href="">Overview</a>
                        <a href="">Order</a>
                        <a href="">User</a>
                        <a href="">Product</a>
                        <a href="">Category</a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card dashboardCard">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between">
                                        <h6>Order List</h6>
                                        <div>
                                            <a href="" class="mr-3 text-success">View All</a>
                                            <a href="" class="btn btn-success">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="mb-3" src="<?= $content->image ? base_url("/images/user/$content->image") : base_url("/images/user/default.jpg") ?>" alt="">
                            <h5><strong><?= $content->name; ?></strong></h5>
                            <h6 class="font-weight-normal"><?= $content->email; ?></h6>
                            <hr>
                            <a style="width: 100%;" href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn-success">Update</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 mb-3">
                    <div class="card">
                        <div class="card-header lead font-weight-bold">
                            <strong>My Order History</strong>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order as $row) : ?>
                                        <?php if ($row->status == 'success') : ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= base_url("/myorder/detail/$row->invoice") ?>"><strong><?= $row->invoice; ?></strong></a>
                                                </td>
                                                <td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
                                                <td>Rp.<?= number_format($row->total, 0, ',', '.'); ?></td>
                                                <td>
                                                    <?php $this->load->view('layouts/_status', ['status' => $row->status]); ?>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success rounded-pill" href="<?= base_url('myorder') ?>">My Order List</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

    </div>

    <!-- <div class="row">
        <div class="col-md-3">
            <?php $this->load->view('layouts/_menu'); ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?= $content->image ? base_url("/images/user/$content->image") : base_url("/images/user/default.jpg") ?>" alt="" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p>Nama: <?= $content->name; ?></p>
                            <p>Email: <?= $content->email; ?></p>
                            <a href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn-success">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</main>