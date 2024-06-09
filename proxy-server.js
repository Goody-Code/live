const express = require('express');
const { createProxyMiddleware } = require('http-proxy-middleware');

const app = express();

// إعداد وكيل للطلبات
app.use('/proxy', createProxyMiddleware({
    target: 'https://www.aflam4you.net', // نطاق مصدر الفيديو
    changeOrigin: true,
    pathRewrite: {
        '^/proxy': '', // إزالة `/proxy` من المسار
    },
}));

// بدء الخادم على المنفذ 3000
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Proxy server is running on https://live-wppi.onrender.com/`);
});
