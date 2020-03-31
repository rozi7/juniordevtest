$(document).ready(function() {
    
    // moment humanize 'to'
    $('[data-moment-human]').each(function(i, el) {
        var from = $(el).data('from');
        var to = $(el).data('to');
        moment.locale('id');
        var text = moment(from).to(to);
        $(el).html(text.charAt(0).toUpperCase() + text.slice(1));
    });
});