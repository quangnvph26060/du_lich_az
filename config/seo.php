<?php

return [
    // Danh sách các rule SEO và điểm số tương ứng
    'rules' => [
        'keyword_in_title' => [
            'enabled' => true,
            'score' => 10,
        ],
        'keyword_in_description' => [
            'enabled' => true,
            'score' => 10,
        ],
        'keyword_density' => [
            'enabled' => true,
            'score' => 15,
            'min' => 1.0, // %
            'max' => 2.5, // %
        ],
        'internal_link' => [
            'enabled' => true,
            'score' => 10,
        ],
        'image_alt' => [
            'enabled' => true,
            'score' => 10,
        ],
        'heading_structure' => [
            'enabled' => true,
            'score' => 10,
        ],
        'meta_tag' => [
            'enabled' => true,
            'score' => 10,
        ],
        // Thêm các rule khác nếu cần
    ],

    // Tổng điểm SEO tối đa
    'max_score' => 75,

    // Danh sách stopwords (có thể mở rộng hoặc lấy từ file ngoài)
    'stopwords' => [
        'và', 'là', 'của', 'cho', 'có', 'một', 'các', 'những', 'được', 'trong', 'với', 'từ', 'đến', 'khi', 'này', 'đó',
        // ...
    ],

    // Ngưỡng đánh giá điểm SEO
    'score_thresholds' => [
        'good' => 60,
        'average' => 40,
        'bad' => 0,
    ],

    // Các cấu hình khác nếu cần
]; 