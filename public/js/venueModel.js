window.__activeRequests = 0;
function __addRequest() {
    $('#save').html('<i class="fa fa-spin fa-spinner"></i> SAVING').addClass('disabled');
    window.__activeRequests++;
}

function __decRequest() {
    window.__activeRequests--;
    if (window.__activeRequests == 0) {
        $('#save').html('<i class="fa fa-check"></i> SAVED');
        setTimeout(function () {
            $('#save').html('SAVE').removeClass('disabled');
        }, 2000)
    }

}

Venue = function (id, name, address, localityId, cityId, rating, lng, lat, operationalTimings, contacts, creditCard, parking, type) {
    this.id = id;
    this.name = name;
    this.address = address;
    this.localityId = localityId;
    this.cityId = cityId;
    this.rating = rating;
    this.longitude = lng;
    this.latitude = lat;
    this.operationalTimings = operationalTimings;
    this.contacts = contacts;
    this.creditCard = creditCard;
    this.parking = parking;
    this.photos = [];
    this.type = type;
    this.towels = 0;
    this.showers = 0;
    this.lockers = 0;
};

Venue.prototype.loadFromPage = function () {
    this.id = $('#id').val();
    this.name = $('#venueName').val();
    this.address = $('#address').val();
    this.localityId = $('.locality-select select').val();
    this.rating = $('#venueRating').find('input[name="score"]').val();
    this.parking = $('#parking').val();
    this.description = $('#description').val();
    this.creditCard = $('#creditCard').val();
    this.cityId = this.getCity();
    this.longitude = this.getLng();
    this.latitude = this.getLat();
    this.contacts = this.getContacts();
    this.operationalTimings = this.getOpTimings();
    this.photos = this.getPhotos();
    this.type = $('.type-select select').val();
    this.towels = $('#towels').is(':checked') ? 1 : 0;
    this.showers = $('#showers').is(':checked') ? 1 : 0;
    this.lockers = $('#lockers').is(':checked') ? 1 : 0;
};

Venue.prototype.getCity = function () {
    if (window.cityId)
        return window.cityId;
    else
        return 1;
};

Venue.prototype.getLng = function () {
    var lng = $('#longitude').val();
    if (!lng) {
        lng = 0;
    }
    return parseFloat(lng).toFixed(7);
};

Venue.prototype.getLat = function () {
    var lat = $('#latitude').val();
    if (!lat) {
        lat = 0;
    }
    return parseFloat(lat).toFixed(7);
};

Venue.prototype.getContacts = function () {
    var $contacts = $('input[name="contact"]');
    var contacts = [];
    for (var i = 0; i < $contacts.length; i++) {
        var $contact = $contacts.eq(i);
        var contact = $contact.val();
        if (contact) {
            contacts.push(contact);
        }
    }
    return contacts;
};

Venue.prototype.getOpTimings = function () {
    var result = {};
    result.from = $('#openFrom').val();
    result.to = $('#openTo').val();
    result.holidays = $('#holidays').val();
    return result;
};

Venue.prototype.getPhotos = function () {
    var originals = $('#venueCarousel').find('.carousel-inner').find('.item:not(.empty)');
    var thumbs = $('.thumbnails').find('.carousel-inner').find('.thumbnail:not(.empty)');
    var photos = [];
    for (var i = 0; i < originals.length; i++) {
        var url = originals.eq(i).attr('data-key');

        var url2 = thumbs.eq(i).find('a').attr('data-key');

        var previewImage = originals.eq(i).find('input[name="previewImage"]').is(':checked');
        var photo = {
            'original': url,
            'thumb': url2,
            previewImage: previewImage
        };

        photos.push(photo);
    }
    return photos;
};

Venue.prototype.getReviews = function () {
    var result = [];
    var $reviews = $('.reviews-block .review');

    for (var i = 0; i < $reviews.length; i++) {
        var $reviewRow = $reviews.eq(i);
        var review = new Review();
        review.loadFromHtml($reviewRow);

        if (review.name && review.remarks) {
            result.push(review);
        }
    }
    return result;
};

