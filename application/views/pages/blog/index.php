<main role="main">
    <?php $this->load->view('layouts/_alert') ?>
    <section class="marginTop">
        <div class="container-xl">
            <div class="flexRow-blog mt-4">
                <div class="flexCol-blog">
                    <div class="card-deck">
                        <?php foreach ($content as $row) : ?>
                            <div class="card">
                                <a href="<?= base_url("blog/detail/$row->slug") ?>">
                                    <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row->blog_title; ?></h5>
                                    <p class="card-text"><?= $row->description ?></p>
                                    <a href="<?= base_url("blog/detail/$row->slug") ?>">Read More</a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <nav aria-label="Page navigation example">
        <?= $pagination; ?>
    </nav>
</main>