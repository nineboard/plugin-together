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
                    'description' => '상단에 표시될 사이트 이름 및 로고 이미지의 대체 텍스트',
                ],
                'logoImage' => [
                    '_type' => 'image',
                    'label' => 'Logo 이미지',
                    'description' => 'Logo 이미지'
                ],
                'slogan' => [
                    '_type' => 'langText',
                    'label' => 'slogan',
                    'description' => 'slogan',
                ],
                'mainMenu' => [
                    '_type' => 'menu',
                    'label' => '메인 메뉴 (GNB. 3 depth)',
                ],
            ]
        ],

        /* 메인페이지 설정 */
        [
            'section' => [
                'class' => 'main-section',
                'title' => '메인페이지 설정'
            ],
            'fields' => [
                'useMainHeader' => [
                    '_type' => 'select',
                    'label' => 'useMainHeader',
                    'options' => [
                        'Y' => '표시함',
                        'N' => '표시 안 함'
                    ],
                    'description' => '메인 Header 사용함?'
                ],
                /* 헤더 이미지 설정 */
                'headerImage' => [
                    '_type' => 'image',
                    'label' => 'Header 이미지',
                    'description' => 'Header 이미지'
                ],
                'headerTitle' => [
                    '_type' => 'langText',
                    'label' => 'headerTitle',
                    'description' => 'headerTitle',
                ],
                'headerDescription' => [
                    '_type' => 'langText',
                    'label' => 'headerDescription',
                    'description' => 'headerDescription',
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

        /* social link */
        [
            'section' => [
                'class' => 'social-section',
                'title' => 'social 설정'
            ],
            'fields' => [
                'socialTwitter' => [
                    '_type' => 'text',
                    'label' => 'socialTwitter',
                ],
                'socialYoutube' => [
                    '_type' => 'text',
                    'label' => 'socialYoutube',
                ],
                'socialInstagram' => [
                    '_type' => 'text',
                    'label' => 'socialInstagram',
                ],
                'socialFacebook' => [
                    '_type' => 'text',
                    'label' => 'socialFacebook',
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
                'useCopyright' => [
                    '_type' => 'select',
                    'label' => 'Copyright 표시 여부',
                    'options' => [
                        'Y' => '사용',
                        'N' => '사용 안함'
                    ]
                ],
                'copyrightContent' => [
                    '_type' => 'textarea',
                    'label' => '카피라이트',
                    'description' => 'HTML사용 가능'
                ]
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
