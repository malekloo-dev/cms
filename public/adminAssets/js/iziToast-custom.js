$.iziQuestion = function (title, message) {
    return new Promise(function(resolve) {
        iziToast.question({
            timeout: false,
            close: false,
            closeOnEscape: true,
            overlay: true,
            displayMode: 2,
            backgroundColor: '#FFF',
            zindex: 999,
            title: title,
            message: message,
            position: 'topCenter',
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            transitionInMobile: 'fadeInDown',
            transitionOutMobile: 'fadeOutUp',
            buttons: [
                ['<button class="btn btn-success mat-elevation-z mat-button radius-all pull-right text-white width-70">Yes</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOutUp' }, toast, 'button');

                    resolve(true);
                }, true],
                ['<button class="btn btn-link mat-button radius-all pull-right text-danger text-13 width-70">No</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOutUp' }, toast, 'button');

                    resolve(false);
                }]
            ]
        });
    });
};

$.iziQuestionDelete = function (title, message) {
    return new Promise(function(resolve) {
        iziToast.error({
            timeout: false,
            close: false,
            closeOnEscape: true,
            overlay: true,
            displayMode: 2,
            iconColor: '#ff1908',
            icon: 'fa fa-trash',
            iconText: '',
            titleColor: '#85251d',
            messageColor: '#ff1908',
            backgroundColor: '#FFF',
            zindex: 999,
            title: title,
            message: message,
            position: 'topCenter',
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            transitionInMobile: 'fadeInDown',
            transitionOutMobile: 'fadeOutUp',
            buttons: [
                ['<button class="btn btn-danger mat-elevation-z mat-button radius-all pull-right text-white width-70">Yes</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOutUp' }, toast, 'button');

                    resolve(true);
                }, true],
                ['<button class="btn btn-link mat-button radius-all pull-right text-black text-13 width-70">No</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOutUp' }, toast, 'button');

                    resolve(false);
                }]
            ]
        });
    });
};

$.iziQuestionConnect = function (title, message) {
    return new Promise(function(resolve) {
        iziToast.warning({
            timeout: false,
            close: true,
            closeOnEscape: false,
            overlay: false,
            displayMode: 2,
            iconColor: '#ff1908',
            icon: 'fa fa-refresh',
            iconText: '',
            titleColor: '#85251d',
            backgroundColor: '#FFF',
            messageColor: '#ffad46',
            zindex: 999,
            title: title,
            message: message,
            target: '.chat-list-container',
            position: 'bottomCenter',
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            transitionInMobile: 'fadeInDown',
            transitionOutMobile: 'fadeOutUp',
            buttons: [
                ['<button class="btn btn-success mat-elevation-z mat-button radius-all pull-right text-white width-70">Connect</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOutUp' }, toast, 'button');

                    resolve(true);
                }, true]
            ]
        });
    });
};

$.iziSuccess = function (title, message) {
    iziToast.success({
        timeout: 5000,
        title: title,
        message: message,
        iconColor: '#FFF',
        closeOnEscape: true,
        icon: 'fa fa-check',
        iconText: '',
        titleColor: '#FFF',
        messageColor: '#FFF',
        backgroundColor: '#4caf50',
        displayMode: 2,
        position: 'topCenter',
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutUp',
        transitionInMobile: 'fadeInDown',
        transitionOutMobile: 'fadeOutUp'
    });
};

$.iziError = function(title, message) {
    iziToast.error({
        timeout: 5000,
        title: title,
        message: message,
        iconColor: '#FFF',
        icon: 'fa fa-ban',
        iconText: '',
        closeOnEscape: true,
        titleColor: '#FFF',
        messageColor: '#FFF',
        backgroundColor: '#ff1908',
        displayMode: 2,
        position: 'topCenter',
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutUp',
        transitionInMobile: 'fadeInDown',
        transitionOutMobile: 'fadeOutUp'
    });
};

$.iziWarning = function(title, message) {
    iziToast.warning({
        timeout: 5000,
        title: title,
        closeOnEscape: true,
        displayMode: 2,
        message: message,
        backgroundColor: '#FFC107',
        position: 'topCenter',
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutUp',
        transitionInMobile: 'fadeInDown',
        transitionOutMobile: 'fadeOutUp'
    });
};