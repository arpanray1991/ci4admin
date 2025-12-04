<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <h1 class="mb-4"><?= isset($module) ? 'Edit' : 'Add' ?> Module</h1>
    <form action="<?= isset($module) ? site_url('admin/modules/update/'.$module['id']) : site_url('admin/modules/store') ?>" method="post">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="module_name" class="form-control" value="<?= $module['module_name'] ?? '' ?>" required>
      </div>
        <div class="form-group">
            <label>Functionality</label>
            <div class="custom-control custom-checkbox">
                <?php
                    if(isset($module) && in_array('add',$module['operations']))
                    {
                        ?>
                            <input class="custom-control-input" checked type="checkbox" id="add" name="add">
                      <?php
                    }else{
                        ?>
                            <input class="custom-control-input" type="checkbox" id="add" name="add">
                        <?php
                    }
                ?>
                <label for="add" class="custom-control-label">Add</label>
            </div>

            <div class="custom-control custom-checkbox">
                <?php
                    if(isset($module) && in_array('view',$module['operations']))
                    {
                        ?>
                            <input class="custom-control-input" checked type="checkbox" id="view" name="view">
                      <?php
                    }else{
                        ?>
                            <input class="custom-control-input" type="checkbox" id="view" name="view">
                        <?php
                    }
                ?>
                <label for="view" class="custom-control-label">View</label>
            </div>

            <div class="custom-control custom-checkbox">
                <?php
                    if(isset($module) && in_array('edit',$module['operations']))
                    {
                        ?>
                            <input class="custom-control-input" checked type="checkbox" id="edit" name="edit">
                      <?php
                    }else{
                        ?>
                            <input class="custom-control-input" type="checkbox" id="edit" name="edit">
                        <?php
                    }
                ?>
                <label for="edit" class="custom-control-label">Edit</label>
            </div>

            <div class="custom-control custom-checkbox">
                <?php
                    if(isset($module) && in_array('delete',$module['operations']))
                    {
                        ?>
                            <input class="custom-control-input" checked type="checkbox" id="delete" name="delete">
                      <?php
                    }else{
                        ?>
                            <input class="custom-control-input" type="checkbox" id="delete" name="delete">
                        <?php
                    }
                ?>
                <label for="delete" class="custom-control-label">Delete</label>
            </div>
        </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <?php if(isset($module['status'])){ ?>
              <?php foreach($statusOptions as $key => $label): ?>
                <option value="<?= $key ?>" 
                  <?= $module['status'] == $key ? 'selected' : '' ?>>
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
      <button type="submit" class="btn btn-success"><?= isset($module) ? 'Update' : 'Save' ?></button>
      <a href="<?= site_url('admin/modules') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</section>

<?= $this->endSection() ?>