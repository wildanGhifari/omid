<main role="main">
    <div class="container-xl" style="padding: 5%;">

        <?php foreach ($blog as $row) : ?>
            <div class="row">
                <div id="blog-detail" class="col-md-12">
                    <h3><?= $row->blog_title ?></h3>
                    <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <span><?= $row->description ?></span>
                    <hr>
                    <p><?= $row->content ?></p>
                </div>
                <div class="col-md-4">
                    <?php foreach ($products as $product) : ?>
                        <div class="row mb-3">
                            <div class="card" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product->product_title ?></h5>
                                    <p class="card-text">Content</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>

        <!-- <div class="row">
            <div id="blog-detail" class="col-md-9">
                <?php foreach ($blog as $row) : ?>
                    <h4><?= $row->blog_title ?></h4>
                    <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>">
                    <div class="container-xl px-0">
                        <span><?= $row->description ?></span>
                        <hr>
                        <p><?= $row->content ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div> -->
    </div>


</main>