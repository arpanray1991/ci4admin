<?= $this->extend('layouts/admin/master') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= site_url('admin/uploadMediaForm') ?>" class="btn btn-success">
            <i class="fas fa-upload"></i> Upload New Image
        </a>
    </div>

    <div class="form-group">
        <label>Featured Image</label>
        <div class="input-group">
            <input type="text" name="featured_image" id="featuredImageInput" class="form-control" readonly>
            <div class="input-group-append">
            <button type="button" class="btn btn-secondary" onclick="pickFeaturedImage()">Select</button>
            </div>
        </div>
        <img id="featuredImagePreview" src="" class="mt-2" style="max-height:150px; display:none;">
    </div>

    <script>
        function pickFeaturedImage() {
        window.lastMediaCallback = function(imageUrl) {
            document.getElementById('featuredImageInput').value = imageUrl;
            document.getElementById('featuredImagePreview').src = imageUrl;
            document.getElementById('featuredImagePreview').style.display = 'block';
        };

        openMediaPicker(window.lastMediaCallback);
        }
        const baseUrl = "<?= base_url() ?>";
    </script>
    


    <div class="row">
        <?php if (empty($images)): ?>
            <div class="col-12">
                <div class="alert alert-warning">No images uploaded yet.</div>
            </div>
        <?php else: ?>
            <?php foreach ($images as $img): ?>
                <div class="col-sm-2">
                    <div class="card">
                        <img src="<?= base_url().$img['file_path'] ?>" class="card-img-top" alt="<?= $img['file_name'] ?>">
                        <!--<div class="card-body p-2">
                            <small class="text-muted"><?= $img['file_name'] ?></small>
                            <input class="form-control form-control-sm mt-1" value="<?= $img['file_path'] ?>" readonly onclick="this.select();">
                        </div>-->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
