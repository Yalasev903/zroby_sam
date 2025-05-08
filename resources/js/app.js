import './bootstrap';
import '../css/app.css';
// ✅ Bootstrap
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// ✅ Alpine.js (Jetstream)
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// ✅ jQuery (если нужно)
import $ from 'jquery';
window.$ = window.jQuery = $;

// Проверка
console.log('Bootstrap Loaded:', typeof bootstrap !== 'undefined');
