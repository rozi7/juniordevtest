$(document).ready(function() {
    $('.btn-submit-sibling').each(function(index, el) {
        var theform = $(el).siblings('form')[0];
        $(el).on('click', function() {
            theform.submit();
        });
    });
});