require('./bootstrap');
require('./sidebar');
window.$ = window.jQuery = require('jquery'); // <-- main, not 'slim'
require('jquery-ui');
window.Popper = require('popper.js');
require('./navbar');
require('slick-carousel');
require('./slider');
require('@fortawesome/fontawesome-free');
window.ZXing = require('@zxing/library');

$(function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
})
