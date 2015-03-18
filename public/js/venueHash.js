$(document).ready(function () {
    $('#newVenueSubmit').on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
            btnHtml = $this.html(),
            data;

        $this.addClass('disabled');
        $this.html('<i class="fa fa-spin fa-spinner"></i> SUBMITTING');

        data = {
            name: $.trim($('#name').val()),
            email: $('#email').val(),
            contactPerson: $.trim($('#person').val()),
            contact: $.trim($('#contact').val())
        };
        if (validateVenueSubmission(data, $this, btnHtml)) {
            submitVenueRequest(
                data,
                function (response) {
                    if (!response.success) {
                        createAlertAfter($this, response.message, 'danger small');
                        $this.removeClass('disabled');
                        $this.html(btnHtml);
                    }
                    else {
                        $this.html('<i class="fa fa-check"></i> SUBMITTED');
                        createAlertAfter($this, '<strong>Voila!</strong> We\'ll contact you soon. Thank you!', 'success small');
                    }
                },
                function (response) {
                    createAlertAfter($this, '<strong>Uhhh!</strong> Something wrong with our system', 'danger small');
                    $this.removeClass('disabled');
                    $this.html(btnHtml);
                }
            );
        }
    });
});

function validateVenueSubmission(data, $btn, btnHtml) {
    if (data.name == '') {
        createAlertAfter($btn, '<strong>Uh oh!</strong> You forgot to write venue\'s name', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#name').focus();
        return false;
    }

    if (data.contactPerson == '') {
        createAlertAfter($btn, '<strong>Uh oh!</strong> You forgot to write contact person\'s name', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#person').focus();
        return false;
    }

    if (!validateEmail(data.email)) {
        createAlertAfter($btn, '<strong>Uh oh!</strong> It seems you mistyped email', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#email').focus();
        return false;
    }

    if (data.contact == '') {
        createAlertAfter($btn, '<strong>Uh oh!</strong> You forgot to write contact number', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#contact').focus();
        return false;
    }

    if (!$('#tnc').is(':checked')) {
        createAlertAfter($btn, 'Please read and accept the terms and conditions', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        return false;
    }
    return true;
}

function submitVenueRequest(data, success, error) {
    $.ajax({
        url: '/api/venuehash/',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: success,
        error: error
    });
}