require('./bootstrap');
import 'bootstrap';
import '@popperjs/core';
import Alpine from 'alpinejs';
import alertifyjs from 'alertifyjs';

window.Alpine = Alpine;
Alpine.start();
window.alertify = alertifyjs;
