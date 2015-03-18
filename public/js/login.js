/*DOM FUNCTIONS*/

GUEST_CALLBACK = function () {
};
GUEST_LOGIN = false;
LOGIN_CALLBACK = function () {
};
$(document).ready(function () {
    $('.btn-login').on('click', function () {
        $LOGIN_BTN = $(this);
        showSigningIn();
    });
    $('#signin').find('.btn-login').click(classicLogin);
    $('#signup').find('.btn-login').click(signup);
    $('#forgot-password').find('.btn-login').click(forgotPassword);
    $('.form-toggle-info a').on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.login-form').addClass('hide');
        $(target).removeClass('hide');
    });
    $('.guest-login a').on('click', function (e) {
        e.preventDefault();
        GUEST_LOGIN = true;
        $('#login-modal').modal('hide');
        GUEST_CALLBACK();
    });

    /*RESET PASSWORD HOOK*/
    $('#reset').find('.btn-bms').click(resetPassword);
});

/*COMMON FUNCTIONS*/
var $LOGIN_BTN = false;
function doAuthenticationRequest(data, callback, error) {
    $.ajax({
        url: '/api/authenticate',
        type: 'post',
        data: data,
        success: callback,
        error: error
    });
}

function showSigningIn() {
    $LOGIN_BTN.addClass('disabled');
    var txt = $LOGIN_BTN.find('span').text();
    $LOGIN_BTN.find('span').text(txt.replace('Sign ', 'Signing '));
}
function hideSigningIn() {
    $LOGIN_BTN.removeClass('disabled');
    var txt = $LOGIN_BTN.find('span').text();
    $LOGIN_BTN.find('span').text(txt.replace('Signing ', 'Sign '));
}

function showSignedIn() {
    $LOGIN_BTN.addClass('disabled');
    var txt = $LOGIN_BTN.find('span').text();
    $LOGIN_BTN.find('span').text(txt.replace('Signing ', 'Signed '));
}

function authenticateUser(method, data) {
    if (method == 'fb') {
        fbGetUser(function (data) {
            data.method = 'fb';
            doAuthenticationRequest(data, authenticationCallback, hideSigningIn);
        }, hideSigningIn);
    }
    else if (method == 'google') {
        data.method = 'google';
        doAuthenticationRequest(data, authenticationCallback, hideSigningIn);
    } else {
        doAuthenticationRequest(data, authenticationCallback, hideSigningIn);
    }
}

function authenticationCallback(response) {
    if (response.success) {
        var data = response.data;
        showSignedIn();
        _initMixpanelProfile(response.data.id);
        if (data.newUser) {
            _createMixpanelProfile(data);
            _trackSignedUp(data.id, data.name, data.email, data.method)
        }
        _trackLoggedIn(data.id, data.name, data.email, data.method);
        var redirectUrl = getParameterByName('redirect');
        if (!redirectUrl) {
            redirectUrl = '/';
        }
        $('#login-modal').modal('hide');
        setTimeout(function () {
            renderUserHeader(response.data);
            LOGIN_CALLBACK();
        }, 500);
    } else {
        createAlertAfter($LOGIN_BTN.parent(), 'Invalid email or password');
        hideSigningIn();
    }
}

/*FACEBOOK Login handling*/

//Initiate API
window.fbAsyncInit = function () {
    FB.init({
        appId: FACEBOOK_APP_ID, // App ID
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true  // parse XFBML
    });


    FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
            $('.fb-login').click(function () {
                authenticateUser('fb');
            });
        } else {
            $('.fb-login').click(fbLogin);
        }
    });
};


//FB Login
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            authenticateUser('fb');
        } else {
            hideSigningIn();
        }
    }, {scope: FACEBOOK_SCOPES});
}

//GET FB User Details
function fbGetUser(callback, error) {
    FB.api('/me', function (resp) {
        if (resp.error)
            error(resp.error);
        else {
            var data = {
                name: resp.name,
                email: resp.email,
                id: resp.id,
                method: 'fb'
            };
            callback(data);
        }
    });
}

// Load the SDK Asynchronously
(function (d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));


/*GOOGLE SIGN IN HANDLING*/
//Initialize Google Login
function initGoogleLogin() {
    var parameters = {
        clientid: GOOGLE_CLIENT_ID,
        cookiepolicy: 'single_host_origin',
        scope: GOOGLE_SCOPES,
        callback: 'googleLoginCallback'
    };

    $('.google-login').click(function () {
        gapi.auth.signIn(parameters);
    });
}

function googleLoginCallback(response) {
    if (response.status.signed_in && response.status.method == 'PROMPT') {
        gapi.client.load('plus', 'v1', function () {
            gapi.client.plus.people.get({userId: 'me'}).execute(function (response) {
                var data = {
                    name: response.displayName,
                    id: response.id
                };
                var emails = response.emails;
                for (var i = 0; i < emails.length; i++) {
                    if (emails[i].type == 'account') {
                        data.email = emails[i].value;
                        break;
                    }
                }
                if (data.email && data.id) {
                    authenticateUser('google', data);
                }
            });
        });
    } else {
        hideSigningIn();
    }
}

