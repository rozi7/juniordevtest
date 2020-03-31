$(document).ready(function() {
    var msgbag_length = $('.msgbag-item').length;
    $('.msgbag-item').each(function(id, el) {
        $(el).delay(10500 + (id * 3750)).hide(500, function() {
            if(id == (msgbag_length-1)) {
                $(el).parents('.msgbag-panel').hide();
            }
        });
    });
});