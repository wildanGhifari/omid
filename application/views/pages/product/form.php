<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Product Form</span>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart($form_action, ['method' => 'POST']) ?>
                        <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
                        <div class="form-group">
                            <label for="productName">Product</label>
                            <?= form_input('title', $input->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'createSlug()', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('title') ?>
                        </div>
                        <div class="form-group">
                            <label for="productName">Produk</label>
                            <?= form_input('judul', $input->judul, ['class' => 'form-control', 'id' => 'judul', 'required' => true]) ?>
                            <?= form_error('judul') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <?= form_textarea(['name' => 'description', 'value' => $input->description, 'row' => 4, 'class' => 'form-control', 'id' => 'myTextarea']) ?>
                            <?= form_error('description') ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <?= form_input(['type' => 'number', 'name' => 'price', 'value' => $input->price, 'class' => 'form-control', 'required' => true]) ?>
                            <?= form_error('price') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Weight</label>
                            <?= form_input(['type' => 'number', 'name' => 'weight', 'value' => $input->weight, 'class' => 'form-control', 'required' => true]) ?>
                            <?= form_error('weight') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <?= form_dropdown('id_category', getDropdownList('category', ['id', 'title']), $input->id_category, ['class' => 'form-control']) ?>
                            <?= form_error('id_category') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Stock</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <?= form_radio(['name' => 'is_available', 'value' => 1, 'checked' => $input->is_available == 1 ? true : false, 'class' => 'form-check-input']) ?>
                                <label for="" class="form-check-label">Available</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?= form_radio(['name' => 'is_available', 'value' => 1, 'checked' => $input->is_available == 0 ? true : false, 'class' => 'form-check-input']) ?>
                                <label for="" class="form-check-label">Empty</label>
                            </div>
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