<!-- CAROUSEL -->
<div class="container-fluid px-0">

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <!-- <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol> -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="#">
                    <div class="crsFirst"></div>
                </a>
            </div>

            <div class="carousel-item">
                <a href="#">
                    <div class="crsSecond"></div>
                </a>
            </div>

            <div class="carousel-item">
                <a href="#">
                    <div class="crsThird"></div>
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- END OFCAROUSEL -->


<main role="main">
    <?php $this->load->view('layouts/_alert') ?>

    <!-- NEW PRODUCT TEASER -->
    <section class="marginTop">
        <div id="teaserProduct" class="container-xl">
            <div class="row py-0">
                <div class="col-md-12">
                    <h4 class="float-left">Our Products</h4>
                    <a href="<?= base_url('shopping') ?>" class="float-right">
                        <h4>See All <i class="fas fa-chevron-right"></i></h4>
                    </a>
                </div>
            </div>
            <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": true }'>
                <?php foreach ($content as $row) : ?>
                    <div class="gallery-cell">
                        <div class="card">
                            <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?>gr</span>
                            <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                <img class="card-img-top" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                            </a>
                            <div class="card-body">
                                <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$row->category_slug") ?>"><?= $row->category_title; ?></a></small>
                                <p class="card-title"><?= $row->product_title; ?></p>
                                <h5>Rp.<?= number_format($row->price, 0, ',', '.') ?></h5>
                                <form action="<?= base_url("/cart/add") ?>" method="POST" class="mt-4">
                                    <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="qty" value="1">
                                        <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- END OF NEW PRODUCT TEASER -->


    <!-- B2B PRODUCTS TEASER -->
    <section class="marginTop">
        <div id="teaserProduct" class="container-xl">
            <div class="row py-0">
                <div class="col-md-12">
                    <h4 class="float-left">B2b Products</h4>
                    <a href="<?= base_url('shopping') ?>" class="float-right">
                        <h4>See All <i class="fas fa-chevron-right"></i></h4>
                    </a>
                </div>
            </div>
            <div class="main-gallery js-flickity" data-flickity-options='{ "freeScroll": true, "contain": true, "prevNextButtons": true, "pageDots": false, "adaptiveHeight": true }'>
                <?php foreach ($products as $row) : ?>
                    <div class="gallery-cell">
                        <div class="card">
                            <span class="badge badge-warning badge-pill mr-2"><?= $row->weight; ?>gr</span>
                            <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                <img class="card-img-top" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" alt="">
                            </a>
                            <div class="card-body">
                                <small><a class="category text-uppercase" href="<?= base_url("/shop/category/$row->category_slug") ?>"><?= $row->category_title; ?></a></small>
                                <p class="card-title"><?= $row->product_title; ?></p>
                                <h5>Rp.<?= number_format($row->price, 0, ',', '.') ?></h5>
                                <form action="<?= base_url("/cart/add") ?>" method="POST" class="mt-4">
                                    <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="" value="1">
                                        <button type="submit" class="btn btn-success" style="width: 100%;">Add To Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- END OF B2B PRODUCTS TEASER -->



    <!-- WHY CHOOSE OUR PRODUCT -->
    <section class="marginTop">
        <div id="WCOP" class="container-xl">
            <h4>Why Should Choose Our Product?</h4>
            <div class="row mt-5">
                <div class="col-md-3 mb-3">
                    <div class="card text-center" style="min-height: 350px;">
                        <img class="card-img-top benefit-img mx-auto mt-4" src="<?= base_url('assets/img/icon/Fast Delivery.png') ?>" alt="Fast Delivery">
                        <div class="card-body">
                            <h6 class="card-title">Fast Delivery</h6>
                            <p class="card-text">We will process every purchase on the same day, just #StayAtHome, choose the time of delivery and We bring healthy foods to your lifestyle!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center" style="min-height: 350px;">
                        <img class="card-img-top benefit-img mx-auto mt-4" src=" <?= base_url('assets/img/icon/Original.png') ?>" alt="100% Original">
                        <div class="card-body">
                            <h6 class="card-title">100% Original</h6>
                            <p class="card-text">The products we sell have high quality certificates and there are halal certificates!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center" style="min-height: 350px;">
                        <img class="card-img-top benefit-img mx-auto mt-4" src="<?= base_url('assets/img/icon/Premium.png') ?>" alt="Premium Service">
                        <div class="card-body">
                            <h6 class="card-title">Premium Service</h6>
                            <p class="card-text">There are attractive promos every week, special gifts, and guaranteed free delivery (read our Terms and Conditions)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-center" style="min-height: 350px;">
                        <img class="card-img-top benefit-img mx-auto mt-4" src="<?= base_url('assets/img/icon/Guarantee.png') ?>" alt="Fresh Goods Guarantee">
                        <div class="card-body">
                            <h6 class="card-title">Fresh Goods Guarantee</h6>
                            <p class="card-text">All products are purchased by our personal shopper who has been in the F&B field for years.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- END OF WHY CHOOSE OUR PRODUCT -->



    <!-- TESTIMONIALS -->
    <section id="testimonials" class="container-fluid marginTop">
        <div class="container-xl py-5">
            <h3 class="text-center text-white">What they say about our products?</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div id="carouselExampleControls" class="carousel slide mt-3 bg-transparent border-0" style="width: 100%;" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card text-center text-white bg-transparent">
                                    <div class="card-body">
                                        <h5 class="card-title">Lynnette Chan</h5>
                                        <p class="card-text text-light">Since the start of the pandemic, I have tried a lot of online grocery delivery palforms and nothing compares to Omid in terms of produce quality & freshness, as well as promptness of service. From local and imported fruits to home made nut butters and yoghurt, there is a huge variety of food to suit my every need. Thank you for helping me to feed my family and always being a delight to order from!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="card text-center text-white bg-transparent">
                                    <div class="card-body">
                                        <h5 class="card-title">Ankita Bansal</h5>
                                        <p class="card-text text-light">I like all the products that we have ordered till now because of genuineness and quality also, the customer service is amazing.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="card text-center text-white bg-transparent">
                                    <div class="card-body">
                                        <h5 class="card-title">Anastasia Yurkevich</h5>
                                        <p class="card-text text-light">Just wanted to say that I was very happy with the quality of the products delivered yesterday. Will be ordering again in the future, thank you for the great service.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" style="width: 50px;" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" style="width: 50px;" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                    <a class="btn btn-warning rounded-pill text-uppercase my-3" style="width: 100%; letter-spacing: 0.1em;" href="<?= base_url('shopping') ?>">OK, Shop Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF TESTIMONIALS -->



    <!-- RECENT BLOG -->
    <section class="marginTop">
        <div class="container-xl">
            <h4>Read our latest blog, and Get insights</h4>
            <p class="mt-2 text-muted">Fill your days by reading our blog and get insights about a healthy lifestyle, healthy / organic food, tips and tricks for processing organic food and much more.</p>
            <div class="flexRow mt-4">
                <?php foreach ($blogs as $blog) : ?>
                    <div class="flexCol">
                        <div class="card mb-4">
                            <a href="<?= base_url("blog/detail/$blog->slug") ?>">
                                <img src="<?= $blog->image ? base_url("images/blog/$blog->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $blog->blog_title; ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title"><?= $blog->blog_title; ?></h6>
                                <p class="card-text"><?= $blog->description ?></p>
                                <a class="float-left" href="<?= base_url("blog/detail/$blog->slug") ?>">Read More</a>
                                <div class="float-right">
                                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                                        <?= form_open(base_url("/blog/delete/$blog->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $blog->id) ?>
                                        <a href="<?= base_url("/blog/edit/$blog->id") ?>"><i class="fas fa-edit text-info"></i></a>
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
            <div class="div row justify-content-center mt-5">
                <div class="col-md-3">
                    <a style="width: 100%; letter-spacing: 0.1em;" class="btn btn-success rounded-pill text-uppercase" href="<?= base_url('/blog') ?>">Discover Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF RECENT BLOG -->



    <!-- SIGN UP CTA -->
    <section id="ctaSignup" class="marginTop">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="text-white">Sign up & Become a member now, it’s free!</h3>
                </div>
            </div>
            <div class="div row justify-content-center mt-5">
                <div class="col-md-3">
                    <a style="width: 100%; letter-spacing: 0.1em;" class="btn btn-warning rounded-pill text-uppercase" href="<?= base_url('/register') ?>">Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SIGN UP CTA -->
</main>