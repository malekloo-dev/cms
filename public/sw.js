var cacheName = 'home';
const TEMPLATE_NAME = new URL(location).searchParams.get('TEMPLATE_NAME');

var filesToCache = [
    '/',
    TEMPLATE_NAME+'/style.css',
    TEMPLATE_NAME+'/img/logo1x.png',
    TEMPLATE_NAME+'/img/logo2x.png'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function(e) {
    console.log('install');
    e.waitUntil(
        caches.open(cacheName).then(function(cache) {
        return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', (e)=>{
    console.log('activate');
})

/* Serve cached content when offline */
self.addEventListener('fetch', function(e) {
    console.log('fetch');
    e.respondWith(
        caches.match(e.request).then(function(response) {
        return response || fetch(e.request);
        })
    );
});
