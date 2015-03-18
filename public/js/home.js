var localityId = 0;
var currentDropdown = '';
$(document).ready(function () {
    fullBanner();
    resizeVenuePhotos();
    $('.location select').select2({
        minimumResultsForSearch: -1,
        containerCssClass: 'country-select',
        dropdownCssClass: 'country-dropdown'
    });

    $('div.dropdown-mask').on('click', function (e) {
        $('.dropdown').removeClass('show')
        $(this).removeClass('show');
        currentDropdown = '';
    });

    $(document).on('focus', '.select2-focusser', function () {
        $('div.dropdown-mask').trigger('click');
    });

    $('#city').on('change', function () {
        if ($(this).val() == '-1') {
            changeOptionsState(false);

        }
        else {
            changeOptionsState(true);
            var city = $('#city').select2('data').text;
            $('#locality').val('All of ' + city);
            window.localityId = 0;
            window.localitySlug = '';
            window.citySlug = $(this).children('option:selected').attr('data-slug');
        }
    });

    $('#searchTerm').on('focus', function () {
        $('.locality-dropdown').removeClass('show');
        var $this = $(this);
        if ($this.val() && currentDropdown == '') {
            $this.val('');
            searchTerm = '';
        }
        if (currentDropdown != 'subcategory') {
            $this.val('');
            $('.category-dropdown').addClass('show');
            currentDropdown = 'category';
            searchTerm = '';
        }
        $('.venue-dropdown').removeClass('show');
        $('.dropdown-mask').addClass('show');
    });

    $('.fitnessButton').click(function () {
        $('.locality-dropdown').removeClass('show');
        var $this = $(this);
        if ($this.val() && currentDropdown == '') {
            $this.val('');
            searchTerm = '';
        }
        if (currentDropdown != 'subcategory') {
            $this.val('');
            $('.category-dropdownfitness').addClass('show');
            currentDropdown = 'category';
            searchTerm = '';
        }
        $('.venue-dropdown').removeClass('show');
        $('.dropdown-mask').addClass('show');
    });

    $('.salonButton').click(function () {

        $('.locality-dropdown').removeClass('show');
        var $this = $(this);
        if ($this.val() && currentDropdown == '') {
            $this.val('');
            searchTerm = '';
        }
        if (currentDropdown != 'subcategory') {
            $this.val('');
            $('.category-dropdownsalon').addClass('show');
            currentDropdown = 'category';
            searchTerm = '';
        }
        $('.venue-dropdown').removeClass('show');
        $('.dropdown-mask').addClass('show');
        
    });

    $('.spasButton').click(function () {
        $('.locality-dropdown').removeClass('show');
        var $this = $(this);
        if ($this.val() && currentDropdown == '') {
            $this.val('');
            searchTerm = '';
        }
        if (currentDropdown != 'subcategory') {
            $this.val('');
            $('.category-dropdownspa').addClass('show');
            currentDropdown = 'category';
            searchTerm = '';
        }
        $('.venue-dropdown').removeClass('show');
        $('.dropdown-mask').addClass('show');
    });

    $('#locality').on('focus', function () {
        $('.dropdown:not(.locality-dropdown)').removeClass('show');
        var $this = $(this);
        positionDropdownSearch($('.locality-dropdown'), $this);
        if ($this.val() && currentDropdown == '') {
            $this.val('');
            localitySlug = '';
        }
        if (currentDropdown != 'locality') {
            $this.val('');
            localitySlug = '';
        }
        popularLocalities();
        $('.locality-dropdown').addClass('show');
        $('.dropdown-mask').addClass('show');
        currentDropdown = 'locality';
        $this.css({position: 'relative'});
    });

    $('.locality-dropdown').on('click', 'li', function (e) {
        e.preventDefault();
        $('#locality').val($.trim($(this).text())).css({'z-index': 0});
        localitySlug = $(this).attr('data-slug');
        localityId = parseInt($(this).attr('data-id'));
        $('.locality-dropdown').removeClass('show');
        $('.dropdown-mask').removeClass('show');
        currentDropdown = '';
    });
    $('#locality').on('keyup', function (e) {
        var val = $(this).val();
        if (val) {
            if (currentDropdown != 'locality') {
                val = $.trim(String.fromCharCode(e.keyCode));
                $(this).val(val);
            }
            $('.locality-dropdown').addClass('show');
            currentDropdown = 'locality';
            searchLocality(val);
        }
        else {
            popularLocalities();
        }
    });

    $('.dropdown.category-dropdownfitness').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        var $li = $(this);
        var catId = $li.attr('data-id');
        changeSubcategoryOptions(catId);
        positionDropdownSearch($('.subcategory-dropdown'), $('#searchTerm'));
        $('.subcategory-dropdown').addClass('show');
        currentDropdown = 'subcategory';
        searchTerm = $.trim($li.text());
        $('#searchTerm').val(searchTerm + ' > ').focus();
        $('.category-dropdownfitness').removeClass('show');

    });

    $('.dropdown.category-dropdownsalon').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        var $li = $(this);
        var catId = $li.attr('data-id');
        changeSubcategoryOptions(catId);
        positionDropdownSearch($('.subcategory-dropdown'), $('#searchTerm'));
        $('.subcategory-dropdown').addClass('show');
        currentDropdown = 'subcategory';
        searchTerm = $.trim($li.text());
        $('#searchTerm').val(searchTerm + ' > ').focus();
        $('.category-dropdownsalon').removeClass('show');

    });

    $('.dropdown.category-dropdownspa').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        var $li = $(this);
        var catId = $li.attr('data-id');
        changeSubcategoryOptions(catId);
        positionDropdownSearch($('.subcategory-dropdown'), $('#searchTerm'));
        $('.subcategory-dropdown').addClass('show');
        currentDropdown = 'subcategory';
        searchTerm = $.trim($li.text());
        $('#searchTerm').val(searchTerm + ' > ').focus();
        $('.category-dropdownspa').removeClass('show');

    });


    $('.dropdown.category-dropdown').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        var $li = $(this);
        var catId = $li.attr('data-id');
        changeSubcategoryOptions(catId);
        positionDropdownSearch($('.subcategory-dropdown'), $('#searchTerm'));
        $('.subcategory-dropdown').addClass('show');
        currentDropdown = 'subcategory';
        searchTerm = $.trim($li.text());
        $('#searchTerm').val(searchTerm + ' > ').focus();
        $('.category-dropdown').removeClass('show');

    });
    $('.dropdown.subcategory-dropdown').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        var $li = $(this);
        searchTerm = $.trim($li.text());
        var nVal = $('#searchTerm').val() + searchTerm;
        $('#searchTerm').val(nVal);
        $('.subcategory-dropdown').removeClass('show');
        $('.dropdown-mask').removeClass('show');
        currentDropdown = '';
    });

    $('.dropdown.venue-dropdown').on('click', 'li:not(.header)', function (e) {
        e.preventDefault();
        window.location.href = $(this).find('a').attr('href');
    });

    $('#searchTerm').on('keyup', function (e) {
        var val = $(this).val();
        if (currentDropdown != 'venue' && val && e.keyCode == 8) {
            $(this).val('');
            if (currentDropdown == 'subcategory') {
                $('.subcategory-dropdown').removeClass('show');
                $('.category-dropdown').addClass('show');
                currentDropdown = 'category';
            }

            val = '';
            searchTerm = '';
            return;
        }
        if (val && val != '') {
            positionDropdownSearch($('.venue-dropdown'), $('#searchTerm'));
            if (currentDropdown != 'venue') {
                val = $.trim(String.fromCharCode(e.which));
                if (isCapslock(e)) {
                    val = val.toLowerCase();
                }
                $(this).val(val);
                $('.venue-dropdown').addClass('show');
            }
            searchVenue(val);
            $('.category-dropdown').removeClass('show');
            $('.subcategory-dropdown').removeClass('show');
            currentDropdown = 'venue';
        }
        else {
            $('.category-dropdown').addClass('show');
            $('.venue-dropdown').removeClass('show');
            currentDropdown = 'category';
        }
    });

    //GET CURRENT USER LOCATION
    detectCurrentLocation();

    //HOOK UP SHOW MORE BUTTON
    $(document).on('click', '#showMore', function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        var params = extractParameters($this[0].search.substr(1));
        console.log(params);
        $this.html('<i class="fa fa-spin fa-spinner"></i> Loading').addClass('disabled');

        var urlData = {
            city: {
                slug: $('#city').children('option:selected').attr('data-slug'),
                id: $('#city').val()
            },
            locality: {
                slug: localitySlug,
                text: $('#locality').val(),
                id: localityId
            },

            page: params.page,
            searchTerm: searchTerm,
            searchText: $('#searchTerm').val(),
            feedUrl: url
        };

        setUrl(urlData);
        getVenueFeed(url, function (response) {
            $this.remove();
            appendVenues(response);
        }, function () {
            $this.html('Show more').removeClass('disabled');
        });
    });

    //HOOK UP SEARCH BUTTON
    $('#searchButton').click(function (e) {
        e.preventDefault();
        var city = $('#city').select2('data').text;
        var locality = $.trim($('#locality').val());

        $(this).addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Searching');

        $('.vemue-list').html('<div class="text-center"><i class="fa fa-3x fa-spin fa-spinner"></i> Loading...</div>');
        var url = '/feed';

        url += '?searchTerm=' + searchTerm +
            '&cityId=' + $('#city').val();

        if (localityId != 0) {
            url += '&localityId=' + localityId;
        }


        if (l.cityId == $('#city').val()) {
            url += '&lat=' + l.latitude + '&lng=' + l.longitude;
        }

        var urlData = {
            city: {
                slug: $('#city').children('option:selected').attr('data-slug'),
                id: $('#city').val()
            },
            locality: {
                slug: localitySlug,
                text: locality,
                id: localityId
            },

            searchTerm: searchTerm,
            searchText: $('#searchTerm').val(),
            feedUrl: url
        };
        setUrl(urlData);
        getVenueFeed(url, function (response) {
            showVenues(response);
            $('#searchButton').removeClass('disabled').html('SEARCH');
        }, function () {

        });

        //Analytics
        _trackSearch(city, searchTerm, locality);

    });
});
$(window).on('load', function () {
    positionDropdownSearch($('.category-dropdown'), $('#searchTerm'));
});

