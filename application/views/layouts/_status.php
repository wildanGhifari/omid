<?php
if ($status == 'waiting') {
    $badge_status   = 'badge-primary py-2';
    $status         = 'Waiting for payments';
}

if ($status == 'paid') {
    $badge_status   = 'badge-secondary py-2';
    $status         = 'Paid';
}

if ($status == 'delivered') {
    $badge_status   = 'badge-info py-2';
    $status         = 'Delivered';
}
if ($status == 'success') {
    $badge_status   = 'badge-success py-2';
    $status         = 'Success';
}

if ($status == 'cancel') {
    $badge_status   = 'badge-danger py-2';
    $status         = 'Cancel';
}
?>

<?php if ($status) : ?>
    <span class="badge badge-pill <?= $badge_status ?>"><?= $status; ?></span>
<?php endif ?>