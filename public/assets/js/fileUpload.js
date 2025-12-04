function openMediaPicker(callback) {
  $('#mediaPickerModal').modal('show');

  // Load existing media
  fetch('json')
    .then(res => res.json())
    .then(data => {
         console.log('--------------------------1');
      const grid = document.getElementById('mediaGrid');
      grid.innerHTML = '';

      data.forEach(image => {
        const col = document.createElement('div');
        col.className = 'col-sm-2 mb-3';
        col.innerHTML = `
          <div class="card image-item" style="cursor:pointer" data-url="${image.file_path}">
            <img src="${baseUrl + image.file_path}" class="card-img-top" />
          </div>
        `;
        grid.appendChild(col);
      });
      document.getElementById('mediaGrid').innerHTML(grid);
      document.querySelectorAll('.image-item').forEach(item => {
        item.addEventListener('click', function () {
          const selectedUrl = this.dataset.url;
          callback(selectedUrl); // Return to the form
          $('#mediaPickerModal').modal('hide');
        });
      });
    });
}

// Handle upload
document.getElementById('uploadForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  fetch("<?= site_url('admin/uploadAjax') ?>", {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("Image uploaded!");
      openMediaPicker(window.lastMediaCallback); // Reload picker
    } else {
      alert("Upload failed");
    }
  });
});
