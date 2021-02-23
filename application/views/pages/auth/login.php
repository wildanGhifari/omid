<main role="main">
    <div class="container-fluid" style="padding: 10% 16px;">
        <?php $this->load->view('layouts/_alert') ?>
        <div class="card container-xl bg-white px-0">
            <div class="row">
                <div class="col-md-6" style="padding: 4% 48px;">
                    <img src="<?= base_url('assets/img/finger_print.svg') ?>" alt="">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mx-auto">
                            <div class="card" style="min-height: 460px;">
                                <div class="card-header text-center">
                                    <p>Member Login</p>
                                    <h4>Welcome Back</h4>
                                </div>
                                <div class="card-body px-5 py-5">
                                    <?= form_open('login', ['method' => 'POST']) ?>
                                    <div class="form-group">
                                        <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control rounded-pill', 'placeholder' => 'your@mail.com', 'required' => true]) ?>
                                        <?= form_error('email') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= form_password('password', '', ['class' => 'form-control rounded-pill', 'placeholder' => 'Password', 'required' => true]) ?>
                                        <?= form_error('password') ?>
                                    </div>
                                    <button type="submit" style="width: 100%;" class="btn btn-success rounded-pill mt-4">Login</button>
                                    <div class="text-center mt-3">
                                        <a href="<?= base_url('forgot_password') ?>" class="small text-dark">Forgot Password?</a>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="<?= base_url('register') ?>" class="small text-dark">Not a member? Sign up here</a>
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