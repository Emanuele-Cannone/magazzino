import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
// import swipePlugin from "alpinejs-swipe";
import "https://hammerjs.github.io/dist/hammer.js";

window.Alpine = Alpine;

Alpine.plugin(focus);
// Alpine.plugin(swipePlugin);

Alpine.start();