Venue.prototype.getMenu = function () {
    var result = [];
    var $items = $('.service-row');

    for (var i = 0; i < $items.length; i++) {
        var menuItem = new MenuItem();
        menuItem.loadFromHtml($items.eq(i));
        menuItem.displayOrder = i + 1;
        if (menuItem.name)
            result.push(menuItem);
    }
    return result;
};

Venue.prototype.save = function () {
    this.saveVenueInfo();
    this.saveReviews();
    this.saveMenu();
};

Venue.prototype.saveVenueInfo = function () {
    var data = {};
    data.name = this.name;
    data.address = this.address;
    data.cityId = this.cityId;
    data.longitude = this.longitude;
    data.latitude = this.latitude;
    data.description = this.description;
    data.operationalTimings = JSON.stringify(this.operationalTimings);
    data.contacts = JSON.stringify(this.contacts);
    data.photos = JSON.stringify(this.photos);
    data.creditCard = this.creditCard;
    data.parking = this.parking;
    data.localityId = this.localityId;
    data.type = this.type;
    data.showers = this.showers;
    data.lockers = this.lockers;
    data.towels = this.towels;

    __addRequest();
    $.ajax({
        url: '/api/venue/' + this.id,
        type: 'PUT',
        data: data,
        success: function (response) {
            if (!response.success)
                alert(response.message)
            __decRequest();
        }
    })
};

Venue.prototype.saveReviews = function () {
    var reviews = this.getReviews();
    for (var i in reviews) {
        var review = reviews[i];
        review.save();
    }
};

Venue.prototype.saveMenu = function () {
    var menuItems = this.getMenu();
    for (var i in menuItems) {
        var menuItem = menuItems[i];
        menuItem.save();
    }
};

Review = function (id, name, remarks, rating, venueId, $elem) {
    if (id) {
        this.id = id;
    } else {
        this.id = 0;
    }
    this.name = name;
    this.remarks = remarks;
    this.rating = rating;
    this.venueId = venueId;
    this.$elem = $elem;
    this.oldVals = {};
};

Review.prototype.loadFromHtml = function ($reviewRow) {
    var id = $reviewRow.attr('data-id');
    var oldVals = {};

    if (id) {
        this.id = id;
    }
    this.name = $.trim($reviewRow.find('input[name="username"]').val());
    this.remarks = $.trim($reviewRow.find('input[name="remarks"]').val());
    this.rating = $reviewRow.find('.js-rating input[name="score"]').val();
    this.venueId = $('#id').val();
    this.$elem = $reviewRow;

    oldVals.name = $.trim($reviewRow.find('input[name="username"]').attr('data-oVal'));
    oldVals.remarks = $.trim($reviewRow.find('input[name="remarks"]').attr('data-oVal'));
    oldVals.rating = $.trim($reviewRow.find('.js-rating').attr('data-rating'));
    this.oldVals = oldVals;

};

Review.prototype.save = function () {
    var method = 'POST',
        data = {};
    data.name = this.name;
    data.remarks = this.remarks;
    data.rating = this.rating;

    if (!this.venueId) {
        return {error: true, message: 'Invalid VenueId'};
    }
    if (this.id) {
        if (!this.isChanged()) {
            return {error: false};
        }
        method = 'PUT';
    }
    __addRequest();
    var $e = this.$elem;
    var r = this;
    $.ajax({
        url: '/api/venue/' + this.venueId + '/selfreview/' + this.id,
        type: method,
        data: data,
        success: function (response) {
            __decRequest();
            $e.attr('data-id', response.data.id);
            if (!r.id) {
                r.mapOldVals($e, response.data);
            }
        }
    });
    return {error: false};

};

Review.prototype.remove = function () {
    __addRequest();
    $.ajax({
        url: '/api/venue/' + this.venueId + '/selfreview/' + this.id,
        async: false,
        type: 'DELETE',
        success: function (response) {
            __decRequest();
        }
    });

    return {error: false};
};

