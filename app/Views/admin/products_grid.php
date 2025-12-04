<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Product List</h3>
        <div class="btn-group ml-auto">
          <a href="<?= site_url('admin/products/create') ?>" class="btn btn-primary">Add Product</a>
          <div class="dropdown ml-1">
            <button type="button" class="btn btn-secondary" data-toggle="dropdown">
              <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
              <!--<span class="dropdown-header">SORT BY</span>
              <a class="dropdown-item" href="?sort=id&order=asc">ID ↑</a>
              <a class="dropdown-item" href="?sort=id&order=desc">ID ↓</a>
              <a class="dropdown-item" href="?sort=name&order=asc">Name ↑</a>
              <a class="dropdown-item" href="?sort=name&order=desc">Name ↓</a>
              <a class="dropdown-item" href="?sort=price&order=asc">Price ↑</a>
              <a class="dropdown-item" href="?sort=price&order=desc">Price ↓</a>
              <div class="dropdown-divider"></div>-->

              <span class="dropdown-header">FILTER BY</span>
              <a class="dropdown-item" href="?status=all">All</a>
              <a class="dropdown-item" href="?status=active">Active</a>
              <a class="dropdown-item" href="?status=inactive">Inactive</a>
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="<?= site_url('admin/products/import') ?>">Import Products</a>
              <a class="dropdown-item" href="<?= site_url('admin/products/export') ?>">Export Products</a>
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
                  <input class="form-check-input" type="checkbox" value="name" onclick=fieldCheckClick(this.id) id="col_name" <?= in_array('name',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_name">Name</label>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="price" onclick=fieldCheckClick(this.id) id="col_price" <?= in_array('price',$hide_fields) ? '' : 'checked'; ?>>
                  <label class="form-check-label" for="col_price">Price</label>
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
              <th class="col_price_th <?php echo in_array('price',$hide_fields) ? 'th_hide' : ''; ?>">Price</th>
              <th class="col_created_at_th <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr>
                <td class="col_id_td <?php echo in_array('id',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($product['id']) ?></td>
                <td class="col_name_td <?php echo in_array('name',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($product['name']) ?></td>
                <td class="col_price_td <?php echo in_array('price',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($product['price']) ?></td>
                <td class="col_created_at_td <?php echo in_array('created_at',$hide_fields) ? 'th_hide' : ''; ?>"><?= esc($product['created_at']) ?></td>
                <td>
                  <!--<a href="<?= site_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                  <a href="javascript:void(0);" onclick="confirmDelete(<?= $product['id'] ?>)" class="btn btn-sm btn-dark">Delete</a>-->
                  <div class="dropdown">
                    <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenuButton<?= $product['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton<?= $product['id'] ?>">
                      <?php 
                        if(checkActionInScope('Products','edit')){
                          ?>
                            <a class="dropdown-item" href="<?= site_url('admin/products/edit/' . $product['id']) ?>">
                              <i class="fas fa-edit text-primary"></i> Edit
                            </a>
                          <?php
                        }
                      ?>
                      <?php 
                        if(checkActionInScope('Products','delete')){
                          ?>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(<?= $product['id'] ?>)">
                              <i class="fas fa-trash text-danger"></i> Delete
                            </a>
                          <?php
                        }
                      ?>
                      <?php 
                        if(checkActionInScope('Products','Email Statement')){
                          ?>
                            <a class="dropdown-item" href="<?= site_url('admin/products/emailStatement/' . $product['id']) ?>">
                              <i class="fas fa-envelope text-info"></i> Email Statement
                            </a>
                          <?php
                        }
                      ?>
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
      text: "This product will be permanently deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= site_url('admin/products/delete/') ?>" + id;
      }
    });
  }

  function fieldCheckClick(id){
    var field_id = id.replace("col_", "");
    var baseUrl = "<?= base_url(); ?>";
    if($('#'+id).is(":checked")){
      $.ajax({
        url:baseUrl+'admin/products/fieldShowHide',
        type:"POST",
        data:{field_id:field_id, is_checked:1},
        success:function(response){
          $('.'+id+'_th').removeClass('th_hide');
          $('.'+id+'_td').removeClass('th_hide');
        }
      })
    } else {
      $.ajax({
        url:baseUrl+'admin/products/fieldShowHide',
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