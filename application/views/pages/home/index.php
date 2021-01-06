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

    <!-- PRODUCT TEASER -->
    <section class="marginTop">
        <div class="container-xl">
            <!-- <h3>Our Product</h3> -->
            <div class="flexRow mt-4">
                <?php foreach ($content as $row) : ?>
                    <div class="flexCol">
                        <div class="card mb-4">
                            <a href="<?= base_url("shopping/detail/$row->slug") ?>">
                                <img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.jpg") ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-warning rounded-pill mb-3"><?= $row->category_title; ?></a>
                                    <p class="card-title"><?= $row->product_title; ?></p>
                                    <h6 class="card-text"><strong>Rp.<?= number_format($row->price, 0, ',', '.') ?></strong></h6>
                                    <hr class="my-3">
                                    <form action="<?= base_url("/cart/add") ?>" method="POST">
                                        <input type="hidden" name="id_product" value="<?= $row->id ?>">
                                        <div class="input-group">
                                            <input style="border-radius: 25px 0 0 25px;" type="number" class="form-control" name="qty" value="1">
                                            <div class="input-group-append">
                                                <button style="border-radius: 0 25px 25px 0;" class="btn btn-success">Add To Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <nav aria-label="Page navigation example">
                <div class="row justify-content-center">
                    <?= $pagination; ?>
                </div>
            </nav>

            <div class="row justify-content-center">
                <a style="letter-spacing: 0.1em;" class="btn btn-success btn-lg rounded-pill text-uppercase mt-4" href="<?= base_url('shopping') ?>">See All Products</a>
            </div>
        </div>
    </section>
    <!-- END OF PRODUCT TEASER -->



    <!-- WHY CHOOSE OUR PRODUCT -->
    <section class="marginTop">
        <div class="container-fluid green-bg">
            <div class="container-xl px-0 py-5">
                <h3 class="text-center">Why Should Choose Our Product?</h3>
                <div class="row mt-5">
                    <div class="col-md-3">
                        <div class="text-center px-3" style="width: 100%;">
                            <img src="<?= base_url('assets/img/organic.png') ?>" height="30" class="card-img-top my-3 benefit-img">
                            <h6>Lorem Ipsum</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, earum.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center px-3" style="width: 100%;">
                            <img src="<?= base_url('assets/img/organic.png') ?>" height="30" class="card-img-top my-3 benefit-img">
                            <h6>Lorem Ipsum</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, earum.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center px-3" style="width: 100%;">
                            <img src="<?= base_url('assets/img/organic.png') ?>" height="30" class="card-img-top my-3 benefit-img">
                            <h6>Lorem Ipsum</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, earum.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center px-3" style="width: 100%;">
                            <img src="<?= base_url('assets/img/organic.png') ?>" height="30" class="card-img-top my-3 benefit-img">
                            <h6>Lorem Ipsum</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, earum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF WHY CHOOSE OUR PRODUCT -->



    <!-- TESTIMONIALS -->
    <section class="container-fluid secondary-bg">
        <div class="container-xl px-0 py-5">
            <h3 class="text-center">What They Say About Our Products</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div id="carouselExampleControls" class="carousel slide mt-3 bg-transparent border-0" style="width: 100%;" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div style="box-shadow: none !important;" class="card bg-transparent">
                                    <div class="card-body px-5 text-center">
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis beatae corporis eos voluptas a id aperiam rerum asperiores aut ad, ratione placeat sunt. Provident neque et nobis totam ea quae facilis id. Rem atque libero quos dolores numquam excepturi blanditiis ipsa, enim corporis pariatur ut quo omnis maxime, velit reiciendis.</p>
                                        <h5 class="card-title">Hanna Rhodes</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div style="box-shadow: none !important;" class="card bg-transparent">
                                    <div class="card-body px-5 text-center">
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero doloribus deleniti non optio. Voluptas obcaecati excepturi eius nostrum veniam fugit, optio, ratione a quaerat maxime in libero dolorum autem assumenda, cumque dignissimos ex. Modi aliquam fugit cumque exercitationem expedita nihil! Sequi perferendis praesentium repellat, quo officiis ex nobis, facilis deleniti molestias, quisquam error sit quia unde eius accusamus aperiam ea doloremque? Necessitatibus ab cum pariatur? Facilis, atque praesentium adipisci cupiditate, tempora deleniti omnis deserunt amet incidunt, pariatur magni accusamus ut?</p>
                                        <h5 class="card-title">Lawson Bryant</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div style="box-shadow: none !important;" class="card bg-transparent">
                                    <div class="card-body px-5 text-center">
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis beatae corporis eos voluptas a id aperiam rerum asperiores aut ad, ratione placeat sunt. Provident neque et nobis totam ea quae facilis id. Rem atque libero quos dolores numquam excepturi blanditiis ipsa, enim corporis pariatur ut quo omnis maxime, velit reiciendis.</p>
                                        <h5 class="card-title">Johanna Ward</h5>
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
                    <a class="text-uppercase" style="width: 100%; letter-spacing: 0.1em; color: #06a954;" href="#">See More</a>
                    <a class="btn btn-success rounded-pill text-uppercase my-3" style="width: 100%; letter-spacing: 0.1em;" href="<?= base_url('shopping') ?>">OK, Shop Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF TESTIMONIALS -->



    <!-- RECENT BLOG -->
    <section class="marginTop">
        <div class="container-xl">
            <h3>Get Insights</h3>
            <p class="lead">Read our blog, get insights on healthy food and much more.</p>
            <div class="flexRow mt-4">
                <div class="flexCol">
                    <div class="card">
                        <a href="#"><img src="<?= base_url("/images/blog/1.jpg") ?>" class="card-img-top blog"></a>
                        <div class="card-body">
                            <p class="date">November 18, 2020</p>
                            <a href="">
                                <h6 class="card-title text-dark">Lorem Ipsum is simply Dummy Text</h6>
                            </a>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis iure itaque quam sunt provident illum!</p>
                        </div>
                    </div>
                </div>

                <div class="flexCol">
                    <div class="card">
                        <a href="#"><img src="<?= base_url("/images/blog/3.jpg") ?>" class="card-img-top blog"></a>
                        <div class="card-body">
                            <p class="date">November 18, 2020</p>
                            <a href="">
                                <h6 class="card-title text-dark">Lorem Ipsum is simply Dummy Text</h6>
                            </a>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis iure itaque quam sunt provident illum!</p>
                        </div>
                    </div>
                </div>

                <div class="flexCol">
                    <div class="card">
                        <a href="#"><img src="<?= base_url("/images/blog/gal1.jpg") ?>" class="card-img-top blog"></a>
                        <div class="card-body">
                            <p class="date">November 18, 2020</p>
                            <a href="">
                                <h6 class="card-title text-dark">Lorem Ipsum is simply Dummy Text</h6>
                            </a>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis iure itaque quam sunt provident illum!</p>
                        </div>
                    </div>
                </div>

                <div class="flexCol">
                    <div class="card">
                        <a href="#"><img src="<?= base_url("/images/blog/gal2.jpg") ?>" class="card-img-top blog"></a>
                        <div class="card-body">
                            <p class="date">November 18, 2020</p>
                            <a href="">
                                <h6 class="card-title text-dark">Lorem Ipsum is simply Dummy Text</h6>
                            </a>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis iure itaque quam sunt provident illum!</p>
                        </div>
                    </div>
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
                    <h3>Sign Up now, it’s Free! </h3>
                </div>
            </div>
            <div class="div row justify-content-center mt-3">
                <div class="col-md-3">
                    <a style="width: 100%; letter-spacing: 0.1em;" class="btn btn-success rounded-pill text-uppercase" href="<?= base_url('/register') ?>">Sign Up Now!</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SIGN UP CTA -->
</main>