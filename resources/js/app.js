require('./bootstrap');
require('./sidebar');
window.$ = window.jQuery = require('jquery'); // <-- main, not 'slim'
require('jquery-ui');
window.Popper = require('popper.js');
require('./navbar');
