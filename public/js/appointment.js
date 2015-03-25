$(document).ready(function () {
    //HOOK UP BOOK ACTION
    $('#call').on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
            btnHtml = $this.html(),
            data;

        $this.addClass('disabled');
        $this.html('<i class="fa fa-spin fa-spinner"></i> SUBMITTING');
        data = {
            name: $.trim($('#name').val()),
            treatments: $('#treatments').val(),
            email: $('#email').val(),
            contact: $.trim($('#phone').val()),
            date: $.trim($('#date').val()),
            time: $.trim($('#time').val()),
            venueId: $.trim($('#venue').val()),
            userId: getCookie('uid'),
            _treatmentNames: $('#treatments').tagsinput('items')
        };
        if (validateAppointmentForm(data, $this, btnHtml)) {
            trackAppointmentSubmission(data);
            updateContact(data);
            bookAppointment(
                data,
                function (response) {
                    if (!response.success) {
                        createAlertAfter($this.parents('.form-footer'), response.message, 'danger small');
                        $this.removeClass('disabled');
                        $this.html(btnHtml);

                    }
                    else {
                        $this.html('<i class="fa fa-check"></i> SUBMITTED');
                        createAlertAfter($this.parents('.form-footer'), '<strong>Voila!</strong> You\'ll get a call soon. Thank you!', 'success small');
                    }
                },
                function (response) {
                    createAlertAfter($this.parents('.form-footer'), '<strong>Uhhh!</strong> Something wrong with our system', 'danger small');
                    $this.removeClass('disabled');
                    $this.html(btnHtml);
                }
            );
        }
    });


    //Initialize Tags
    initializeTagsInput($('#treatments'));

    //Initialize Date Time Pickers
    initializeDateTimePickers();

    //Add Session Treatments
    addSessionTreatments();
});

function bookAppointment(data, success, error) {
    $.ajax({
        url: '/api/appointment/',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: function (response) {
            success(response);
        },
        error: function (response) {
            error(response);
        }
    });
}

function validateAppointmentForm(data, $btn, btnHtml) {
    if (data.name == '') {
        createAlertAfter($btn.parents('.form-footer'), '<strong>Uh oh!</strong> You forgot to write your name', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#name').focus();
        return false;
    }

    if (!validateEmail(data.email)) {
        createAlertAfter($btn.parents('.form-footer'), '<strong>Uh oh!</strong> The E-Mail seems invalid', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#email').focus();
        return false;
    }

    if (!validateMobile(data.contact)) {
        createAlertAfter($btn.parents('.form-footer'), '<strong>Uh oh!</strong> The mobile number seems invalid', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#phone').focus();
        return false;
    }

    if (data.treatments == '') {
        createAlertAfter($btn.parents('.form-footer'), 'Please select at least one treatment', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#treatments').focus();
        return false;
    }

    if (data.date == '' || data.time == '') {
        createAlertAfter($btn.parents('.form-footer'), '<strong>Uh oh!</strong> You forgot to choose date and time', 'danger small');
        $btn.removeClass('disabled');
        $btn.html(btnHtml);
        $('#date').focus();
        return false;
    }
    return true;
}

function initializeTagsInput($element) {
    /*engine = new BloodHound({

     })*/
    $element.tagsinput({
        itemValue: 'value',
        itemText: 'text'
    });

    $element.tagsinput('input').typeahead({
        valueKey: 'text',
        local: substringMatcher(),
        template: '<p>{{text}}</p>',
        engine: Hogan
    }).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum);
        this.tagsinput('input').typeahead('setQuery', '');
    }, $element));
}
function substringMatcher(q, cb) {

    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    for (var i in menuItems) {

        var str = menuItems[i];
        /*if (substrRegex.test(str.itemName)) {*/
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({value: str.itemId, text: str.itemName});
        /*}*/
    }
    return matches;
    cb(matches);

}

