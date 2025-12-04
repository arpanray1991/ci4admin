<?= $this->extend('layouts/admin/master') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Upload Image</h3>
        </div>
        <form action="<?= site_url('admin/uploadMedia') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Upload</button>
                <a href="<?= site_url('admin/media') ?>" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
