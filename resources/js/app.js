import './bootstrap';

import $ from 'jquery';

window.$ = window.jQuery = $;

import ('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js').then(function() {
        $('#categories').select2()
});



//await import ('jquery-ui');
//await import ('jquery-multiselect');




import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
