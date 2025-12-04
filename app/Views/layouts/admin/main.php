<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?= $this->include('admin/layout/navbar') ?>
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content-wrapper">
        <section class="content pt-3">
            <?= $this->renderSection('content') ?>
        </section>
    </div>

    <footer class="main-footer text-center">
        <strong>&copy; <?= date('Y') ?> Admin Panel</strong>
    </footer>
</div>

<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
