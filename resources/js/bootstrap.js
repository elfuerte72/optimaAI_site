import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Импортируем Vue
import { createApp } from 'vue';
window.Vue = { createApp };
