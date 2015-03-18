function getHashData($hash) {
    var data = {};
    data.id = $.trim($hash.attr('id'));
    data.name = $.trim($hash.find('.hash-name').text());
    data.email = $.trim($hash.find('.hash-email').text());
    data.contactPerson = $.trim($hash.find('.hash-contact-person').text());
    data.contact = $.trim($hash.find('.hash-contact').text());
    data.hash = $.trim($hash.find('.hash-hash').text());
    data.venueId = $.trim($hash.attr('data-venueId'));
    if (data.venueId == "") {
        delete data.venueId;
    }
    return data;
}
$(document).on('click', '.btn.generateHash', function (e) {
    e.preventDefault();
    var $this = $(this),
        $hash = $this.parents('.hash'),
        data = getHashData($hash);
    data.newHash = 1;
    if (confirm("Sure, you want to generate new Hash for this entry?"))
        updateHash(data, $hash);
});
$(document).on('click', '.btn.deleteHash', function (e) {
    e.preventDefault();
    var $this = $(this),
        $hash = $this.parents('.hash'),
        data = getHashData($hash);
    data.deleted = 1;
    if (confirm("Sure, you want to mark this entry for delete?")) {
        updateHash(data, $hash);
    }
});
$(document).on('click', '.btn.notify', function (e) {
    e.preventDefault();
    var $this = $(this),
        $hash = $this.parents('.hash'),
        data = getHashData($hash);
    data.notifyUser = 1;
    if (confirm("Sure, you want to send email to the user?"))
        notifyUser(data, $hash);
});

function updateHash(data, $hash) {
    $hash.find('.btn').addClass('disabled');
    $.ajax({
        url: '/api/venuehash/' + data.id,
        data: data,
        type: 'PUT',
        success: function (response) {
            if (response.success) {
                updateHashValues($hash, response.data);
                if (response.data.deleted == 1)
                    $hash.remove();

            }
            else {
                alert(response.message);
            }
            $hash.find('.btn').removeClass('disabled');
        }
    })
}

function updateHashValues($hash, data) {
    console.log(data);
    $hash.find('.hash-hash a').html(data.hash).attr('href', '/venue/edit/' + data.hash);
    $hash.find('.hash-contact').html(data.contact);
    $hash.find('.hash-email').html(data.email);
    $hash.find('.hash-contact-person').html(data.contactPerson);
    if (data.venueId) {
        $hash.attr('data-venueId',data.venueId);
        $hash.find('.hash-name').html('<a href="/venue/' + data.venueId + '" target="_blank">' + data.name + '</a>');
    } else {
        $hash.find('.hash-name').text(data.name);
    }
}

function updateVenueValues($hash, data) {
    $hash.find('.hash-name').html('<a href="/venue/' + data.id + '" target="_blank">' + data.name + '</a>');
    var $check = $hash.find('.hash-public input');
    if (data.public)
        $check.prop('checked', true);
    else
        $check.prop('checked', false);

}

function loadFromVenues() {
    $('.hash').each(function (i, e) {
        var $hash = $(e);
        var venueId = $hash.attr('data-venueId');
        if (venueId != '') {
            var $h = $hash;
            $.ajax({
                url: '/api/venue/' + venueId,
                success: function (response) {
                    if (response.id) {
                        updateVenueValues($h, response);
                    }
                }
            })
        }
    });
}
function updateVenue($hash) {
    var data = {};
    data.id = $hash.attr('data-venueId');
    data.public = $hash.find('.hash-public input').is(':checked') ? 1 : 0;
    if (data.id != '') {
        updateHash(getHashData($hash), $hash);
        $.ajax({
            url: '/api/venue/' + data.id,
            type: 'PUT',
            data: data,
            success: function (response) {
                if (!response.success) {
                    alert(data.id + '-' + response.message);
                }
            }
        })
    }
}

function notifyUser(data, $hash) {
    updateHash(data, $hash);
    $hash.find('.btn').removeClass('disabled');
}
$(document).on('change', 'input[name="public"]', function (e) {
    e.preventDefault();
    var $hash = $(this).parents('.hash');
    updateVenue($hash);
});
$(document).ready(function (e) {
    loadFromVenues();
});