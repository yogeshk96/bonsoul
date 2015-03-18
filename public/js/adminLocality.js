function getLocalityData($locality) {
    var data = {};
    data.id = $.trim($locality.find('input[name="id"]').val());
    data.name = $.trim($locality.find('input[name="name"]').val());
    data.lat = $.trim($locality.find('input[name="lat"]').val());
    data.lng = $.trim($locality.find('input[name="lng"]').val());
    data.slug = $.trim($locality.find('input[name="slug"]').val());
    data.popular = ($locality.find('[name="popular"]').is(':checked')) ? 1 : 0;
    data.cityId = window.cityId;
    return data;
}

$(document).on('ready', function () {
    var autocomplete = new google.maps.places.Autocomplete($("#locality")[0], {types: ['geocode']});
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        var lng = place.geometry.location.lng();
        var lat = place.geometry.location.lat();
        var components = place.address_components;
        for (i in components) {
            if (components[i].types.indexOf('sublocality') != -1) {
                $('#locality').attr('data-lat', lat);
                $('#locality').attr('data-lng', lng);
                $('#locality').attr('data-name', components[i].long_name);
                $('#locality').attr('data-slug', generateSlug(components[i].short_name));
            }
        }
    });
});

$(document).on('click', '.btn.editLocality', function (e) {
    e.preventDefault();
    var $this = $(this),
        $locality = $this.parents('tr');
    if (!$this.hasClass('saveLocality')) {
        $locality.find('input').removeAttr('readonly').removeClass('bs-plain');
        $this.addClass('saveLocality').html('Save');
        $locality.find('.deleteLocality').addClass('cancel').html('Cancel');
    }
    else {
        if (confirm("Sure, you want to save changes?"))
            updateLocality($locality);
    }
});
$(document).on('click', '.btn.deleteLocality', function (e) {
    e.preventDefault();
    var $this = $(this),
        $locality = $this.parents('tr');
    if ($this.hasClass('cancel')) {
        $locality.find('input').attr('readonly', 'readonly').addClass('bs-plain');
        $this.removeClass('cancel').html('Delete');
        $locality.find('.editLocality').removeClass('saveLocality').html('Edit');
    }
    else {
        if (confirm("Sure, you want to mark this entry for delete?")) {
            deleteLocality($locality);
        }
    }
});
$(document).on('click', '#addLocality', function (e) {
    e.preventDefault();
    var name = $.trim($('#locality').attr('data-name'));
    var lat = $.trim($('#locality').attr('data-lat'));
    var lng = $.trim($('#locality').attr('data-lng'));
    var slug = $.trim($('#locality').attr('data-slug'));
    if (!name || name == "") {
        return;
    }
    $(this).addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Saving');
    addLocality({name: name, lat: lat, lng: lng, slug: slug});
    $('#locality').removeAttr('data-name');
    $('#locality').removeAttr('data-lat');
    $('#locality').removeAttr('data-lng');
    $('#locality').removeAttr('data-slug');
    $('#locality').val('');
});

function updateLocality($locality) {
    $locality.find('.btn').addClass('disabled');
    var data = getLocalityData($locality);
    $.ajax({
        url: '/api/locality/' + data.id,
        data: data,
        type: 'PUT',
        success: function (response) {
            if (response.success) {
                updateLocalityHtml($locality, response.data);
            }
            else {
                alert(response.message);
            }
            $locality.find('.btn').removeClass('disabled');
            $locality.find('.btn.cancel').click();
        }
    })
}

function deleteLocality($locality) {
    $locality.find('.btn').addClass('disabled');
    var data = getLocalityData($locality);
    $.ajax({
        url: '/api/locality/' + data.id,
        data: data,
        type: 'DELETE',
        success: function (response) {
            if (response.success) {
                $locality.remove();
            }
            else {
                alert(response.message);
            }
        }
    })
}

function addLocality(data) {
    console.log(data);
    data.cityId = window.cityId;
    $.ajax({
        url: '/api/locality/0',
        data: data,
        type: 'POST',
        success: function (response) {
            if (response.success) {
                var $newLocality = $('table tr:last-child').clone();
                $newLocality = updateLocalityHtml($newLocality, response.data);
                if ($newLocality.find('input').length) {
                    $('table').append($newLocality);
                    $('#addLocality').removeClass('disabled').html('Add');
                }
                else {
                    window.location.reload();
                }
            }
            else {
                alert(response.message);
                $('#addLocality').removeClass('disabled').html('Add');
            }
        }
    })
}

function updateLocalityHtml($locality, data) {
    console.log(data);
    $locality.find('input[name="id"]').val(data.id);
    $locality.find('input[name="name"]').val(data.name);
    $locality.find('input[name="lat"]').val(data.lat);
    $locality.find('input[name="lng"]').val(data.lng);
    $locality.find('input[name="slug"]').val(data.slug);
    if (data.popular)
        $locality.find('[name="popular"]').attr('checked', true);
    else
        $locality.find('[name="popular"]').attr('checked', false);
    return $locality;
}

function generateSlug(name) {
    var slug = name.toLowerCase();
    slug = slug.replace(/\./g, '-');
    slug = slug.replace(/ /g, '-');
    return slug;
}