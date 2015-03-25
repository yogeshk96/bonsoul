/*DOM FUNCTIONS*/
$(document).ready(function () {
    $('.btn-bms').on('click', function () {
        $SAVE_BTN = $(this);
        showSaving();
    });
    $('#info').find('.btn-bms').click(updateInfo);
    $('#pass').find('.btn-bms').click(changePass);
});

/*COMMON FUNCTIONS*/
var $SAVE_BTN = false;

function showSaving() {
    $SAVE_BTN.addClass('disabled');
    var txt = $SAVE_BTN.text();
    $SAVE_BTN.text(txt.replace('Save', 'Saving'));
    $SAVE_BTN.text(txt.replace('Update', 'Updating'));
    $SAVE_BTN.prepend('<i class="fa fa-spin fa-spinner"></i> ');
}
function hideSaving() {
    $SAVE_BTN.removeClass('disabled');
    var txt = $SAVE_BTN.text();
    $SAVE_BTN.text(txt.replace('Saving', 'Save'));
    $SAVE_BTN.text(txt.replace('Updating', 'Update'));
    $SAVE_BTN.find('i').remove();
}

function showSaved() {
    setTimeout(function () {
        $SAVE_BTN.removeClass('disabled');
        var txt = $SAVE_BTN.text();
        $SAVE_BTN.text(txt.replace('Saved', 'Save'));
        $SAVE_BTN.text(txt.replace('Updated', 'Update'));
        $SAVE_BTN.find('i').remove();
    }, 2000);

    var txt = $SAVE_BTN.text();
    $SAVE_BTN.text(txt.replace('Saving', 'Saved'));
    $SAVE_BTN.text(txt.replace('Updating', 'Updated'));
    $SAVE_BTN.find('i').removeClass('fa-spin fa-spinner').addClass('fa-check');
}

function updateInfo() {
    var $form = $('#info');
    var name = $.trim($form.find('#name').val());
    var contact = $.trim($form.find('#contact').val());
    var $alertAnchor = $form.find('.form-group').last();
    if (name.length < 4) {
        createAlertAfter($alertAnchor, 'Please enter your name');
        hideSaving();
        return;
    }
    if (contact.length && !validateMobile(contact)) {
        createAlertAfter($alertAnchor, 'Please enter valid mobile number');
        hideSaving();
        return;
    }
    var data = {
        name: name,
        contact: contact
    };
    updateUser(data, function (response) {
        var data = response.data;
        if (response.success) {
            _trackEditProfile(data.id, data.name, data.email, data.contact);
        }
        updateUserCallback(response);
    });
}

function changePass() {
    var $form = $('#pass');
    var npass = $form.find('#npassword').val();
    var cpass = $form.find('#cpassword').val();
    var $alertAnchor = $form.find('.form-group').last();
    console.log($alertAnchor[0]);
    if (npass.length < 6) {
        createAlertAfter($alertAnchor, 'Password should be of at least 6 characters');
        hideSaving();
        return;
    }
    if (cpass != npass) {
        createAlertAfter($alertAnchor, 'Passwords do not match');
        hideSaving();
        return;
    }

    var data = {
        password: npass
    };
    updateUser(data, function (response) {
        var data = response.data;
        if (response.success) {
            _trackChangePassword(data.id, data.name, data.email);
        }
        updateUserCallback(response);
    });
}


function updateUser(data, callback, error) {
    $.ajax({
        url: '/api/user/' + getCookie('uid'),
        type: 'put',
        data: data,
        success: callback,
        error: error
    });
}

function updateUserCallback(response) {
    if (response.success) {
        showSaved();
    } else {
        hideSaving();
        createAlertAfter($SAVE_BTN.parent(), response.message);
    }
}