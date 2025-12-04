function generateQr() {
    var qr_text = $('#qr_text').val();
    var base_url = document.body.dataset.baseUrl;
    $.ajax({
        url:base_url+'getQr',
        type:"POST",
        data:{qr_text:qr_text},
        success:function(response){
          $('#qr_image').attr('src', response);
        }
      })
}