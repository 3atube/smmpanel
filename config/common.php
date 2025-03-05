<?php

return [
    'timezone' => [
        -43200 => "(UTC -12:00) Baker/Howland Island",
        -39600 => "(UTC -11:00) Niue",
        -36000 => "(UTC -10:00) Hawaii-Aleutian Standard Time,
            Cook Islands, Tahiti",
        -34200 => "(UTC -9:30) Marquesas Islands",
        -32400 => "(UTC -9:00) Alaska Standard Time, Gambier
            Islands",
        -28800 => "(UTC -8:00) Pacific Standard Time,
            Clipperton Island",
        -25200 => "(UTC -7:00) Mountain Standard Time",
        -21600 => "(UTC -6:00) Central Standard Time",
        -18000 => "(UTC -5:00) Eastern Standard Time, Western
            Caribbean Standard Time",
        -16200 => "(UTC -4:30) Venezuelan Standard Time
        ",
        -14400 => "(UTC -4:00) Atlantic Standard Time, Eastern
            Caribbean Standard Time",
        -12600 => "(UTC -3:30) Newfoundland Standard Time
        ",
        -10800 => "(UTC -3:00) Argentina, Brazil, French
            Guiana, Uruguay",
        -7200 => "(UTC -2:00) South Georgia/South Sandwich
            Islands",
        -3600 => "(UTC -1:00) Azores, Cape Verde Islands
        ",
        0 => "(UTC) Greenwich Mean Time, Western European
            Time",
        3600 => "(UTC +1:00) Central European Time, West
            Africa Time",
        7200 => "(UTC +2:00) Central Africa Time, Eastern
            European Time, Kaliningrad Time",
        10800 => "(UTC +3:00) Moscow Time, East Africa Time,
            Arabia Standard Time",
        12600 => "(UTC +3:30) Iran Standard Time",
        14400 => "(UTC +4:00) Azerbaijan Standard Time, Samara
            Time",
        16200 => "(UTC +4:30) Afghanistan",
        18000 => "(UTC +5:00) Pakistan Standard Time,
            Yekaterinburg Time",
        19800 => "(UTC +5:30) Indian Standard Time, Sri Lanka
            Time",
        20700 => "(UTC +5:45) Nepal Time",
        21600 => "(UTC +6:00) Bangladesh Standard Time, Bhutan
            Time, Omsk Time",
        23400 => "(UTC +6:30) Cocos Islands,
            Myanmar",
        25200 => "(UTC +7:00) Krasnoyarsk Time, Cambodia,
            Laos, Thailand, Vietnam",
        28800 => "(UTC +8:00) Australian Western Standard
            Time, Beijing Time, Irkutsk Time",
        31500 => "(UTC +8:45) Australian Central Western
            Standard Time",
        32400 => "(UTC +9:00) Japan Standard Time, Korea
            Standard Time, Yakutsk Time",
        34200 => "(UTC +9:30) Australian Central Standard Time
        ",
        36000 => "(UTC +10:00) Australian Eastern Standard
            Time, Vladivostok Time",
        37800 => "(UTC +10:30) Lord Howe Island",
        39600 => "(UTC +11:00) Srednekolymsk Time, Solomon
            Islands, Vanuatu",
        41400 => "(UTC +11:30) Norfolk Island",
        43200 => "(UTC +12:00) Fiji, Gilbert Islands,
            Kamchatka Time, New Zealand Standard Time",
        45900 => "(UTC +12:45) Chatham Islands Standard Time
        ",
        46800 => "(UTC +13:00) Samoa Time Zone, Phoenix
            Islands Time, Tonga",
        50400 => "(UTC +14:00) Line Islands",
    ],
    'convert_time' => [
        -43200 => "-12:00",
        -39600 => "-11:00",
        -36000 => "-10:00",
        -34200 => "-9:30",
        -32400 => "-9:00",
        -28800 => "-8:00",
        -25200 => "-7:00",
        -21600 => "-6:00",
        -18000 => "-5:00",
        -16200 => "-4:30",
        -14400 => "-4:00",
        -12600 => "-3:30",
        -10800 => "-3:00",
        -7200 => "-2:00",
        -3600 => "-1:00",
        0 => "+00:00",
        3600 => "+1:00",
        7200 => "+2:00",
        10800 => "+3:00",
        12600 => "+3:30",
        14400 => "+4:00",
        16200 => "+4:30",
        18000 => "+5:00",
        19800 => "+5:30",
        20700 => "+5:45",
        21600 => "+6:00",
        23400 => "+6:30",
        25200 => "+7:00",
        28800 => "+8:00",
        31500 => "+8:45",
        32400 => "+9:00",
        34200 => "+9:30",
        36000 => "+10:00",
        37800 => "+10:30",
        39600 => "+11:00",
        41400 => "+11:30",
        43200 => "+12:00",
        45900 => "+12:45",
        46800 => "+13:00",
        50400 => "+14:00",
    ],
    'convert_vnd'=>1000,
    'convert_usd'=>23000,
    'status_order'=>[
        'pending'=>'Chờ xử lý',
        'finish'=>'Hoàn thành',
        'pending_checkout'=>'Chờ thanh toán'
    ],
    'payment_order'=>[
        'momo'=>'Chuyển toán qua MOMO',
        'bank'=>'Chuyển qua ATM'
    ],
    'modules'   => [
        'role'                  => 'phân quyền',
        'log'                   => 'log hệ thống',
        'options'               => 'cài đặt',
        'user'                  => 'thành viên',
        'promotion'             => 'mã khuyến mãi',
        'group_service'         => 'group service',
        'group_product'         => 'group product',
        'profile_custom'        => 'profile custom',
        'order'                 => 'order',
        'product'               => 'product',
        'service'               => 'service',
        'profile_service'       => 'profile service',
        'gallery'               => 'gallery',
        'customer'              => 'customer',
        'transaction'           => 'Giao dịch',
        'transaction_history'   => 'transaction_history',
        'order'                 => 'hóa đơn',
        'invoice_order'            =>'Giao dịch xu',
        'update_coin'            =>'Cập nhật giảm xu',
        'buy_product'            =>'Mua sản phẩm',
        'users'            =>'người dùng',
        'order_checkout'        =>'Order sản phẩm Cart'
    ],
    'actions'   => [
        'store'         => 'Thêm',
        'update'        => 'Cập nhật',
        'destroy'       => 'Xóa',
        'removeAll'     => 'Xóa tất cả',
        'approved'      => 'Phê duyệt',
        'not_approved'  => 'Không phê duyệt',
        'reply'         => 'Phản hồi',
        'send'          => 'Gửi tin nhắn',
        'changeList'    => 'Thay đổi danh sách',
    ],
];