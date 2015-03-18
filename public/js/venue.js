//Analytics
var venueName = $.trim($('.venue-name').text());
$(document).ready(function () {
    //Initialize Tabs [Photos | Map]
    $('.venue-details .bs-pills a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    //Initialize Map
    initializeMap($('#latitude').val(), $('#longitude').val(), '#venueMap .map_canvas');


    //Initialize Carousel
    initializeCarousel();
    arrangeThumbnails();
    $(window).on('resize', arrangeThumbnails);

    //Initialize Menu Category Switches
    initializeMenuCategorySwitches();
    readHashAndAct();

    //Handle Address Toggle
    $('.toggleAddress').on('click', function (e) {
        e.preventDefault();
        var $longAddress = $('#address').toggleClass('long').find('.long-address');
        $longAddress.toggleClass('hidden');
        if ($longAddress.hasClass('hidden')) {
            $(this).text('Show more');
        }
        else {
            $(this).text('Show less');
        }
    });

    //Handle Add Appointment Button
    $('.addTreatment').on('click', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var data = {};
        data.itemId = $btn.parents('.menu-item').attr('data-id');
        data.venueId = $('#vid').val();
        if ($btn.hasClass('disabled')) {
            removeTreatmentFromSession(data, function (response) {
                if (response.success) {
                    $btn.removeClass('disabled');
                }
            });
        } else {
            addTreatmentToSession(data, function (response) {
                if (response.success) {
                    $btn.addClass('disabled');
                }
            });
        }
    });

    hookReviewSubmit();
    changeToStars($('.write-review .js-rating'));

    //Login Popup on book appointment
    $('#appointmentButton').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (!getCookie('uid')) {
            LOGIN_CALLBACK = GUEST_CALLBACK = function () {
                window.location.href = url;
            };
            login(true);
            return;
        }
        window.location.href = url;
    });

    //Init Facility Value Toggle
    initFacilityToggle();
    $('.toggle-contact').on('click', function (e) {
        _trackShowVenueContact(venueName, $('#vid').val());
    });
});


function initializeCarousel() {
    var $thumbCarousel = $('.thumbnails.carousel');
    var $venueCarousel = $('#venueCarousel');
    $thumbCarousel.carousel({interval: false});
    $venueCarousel.carousel({interval: false});
    $thumbCarousel.on('click', '.thumbnail a', function (e) {
        e.preventDefault();
        var $this = $(this),
            slideNumber = $this.attr('data-slide-to');
        $this.parent('.thumbnail').siblings('.selected').removeClass('selected');
        $this.addClass('selected');
        $venueCarousel.carousel(parseInt(slideNumber));
    });
}
function readHashAndAct() {
    var h = window.location.hash;
    if (h == '' || h.length == 1) {
        return;
    }
    h = h.substr(1);
    $('#-1').find('a').each(function (i, e) {
        if ($(e).text().toLowerCase() == h.toLocaleLowerCase()) {
            $(e).trigger('click');
            return false;
        }
    });
}


function initializeMenuCategorySwitches() {
    $('.categoryFilter a').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var cat = $this.attr('href');
        $('.tab-pane' + cat).addClass('active').siblings('.active').removeClass('active');
        $this.parents('li').addClass('active').siblings('.active').removeClass('active');
    });
    $('.category-list a').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $li = $this.parents('li');
        var cat = $this.attr('href');
        var subcat = cat;
        if (!$li.hasClass('header')) {
            cat = $li.siblings('.header').children('a').attr('href');
        }
        $('.categoryFilter a[href="' + cat + '"]').trigger('click');
        var offset = $(subcat).offset().top;
        $('html,body').animate({scrollTop: offset});
    });
}

function arrangeThumbnails() {
    var w = $('.thumbnails .item').width();
    var $t = $('.thumbnail');
    var s = $t.outerWidth();
    var $container = $('.thumbnail-container');
    var c = $t.length;
    var p = parseInt((w - 5 * s) / 8);
    $t.css({margin: '1.2915em ' + p + 'px'});
    $container.width(c * s + 2 * p * (c - 1));
    $container.css({left: $container.position().left});
    initThumbnailScroll($t.length, 0, $container.position().left, p);

}
function initThumbnailScroll(thumbCount, currentThumb, startLeft, padding) {
    $('.thumbnails').on('click', '.carousel-control', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $container = $('.thumbnail-container');
        var n = 0;
        var l = 0;
        if ($this.hasClass('right')) {
            n = thumbCount - currentThumb - 5;
            if (n < 0) {
                n = 0;
            }
            if (n > 5) {
                n = 5;
            }
            l = padding - startLeft;
        }
        else {
            n = currentThumb;
            l = -startLeft;
            if (n > 5) {
                n = 5;
                l = -startLeft + padding;
            }
            n = -n;
        }

        if (Math.abs(n) <= 0) {
            return;
        }

        currentThumb += n;
        l += $('.thumbnail').eq(currentThumb).position().left;
        console.log(l);
        $container.animate({left: -l});

    });
}

function addTreatmentToSession(data, callback, error) {
    $.ajax({
        url: '/api/session_treatment',
        data: data,
        type: 'post',
        success: callback,
        error: error
    })
}

function removeTreatmentFromSession(data, callback, error) {
    $.ajax({
        url: '/api/session_treatment',
        data: data,
        type: 'delete',
        success: callback,
        error: error
    })
}

function addReview(data, callback, error) {
    $.ajax({
        url: '/api/venue/' + data.venueId + '/selfreview',
        type: 'post',
        data: data,
        success: callback,
        error: error
    })
}

function hookReviewSubmit() {
    $('#reviewSubmit').on('click', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var $alertAnchor = $btn.parent();
        var $review = $btn.parents('.review');
        var data = {};
        data.rating = $review.find('.js-rating input[name="score"]').val();
        data.remarks = $review.find('#remarks').val();
        data.venueId = $('#vid').val();
        $btn.addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i> Submitting');
        data.userId = getCookie('uid');
        if (!data.userId) {
            LOGIN_CALLBACK = function () {
                $btn.trigger('click');
            };
            login();
            $btn.removeClass('disabled').html('Submit');
            return;
        }
        if (!data.remarks) {
            createAlertAfter($alertAnchor, 'Please enter a remark');
            $btn.removeClass('disabled').html('Submit');
            return;
        }

        addReview(data, function (response) {
            if (response.success) {
                var rData = response.data;
                _trackReview(rData.venueId, venueName, rData.userId, rData.name, rData.rating, rData.remarks);
                insertReviewRow(rData);
                $btn.addClass('disabled').html('<i class="fa fa-check"></i> Submited');
            } else {
                createAlertAfter($alertAnchor, response.message);
                $btn.removeClass('disabled').html('Submit');
            }
        })
    });
}

function insertReviewRow(data) {
    var html = '<div class="row review">' +
        '<div class="username pull-left">' +
        '<span>' + data.name + '</span>' +
        '</div>' +
        '<div class="js-rating pull-right">';
    for (var i = 0; i < data.rating; i++) {
        html += '<img src="/img/bs-star.png" alt="rating">';
    }
    html += '</div>' +
    '<div class="remarks pull-left">' +
    '<span>' + data.remarks + '</span>' +
    '</div>' +
    '</div>';
    $('.reviews-block').eq(0).prepend(html).removeClass('hide').fadeOut(0).fadeIn();
    $('.first-reviewer').fadeOut();
}

function initFacilityToggle() {
    $('[data-toggle="facility"]').on('click', function (e) {
        var $elem = $(this).parent();
        $elem.addClass('hide');
        $elem.siblings('.facility-value').removeClass('hide');
    });
}