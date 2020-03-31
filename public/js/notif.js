$(document).ready(function() {
    var getNotifTimeout = undefined;
    function getNotif(timeout) {
        if(timeout == undefined) timeout = 3000;
        
        // clear old timeout
        if(getNotifTimeout != undefined) clearTimeout(getNotifTimeout);

        getNotifTimeout = setTimeout(function() {
            $.ajax({
                url: $('#baseurl').val() + 'a/notif',
                success: function(d) {
                    $(d).each(function(key, item) {
                        if(item.value <= 0) $('[data-notif-hide="'+ item.name +'"]').hide();
                        else $('[data-notif-hide="'+ item.name +'"]').show();

                        $('[data-notif="'+ item.name +'"]').html(item.value);
                    });
                    getNotif();
                },
                error: function() {
                    getNotif();
                }
            });
        }, timeout);
    }

    getNotif(0);
});