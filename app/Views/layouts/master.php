<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= esc($title ?? 'Admin Dashboard') ?></title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- your navbar here -->
    <span class="navbar-brand">AdminLTE</span>
  </nav>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <?= $this->renderSection('content') ?>
  </div>

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>AdminLTE</strong> - Powered by CodeIgniter 4
  </footer>

</div>

<!-- Scripts -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>