function initializeDateTimePickers() {
    $('#date').datetimepicker({
        format: 'DD-MM-YYYY',
        pickTime: false,
        minDate: getYesterdayDate()
    });


    $('#time').datetimepicker({
        pickDate: false,
        minuteStepping: 30,
        useSeconds: false
    });

    var timeRange = getTimeRange(new moment());
    var now = new moment();
    if (timeRange.start.unix() >= timeRange.end.unix()) {
        $('#date').data("DateTimePicker").setMinDate(now);
        now.add('d', 1);
        timeRange = getTimeRange(now);
    }

    $('#time').data("DateTimePicker").setMinDate(timeRange.start);
    $('#time').data("DateTimePicker").setMaxDate(timeRange.end);
    $('#time').data("DateTimePicker").setDate(timeRange.start.add('m', 15));
    $('#date').data("DateTimePicker").setDate(now);

    $('#date').on('dp.change', function (e) {
        var timeRange = getTimeRange(e.date);
        $('#time').data("DateTimePicker").setMinDate(timeRange.start);
        $('#time').data("DateTimePicker").setMaxDate(timeRange.end);
        $('#time').data("DateTimePicker").setDate(timeRange.start.add('m', 15));
    });

    $('.form-group > i').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('input').focus();
    });
}

function getYesterdayDate() {
    var t = new Date();
    var y = new Date(t);
    y.setDate(t.getDate() - 1);
    return y;
}

function getTimeRange(date) {
    var moments = new moment(date);
    var now = new moment();
    var startTime = new moment(date);
    var endTime = new moment(date);
    var openingTimeComponents = parseTime(operationalTime.from);
    var closingTimeComponents = parseTime(operationalTime.to);

    startTime.hours(openingTimeComponents.hours);
    startTime.minutes(openingTimeComponents.minutes);


    endTime.hours(closingTimeComponents.hours);
    endTime.minutes(closingTimeComponents.minutes);

    if (moments.date() == now.date() && moments.month() == now.month()) {
        var m = (Math.round(now.minutes() / 30) * 30) % 60;
        var h = now.hours();
        h = now.minutes() > 31 ? (h === 23 ? 0 : ++h) : h;
        now.hours(h + 2);
        now.minutes(m);
        startTime = now

    }

    startTime.add('m', -15);
    endTime.add('m', -15);

    return {'start': startTime, 'end': endTime};
}

function parseTime(time) {
    var components = time.split(' ');
    var pTime = {hours: 0, minutes: 0};
    components[0] = components[0].split(':');
    pTime.hours = parseInt(components[0][0]);
    pTime.minutes = parseInt(components[0][1]);

    if (components[1].toLowerCase() == 'pm')
        pTime.hours += 12;

    return pTime;
}

function trackAppointmentSubmission(data) {
    var treatmentList = [];
    var venueName = $.trim($('.choice-venue h2').text());
    for (var i in data._treatmentNames) {
        treatmentList.push(data._treatmentNames[i].text);
    }
    _trackAppointmentSubmit(data.name, venueName, data.venueId, treatmentList, data.contact, data.email);
}

function updateContact(userInfo) {
    var shouldUpdate = getCookie('updateContact');
    if (shouldUpdate && shouldUpdate == '1') {
        var data = {contact: userInfo.contact};

        //Set Phone Number on Mixpanel if not set already
        _updateMixpanelContact(data.contact);

        $.ajax({
            url: '/api/user/' + userInfo.userId,
            type: 'PUT',
            data: data,
            success: function (response) {
                if (response.success) {
                    setCookie('updateContact', 0);
                }
            }
        })
    }
}

function addSessionTreatments() {
    for (var i = 0; i < menuItems.length; i++) {
        var item = menuItems[i];
        if (addedTreatments.indexOf(item.itemId.toString()) !== -1) {
            var datum = {
                value: item.itemId,
                text: item.itemName
            };
            $('#treatments').tagsinput('add', datum);
        }
    }
}