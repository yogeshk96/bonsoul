function getCityData($city) {
    var data = {};
    data.id = $.trim($city.find('input[name="id"]').val());
    data.name = $.trim($city.find('input[name="name"]').val());
    data.slug = $.trim($city.find('input[name="slug"]').val());
    data.public = ($city.find('[name="public"]').is(':checked')) ? 1 : 0;
    data.stateId = 1;
    return data;
}

$(document).on('ready', function () {

});

$(document).on('click', '.btn.editCity', function (e) {
    e.preventDefault();
    var $this = $(this),
        $city = $this.parents('tr');
    if (!$this.hasClass('saveCity')) {
        $city.find('input').removeAttr('readonly').removeClass('bs-plain');
        $this.addClass('saveCity').html('Save');
        $city.find('.deleteCity').addClass('cancel').html('Cancel');
    }
    else {
        if (confirm("Sure, you want to save changes?"))
            updateCity($city);
    }
});
$(document).on('click', '.btn.deleteCity', function (e) {
    e.preventDefault();
    var $this = $(this),
        $city = $this.parents('tr');
    if ($this.hasClass('cancel')) {
        $city.find('input').attr('readonly', 'readonly').addClass('bs-plain');
        $this.removeClass('cancel').html('Delete');
        $city.find('.editCity').removeClass('saveCity').html('Edit');
    }
    else {
        if (confirm("Sure, you want to mark this entry for delete?")) {
            deleteCity($city);
        }
    }
});
$(document).on('click', '#addCity', function (e) {
    e.preventDefault();
    var name = $.trim($('#city').val());
    if (!name || name == "") {
        return;
    }
    var slug = generateSlug(name);
    $(this).addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Saving');
    addCity({name: name, slug: slug, stateId:1});
});

function updateCity($city) {
    $city.find('.btn').addClass('disabled');
    var data = getCityData($city);
    $.ajax({
        url: '/api/city/' + data.id,
        data: data,
        type: 'PUT',
        success: function (response) {
            if (response.success) {
                updateCityHtml($city, response.data);
            }
            else {
                alert(response.message);
            }
            $city.find('.btn').removeClass('disabled');
            $city.find('.btn.cancel').click();
        }
    })
}

function deleteCity($city) {
    $city.find('.btn').addClass('disabled');
    var data = getCityData($city);
    $.ajax({
        url: '/api/city/' + data.id,
        data: data,
        type: 'DELETE',
        success: function (response) {
            if (response.success) {
                $city.remove();
            }
            else {
                alert(response.message);
            }
        }
    })
}

function addCity(data) {
    console.log(data);
    data.stateId = 1;
    $.ajax({
        url: '/api/city/0',
        data: data,
        type: 'POST',
        success: function (response) {
            if (response.success) {
                var $newCity = $('table tr:last-child').clone();
                $newCity = updateCityHtml($newCity, response.data);
                $('table').append($newCity);
                $('#addCity').removeClass('disabled').html('Add');
                $('#city').val('');
                window.location.reload();
            }
            else {
                alert(response.message);
                $('#addCity').removeClass('disabled').html('Add');
            }
        }
    })
}

function updateCityHtml($city, data) {
    console.log(data);
    $city.find('input[name="id"]').val(data.id);
    $city.find('input[name="name"]').val(data.name);
    $city.find('input[name="slug"]').val(data.slug);
    if (data.public)
        $city.find('[name="public"]').attr('checked', true);
    else
        $city.find('[name="public"]').attr('checked', false);
    return $city;
}