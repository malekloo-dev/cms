document.addEventListener('DOMContentLoaded', (e) => {
    console.log('onload' ,TEMPLATE_NAME);
  
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js?TEMPLATE_NAME=' + encodeURIComponent(TEMPLATE_NAME),{scop:'./'})
        .then(function(registration){
            console.log('sw registered', registration.scope)
        })
    }
});