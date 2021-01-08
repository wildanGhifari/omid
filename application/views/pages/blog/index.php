<main role="main">
    <?php $this->load->view('layouts/_alert') ?>
    <section class="marginTop">
        <div class="container-xl">
            <div class="flexRow mt-4">
                <div class="flexCol">
                    <div class="card-deck">
                        <?php foreach ($content as $row) : ?>
                            <div class="card">
                                <img src="<?= $row->image ? base_url("images/blog/$row->image") : base_url("images/blog/default.jpg") ?>" alt="<?= $row->blog_title; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row->blog_title; ?></h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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