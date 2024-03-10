<?php
//Thông tin cấu hình
//define('URL_DEMO', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);
// define('URL_DEMO', env('APP_URL'));
$urlDemo = env('APP_URL');
$urlCallback = $urlDemo . '/alepay/success';
return [
    "payment_online" => false,
    "momo" => [
        "active" => false,
        "type" => "sandbox",
        "sandbox" => array(
            "partnerCode" => "",
            "accessKey" => "",
            "secretKey" => "",
            "endpoint" => "https://test-payment.momo.vn"
        ),
        "live" => array(
            "partnerCode" => "",
            "accessKey" => "",
            "secretKey" => "",
            "endpoint" => "https://payment.momo.vn"
        )
    ],
    "alepay" => [
        "active" => false,
        "type" => "sandbox",
        "sandbox" => array(
            "apiKey" => "RAtsJtjGkBMhsyL2WtTPYXvhCv1EO6", //Là key dùng để xác định tài khoản nào đang được sử dụng.
            "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCAlVcdhGxD93gD8NS59lqAgHBOeRMWSzUOHmcYctgIYRxt8AU/6HaVRiG1KL052cdfCPXd9t70380gyLm3TA3LkOsDhsa4VX3j0hVhF0g/LqkzgCtWyPPY1KQukWprH5MOuGHm/aJSYv7YG64SsIZEtYTUlBLyCtjOjFYRD4Si0wIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
            "checksumKey" => "j69gHfvBLaAbK1nemWlBdH3nrymqsH", //Là key dùng để tạo checksum data.
            "callbackUrl" => $urlCallback,
            "env" => "test",
        ),
        "live" => array(
            "apiKey" => "XRmL9aua13UEkv9hIfnMMVaG8i1A4Q", //Là key dùng để xác định tài khoản nào đang được sử dụng.
            "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCA5+Ia7Mts3ndPpnOxpkRgTi4wjh0J6siDWI+Gu+rh9Z8MCMIKoL5I9LSKGfOtXuEjNNltBGnqKnHprtewB3cXN2jNIFeiKTXgXG/lzWSeJ6+XXEGMiI8uyMy/Lao1xB1jbITalGQyzgi727O6+4g7FlTOm+kCj9FwGCNi9vk1NQIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
            "checksumKey" => "GAHYPCSr7VZqCxMwfS4QbRc26Lc63s", //Là key dùng để tạo checksum data.
            "callbackUrl" => $urlCallback,
            "env" => "live",
        ),
        'payment_method' => [
            'COD' => [
                'name'  => 'Thanh toán khi nhận hàng COD',
                'color' => 'dark'
            ],
            'alepay' => [
                'name'  => 'Thanh toán online qua cổng Alepay',
                'color' => 'dark'
            ],
            'alepay-domestic' => [
                'name'  => 'Thanh toán trả góp qua cổng Alepay',
                'color' => 'dark'
            ]
        ],
    ],
    "nganluong" => [
        "active" => false,
        "type" => "live",
        "sandbox" => [
            "URL_API" => "https://sandbox.nganluong.vn:8088/nl35/checkout.api.nganluong.post.php",
            "RECEIVER" => "anbinh.itweb@gmail.com",
            "MERCHANT_ID" => "51063",
            'MERCHANT_PASS' => '8474a26bc293e51883957fdc56531950'
        ],
        "live"=> [
            "URL_API" => "https://www.nganluong.vn/checkout.api.nganluong.post.php",
            "RECEIVER" => "minhhieu@lovefishaqua.com.vn",
            "MERCHANT_ID" => "66216",
            'MERCHANT_PASS' => "42979bdc11a51d9c283720714520f685"
        ],
        'payment_method' => [
            'COD' => [
                'name'  => 'Thanh toán khi nhận hàng COD',
                'color' => 'dark'
            ],
            'VISA' => [
                'name'  => 'Thanh toán thẻ quốc tế',
                'color' => 'dark'
            ],
            'ATM_ONLINE' => [
                'name'  => 'Thanh toán online bằng thẻ ngân hàng nội địa',
                'color' => 'dark'
            ]
        ],
    ],

];
