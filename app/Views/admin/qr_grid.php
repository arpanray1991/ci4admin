<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">QR List</h3>
        <div class="btn-group ml-auto">
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

              <a class="dropdown-item" href="<?= site_url('admin/products/import') ?>">Import QR</a>
              <a class="dropdown-item" href="<?= site_url('admin/products/export') ?>">Export QR</a>
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
                  <input class="form-check-input" type="checkbox" value="user" onclick=fieldCheckClick(this.id) id="col_user" <?= in_array('user',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_user">User</label>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="qr_text" onclick=fieldCheckClick(this.id) id="col_qr_text" <?= in_array('qr_text',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_qr_text">QR Text</label>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="qr_hash" onclick=fieldCheckClick(this.id) id="col_qr_hash" <?= in_array('qr_hash',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_qr_hash">QR Hash</label>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="short_code" onclick=fieldCheckClick(this.id) id="col_short_code" <?= in_array('short_code',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_short_code">Short Code</label>
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
              <th class="col_user_th <?php echo in_array('user',$hide_fields) ? 'th_hide' : ''; ?>">User</th>
              <th class="col_qr_text_th <?php echo in_array('qr_text',$hide_fields) ? 'th_hide' : ''; ?>">Qr Text</th>
              <th class="col_qr_hash_th <?php echo in_array('qr_hash',$hide_fields) ? 'th_hide' : ''; ?>">Qr Hash</th>
              <th class="col_short_code_th <?php echo in_array('short_code',$hide_fields) ? 'th_hide' : ''; ?>">Short Code</th>
              <th class="col_created_at_th <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($qr_data as $qr): ?>
              <tr>
                <td class="col_id_td <?php echo in_array('id',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($qr['id']) ?></td>
                <td class="col_user_td <?php echo in_array('user',$hide_fields) ? 'th_hide' : ''; ?>">Guest</td>
                <td class="col_qr_text_td <?php echo in_array('qr_text',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($qr['qr_text']) ?></td>
                <td class="col_qr_hash_td <?php echo in_array('qr_hash',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($qr['qr_hash']) ?></td>
                <td class="col_short_code_td <?php echo in_array('short_code',$hide_fields) ? 'th_hide' : ''; ?>"><?= base_url().'qrRedirect/'.esc($qr['qr_hash']) ?></td>
                <td class="col_created_at_td <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc(date('d/m/Y', strtotime($qr['created_at']))) ?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenuButton<?= $qr['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton<?= $qr['id'] ?>">
                      <a class="dropdown-item" href="<?= site_url('admin/qr_data/view/' . $qr['id']) ?>">
                        <i class="fas fa-eye text-primary"></i> View
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(<?= $qr['id'] ?>)">
                        <i class="fas fa-trash text-danger"></i> Delete
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
      text: "This data will be permanently deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= site_url('admin/qr_data/delete/') ?>" + id;
      }
    });
  }

  function fieldCheckClick(id){
    var field_id = id.replace("col_", "");
    var baseUrl = "<?= base_url(); ?>";
    if($('#'+id).is(":checked")){
      $.ajax({
        url:baseUrl+'admin/qr_data/fieldShowHide',
        type:"POST",
        data:{field_id:field_id, is_checked:1},
        success:function(response){
          $('.'+id+'_th').removeClass('th_hide');
          $('.'+id+'_td').removeClass('th_hide');
        }
      })
    } else {
      $.ajax({
        url:baseUrl+'admin/qr_data/fieldShowHide',
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