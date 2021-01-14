<main role="main">
    <?php $this->load->view('layouts/_alert') ?>

    <div class="container-xl marginTop">
        <div class="row justify-content-between">
            <div class="col-md-12 mb-3">
                <h5 class="float-left"><?= isset($category) ? $category : 'All Category' ?></h5>
                <div class="dropdown float-right">
                    <a class="btn btn-secondary dropdown-toggle rounded-0" id="dropdown-1" data-bs-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort Price By:
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdown-1">
                        <a href="<?= base_url("/shop/sortby/asc") ?>" class="dropdown-item">Lowest</a>
                        <a href="<?= base_url("/shop/sortby/desc") ?>" class="dropdown-item">Highest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>