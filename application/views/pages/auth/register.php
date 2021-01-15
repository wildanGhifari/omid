<main role="main">
    <div class="container-xl" style="padding: 10% 16px;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="card container-xl bg-white px-0">
            <div class="row">
                <div class="col-md-6" style="padding: 5% 48px;">
                    <img src="<?= base_url('assets/img/finger_print.svg') ?>" alt="">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <p>Join as a Member</p>
                                    <!-- <h4>Get 10% Off on your first purchase!</h4> -->
                                </div>
                                <div class="card-body px-5 py-5">
                                    <?= form_open('register', ['method' => 'POST']) ?>

                                    <div class="form-group">
                                        <?= form_input('name', $input->name, ['class' => 'form-control', 'placeholder' => 'Fullname', 'required' => true, 'autofocus' => true]) ?>
                                        <?= form_error('name') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control', 'placeholder' => 'your@mail.com', 'required' => true]) ?>
                                        <?= form_error('email') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Minimal 8 Character', 'required' => true]) ?>
                                        <?= form_error('password') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= form_password('password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'required' => true]) ?>
                                        <?= form_error('password_confirmation') ?>
                                    </div>
                                    <button type="submit" style="width: 100%;" class="btn btn-success rounded-pill mt-4">Sign Up</button>
                                    <div class="text-center mt-4">
                                        <a href="<?= base_url('login') ?>" class="small text-dark">Already a Member? Login here</a>
                                    </div>

                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







    </div>
</main>