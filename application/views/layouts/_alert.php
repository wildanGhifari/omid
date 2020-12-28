<?php

$success    = $this->session->flashdata('success');
$error      = $this->session->flashdata('error');
$warning    = $this->session->flashdata('warning');

if ($success) {
    $alert_status   = 'alert-success';
    $status         = 'Success';
    $message        = $success;
}

if ($error) {
    $alert_status   = 'alert-danger';
    $status         = 'Error';
    $message        = $error;
}

if ($warning) {
    $alert_status   = 'alert-warning';
    $status         = 'Warning';
    $message        = $warning;
}
?>

<?php if ($success || $error || $warning) : ?>
    <div class="container-xl px-0">
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="alert <?= $alert_status ?> alert-dismissible fade show" role="alert">
                    <strong><?= $status ?></strong> <?= $message ?>.
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>