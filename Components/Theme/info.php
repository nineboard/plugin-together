<?php
return [
    'view' => 'theme',
    'setting' => [
        [
            'section' => [
                'class' => 'common',
                'title' => '일반'
            ],
            'fields' => [
                /* colorset */
                'colorset' => [
                    '_type' => 'select',
                    'label' => 'Colorset',
                    'options' => [
                        'blue' => 'Blue',
                        'orange' => 'Orange',
                        'green' => 'Green',
                        'gray' => 'Gray'
                    ]
                ],
            ]
        ],
        /* 헤더 설정 */
        [
            'section' => [
                'class' => 'header-section',
                'title' => '헤더 설정'
            ],
            'fields' => [
                /* 로고 설정 */
                'logoType' => [
                    '_type' => 'select',
                    'label' => 'Logo 설정',
                    'options' => [
                        'text' => 'Logo 텍스트 사용',
                        'image' => 'Logo 이미지 사용',
                    ]
                ],
                'logoText' => [
                    '_type' => 'langText',
                    'label' => 'Logo 텍스트',
                    'placeholder' => '상단에 표시될 사이트 이름 및 로고 이미지의 대체 텍스트',
                ],
                'logoImage' => [
                    '_type' => 'image',
                    'label' => 'Logo 이미지',
                    'description' => '흰색 배경용 로고 이미지'
                ],
                'logoImageWithBg' => [
                    '_type' => 'image',
                    'label' => 'Logo 이미지',
                    'description' => '컬러셋 색상 배경용 로고 이미지 (밝은색 및 투명 PNG 이미지 권장)'
                ],
                'mainMenu' => [
                    '_type' => 'menu',
                    'label' => '메인 메뉴 (GNB. 3 depth)',
                ],
            ]
        ],

        /* sidebar 설정 */
        [
            'section' => [
                'class' => 'sidebar-section',
                'title' => 'sidebar 설정'
            ],
            'fields' => [
                'useSnb' => [
                    '_type' => 'select',
                    'label' => 'SNB 사용 여부',
                    'options' => [
                        'N' => '사용 안함',
                        'Y' => '사용'
                    ]
                ],
                'sidebarMenu' => [
                    '_type' => 'menu',
                    'label' => 'sidebar 메뉴 (SNB, 1 depth)',
                ]
            ]
        ],

        /* Footer 설정 */
        [
            'section' => [
                'class' => 'footer-section',
                'title' => 'footer 설정'
            ],
            'fields' => [
                'footerMenu' => [
                    '_type' => 'menu',
                    'label' => 'footer 메뉴 (FNB. 1 depth)',
                ],
                /* footer 설정 */
                'useCopyright' => [
                    '_type' => 'select',
                    'label' => '푸터 영역 사용 여부',
                    'options' => [
                        'Y' => '사용',
                        'N' => '사용 안함'
                    ]
                ],
                'copyrightContent' => [
                    '_type' => 'textarea',
                    'label' => '카피라이트',
                    'description' => 'HTML사용 가능'
                ],
            ]
        ],
    ],
    'support' => [
        'mobile' => true,
        'desktop' => true
    ],
    'editable' => [
        'theme.blade.php',
        'frame.blade.php',
        'main.blade.php',
        'sub.blade.php',
        'gnb.blade.php',
        'fnb.blade.php'
    ]
];
