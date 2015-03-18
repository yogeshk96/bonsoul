$(document).ready(function () {
    //Initialize Image Uploader
    initializeImageuploader();

    //Initialize Ratings
    changeToStars();

    //Initialize TimePickers
    $('#openFrom').datetimepicker({pickDate: false});
    $('#openTo').datetimepicker({pickDate: false});

    //Initialize Address Scripts
    //Initialize Address AutoComplete
    initializeAddressAutocomplete();
    $('#address').on('change', function (e) {
        detectVenueLatLng($(this).val());
    });

    //Initialize automatic blank row insertion
    initializeAddingEmptyRows();

    //Handle Deletes
    //DELETE MENU ITEM
    $(document).on('click', '.service-row > .delete', function (e) {
        e.preventDefault();
        var $serviceElem = $(this).parents('.service-row');
        deleteMenuItem($serviceElem)
    });
    //DELETE REVIEW
    $(document).on('click', '.review > .delete', function (e) {
        e.preventDefault();
        var $reviewElem = $(this).parents('.review');
        deleteReview($reviewElem)
    });
    //DELETE PHOTO
    $(document).on('click', '#venueCarousel .delete', function (e) {
        e.preventDefault();
        var $holder = $(this).parents('.item');
        var i = $holder.prevAll().length;
        $holder.addClass('empty imgUHolder').css('background-image', '');
        $holder.html('<span class="imgU">DRAG IMAGE(S) HERE OR CLICK BELOW</span>');
        imgUploader.createDragDropPane($holder);
        var $thumb = $('.thumbnails .thumbnail').eq(i);
        console.log($thumb.children('a'));
        $thumb.addClass('empty imgUHolder');
        $thumb.children('a').css('background-image', '').addClass('imgU').html('<span>ADD IMAGE</span>');
        imgUploader.createButton($('.thumbnail.empty'));
    });

    //SHOW PRICE TOGGLE
    $(document).on('change', 'input[name="visible"]', function (e) {
        var $this = $(this),
            checked = $this.is(':checked'),
            $row = $this.parents('.service-row');

        if (checked) {
            $row.find('input[name="menuItemPrice"]').removeClass('hide');
            $row.find('select[name="menuItemPrice"]').addClass('hide');
        }
        else {
            $row.find('input[name="menuItemPrice"]').addClass('hide');
            $row.find('select[name="menuItemPrice"]').removeClass('hide');
        }
    });

    //HOOK UP SAVE BUTTON
    $('#save').on('click', function (e) {
        e.preventDefault();
        var v = new Venue();
        v.loadFromPage();
        v.save();
    });

    //HANDLE GYM OPTION TOGGLE
    handleGymToggle();
});


function initializeImageuploader() {
    window.imgUploader = new ImageUploader();
    imgUploader.setFilepickerKey(FILEPICKER_KEY);
    $('#venueCarousel').find('.empty').each(function (i, e) {
        imgUploader.createDragDropPane(e);
    });
    imgUploader.createButton($('.thumbnail.empty'));
}

function initializeAddressAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        window.skipDetect = true;
        var place = autocomplete.getPlace();
        var lng = place.geometry.location.lng();
        var lat = place.geometry.location.lat();
        var components = place.address_components;
        $('#longitude').val(lng);
        $('#latitude').val(lat);
        setTimeout(function () {
            $('#address').val(place.formatted_address);
        }, 50);
        initializeMap(lat, lng, '#venueMap .map_canvas');
        for (i in components) {
            if (components[i].types.indexOf('locality') != -1) {
                var newCityId = getCityIdFromName(components[i].long_name, true);
                if (newCityId != window.cityId) {
                    window.cityId = newCityId;
                    changeLocalityList(newCityId);
                }
                break;
            }
        }
    });
}

function detectVenueLatLng(address) {
    var geocoder = new google.maps.Geocoder();
    if (!window.skipDetect)
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();
                var components = results[0].address_components;
                $('#longitude').val(lng);
                $('#latitude').val(lat);
                initializeMap(lat, lng, '#venueMap .map_canvas');
                for (i in components) {
                    if (components[i].types.indexOf('locality') != -1) {
                        var newCityId = getCityIdFromName(components[i].long_name, true);
                        if (newCityId != window.cityId) {
                            window.cityId = newCityId;
                            changeLocalityList(newCityId);
                        }
                        break;
                    }
                }
            }
        });
    window.skipDetect = false;
}


//FUNCTIONS TO ADD BLANK ELEMENTS
function initializeAddingEmptyRows() {
    //ADD NEW CONTACT ROW
    $('.contacts').on('keyup', 'input[name="contact"]:last-child', function (e) {
        var val = $.trim($(this).val());
        if (val.length != 0) {
            addContactRow();
        }
    });

    //ADD NEW REVIEW ROW
    $('.reviews-section').on('keyup', '.review:last-child input[name="username"]', function (e) {
        var val = $.trim($(this).val());

        if (val.length != 0) {
            addReviewRow();
        }
    });

    //ADD NEW MENU ROW
    $('.service-list').on('keyup', '.service-row:last-child input[name="menuItem"]', function (e) {
        var val = $.trim($(this).val());

        if (val.length != 0) {
            addMenuRow($(this).parents('.service-list'));
        }
    });
}
function addContactRow() {
    var $html = $('input[name="contact"]:last-child').clone(true);
    $html.val('');
    $('.contacts').append($html);
}
function addReviewRow() {
    var $html = $('.review:last-child').clone(true);
    $html.find('input').val('');
    changeToStars($html.find('.js-rating'));
    $('.reviews-block').append($html);
}
function addMenuRow($list) {
    if (!$list) {
        $list = $('.service-list');
    }
    var $html = $list.find('.service-row:last-child').clone(true);
    $html.find('input').val('');
    $list.append($html);
}


//Functions for DELETES
function deleteMenuItem($element) {
    var menuItem = new MenuItem();
    menuItem.loadFromHtml($element);
    if (menuItem.name == "") {
        return;
    }
    if (menuItem.id) {
        if (confirm('Are you sure you want to delete this item?'))
            menuItem.remove();
        else
            return;
    }
    $element.remove();
}
function deleteReview($element) {
    var review = new Review();
    review.loadFromHtml($element);
    if (review.name == "") {
        return;
    }
    if (review.id) {
        if (confirm('Are you sure you want to delete this item?'))
            review.remove();
        else
            return;
    }
    $element.remove();
}


function changeLocalityList(cityId) {
    $.ajax({
        url: '/api/locality',
        data: {cityId: cityId},
        success: function (data) {
            var $select = $('.locality-select select');
            $select.html('');
            for (var i in data) {
                $select.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
        }
    });
}

function handleGymToggle() {
    $('.type-select select').on('change', function () {
        var $e = $(this);
        var type = $e.val();
        if (type == 'gym') {
            $('.facility.gym').removeClass('hide');
            $('.facility.no-gym').addClass('hide');
        } else {
            $('.facility.gym').addClass('hide');
            $('.facility.no-gym').removeClass('hide');
        }
    });
}