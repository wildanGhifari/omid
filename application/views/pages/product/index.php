<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <a style="width: 100%;" href="<?= base_url('product/create') ?>" class="btn btn-success rounded-0">Add New Product</a>
                    </div>
                    <div class="col-md-9 mb-3">
                        <form action="<?= base_url("product/search") ?>" method="POST">
                            <div class="input-group border">
                                <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?= $this->session->userdata('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn bg-white rounded-0 border-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="<?= base_url("product/reset") ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>Product</strong>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($content as $row) : $no++; ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td>
                                            <p>
                                                <img class="mr-2" src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= $row->product_title; ?>" height="50">
                                                <?= $row->product_title; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning"><?= $row->category_title; ?></span>
                                        </td>
                                        <td>Rp.<?= number_format($row->price, 0, ',', '.') ?></td>
                                        <td><?= $row->is_available ? 'Available' : 'Empty'; ?></td>
                                        <td>
                                            <?= form_open(base_url("/product/delete/$row->id"), ['method' => 'POST']) ?>
                                            <?= form_hidden('id', $row->id) ?>
                                            <a href="<?= base_url("/product/edit/$row->id") ?>" class="btn btn-sm">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <button class="btn btn-sm" type="submit" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                            <?= form_close() ?>
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