function detectCurrentLocation() {
    window.l = new UserLocation();
    l.callback = function () {
        if (window.citySlug == '') {
            if (l.cityId > 0) {
                $('#city').select2('val', l.cityId);
                $('#locality').val('All of ' + l.city);
            }
            else {
                $('#city').prepend('<option value="-1">' + l.city + '</option>');
                $('#city').select2('val', -1);
                changeOptionsState(false);
            }
        }
        else if (window.localitySlug == '') {
            $('#locality').val('All of ' + $('#city').select2('data').text);
        }
    };
    l.detect();
}


function positionDropdownSearch($elem, $ref) {
    var l = $ref.position().left;
    var t = $ref.position().top;
    var w = $ref.outerWidth();
    var h = $ref.outerHeight();

    $elem.css({position: 'absolute', left: l, top: t + h, width: w});
}

function changeSubcategoryOptions(selectedId) {
    var $elem = $('.subcategory-dropdown ul');
    var newCategories = categories[selectedId];
    $elem.html('<li class="header">Choose a subcategory</li>');
    for (var i in newCategories) {
        var val = 0;
        if (selectedId == 0) {
            val = newCategories[i].id;
        }
        $elem.append('<li>' + newCategories[i].name + '</li>');
    }
    return true;
}
function changeVenueOptions(venues) {
    var $elem = $('.venue-dropdown ul');
    $elem.html('<li class="header">Choose a venue</li>');
    for (var i in venues) {
        $elem.append('<li><a href="' + venues[i].url + '">' + venues[i].name + '</a></li>');
        if (i == 3)
            break;
    }
}
function changeLocalityOptions(localities, popular) {
    var $elem = $('.locality-dropdown ul');
    var city = $('#city').select2('data').text;
    $elem.html('<li data-id="0" data-slug="">All of ' + city + '</li>');
    if (popular)
        $elem.append('<li class="header">Popular localities</li>');
    for (var i in localities) {
        var slug = localities[i].slug;
        if (!slug) {
            slug = '';
        }
        $elem.append('<li data-id="' + localities[i].id + '" data-slug="' + slug + '">' + localities[i].name + '</li>');
    }
}


