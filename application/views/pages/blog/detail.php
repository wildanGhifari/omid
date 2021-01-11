<main role="main">
    <div class="container-xl" style="padding: 5% 0;">
        <div class="row">
            <div id="blog-detail" class="col-md-9">
                <?php foreach ($blog as $row) : ?>
                    <h4><?= $row->blog_title ?></h4>
                    <img style="width: 100%;" src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>">
                    <div class="container">
                        <span><?= $row->description ?></span>
                        <hr>
                        <p><?= $row->content ?></p>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>


</main>