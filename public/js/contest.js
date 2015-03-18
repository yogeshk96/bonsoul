function hookEnterContest() {
    $('#contestSubmit').on('click', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var inviteLink = getParameterByName('ref');
        var email = $.trim($('#contest-email').val());
        var name = $.trim($('#contest-name').val());
        if (!validateEmail(email)) {
            createAlertAfter($btn, 'Please enter a valid email');
            return;
        }
        if (name.length < 4) {
            createAlertAfter($btn, 'Please enter your full name');
            return;
        }
        var data = {
            name: name,
            email: email
        };
        if (inviteLink) {
            data.inviteLink = inviteLink;
        }
        contestRequest(data, function (response) {
            if(response.success){

            }
        });
    });
}

function contestRequest(data, callback) {
    $.ajax({
        url: '/api/contest',
        type: 'POST',
        data: data,
        success: callback
    });
}