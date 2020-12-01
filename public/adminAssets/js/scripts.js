$(document).ready(function() {
    var $body = $('body'),
        $toggleSideBar = $('#toggleSideBar'),
        $sideBar = $('.side-left');

    $toggleSideBar.on('click', function () {
        $sideBar.toggleClass('active');

        if ($sideBar.hasClass('active')) {
            $toggleSideBar.find('i').removeClass('fa-bars').addClass('fa-times');
        } else {
            $toggleSideBar.find('i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    $('[title]').tooltip()

});

