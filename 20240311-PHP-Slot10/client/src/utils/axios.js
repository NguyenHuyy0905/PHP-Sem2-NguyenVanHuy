import _axios from 'axios';
import Cookies from 'js-cookie';

const axios = _axios.create({
    baseURL: 'http://localhost:8000/api',
});

// Thêm interceptor để tự động thêm token vào mỗi yêu cầu
axios.interceptors.request.use(function (config) {
    const accessToken = Cookies.get('access_token');
    if (accessToken) {
        config.headers['Authorization'] = `Bearer ${accessToken}`;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});

export default axios;