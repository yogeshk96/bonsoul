UserLocation = function () {
    this.latitude = 0;
    this.longitude = 0;
    this.city = '';
    this.state = '';
    this.country = '';
    this.callback = function () {
    };
    this.locality = '';
    this.cityId = -1;
};

UserLocation.prototype.detect = function () {
    if (navigator.geolocation) {
        var t = this;
        navigator.geolocation.getCurrentPosition(function (p) {
            t.loadPosition(p);
        }, this.errorHandler);
    }
};

UserLocation.prototype.loadPosition = function (position) {
    this.latitude = position.coords.latitude;
    this.longitude = position.coords.longitude;
    this.getAddress();
};

UserLocation.prototype.errorHandler = function () {

};

UserLocation.prototype.getAddress = function () {
    var url = 'https://maps.googleapis.com/maps/api/geocode/json?sensor=false&latlng=' +
        this.latitude +
        ',' +
        this.longitude +
        '';

    var t = this;
    $.ajax({
        url: url,
        success: function (response) {
            if (response.status == "OK") {
                console.log(response.results);
                var components = response.results[0].address_components;
                for (i in components) {
                    if (components[i].types.indexOf('locality') != -1) {
                        t.city = components[i].long_name;
                    }
                    else if (components[i].types.indexOf('sublocality') != -1) {
                        t.locality = components[i].long_name;
                    }
                    else if (components[i].types.indexOf('administrative_area_level_1') != -1) {
                        t.state = components[i].long_name;
                    }

                }
            }
            t.loadCityId();
            t.callback();
        }
    });
};

UserLocation.prototype.loadCityId = function () {
    this.cityId = getCityIdFromName(this.city);
};

UserLocation.prototype.getLocalityCoordinates = function (locality, city) {
    if (!locality)
        locality = this.locality;

    if (!city)
        city = this.city;

    var url = 'https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=' +
        locality.replace(' ', '+') +
        '+' +
        city;
    var t = this;
    var coords = {};
    $.ajax({
        url: url,
        async: false,
        success: function (response) {
            if (response.status == "OK") {
                var flag = false;
                var components = response.results[0].address_components;
                for (var i in components) {
                    if (locality!='' && components[i].types.indexOf('sublocality') != -1) {
                        flag = true;
                        break;
                    }
                    else if(components[i].types.indexOf('locality') != -1){
                        flag = true;
                        break;
                    }
                }
                if (flag)
                    coords = response.results[0].geometry.location;
            }
        }
    });
    return coords;
};