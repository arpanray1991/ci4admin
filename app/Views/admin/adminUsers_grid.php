<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Admin User List</h3>
        <div class="btn-group ml-auto">
          <a href="<?= site_url('admin/adminusers/create') ?>" class="btn btn-primary">Add User</a>
          <div class="dropdown ml-1">
            <button type="button" class="btn btn-secondary" data-toggle="dropdown">
              <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">

              <span class="dropdown-header">FILTER BY</span>
              <a class="dropdown-item" href="?status=all">All</a>
              <a class="dropdown-item" href="?status=active">Active</a>
              <a class="dropdown-item" href="?status=inactive">Inactive</a>
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="<?= site_url('admin/products/import') ?>">Import Users</a>
              <a class="dropdown-item" href="<?= site_url('admin/products/export') ?>">Export Users</a>
            </div>
          </div>
          <div class="dropdown ml-1">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
              <i class="fas fa-columns"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <span class="dropdown-header">ENABLE FIELDS</span>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="id" onclick=fieldCheckClick(this.id) id="col_id" <?= in_array('id',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_id">ID</label>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="created_at" onclick=fieldCheckClick(this.id) id="col_created_at" <?= in_array('created_at',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_created_at">Created At</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <table id="gridTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="col_id_th <?php echo in_array('id',$hide_fields) ? 'th_hide' : ''; ?>">ID</th>
              <th class="col_name_th <?php echo in_array('name',$hide_fields) ? 'th_hide' : ''; ?>">Name</th>
              <th class="col_price_th <?php echo in_array('price',$hide_fields) ? 'th_hide' : ''; ?>">Email</th>
              <th class="col_created_at_th <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($adminusers as $adminuser): ?>
              <tr>
                <td class="col_id_td <?php echo in_array('id',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($adminuser['id']) ?></td>
                <td class="col_name_td <?php echo in_array('name',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($adminuser['firstname'].' '.$adminuser['lastname']) ?></td>
                <td class="col_price_td <?php echo in_array('price',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($adminuser['email']) ?></td>
                <td class="col_created_at_td <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($adminuser['created_at']) ?></td>
                <td>
                  <!--<a href="<?= site_url('admin/products/edit/' . $adminuser['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                  <a href="javascript:void(0);" onclick="confirmDelete(<?= $adminuser['id'] ?>)" class="btn btn-sm btn-dark">Delete</a>-->
                  <div class="dropdown">
                    <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenuButton<?= $adminuser['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton<?= $adminuser['id'] ?>">
                      <a class="dropdown-item" href="<?= site_url('admin/adminusers/edit/' . $adminuser['id']) ?>">
                        <i class="fas fa-edit text-primary"></i> Edit
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(<?= $adminuser['id'] ?>)">
                        <i class="fas fa-trash text-danger"></i> Delete
                      </a>
                      <a class="dropdown-item" href="<?= site_url('admin/adminusers/emailStatement/' . $adminuser['id']) ?>">
                        <i class="fas fa-envelope text-info"></i> Email Statement
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This user will be permanently deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= site_url('admin/adminusers/delete/') ?>" + id;
      }
    });
  }

  function fieldCheckClick(id){
    var field_id = id.replace("col_", "");
    var baseUrl = "<?= base_url(); ?>";
    if($('#'+id).is(":checked")){
      $.ajax({
        url:baseUrl+'admin/adminusers/fieldShowHide',
        type:"POST",
        data:{field_id:field_id, is_checked:1},
        success:function(response){
          $('.'+id+'_th').removeClass('th_hide');
          $('.'+id+'_td').removeClass('th_hide');
        }
      })
    } else {
      $.ajax({
        url:baseUrl+'admin/adminusers/fieldShowHide',
        type:"POST",
        data:{field_id:field_id, is_checked:0},
        success:function(response){
          $('.'+id+'_th').addClass('th_hide');
          $('.'+id+'_td').addClass('th_hide');
        }
      }) 
    }
  }
</script>
<?= $this->endSection() ?>