function searchVenue(name) {
    if (window.currentRequest) {
        window.currentRequest.abort();
    }
    var cityId = $('#city').val();
    var url = '/api/autocomplete?venue' +
        '&q=' + name +
        '&cityId=' + cityId;
    window.currentRequest = $.ajax({
        url: url,
        success: function (response) {
            changeVenueOptions(response);
        }
    });
}

function searchLocality(name) {
    if (window.currentRequest) {
        window.currentRequest.abort();
    }
    var city = $('#city').val();
    window.currentRequest = $.ajax({
        url: '/api/autocomplete?locality' +
            '&q=' + name +
            '&cityId=' + city,
        success: function (response) {
            changeLocalityOptions(response);
        }
    });
}

function popularLocalities() {
    if (window.currentRequest) {
        window.currentRequest.abort();
    }
    var city = $('#city').val();
    window.currentRequest = $.ajax({
        url: '/api/locality?popular=1&cityId=' + city,
        success: function (response) {
            changeLocalityOptions(response, true);
        }
    })
}

function resizeVenuePhotos() {
    var $e = $('.venue-photo');
    var w = $e.width();
    var h = w / 1.6;
    $e.height(h);
}

function getVenueFeed(url, success, error) {
    $.ajax({
        url: url,
        success: function (response) {
            if (success) {
                success(response);
            }
        },
        error: function (response) {
            if (error) {
                error(response);
            }
        }
    })
}

