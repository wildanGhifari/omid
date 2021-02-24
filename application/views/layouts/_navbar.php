<nav style="z-index: 9999;" class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/img/OmidLogo.png') ?>" alt="">
        </a>

        <div class="ml-auto d-flex">
            <a href="<?= base_url('wishlist') ?>" class="nav-link btn py-3 cartMobile">
                <i class="text-muted fas fa-heart fa-lg"></i>
                <?php if ($this->session->userdata('is_login')) : ?>
                    <span class="badge badge-success rounded-circle mr-2" aria-valuemin="0">
                        <?= getWishlist(); ?>
                    </span>
                <?php endif ?>
            </a>

            <a href="<?= base_url('cart') ?>" class="nav-link btn py-3 cartMobile">
                <i class="text-muted fas fa-shopping-cart fa-lg"></i>
                <?php if ($this->session->userdata('is_login')) : ?>
                    <span class="badge badge-success rounded-circle" aria-valuemin="0">
                        <?= getCart(); ?>
                    </span>
                <?php endif ?>
            </a>
        </div>


        <!-- <?php if ($this->session->userdata('is_login')) : ?>
            <a href="#" class="nav-link dropdown-toggle text-dark userMobile" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img style="max-height: 46px;" class="rounded-circle border border-success" src="<?= base_url('images/user/') . $this->session->userdata('image') ?>" alt="">
            </a>
            <div style="width: 100%;" class="dropdown-menu py-0" aria-labelledby="dropdown-2">
                <a href="<?= base_url('/profile') ?>" class="dropdown-item py-3"><i class="fas fa-user mr-2"></i>Profile</a>
                <a href="<?= base_url('/myorder') ?>" class="dropdown-item py-3"><i class="fas fa-list-alt mr-2"></i>Orders</a>
                <a href="<?= base_url('/logout') ?>" class="dropdown-item accent-bg py-3"><i class="fa fa-sign-out mr-2"></i>Log out</a>
            </div>
        <?php endif ?> -->

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav text-right">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('shopping') ?>">Shop<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav mx-auto">
                <form action="<?= base_url('shop/search') ?>" method="POST">
                    <div class="input-group searchBar">
                        <input style="border-radius: 25px 0 0 25px;" type="text" name="keyword" placeholder="Almond, Cranberry, etc. . ." value="<?= $this->session->userdata('keyword') ?>" class="form-control">
                        <div class="input-group-append">
                            <button style="border-radius: 0 25px 25px 0;" class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </ul>
            <ul class="navbar-nav ml-auto text-right">
                <li class="nav-item">
                    <a href="<?= base_url('wishlist') ?>" class="nav-link btn py-3 cartDesktop">
                        <i class="fas fa-heart fa-lg"></i>
                        <?php if ($this->session->userdata('is_login')) : ?>
                            <span class="badge badge-success rounded-circle mr-2" aria-valuemin="0">
                                <?= getWishlist(); ?>
                            </span>
                        <?php endif ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('cart') ?>" class="nav-link btn py-3 cartDesktop">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <?php if ($this->session->userdata('is_login')) : ?>
                            <span class="badge badge-success rounded-circle mr-2" aria-valuemin="0">
                                <?= getCart(); ?>
                            </span>
                        <?php endif ?>
                    </a>
                </li>
                <?php if (!$this->session->userdata('is_login')) : ?>
                    <li class="nav-item mt-2">
                        <a href="<?= base_url('/login') ?>" class="px-3 nav-link btn btn-outline-success rounded-pill login">Login</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="<?= base_url('/register') ?>" class="px-3 nav-link btn btn-success rounded-pill signup">Sign Up</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>
                                <?php
                                $names  = $this->session->userdata('name');
                                $name   = explode(" ", $names);

                                echo $name[0];
                                ?>
                            </strong>
                            <img style="max-height: 46px;" class="rounded-circle border border-success ml-2" src="<?= base_url('images/user/') . $this->session->userdata('image') ?>" alt="">
                        </a>
                        <div style="width: 100%;" class="dropdown-menu py-0" aria-labelledby="dropdown-2">
                            <a href="<?= base_url('/profile') ?>" class="dropdown-item py-2"><i class="fas fa-user mr-2"></i>Profile</a>
                            <a href="<?= base_url('/myorder') ?>" class="dropdown-item py-2"><i class="fas fa-list-alt mr-2"></i>My Orders</a>
                            <a href="<?= base_url('/logout') ?>" class="dropdown-item accent-bg py-2"><i class="fa fa-sign-out mr-2"></i>Log out</a>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<div id="navbarCat" class="category-nav container-fluid green-bg sticky-top">
    <div class="container-xl px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="slider">
                    <div class="slides">
                        <?php foreach (getCategories() as $category) : ?>
                            <div class="">
                                <a href="<?= base_url("/shop/category/$category->slug") ?>"><?= $category->title ?></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>