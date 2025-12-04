<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <h1 class="mb-4"><?= isset($adminuser) ? 'Edit' : 'Add' ?> Admin User</h1>
    <form action="<?= isset($adminuser) ? site_url('admin/adminusers/update/'.$adminuser['id']) : site_url('admin/adminusers/store') ?>" method="post">
      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control" value="<?= $adminuser['firstname'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname" class="form-control" value="<?= $adminuser['lastname'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input <?= isset($adminuser) ? 'readonly' : '' ?> type="text" name="email" class="form-control" value="<?= $adminuser['email'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $adminuser['username'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input <?= isset($adminuser) ? 'readonly' : '' ?> type="text" name="password" class="form-control" value="<?= isset($adminuser) ? '*****' : '' ?>" required>
      </div>
      <div>
        <label>Scope</label>
        <select class="form-control" name="user_scope" id="user_scope">
          <option value="">Select Scope</option>
          <?php
            foreach($scopes as $scope)
            {
              ?>
                <option value="<?= $scope['id']; ?>"
                  <?= (isset($adminuser['user_scope']) && $adminuser['user_scope'] == $scope['id']) ? 'selected' : '' ?>>
                  <?= $scope['scope_type'] ?>
                </option>
              <?php
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <?php if(isset($adminuser['status'])){ ?>
              <?php foreach($statusOptions as $key => $label): ?>
                <option value="<?= $key ?>" 
                  <?= $adminuser['status'] == $key ? 'selected' : '' ?>>
                  <?= $label ?>
                </option>
              <?php endforeach; ?>
          <?php }else{ ?>
            <?php foreach($statusOptions as $key => $label): ?>
              <option value="<?= $key ?>">
                <?= $label ?>
              </option>
            <?php endforeach; ?>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-success"><?= isset($adminuser) ? 'Update' : 'Save' ?></button>
      <a href="<?= site_url('admin/adminusers') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</section>

<?= $this->endSection() ?>
