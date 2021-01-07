<div class="jumbotron jumbotron-fluid" style="padding: 10% 0;">
    <div class="container text-center text-white" style="margin-top:auto;" style="background-color: #fff;">
        <h1>About Us</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, accusamus mollitia! In illum accusamus ex?</p>
    </div>
    <!-- <span style="margin-left:20px; margin-top:30px">Photo by <a href="https://unsplash.com/@maddibazzocco?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Maddi Bazzocco</a> on <a href="https://unsplash.com/s/photos/nuts?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->
</div>

<main role="main">
    <section class="marginTop">
        <div class="container-xl">
            <div id="aboutOmidRow">
                <div class="aboutOmidCol">
                    <img style="width: 100%; height: 100%;" src="<?= base_url('assets/img/online_store_.svg') ?>" alt="online_store">
                </div>

                <div class="aboutOmidCol">
                    <h3>Who we are?</h3>
                    <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit officia sed aperiam obcaecati quisquam, alias at adipisci dolores eius cupiditate pariatur ipsa suscipit totam fugit ea corporis quos consequuntur. Voluptatum, numquam. Officiis laudantium magnam est ipsa fugiat consectetur amet, ullam, dignissimos error aperiam minus recusandae? Molestiae cum eius neque odit autem molestias corporis aliquid minima totam esse nihil vero dolorem quo, optio veniam consequuntur illum, labore quaerat quibusdam. Nesciunt reprehenderit delectus ipsum quaerat quisquam quos?</p>
                </div>
            </div>
        </div>
    </section>

    <section class="marginTop">
        <div class="container-xl">
            <div id="aboutOmidRow">
                <div class="aboutOmidCol" id="blogDesc">
                    <h3>Read our blogs</h3>
                    <p class="mt-3">Fill your days by reading our blog and get insights about healthy food, the benefits of eating healthy food, why you should start paying attention to your diet and much more</p>
                    <a class="btn btn-success rounded-pill mt-4" href="">Read Here</a>
                </div>

                <div class="aboutOmidCol" id="blogIls">
                    <img style="width: 100%; height: 100%;" src="<?= base_url('assets/img/book_lover.svg') ?>" alt="book_lover">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-xl" style="padding: 5% 10px;">
            <div id="aboutOmidRow">
                <div class="aboutOmidCol">
                    <img style="width: 100%; height: 100%;" src="<?= base_url('assets/img/eating_salad_.svg') ?>" alt="eating_salad">
                </div>

                <div class="aboutOmidCol" id="signupAbout">
                    <h3>Sign up now! it's Free!</h3>
                    <p class="mt-3">Sign up now and <strong>Get a 10% Off</strong> on your first purchase. You will also get promos and other interesting insights about healthy food.</p>
                    <a style="letter-spacing: 0.1em;" class="btn btn-success rounded-pill text-uppercase mt-4" href="<?= base_url('/register') ?>">Sign up Now!</a>
                </div>
            </div>
        </div>
    </section>

    <section class="marginTop">
        <div class="container-fluid bg-white" style="padding: 5% 0;">
            <div class="container-xl">
                <h3>Our Product</h3>
                <div class="prodCatFlexRow">
                    <?php foreach (getCategories() as $category) : ?>
                        <div class="prodCatFlexCol">
                            <a href="<?= base_url("/shop/category/$category->slug") ?>">
                                <div class="card mx-2 my-2" style="min-width: 50% !important;">
                                    <div class="card-body text-center">
                                        <img src="" alt="" width="120px" height="120px">
                                        <p class="card-text mt-4"><?= $category->title ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="row justify-content-center py-4 px-3">
                    <a style="letter-spacing: 0.1em;" class="btn btn-success btn-lg rounded-pill text-uppercase mt-4" href="<?= base_url('shopping') ?>">See All Products</a>
                </div>
            </div>
        </div>
    </section>
</main>