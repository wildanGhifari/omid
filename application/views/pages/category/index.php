<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <a style="width: 100%;" href="<?= base_url('category/create') ?>" class="btn btn-success rounded-0">Add New Category</a>
                    </div>
                    <div class="col-md-9 mb-3">
                        <?= form_open(base_url('category/search'), ['method' => 'POST']) ?>
                        <div class="input-group border">
                            <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?php $this->session->userdata('keyword') ?>">
                            <div class="input-group-append">
                                <button class="btn bg-white rounded-0 border-start-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url('category/reset') ?>" class="btn bg-white rounded-0"><i class="fas fa-eraser"></i></a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>Category</strong>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($content as $row) : $no++; ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $row->title; ?></td>
                                        <td><?= $row->slug; ?></td>
                                        <td>
                                            <?= form_open("category/delete/$row->id", ['method' => 'POST']) ?>
                                            <?= form_hidden('id', $row->id) ?>
                                            <a href="<?= base_url("category/edit/$row->id") ?>" class="btn btn-sm">
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