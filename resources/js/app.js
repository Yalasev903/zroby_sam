// Подключаем Bootstrap и его компоненты, включая JavaScript
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.min.js'; // Подключаем сам Bootstrap JS
import 'bootstrap/dist/css/bootstrap.min.css'; // Стили Bootstrap

// Подключаем Popper.js (необходим для некоторых компонентов Bootstrap, включая модальные окна)
import { createPopper } from '@popperjs/core'; // Убедись, что Popper.js подключен правильно

// Подключаем jQuery, если он нужен для других компонентов
import $ from 'jquery'; // Загружаем jQuery

// Устанавливаем глобальные переменные для jQuery
window.$ = window.jQuery = $;

// Логируем, что Bootstrap загружен, чтобы проверить подключение
console.log('Bootstrap Loaded:', typeof bootstrap !== 'undefined');
