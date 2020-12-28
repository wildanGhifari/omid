<main role="main" class="container">
    <div class="container-xl" style="padding: 5% 0;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header lead font-weight-bold">
                        <strong>Edit Profile</strong>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart($form_action, ['method' => 'POST',]) ?>
                        <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
                        <div class="form-group">
                            <label for="">Fullname</label>
                            <?= form_input('name', $input->name, ['class' => 'form-control  rounded-0', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('name') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control rounded-0', 'placeholder' => 'your@mail.com', 'required' => true, 'readonly' => true]) ?>
                            <?= form_error('email') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <?= form_password('password', '', ['class' => 'form-control rounded-0', 'placeholder' => 'Minimal 8 Character']) ?>
                            <?= form_error('password') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Photo</label><br>
                            <div class="input-group">
                                <?= form_upload('image') ?>
                                <?php if ($this->session->flashdata('image_error')) : ?>
                                    <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                                <?php endif ?>
                                <?php if (isset($input->image)) : ?>
                                    <img src="<?= base_url("/images/user/$input->image") ?>" alt="" height="150">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 mt-4">
                                <button style="width: 100%;" class="btn btn-success rounded-0" type="submit">Save</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>