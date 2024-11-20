import axios from 'axios';
window.axios = axios;

axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
