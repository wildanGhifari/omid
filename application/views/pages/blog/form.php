<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Blog Form</span>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart($form_action, ['method' => 'POST']) ?>
                        <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
                        <div class="form-group">
                            <label for="blogName">Blog Post</label>
                            <?= form_input('title', $input->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'createSlug()', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('title') ?>
                        </div>
                        <div class="form-group">
                            <label for="key1">Keywords 1</label>
                            <?= form_input('key1', $input->key1, ['class' => 'form-control', 'id' => 'key1', 'required' => true]) ?>
                            <?= form_error('key1') ?>
                        </div>
                        <div class="form-group">
                            <label for="key2">Keywords 2</label>
                            <?= form_input('key2', $input->key2, ['class' => 'form-control', 'id' => 'key2', 'required' => true]) ?>
                            <?= form_error('key2') ?>
                        </div>
                        <div class="form-group">
                            <label for="key3">Keywords 3</label>
                            <?= form_input('key3', $input->key3, ['class' => 'form-control', 'id' => 'key3', 'required' => true]) ?>
                            <?= form_error('key3') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <?= form_dropdown('id_blog_category', getDropdownList('blog_category', ['id', 'title']), $input->id_blog_category, ['class' => 'form-control']) ?>
                            <?= form_error('id_blog_category') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <?= form_textarea(['name' => 'description', 'value' => $input->description, 'row' => 4, 'class' => 'form-control', 'id' => 'blogTextarea']) ?>
                            <?= form_error('description') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <?= form_textarea(['name' => 'content', 'value' => $input->content, 'row' => 4, 'class' => 'form-control', 'id' => 'contentBlogTextarea']) ?>
                            <?= form_error('content') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label> <br>
                            <?= form_upload('image') ?>
                            <?php if ($this->session->flashdata('image_error')) : ?>
                                <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                            <?php endif ?>
                            <?php if ($input->image) : ?>
                                <img src="<?= base_url("/images/product/$input->image") ?>" alt="" height="150">
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <?= form_input('slug', $input->slug, ['class' => 'form-control', 'id' => 'slug', 'required' => true]) ?>
                            <?= form_error('slug') ?>
                        </div>
                        <button type="submit" class="btn btn-success rounded-0" style="width: 100%;">Save</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>