<?php
// قائمة بالأيبيهات المعروفة لشبكات MikroTik
$known_ips = array(
    '172.16.0.1',
    '10.0.0.1',
    '1.1.1.1',
    '4.4.4.4',
    '0.0.0.0'
);

// تحقق من الأيبيات وقم بإعادة التوجيه عند العثور على أحد الأيبيهات
foreach ($known_ips as $ip) {
    // اختبار الاتصال بالأيبي للتحقق من الاستجابة
    $ch = curl_init("http://$ip/login");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); // زمن انتظار الاتصال
    curl_setopt($ch, CURLOPT_TIMEOUT, 3); // زمن انتظار الاستجابة

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // إذا تم العثور على الأيبي وتمكن الاتصال، قم بإعادة التوجيه إلى صفحة الهوتسبوت
    if ($http_code == 200) {
        $redirect_url = "http://$ip/login";
        header("Location: $redirect_url");
        exit;
    }
}

// إذا لم يتم العثور على أي من الأيبيهات المعروفة
echo "Unable to find MikroTik network. Please try again later.";
?>
