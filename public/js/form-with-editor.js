$(document).ready(function() {
    $('form.with-editor').on('submit', function(e) {
        var editor = $(this).find('.editor-wrapper');
        var target = editor.data('target');
        var thehtml = editor.html();
        
        $(this).find(target).val(thehtml);
    });
});