Review.prototype.isChanged = function () {
    return this.name != this.oldVals.name
    || this.remarks != this.oldVals.remarks
    || this.rating != this.oldVals.rating;
};

Review.prototype.mapOldVals = function ($e, data) {
    $e.find('input[name="username"]').attr('data-oVal', data.name);
    $e.find('input[name="remarks"]').attr('data-oVal', data.remarks);
    $e.find('.js-rating').attr('data-rating', data.rating);
};

MenuItem = function (id, name, description, highlights, price, categoryId, displayOrder, visible, $elem) {
    if (id) {
        this.id = id;
    }
    else
        this.id = 0;

    this.name = name;
    this.description = description;
    this.highlights = highlights;
    this.price = price;
    this.categoryId = categoryId;
    this.displayOrder = displayOrder;
    this.visible = visible;
    this.$elem = $elem;
    this.oldVals = {};
};

MenuItem.prototype.loadFromHtml = function ($serviceRow) {
    var id = $serviceRow.attr('data-id');
    var oldVals = {};
    if (id) {
        this.id = id;
    }
    this.name = $.trim($serviceRow.find('input[name="menuItem"]').val());
    this.description = '';
    this.highlights = '';

    var price1 = $serviceRow.find('input[name="menuItemPrice"]').val();
    var price2 = $serviceRow.find('select[name="menuItemPrice"]').val();
    var visible = $serviceRow.find('input[name="visible"]').is(':checked');

    if (visible) {
        this.visible = 1;
        if (price1)
            this.price = parseFloat(price1.replace(',', ''));
        else
            this.price = 0;
    }
    else {
        this.visible = 0;
        this.price = price2;
    }
    this.categoryId = parseInt($serviceRow.find('select[name="menuItemCategory"]').val());
    this.$elem = $serviceRow;

    oldVals.name = $.trim($serviceRow.find('input[name="menuItem"]').attr('data-oVal'));
    oldVals.description = '';
    oldVals.highlights = '';
    oldVals.price = $serviceRow.find('input[name="menuItemPrice"]').attr('data-oVal');
    oldVals.visible = $serviceRow.find('input[name="visible"]').attr('data-oVal');
    oldVals.categoryId = parseInt($serviceRow.find('select[name="menuItemCategory"]').attr('data-oVal'));
    this.oldVals = oldVals;
};

MenuItem.prototype.save = function () {
    var method = 'POST',
        data = {};
    data.name = this.name;
    data.description = this.description;
    data.highlights = this.highlights;
    data.price = this.price;
    data.categoryId = this.categoryId;
    data.displayOrder = this.displayOrder;
    data.visible = this.visible;

    if (this.id) {
        if (!this.isChanged()) {
            return {error: false};
        }
        method = 'PUT';
    }
    __addRequest();
    var $e = this.$elem;
    var mi = this;
    $.ajax({
        url: '/api/menuItem/' + this.id,
        type: method,
        data: data,
        success: function (response) {
            __decRequest();
            $e.attr('data-id', response.data.id);
            if (!mi.id) {
                mi.mapOldVals($e, response.data);
            }
        }
    });

    return {error: false};
};


MenuItem.prototype.remove = function () {
    __addRequest();
    $.ajax({
        url: '/api/menuItem/' + this.id,
        async: false,
        type: 'DELETE',
        success: function (response) {
            __decRequest();
        }
    });

    return {error: false};
};

MenuItem.prototype.isChanged = function () {
    return this.name != this.oldVals.name
    || this.description != this.oldVals.description
    || this.highlights != this.oldVals.highlights
    || this.price != this.oldVals.price
    || this.visible != this.oldVals.visible
    || this.categoryId != this.oldVals.categoryId;
};

MenuItem.prototype.mapOldVals = function ($e, data) {
    $e.find('input[name="menuItem"]').attr('data-oVal', data.name);
    $e.find('input[name="menuItemPrice"]').attr('data-oVal', data.price);
    $e.find('input[name="visible"]').attr('data-oVal', data.visible);
    $e.find('select[name="menuItemCategory"]').attr('data-oVal', data.categoryId);
};