<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <h1 class="mb-4"><?= isset($scope) ? 'Edit' : 'Add' ?> Scope</h1>
    <form action="<?= isset($scope) ? site_url('admin/scopes/update/'.$scope['id']) : site_url('admin/scopes/store') ?>" method="post">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="scope_type" class="form-control" value="<?= $scope['scope_type'] ?? '' ?>" required>
      </div>
        <div class="form-group">
            <label>Modules</label>
            <?php
                foreach($modules as $module){
                    ?>
                        <div>
                            <?php
                                if(isset($selected_modules) && in_array($module['module_name'],$selected_modules)){
                                    $key = array_search($module['module_name'], $selected_modules);
                                    $selected_actions = explode(',',$selected_action[$key]);
                                    ?>
                                        <input type = "checkbox" checked name = "module_<?= $module['id'] ?>"><?= $module['module_name'] ?>
                                        <div class="form-group">
                                            <label>Actions</label><br>
                                            <?php
                                                $functionality = json_decode($module['functionality']);
                                                foreach($functionality as $fn){
                                                    if(in_array($fn,$selected_actions)){
                                                        ?>
                                                            <input type="checkbox" checked name="<?= $module['id'].'_action' ?>[]" value="<?= $fn ?>"> <?= ucfirst($fn) ?><br>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <input type="checkbox" name="<?= $module['id'].'_action' ?>[]" value="<?= $fn ?>"> <?= ucfirst($fn) ?><br>
                                                        <?php
                                                    }
                                                    ?>
                                                        
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    <?php
                                }else{
                                    ?>
                                        <input type = "checkbox" name = "module_<?= $module['id'] ?>"><?= $module['module_name'] ?>
                                        <div class="form-group">
                                            <label>Actions</label><br>
                                            <?php
                                                $functionality = json_decode($module['functionality']);
                                                foreach($functionality as $fn){
                                                    ?>
                                                        <input type="checkbox" name="<?= $module['id'].'_action' ?>[]" value="<?= $fn ?>"> <?= ucfirst($fn) ?><br>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    <?php
                                }
                            ?>
                            
                            
                        </div>
                    <?php
                }
            ?>
        </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <?php if(isset($scope['status'])){ ?>
              <?php foreach($statusOptions as $key => $label): ?>
                <option value="<?= $key ?>" 
                  <?= $scope['status'] == $key ? 'selected' : '' ?>>
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
      <button type="submit" class="btn btn-success"><?= isset($scope) ? 'Update' : 'Save' ?></button>
      <a href="<?= site_url('admin/scopes') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</section>

<?= $this->endSection() ?>