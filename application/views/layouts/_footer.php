<!-- WHATSAPP LINK -->
<a id="chatBox" href=""><img style="width: 40px;" src="<?= base_url('assets/img/Wa.png') ?>"></a>


<!-- FOOTER -->
<footer>
    <div class="container-fluid green-bg">
        <div class="container-xl px-0 py-5">
            <div class="row justify-content-between">

                <div class="col-md-3">
                    <div class="mb-4">
                        <h5><strong>Company</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('about') ?>">About Us</a>
                            </li>
                            <li class="list-group-item px-0 py-2 bg-transparent border-0 pr-5">
                                <address>
                                    <a style="color: #fff;" href="https://www.google.com/maps/place/Omid+Health+Style/@-6.267099,106.816013,15z/data=!4m5!3m4!1s0x0:0xb553104b28ad1c15!8m2!3d-6.267099!4d106.816013">
                                        <p>Jl. Kemang Raya No.69c, RT.4/RW.2, Bangka, Kec. Mampang Prpt., Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12730</p>
                                    </a>
                                </address>
                            </li>
                        </ul>
                        <h5 class="mb-4">Follow Us</h5>
                        <a href=""><i class="fa fa-facebook fa-2x mr-3" style="color:#fff;"></i></a>
                        <a href="https://www.instagram.com/omidhealthstyle/?hl=id" target="_blank"><i class="fa fa-instagram fa-2x mr-3" style="color:#fff;"></i></a>
                        <a href=""><i class="fa fa-twitter fa-2x mr-3" style="color:#fff;"></i></a>
                        <a href=""><i class="fa fa-youtube-play fa-2x mr-3" style="color:#fff;"></i></a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-4">
                        <h5><strong>Categories</strong></h5>
                        <ul class="list-group list-group-flush">
                            <?php foreach (getCategories() as $category) : ?>
                                <li class="list-group-item px-0 py-2 bg-transparent border-0"><a class="text-white" href="<?= base_url("/shop/category/$category->slug") ?>"><?= $category->title ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-4">
                        <h5><strong>Discover</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('blog') ?>">Blog</a>
                            </li>
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('recipes') ?>">Recipes</a>
                            </li>
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('testimonial') ?>">Customer Testimonials</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-4">
                        <h5><strong>Have Question?</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('contact') ?>">Contact Us</a>
                            </li>
                            <li class="list-group-item px-0 py-2 bg-transparent border-0">
                                <a class="text-white" href="<?= base_url('faq') ?>">FAQs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="container-fluid bg-white">
    <div class="container-xl px-0 py-3">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <p>Copyright <span>&copy;</span>2020 - PT. Omid Health Style. All rights reserved.</p>
            </div>
            <div class="col-md-6 privacyTerms">
                <a class="mr-3 text-dark" href="<?= base_url('privacy') ?>">Privacy Policy</a>
                <a class="mr-3 text-dark" href="<?= base_url('terms') ?>">Term of Use</a>
            </div>
        </div>
    </div>
</div>
<!-- END OF FOOTER -->