<?php
// @see views/setting.blade.php
return [
   'setting' => [
       [
            'section' => [
                'class' => 'header-section',
                'title' => '헤더 설정'
            ],
           '_type' => 'select',
           '_section' => '기본설정',
           'fields' => [
                'listType' => [
                    '_type' => 'select',
                    'label' => '목록 형태',
                    'options' => [
                        'text' => '일반 목록',
                        'thumbnail' => 'Thumbnail 표시',
                        'gallery' => 'Gallery',
                    ]
                ],
           ]
       ],
   ],
   'support' => [
       'mobile' => true,
       'desktop' => true
   ]
];