//Load SDK
(function () {
    var po = document.createElement('script');
    po.type = 'text/javascript';
    po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js?onload=initGoogleLogin';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();

/*CLASSIC SIGN IN*/
function classicLogin() {
    var $form = $('#signin');
    var email = $form.find('#email').val();
    var password = $form.find('#password').val();
    var $alertAnchor = $form.find('.form-group').last();
    if (!validateEmail(email)) {
        createAlertAfter($alertAnchor, 'Please enter a valid email address');
        hideSigningIn();
        return;
    }
    if (password.length == '') {
        createAlertAfter($alertAnchor, 'Please enter your password');
        hideSigningIn();
        return;
    }
    var data = {
        email: email,
        password: password
    };
    authenticateUser(null, data);
}

/*SIGNUP*/
function signup() {
    var $form = $('#signup');
    var name = $.trim($form.find('#name').val());
    var email = $form.find('#email').val();
    var password = $form.find('#password').val();
    var $alertAnchor = $form.find('.form-group').last();
    if (name.length < 4) {
        createAlertAfter($alertAnchor, 'Please enter your name');
        hideSigningIn();
        return;
    }
    if (!validateEmail(email)) {
        createAlertAfter($alertAnchor, 'Please enter a valid email address');
        hideSigningIn();
        return;
    }
    if (password.length == '') {
        createAlertAfter($alertAnchor, 'Please enter your password');
        hideSigningIn();
        return;
    }
    var data = {
        name: name,
        email: email,
        password: password
    };

    $.ajax({
        url: '/api/user',
        data: data,
        type: 'post',
        success: function (response) {
            if (response.success) {
                var rData = response.data;
                showSignedIn();
                _createMixpanelProfile(rData);
                _trackSignedUp(rData.id, rData.name, rData.email, 'Classic');
                authenticateUser(null, data);
            } else {
                createAlertAfter($alertAnchor, response.message);
                hideSigningIn();
            }
        }
    })
}

function renderUserHeader(user) {
    var html = '<li class="dropdown">' +
        '<a data-toggle="dropdown" class="dropdown-toggle clickable">' +
        'Hi ' + user.name.split(' ')[0] +
        '<b class="caret"></b>' +
        '</a>' +
        '<ul class="dropdown-menu">' +
        '<li><a href="/profile">Edit Profile</a></li>' +
        '<li><a href="/logout" class="logout" onclick="_trackLoggedOut()">Logout</a></li>' +
        '</ul>' +
        '</li>';
    var $list = $('#main-menu').children('ul');
    var $login = $list.find('.login');
    if ($login.length) {
        $login.remove();
        $list.append(html);
    }
}

/*FORGOT PASSWORD*/
function forgotPassword() {
    var $form = $('#forgot-password');
    var $alertAnchor = $form.find('.form-group').last();
    var $btn = $form.find('.btn-login');
    $btn.addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Submitting');
    var data = {
        email: $.trim($form.find('#email').val())
    };
    if (!validateEmail(data.email)) {
        createAlertAfter($alertAnchor, 'Please enter a valid email address');
        $btn.removeClass('disabled').html('Submit');
        return;
    }
    $.ajax({
        url: '/api/forgot_password',
        type: 'POST',
        data: data,
        success: function (response) {
            if (response.success) {
                _trackForgotPassword(data.email);
                createAlertAfter($alertAnchor, 'An E-Mail has been sent to you', 'success');
                $btn.html('<i class="fa fa-check"></i> Submited');
            } else {
                createAlertAfter($alertAnchor, 'E-Mail is not in use');
                $btn.removeClass('disabled').html('Submit');
            }
        }
    })
}


/*RESET PASSWORD*/
function resetPassword() {
    var $form = $('#reset');
    var $btn = $form.find('.btn-bms');
    var $alertAnchor = $form.find('.form-group').last();
    $btn.addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Submitting');
    var data = {
        key: $form.find('#key').val(),
        password: $form.find('#npassword').val(),
        cpassword: $form.find('#cpassword').val()
    };
    if (data.password.length < 6) {
        createAlertAfter($alertAnchor, 'Password should be of at least 6 characters');
        $btn.removeClass('disabled').html('Submit');
        return;
    }
    if (data.password != data.cpassword) {
        createAlertAfter($alertAnchor, 'Passwords do not match');
        $btn.removeClass('disabled').html('Submit');
        return;
    }
    $.ajax({
        url: '/api/forgot_password',
        data: data,
        type: 'PUT',
        success: function (response) {
            if (response.success) {
                _trackPasswordReset(data.key);
                createAlertAfter($alertAnchor, 'Your Password has been reset', 'success');
                $btn.html('<i class="fa fa-check"></i> Submited');
            } else {
                createAlertAfter($alertAnchor, 'You are not authorised to reset password');
                $btn.removeClass('disabled').html('Submit');
            }
        }
    });
}