function showVenues(html) {
    shortBanner();
    if (!html || html == '') {
        $('.venue-list').html('<div class="text-center no-result">We couldn\'t find a place, but we\'ll make a note of this.</div>');
    }
    else
        $('.venue-list').html(html);
    resizeVenuePhotos();
}

function appendVenues(html) {
    $('.venue-list').append(html);
    resizeVenuePhotos();
}

function setUrl(data) {
    var url = '/' + data.city.slug;
    var searchParameters = [];
    if (data.locality.slug) {
        url += '/spas-in-' + data.locality.slug;
    }
    if (data.searchTerm) {
        searchParameters.push('category=' + data.searchTerm);
    }
    if (!data.page) {
        data.page = 0;
    }
    else {
        searchParameters.push('page=' + data.page);
    }

    searchParameters = searchParameters.join('&');
    if (searchParameters.length) {
        url += '?' + searchParameters;
    }

    data.exists = true;

    window.history.pushState(data, 'Venues', url);
}
window.onpopstate = function (e) {
    if (e.state && e.state.exists) {
        var data = e.state;
        localitySlug = data.locality.slug;
        localityId = data.locality.id;
        citySlug = data.city.slug;
        searchTerm = data.searchTerm;

        $('#city').select2('val', data.city.id);

        $('#locality').val(data.locality.text);

        $('#searchTerm').val(data.searchText);
        getVenueFeed(data.feedUrl, showVenues, function () {

        });
    }
};

function extractParameters(string) {
    var params = {};
    string = string.split('&');
    for (var i = 0; i < string.length; i++) {
        var param = string[i].split('=');
        params[param[0]] = param[1];
    }
    return params;
}

function fullBanner(animate) {
    var ph = $(window).height();
    var fh = $('.page-footer').height();
    var b = $('.home-banner');
    b.attr('data-h', b.height());
    if (animate) {
        b.animate({'min-height': ph - fh}, 200, 'linear');
    }
    else
        b.css('min-height', ph - fh);
}

function shortBanner() {
    var b = $('.home-banner');
    var h = b.attr('data-h');
    b.animate({'min-height': 0}, 200, 'linear');
    $('.venue-list').removeClass('hide');
    $('html,body').animate({scrollTop: h});
}

function showNotAvailableMessage() {
    shortBanner();
    $('.venue-list').html('<div class="text-center no-result">We are not present in your city yet, please subscribe and we will notify you as soon as we launch.<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4"><input class="bms-txt-back form-control" type="email" placeholder="E-MAIL" id="subscribe-email"><button class="btn btn-bms" id="subscribeButton">SUBMIT</button><br><br></div></div>').removeClass('hide');
}
function hideNotAvailableMessage() {
    $('.venue-list').html('').addClass('hide');
    fullBanner(true);
}

function changeOptionsState(enabled) {
    var disabled = !enabled;
    $('#searchButton').attr('disabled', disabled);
    $('#searchTerm').attr('disabled', disabled);
    $('#locality').attr('disabled', disabled);
    if (disabled)
        showNotAvailableMessage();
    else
        hideNotAvailableMessage();
}