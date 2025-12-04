<?= $this->extend('layouts/admin/master') ?>
<?= $this->section('content') ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View QR</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="/admin/qr_data" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <h2 class="card-title">QR Data</h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <!-- Left: QR details -->
                <div class="col-md-7">
                    <dl class="row">
                        <dt class="col-sm-3">User</dt>
                        <dd class="col-sm-9"><?= $qr_data['user_name']; ?></dd>

                        <dt class="col-sm-3">Qr Link</dt>
                        <dd class="col-sm-9"><?= $qr_data['qr_text']; ?></dd>

                        <dt class="col-sm-3">QR Hash</dt>
                        <dd class="col-sm-9"><?= $qr_data['qr_hash']; ?></dd>

                        <dt class="col-sm-3">Scan Count</dt>
                        <dd class="col-sm-9"><?= $qr_scan_count; ?></dd>

                        <dt class="col-sm-3">Created At</dt>
                        <dd class="col-sm-9"><?= date('d/m/Y', strtotime($qr_data['created_at'])); ?></dd>
                    </dl>
                </div>
                <!-- Right: QR Image -->
                <div class="col-md-5 text-center">
                    <img src="<?= base_url().$qr_data['image_url']; ?>" alt="QR Code" class="img-fluid img-thumbnail" style="max-width: 200px;">
                </div>
            </div>
            <div class="row">
                <table id="gridTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th class="col_id_th">IP Address</th>
                        <th class="col_name_th">User Agent</th>
                        <th class="col_price_th">Platform</th>
                        <th class="col_price_th">Browser</th>
                        <th class="col_price_th">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($qr_scan as $qr_scan_data): ?>
                        <tr>
                            <td class="col_id_td"><?= esc($qr_scan_data['ip_address']) ?></td>
                            <td class="col_name_td"><?= esc($qr_scan_data['user_agent']) ?></td>
                            <td class="col_price_td"><?= esc($qr_scan_data['platform']) ?></td>
                            <td class="col_price_td"><?= esc($qr_scan_data['browser']) ?></td>
                            <td class="col_price_td"><?= esc(date('d/m/Y h:i:s', strtotime($qr_scan_data['created_at']))) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
          <!--<a href="/user/1/edit" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
          </a>-->
          <a href="/admin/qr_data" class="btn btn-secondary">Back</a>
        </div>
      </div>

    </div>
  </section>
<?= $this->endSection() ?>