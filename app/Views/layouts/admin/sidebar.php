<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= site_url('admin/dashboard') ?>" class="brand-link">
    <span class="brand-text font-weight-light">AdminLTE</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item">
          <a href="<?= site_url('admin/dashboard') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <?php if(checkModuleInScope('Products')){ ?>
          <li class="nav-item">
            <a href="<?= site_url('admin/products') ?>" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Products</p>
            </a>
          </li>
        <?php } if(checkModuleInScope('Admin Users')){ ?>
        <li class="nav-item">
          <a href="<?= site_url('admin/adminusers') ?>" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Admin Users</p>
          </a>
        </li>
        <?php } if(checkModuleInScope('QR Data')){ ?>
        <li class="nav-item">
          <a href="<?= site_url('admin/qr_data') ?>" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>QR Data</p>
          </a>
        </li>
        <?php } if(checkModuleInScope('Media')){ ?>
          <li class="nav-item">
            <a href="<?= site_url('admin/media') ?>" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Media</p>
            </a>
          </li>
        <?php } if(checkModuleInScope('Modules')){ ?>
        <li class="nav-item">
          <a href="<?= site_url('admin/modules') ?>" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Modules</p>
          </a>
        </li>
        <?php } if(checkModuleInScope('Scope')){ ?>
        <li class="nav-item">
          <a href="<?= site_url('admin/scopes') ?>" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Scope</p>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="<?= site_url('admin/logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>