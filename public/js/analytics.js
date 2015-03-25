function initMixpanel() {
    (function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
        for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;a.src="//cdn.mxpnl.com/libs/mixpanel-2.2.min.js";e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
    mixpanel.init(MIXPANEL_TOKEN);
}

function _trackSearch(city, category, locality) {
    if (!checkIfAdmin())
        mixpanel.track('search', {
            city: city,
            category: category,
            locality: locality
        });
}

function _trackAppointmentPage(venueName, venueId) {
    if (!checkIfAdmin())
        mixpanel.track('booking page viewed', {
            name: venueName,
            id: venueId
        });
}

function _trackAppointmentSubmit(name, venueName, venueId, treatments, contact, email) {
    if (!checkIfAdmin())
        mixpanel.track('call requested', {
            name: name,
            venueName: venueName,
            venueId: venueId,
            treatments: treatments,
            contact: contact,
            email: email
        });
}

function _initMixpanelProfile(id) {
    if (!checkIfAdmin())
        mixpanel.identify(id);
}

function _createMixpanelProfile(data) {
    if (!checkIfAdmin()) {
        mixpanel.people.set({
            $name: data.name,
            $email: data.email,
            $contact: data.contact,
            $created: new Date()
        });
    }
}

function _trackPageView() {
    if (!checkIfAdmin())
        mixpanel.track('Viewed Page', {
            URL: window.location.pathname,
            Title: document.title
        });
}

function _trackVenueView(venueName, venueId) {
    if (!checkIfAdmin())
        mixpanel.track('venue viewed', {
            Name: venueName,
            Id: venueId
        });
}

function _trackLoggedIn(userId, userName, email, method) {
    if (!checkIfAdmin()) {
        mixpanel.track('Logged In', {
            'User Id': userId,
            'Name': userName,
            Email: email,
            Method: method
        });
    }
}

function _trackLoggedOut() {
    if (!checkIfAdmin()) {
        mixpanel.track('Logged Out', {
            'User Id': getCookie('uid')
        });
        mixpanel.cookie.clear();
    }
}

function _trackSignedUp(userId, userName, email, method) {
    if (!checkIfAdmin()) {
        mixpanel.track('Signed Up', {
            'User Id': userId,
            'Name': userName,
            Email: email,
            Method: method
        });
    }
}

function _updateMixpanelContact(contact) {
    if (!checkIfAdmin()) {
        mixpanel.people.set({
            $contact: contact
        });
    }
}

function _trackReview(venueId, venueName, userId, userName, rating, remarks) {
    if (!checkIfAdmin()) {
        mixpanel.track('Reviewed Venue', {
            'User Id': userId,
            'Name': userName,
            'Venue Id': venueId,
            'Venue Name': venueName,
            'Rating': rating,
            'Remarks': remarks
        });
    }
}

function _trackEditProfile(userId, name, email, contact) {
    if (!checkIfAdmin()) {
        mixpanel.track('Updated Profile', {
            'User Id': userId,
            'Name': name,
            'E-Mail': email,
            'Contact': contact
        });
        var profile = {
            $name: name
        };
        if (contact) {
            profile.$contact = contact;
        }
        mixpanel.people.set(profile);
    }
}

function _trackChangePassword(userId, name, email) {
    if (!checkIfAdmin()) {
        mixpanel.track('Changed Password', {
            'User Id': userId,
            'Name': name,
            'E-Mail': email
        });
    }
}

function _trackForgotPassword(email) {
    if (!checkIfAdmin()) {
        mixpanel.track('Requested Password Reset', {
            'E-Mail': email
        });
    }
}

function _trackPasswordReset(key) {
    if (!checkIfAdmin()) {
        mixpanel.track('Reset Password', {
            'Reset Key': key
        });
    }
}

function _trackShowVenueContact(venueName, venueId) {
    if (!checkIfAdmin()) {
        mixpanel.track('Viewed Venue Contact', {
            'Venue Name': venueName,
            'Venue Id': venueId
        });
    }
}

function _trackShowVenueReviews(venueName, venueId) {
    if (!checkIfAdmin()) {
        mixpanel.track('Viewed Venue Reviews', {
            'Venue Name': venueName,
            'Venue Id': venueId
        });
    }
}

initMixpanel();