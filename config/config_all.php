<?php
return [
    //Color:9D1E21
    //### config all
    "config_base" => '',
    "config_url" => "acit-pmc",
    "config_all_url" => env('APP_URL') . "/acit-pmc",
    "debug_developer" => true,
    "ishost" => false,
    "sendmail" => false,
    "lockpage" => false,
    "data_demo" => false,

    "author" => [
        "name" => "",
        "email" => "",
        "website" => "",
        'hotline' => '',
        'appkey' => ''
    ],

    "arrayDomainSSL" => [],

    "lang" => [
        "vi" => "Tiếng Việt",
    ],

    "slug" => [
        "vi" => "Tiếng Việt",
    ],

    "seo" => [
        "vi" => "Tiếng Việt",
    ],

    "coupon" => [
        "active" => false,
    ],

    "filter_price" => [
        0 => 0,
        1 => 2000000,
        2 => 5000000,
        3 => 10000000,
        4 => 20000000,
        5 => 30000000,
        6 => 50000000,
        7 => 60000000
    ],

    "extension_img" => ['png', 'gif', 'jpg', 'webp', 'jpeg', 'pdf', 'docx', 'xlsx', 'JPG', 'PNG', 'GIF', 'JPEG'],
    "extension_video" => ['mp4'],

    "fileupload" => false,
    "autosave_time" => 10 * 60, //second

    "transport" => [
        "active" => false,
    ],

    "setting" => [
        "diachi" => false,
        "dienthoai" => false,
        "hotline" => true,
        "zalo" => true,
        "oaidzalo" => true,
        "email" => true,
        "website" => true,
        "fanpage" => true,
        "toado" => true,
        "toado_iframe" => true
    ],

    "order" => [
        "active" => false,
        "printOrder" => false,
        "search" => true
    ],

    "danhgia" => [
        'active' => false
    ],

    'login' => [
        'attempt' => 3,
        'delay' => 15
    ],

    "export_exel" => false,
    "import_exel" => false,

    /* Quản lý phân quyền */
    "permission" => false,

    /* Quản lý tỉnh thành */
    "places" => false,

    /* Quản lý menu */
    "menus" => false,

    /* Quản lý phân trang */
    "numberperpage" => [
        // number per page of product
        "category" => 6,
        "productman" => 6,
        "postman" => 6,
        "albumman" => 20,
        "post" => 6,
        // number per page of photo
        "photo" => 20,
        // number per page of size and color
        "color" => 20,
        "size" => 20,
        "brand" => 20,
        "tags" => 20,
        "newsletter" => 6,
        "contact" => 20,
        "coupon" => 20,
        "question" => 20,
    ],

    'folder_gallery' => [
        '1' => [
            'type'  => 'product',
            'name' => 'Thư mục sản phẩm'
        ],
        '2' => [
            'type'  => 'post',
            'name' => 'Thư mục bài viết'
        ],
        '3' => [
            'type'  => 'album',
            'name' => 'Thư mục album'
        ],
        '4' => [
            'type'  => 'photo',
            'name' => 'Thư mục hình ảnh'
        ]
    ],

    'payment_define' => false,
    'payment_method' => [
        '1' => [
            'name'  => 'Thanh toán khi nhận hàng (COD)',
            'color' => 'dark'
        ],
        '2' => [
            'name'  => 'Chuyển khoản ngân hàng',
            'color' => 'dark'
        ],
        '3' => [
            'name'  => 'Online quốc tế',
            'color' => 'dark'
        ],
        '4' => [
            'name'  => 'Online ATM',
            'color' => 'dark'
        ]
    ],
    'payment_status' => [
        '0' => [
            'name'  => 'Chưa thanh toán',
            'color' => 'danger'
        ],
        '1' => [
            'name'  => 'Đã thanh toán',
            'color' => 'success'
        ],
        '2' => [
            'name'  => 'Thanh toán không thành công',
            'color' => 'warning'
        ],
        '3' => [
            'name'  => 'Thanh toán không thành công',
            'color' => 'warning'
        ]
    ],
    'order_status' => [
        '1' => [
            'name'  => 'Mới đặt',
            'color' => 'primary'
        ],
        '2' => [
            'name'  => 'Đã xác nhận',
            'color' => 'info'
        ],
        '3' => [
            'name'  => 'Đang giao hàng',
            'color' => 'warning'
        ],
        '4' => [
            'name'  => 'Hoàn thành',
            'color' => 'success'
        ],
        '6' => [
            'name'  => 'Đang chuyển hoàn',
            'color' => 'info'
        ],
        '7' => [
            'name'  => 'Đã chuyển hoàn',
            'color' => 'success'
        ],
        '5' => [
            'name'  => 'Đã hủy',
            'color' => 'danger'
        ],
    ],
    'delivery_status' => [
        '1' => [
            'name'     => 'Mới đặt',
            'color'    => 'primary',
            'log_name' => 'Đã tiếp nhận',
            'log_text' => 'Đơn hàng đã được tiếp nhận thành công'
        ],
        '2' => [
            'name'     => 'Đã xác nhận',
            'color'    => 'info',
            'log_name' => 'Đã xác nhận',
            'log_text' => 'Đơn hàng đã được xác nhận'
        ],
        '3' => [
            'name'     => 'Đang giao hàng',
            'color'    => 'warning',
            'log_name' => 'Đang giao hàng',
            'log_text' => 'Đơn hàng đang được giao'
        ],
        '4' => [
            'name'     => 'Đã giao',
            'color'    => 'success',
            'log_name' => 'Đã giao',
            'log_text' => 'Đơn hàng đã được giao thành công'
        ],
        '5' => [
            'name'     => 'Đã hủy',
            'color'    => 'danger',
            'log_name' => 'Đã hủy',
            'log_text' => 'Đơn hàng đã hủy'
        ],
        '6' => [
            'name'     => 'Đang chuyển hoàn',
            'color'    => 'info',
            'log_name' => 'Đang chuyển hoàn',
            'log_text' => 'Đơn hàng đang chuyển hoàn'
        ],
        '7' => [
            'name'     => 'Đã chuyển hoàn',
            'color'    => 'success',
            'log_name' => 'Đã chuyển hoàn',
            'log_text' => 'Đơn hàng đã chuyển hoàn'
        ]
    ],
    'channel' => [
        '0' => [
            'name'  => 'Website',
            'color' => 'success',
            'active' => true
        ],
        '1' => [
            'name'  => 'Facebook',
            'color' => 'primary',
            'active' => false
        ],
        '2' => [
            'name'  => 'Shopee',
            'color' => 'danger',
            'active' => true
        ],
        '3' => [
            'name'  => 'Lazada',
            'color' => 'warning',
            'active' => true
        ],
        '4' => [
            'name'  => 'Tiki',
            'color' => 'info',
            'active' => false
        ],
        '5' => [
            'name'  => 'Khác',
            'color' => 'secondary',
            'active' => false
        ]
    ]
];
