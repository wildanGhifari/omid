<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('/assets/libs/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/libs/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/app.css') ?>">

    <title><?= isset($title) ? $title : 'Omid Health Style' ?></title>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('layouts/_navbar') ?>
    <!-- End of Navbar -->

    <!-- Content -->
    <?php $this->load->view($page); ?>
    <!-- End of Content -->

    <!-- Footer -->
    <?php $this->load->view('layouts/_footer') ?>
    <!-- End of Footer -->
    <script src="<?= base_url('/assets/libs/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/app.js') ?>"></script>

    <!-- tinyMCE -->
    <script src="https://cdn.tiny.cloud/1/5iycmpuhldf0ioeamw67q9wxfok36a5hjlozduy32yfbl4d5/tinymce/4.4/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#myTextarea',
            plugins: 'lists advlist'
        });
    </script>
</body>

</html>