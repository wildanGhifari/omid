<?php
if ($status == 'waiting') {
    $badge_status   = 'badge-primary';
    $status         = 'Waiting for payments';
}

if ($status == 'paid') {
    $badge_status   = 'badge-secondary';
    $status         = 'Paid';
}

if ($status == 'delivered') {
    $badge_status   = 'badge-info';
    $status         = 'Delivered';
}
if ($status == 'success') {
    $badge_status   = 'badge-success';
    $status         = 'Success';
}

if ($status == 'cancel') {
    $badge_status   = 'badge-danger';
    $status         = 'Cancel';
}
?>

<?php if ($status) : ?>
    <span class="badge badge-pill <?= $badge_status ?>"><?= $status; ?></span>
<?php endif ?>