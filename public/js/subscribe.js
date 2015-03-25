$(document).on('click', '#subscribeButton', function (e) {
    e.preventDefault();
    var $this = $(this),
        $html = $this.html();
    if ($this.hasClass('disabled')) {
        return;
    }
    $this.addClass('disabled');
    $this.html('<i class="fa fa-spin fa-spinner"></i> SUBMITTING');
    var data = {
        email: $('#subscribe-email').val(),
        type: 'newsletter'
    };
    if ($('#subscribe-name')[0]) {
        if ($('#subscribe-name').val() == '') {
            createAlertAfter($this, '<strong>Uh oh!</strong> You forgot to write your name', 'danger');
            $this.removeClass('disabled');
            $this.html($html);
            $('#subscribe-name').focus();
            return;
        }
        else {
            data.name = $('#subscribe-name').val();
        }
    }
    if (!validateEmail(data.email)) {
        createAlertAfter($this, '<strong>Uh oh!</strong> It seems you mistyped email', 'danger');
        $this.removeClass('disabled');
        $this.html($html);
        $('#subscribe-email').focus();
        return;
    }
    $.ajax({
        url: '/api/subscribe',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.hasOwnProperty('error')) {
                createAlertAfter($this, '<strong>Uhhh!</strong> Something wrong with our system', 'danger');
                $this.removeClass('disabled');
                $this.html($html);
                $('#subscribe-email').focus();
            }
            else {
                $this.html('<i class="fa fa-check"></i> SUBMITTED');
            }
        },
        error: function (response) {
            createAlertAfter($this, '<strong>Uhhh!</strong> Something wrong with our system', 'danger');
            $this.removeClass('disabled');
            $this.html($html);
            $('#subscribe-email').focus();
        }
    })
});
$(document).on('keydown', '#subscribe-email', function (e) {
    if (e.keyCode == 13) {
        $('#subscribeButton').trigger('click');
    }
});