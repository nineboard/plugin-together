<?php

return [
    'view' => 'theme',
    'setting' => [
        /* 헤더 설정 */
        [
            'section' => [
                'class' => 'common-section',
                'title' => '일반 설정',
            ],
            'fields' => [
                'layoutType' => [
                    '_type' => 'select',
                    'label' => '레이아웃 형태',
                    'options' => [
                        'sub' => '서브 페이지용',
                        'main' => '메인 페이지용',
                    ],
                ],
                'mainMenu' => [
                    '_type' => 'menu',
                    'label' => '메인 메뉴',
                    'description' => '3단계까지 출력 가능',
                ],
            ],
        ],

        /* 헤더 설정 */
        [
            'section' => [
                'class' => 'header-section',
                'title' => '헤더 설정',
            ],
            'fields' => [
                /* 로고 설정 */
                'logoType' => [
                    '_type' => 'select',
                    'label' => '로고 설정',
                    'options' => [
                        'text' => '로고 텍스트 사용',
                        'image' => '로고 이미지 사용',
                    ],
                ],
                'logoText' => [
                    '_type' => 'langText',
                    'label' => '로고 텍스트',
                    'description' => '상단에 표시될 사이트 이름 및 로고 이미지의 대체 텍스트',
                ],
                'logoImage' => [
                    '_type' => 'image',
                    'label' => '로고 이미지',
                    'description' => '로고 이미지',
                ],
                'slogan' => [
                    '_type' => 'langText',
                    'label' => '슬로건',
                ],
            ],
        ],

        /* 메인페이지 설정 */
        [
            'section' => [
                'class' => 'main-section',
                'title' => '메인페이지 설정',
            ],
            'fields' => [
                'useMainHeader' => [
                    '_type' => 'select',
                    'label' => '메인 헤더 출력 여부',
                    'options' => [
                        'Y' => '표시함',
                        'N' => '표시 안 함',
                    ],
                ],
                /* 헤더 이미지 설정 */
                'headerImage' => [
                    '_type' => 'image',
                    'label' => '헤더 이미지',
                ],
                'headerTitle' => [
                    '_type' => 'langTextarea',
                    'label' => '헤더 제목',
                ],
                'headerDescription' => [
                    '_type' => 'langTextarea',
                    'label' => '헤더 설명',
                ],
            ],
        ],

        /* sidebar 설정 */
        [
            'section' => [
                'class' => 'sidebar-section',
                'title' => '사이드바 설정',
            ],
            'fields' => [
                'useSnb' => [
                    '_type' => 'select',
                    'label' => '사이드바 사용 여부',
                    'options' => [
                        'N' => '사용 안함',
                        'Y' => '사용',
                    ],
                ],
                'sidebarMenu' => [
                    '_type' => 'menu',
                    'label' => '사이드바 메뉴',
                    'description' => '1단계까지 출력 가능',
                ],
            ],
        ],

        /* social link */
        [
            'section' => [
                'class' => 'social-section',
                'title' => 'SNS 설정',
            ],
            'fields' => [
                'socialTwitter' => [
                    '_type' => 'text',
                    'label' => '트위터 링크',
                ],
                'socialYoutube' => [
                    '_type' => 'text',
                    'label' => '유튜브 링크',
                ],
                'socialInstagram' => [
                    '_type' => 'text',
                    'label' => '인스타그램 링크',
                ],
                'socialFacebook' => [
                    '_type' => 'text',
                    'label' => '페이스북 링크',
                ],
            ],
        ],

        /* Footer 설정 */
        [
            'section' => [
                'class' => 'footer-section',
                'title' => '푸터 설정',
            ],
            'fields' => [
                'useCopyright' => [
                    '_type' => 'select',
                    'label' => 'Copyright 표시 여부',
                    'options' => [
                        'Y' => '사용',
                        'N' => '사용 안함',
                    ],
                ],
                'copyrightContent' => [
                    '_type' => 'textarea',
                    'label' => 'Copyright',
                    'description' => 'HTML사용 가능',
                ],
            ],
        ],
    ],
    'support' => [
        'mobile' => true,
        'desktop' => true,
    ],
    'editable' => [
        'theme.blade.php',
        'frame.blade.php',
        '_footer.blade.php',
        '_header.blade.php',
        '_sidebar.blade.php',
    ],
];
