document.addEventListener('DOMContentLoaded', (e) => {
    console.log('onload', TEMPLATE_NAME);

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js?TEMPLATE_NAME=' + encodeURIComponent(TEMPLATE_NAME), { scop: './' })
            .then(function (registration) {
                console.log('sw registered', registration.scope)
            })
    }


    //for access to notification in web
    // Notification.requestPermission(function (status) {
    //     console.log('Notification permission status:', status);
    // });


    // function displayNotification() {
    //     if (Notification.permission == 'granted') {
    //         navigator.serviceWorker.getRegistration().then(function (reg) {
    //             var options = {
    //                 body: 'Here is a notification body!',
    //                 icon: 'images/example.png',
    //                 vibrate: [100, 50, 100],
    //                 data: {
    //                     dateOfArrival: Date.now(),
    //                     primaryKey: 1
    //                 }
    //             };
    //             reg.showNotification('Hello world!', options);
    //         });
    //     }
    // }
});
