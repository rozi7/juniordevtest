$(document).ready(function() {
    // registrasi
    $('#tolak').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idreg = button.data('idRegistrasi');
        var modal = $(this);
        modal.find('#id_tolak').val(idreg);
    });

    // registrasi & pendirian
    $('#detail_gagal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var alasan = button.siblings('.alasan-ditolak').html();
        var modal = $(this);
        modal.find('#alasan_ditolak').html(alasan);
    });

    // pendirian
    $('#detail_active').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var detail = button.siblings('.detail-active-content').html();
        var modal = $(this);
        modal.find('.modal-body').html(detail);
    }); 

    // pendirian
    $('#tolak').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#id_tolak').val(id);
    });

    // modalPdfDetail
    $('#modalPdfDetail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var file = button.data('file');
        var namaCabang = button.data('namaCabang');
        var modal = $(this);

        modal.find('#namaCabang').html(namaCabang);
        modal.find('#pdf-object').attr('data', file);
    });

    // modal konfirmasi hapus
    $('#confirm_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var url = button.data('url');
        var modal = $(this);

        modal.find('#confirmed_delete').attr('url', url);
        modal.find('#confirmed_delete').data('url', url);
    });
    $('#confirmed_delete').on('click', function(e) {
        var url = $(this).data('url');
        window.location.replace(url);
    });
});