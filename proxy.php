<?php
// إعدادات البروكسي
$proxy_ip = '192.18.151.166';
$proxy_port = 8888;

// عنوان URL المطلوب
$url = $_GET['url'];

// تهيئة cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PROXY, $proxy_ip);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);

// إرسال الطلب
$response = curl_exec($ch);

// معالجة أي أخطاء
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// إغلاق cURL
curl_close($ch);

// إرسال الاستجابة إلى العميل
echo $response;
?>
