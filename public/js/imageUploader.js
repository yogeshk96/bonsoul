ImageUploader = function () {

};

ImageUploader.prototype.setFilepickerKey = function (key) {
    this.apiKey = key;
    filepicker.setKey(this.apiKey);
};


ImageUploader.prototype.createDragDropPane = function (element, options) {
    if (!options) {
        options = {};
    }
    if (!options.onSuccess) {
        options.onSuccess = this.onSuccess;
    }
    if (!options.onStart) {
        options.onStart = this.onStart;
    }
    if (!options.multiple) {
        options.multiple = true;
    }
    if (!options.access) {
        options.access = 'public';
    }
    options.extensions = '.jpg, .jpeg, .png';
    filepicker.makeDropPane(element, options);
};

ImageUploader.prototype.onStart = function (files) {
    for (var i in files) {
        $('#venueCarousel').find('.imgUHolder').eq(i).find('.imgU').html('<i class="fa fa-spin fa-spinner"></i> Uploading');
        $('.thumbnails').find('.imgUHolder').eq(i).find('.imgU').html('<i class="fa fa-spin fa-spinner"></i> Uploading');
    }
};

ImageUploader.prototype.onSuccess = function (inkBlobs) {
    console.log(inkBlobs);
    for (var i in inkBlobs) {
        var h = $('#venueCarousel').find('.imgUHolder').eq(0),
            t = $('.thumbnail.imgUHolder').eq(0);
        storeOriginalImage(inkBlobs[i], h);
        storeThumb(inkBlobs[i], t)
    }
};

ImageUploader.prototype.createButton = function ($element) {
    var options = {};
    if (!options.onSuccess) {
        options.onSuccess = this.onSuccess;
    }
    if (!options.onStart) {
        options.onStart = this.onStart;
    }
    if (!options.multiple) {
        options.multiple = true;
    }
    if (!options.access) {
        options.access = 'public';
    }
    options.extensions = '.jpg, .jpeg, .png';
    $element.on('click', function (e) {
        filepicker.pick(
            options,
            function (inkBlob) {
                options.onStart([inkBlob]);
                options.onSuccess([inkBlob]);
            }
        );
    });
};

var previewCheckbox = function () {
    var rand = parseInt(Math.random() * 1000);
    return '<div class="preview-image"><input type="radio" id="c' + rand + '" name="previewImage"><label for="c' + rand + '"><span></span>Preview Image</label></div>';

};

var deleteButton = function () {
    return '<a class="delete" href="#"><i class="fa fa-minus-circle"></i></a>';

};

var convertImage = function (inkBlob, path, w, h, callback) {
    var options = {
        width: w,
        height: h,
        fit: 'clip',
        rotate: 'exif'
    };
    var storageOptions = {
        location: 'S3',
        path: IMG_PATH_PREFIX + path,
        access: 'public'
    };

    filepicker.convert(
        inkBlob,
        options,
        storageOptions,
        callback
    );
};

var storeOriginalImage = function (inkBlob, $elem) {
    var path = 'originals/' + inkBlob.key;
    var width = 1000;
    var height = 563;
    convertImage(inkBlob, path, width, height, function (inkBlob) {
        var imgUrl = inkBlob.url;
        $elem.css({'background-image': 'url(' + imgUrl + ')'}).html(deleteButton() + previewCheckbox()).removeClass('imgUHolder').removeClass('empty');
        $elem.attr('data-key', inkBlob.key);
    });
};

var storeThumb = function (inkBlob, $thumb) {
    var path = 'thumbs/' + inkBlob.key;
    var width = 90;
    var height = 90;
    convertImage(inkBlob, path, width, height, function (inkBlob) {
        var imgUrl = inkBlob.url;
        $thumb.removeClass('imgUHolder empty').find('.imgU').css({'background-image': 'url(' + imgUrl + ')'}).html('').attr('data-key', inkBlob.key);
        $thumb.off('click');
    });
};