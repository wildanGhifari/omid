<main role="main">
    <?php $this->load->view('layouts/_alert') ?>
    <section class="marginTop">
        <div class="container-xl">
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a style="width: 100%;" href="<?= base_url('blog/create') ?>" class="btn btn-success rounded-0">Add New Blog</a>
                    </div>
                    <div class="col-md-9 mb-3">
                        <form action="<?= base_url("blog/search") ?>" method="POST">
                            <div class="input-group border">
                                <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?= $this->session->userdata('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn bg-white rounded-0 border-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="<?= base_url("blog/reset") ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
            <div class="row mt-3">
                <?php foreach ($content as $row) : ?>
                    <div class="col-md-3 mb-4">
                        <div class="card" style="min-height: 200px !important;">
                            <a href="<?= base_url("blog/detail/$row->slug") ?>">
                                <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <small class="text-muted font-weight-bold"><?= $row->date; ?></small>
                                <h5 class="card-title"><?= $row->blog_title; ?></h5>
                                <p class="card-text"><?= $row->description ?></p>
                                <a class="float-left text-success" href="<?= base_url("blog/detail/$row->slug") ?>">Read More</a>
                                <div class="float-right">
                                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                                        <?= form_open(base_url("/blog/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("/blog/edit/$row->id") ?>"><i class="fas fa-edit text-info"></i></a>
                                        <button style="border: none; background-color: #fff;" class="ml-3" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                        <?= form_close() ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>






            <!-- <div class="flexRow-blog mt-4">
                <?php foreach ($content as $row) : ?>
                    <div class="flexCol-blog">
                        <div class="card">
                            <a href="<?= base_url("blog/detail/$row->slug") ?>">
                                <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?= $row->blog_title; ?></h5>
                                <p class="card-text"><?= $row->description ?></p>
                                <a class="float-left" href="<?= base_url("blog/detail/$row->slug") ?>">Read More</a>
                                <div class="float-right">
                                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                                        <?= form_open(base_url("/blog/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("/blog/edit/$row->id") ?>"><i class="fas fa-edit text-info"></i></a>
                                        <button style="border: none; background-color: #fff;" class="ml-3" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                        <?= form_close() ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div> -->
        </div>
    </section>

    <nav aria-label="Page navigation example">
        <?= $pagination; ?>
    </nav>
</main>

<!-- <a href="<?= base_url("/blog/edit/$content->id") ?>" class="btn btn-success rounded-0 mb-3">Edit</a> -->