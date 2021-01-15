<main role="main">
    <?php $this->load->view('layouts/_alert') ?>

    <div class="container-xl marginTop">
        <?php if ($this->session->userdata('role') == 'admin') : ?>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a style="width: 100%;" href="<?= base_url('reseller/create') ?>" class="btn btn-success rounded-0">Add New B2B Product</a>
                </div>
                <div class="col-md-9 mb-3">
                    <form action="<?= base_url("reseller/search") ?>" method="POST">
                        <div class="input-group border">
                            <input type="text" name="keyword" class="form-control form-control rounded-0 border-0" placeholder="search" value="<?= $this->session->userdata('keyword') ?>">
                            <div class="input-group-append">
                                <button class="btn bg-white rounded-0 border-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("reseller/reset") ?>" class="btn bg-white rounded-0 border-0"><i class="fas fa-eraser"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>
</main>