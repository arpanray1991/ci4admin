<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <h1 class="mb-4"><?= isset($product) ? 'Edit' : 'Add' ?> Product</h1>
    <form action="<?= isset($product) ? site_url('admin/products/update/'.$product['id']) : site_url('admin/products/store') ?>" method="post">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= $product['name'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Sku</label>
        <input <?= isset($product) ? 'readonly' : '' ?> type="text" name="sku" class="form-control" value="<?= $product['sku'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="<?= $product['price'] ?? '' ?>" required>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <?php foreach($statusOptions as $key => $label): ?>
            <option value="<?= $key ?>" 
              <?= (isset($product['status']) == $key) ? 'selected' : '' ?>>
              <?= $label ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-success"><?= isset($product) ? 'Update' : 'Save' ?></button>
      <a href="<?= site_url('admin/products') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</section>

<?= $this->endSection() ?>