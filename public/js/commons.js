function createAlertAfter($elem, $html, type) {
    if (!type) {
        type = 'danger'
    }
    var $alert = $('<div class="alert"></div>');
    $alert.addClass('alert-' + type);
    $alert.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>');
    $alert.append($html);
    $alert.addClass('fade in');
    $elem.after($alert);
    setTimeout(function () {
        $alert.alert('close');
    }, 2000)
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateMobile(contact) {
    var l = contact.length;
    if (l < 10 || l > 13) {
        return false
    }
    if (contact[0] != '8' && contact[0] != '9' && contact[0] != '7')
        return false;
    return $.isNumeric(parseInt(contact));

}

function getCityIdFromName(city, all) {
    if (!all) {
        all = 0;
    }
    else {
        all = 1;
    }
    var url = '/api/city?' +
            'all=' + all +
            '&name=' + city,
        id = 0;
    $.ajax({
        url: url,
        async: false,
        success: function (response) {
            if (response.length == 1) {
                id = response[0].id;
            }
        }
    });
    return id;
}

function isCapslock(e) {

    e = (e) ? e : window.event;

    var charCode = false;
    if (e.which) {
        charCode = e.which;
    } else if (e.keyCode) {
        charCode = e.keyCode;
    }

    var shifton = false;
    if (e.shiftKey) {
        shifton = e.shiftKey;
    } else if (e.modifiers) {
        shifton = !!(e.modifiers & 4);
    }

    if (charCode >= 97 && charCode <= 122 && shifton) {
        return true;
    }

    if (charCode >= 65 && charCode <= 90 && !shifton) {
        return true;
    }

    return false;

}

function getCookie(cookieName) {
    var i, x, y, ARRcookies = document.cookie.split(";");

    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == cookieName) {
            return decodeURI(y);
        }
    }
    return '';
}

function setCookie(cookieName, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = encodeURI(value)
        + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString())
        + '; path=/';
    document.cookie = cookieName + "=" + cookieValue;
}

function generateSlug(name) {
    var slug = name.toLowerCase();
    slug = slug.replace(/\./g, '-');
    slug = slug.replace(/ /g, '-');
    return slug;
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function checkIfAdmin() {
    return getCookie('adminCheck') == '1';
}

function changeToStars($elem) {
    if (!$elem) {
        $elem = $('.js-rating');
    }
    $elem.each(function (i, e) {
        var $e = $(e),
            score = $e.attr('data-rating'),
            readOnly = $e.attr('data-readonly'),
            options = {
                score: parseFloat(score),
                starOff: '/img/bs-dot.png',
                starOn: '/img/bs-star.png',
                size: 26
            };
        if (readOnly == "true") {
            options.readOnly = true;
        }

        $e.raty(options);
    })
}

function login(allowGuest) {
    $('.login a').click();
    if (allowGuest) {
        $('#login-modal').find('.guest-login').removeClass('hide');
    } else {
        $('#login-modal').find('.guest-login').addClass('hide');
    }
}