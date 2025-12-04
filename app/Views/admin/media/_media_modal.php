<div class="modal fade" id="mediaPickerModal" tabindex="-1" role="dialog" aria-labelledby="mediaPickerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select or Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- Upload Form -->
        <form id="uploadForm" enctype="multipart/form-data">
          <div class="form-row align-items-center">
            <div class="col">
              <input type="file" name="image" id="mediaUploadInput" class="form-control" required>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </form>

        <hr>

        <!-- Image Grid -->
        <div id="mediaGrid" class="row mt-3"></div>

      </div>
    </div>
  </div>
</div>
